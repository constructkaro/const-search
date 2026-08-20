<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class OtpService
{
    private string $provider;

    public function __construct()
    {
        $this->provider = (string) config('services.otp.provider', 'twilio');
    }

    public function send(string $mobile): array
    {
        return match ($this->provider) {
            'local', 'log' => $this->sendLocalOtp($mobile),
            'realtime' => $this->sendWithRealtime($mobile),
            default => $this->sendWithTwilio($mobile),
        };
    }

    public function verify(string $mobile, string $otp): bool
    {
        return match ($this->provider) {
            'local', 'log', 'realtime' => $this->verifyCachedOtp($mobile, $otp),
            default => $this->verifyTwilioOtp($mobile, $otp),
        };
    }

    private function sendLocalOtp(string $mobile): array
    {
        $otp = (string) random_int(100000, 999999);
        $this->storeOtp($mobile, $otp);

        Log::info('Local customer OTP generated.', [
            'mobile' => $mobile,
            'otp' => $otp,
        ]);

        return [
            'status' => true,
            'provider_status' => 'sent',
            'debug_otp' => config('app.debug') ? $otp : null,
        ];
    }

    private function sendWithTwilio(string $mobile): array
    {
        $twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $verification = $twilio->verify->v2
            ->services(config('services.twilio.verify_sid'))
            ->verifications
            ->create('+91' . $mobile, 'sms');

        return [
            'status' => true,
            'provider_status' => $verification->status,
        ];
    }

    private function verifyTwilioOtp(string $mobile, string $otp): bool
    {
        $twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $check = $twilio->verify->v2
            ->services(config('services.twilio.verify_sid'))
            ->verificationChecks
            ->create([
                'to' => '+91' . $mobile,
                'code' => $otp,
            ]);

        return $check->status === 'approved';
    }

    private function sendWithRealtime(string $mobile): array
    {
        $endpoint = config('services.realtime_otp.endpoint');

        if (!$endpoint) {
            throw new \RuntimeException('Realtime OTP endpoint is not configured.');
        }

        $otp = (string) random_int(100000, 999999);
        $message = str_replace(
            ['{otp}', '{mobile}'],
            [$otp, $mobile],
            (string) config('services.realtime_otp.message')
        );

        $payload = $this->buildRealtimePayload($mobile, $otp, $message);
        $request = Http::timeout((int) config('services.realtime_otp.timeout', 15))
            ->acceptJson();

        $authHeader = config('services.realtime_otp.auth_header');
        $apiKey = config('services.realtime_otp.api_key');

        if ($authHeader && $apiKey) {
            $request = $request->withHeaders([$authHeader => $apiKey]);
        }

        $method = strtoupper((string) config('services.realtime_otp.method', 'POST'));
        $response = $method === 'GET'
            ? $request->get($endpoint, $payload)
            : $request->post($endpoint, $payload);

        if (!$response->successful()) {
            throw new \RuntimeException('Realtime OTP API request failed.');
        }

        $successPath = config('services.realtime_otp.success_path');
        $successValue = config('services.realtime_otp.success_value');

        if ($successPath) {
            $actual = Arr::get($response->json() ?? [], $successPath);

            if ($successValue !== null && (string) $actual !== (string) $successValue) {
                throw new \RuntimeException('Realtime OTP API returned an unsuccessful response.');
            }

            if ($successValue === null && !$actual) {
                throw new \RuntimeException('Realtime OTP API returned an unsuccessful response.');
            }
        }

        $this->storeOtp($mobile, $otp);

        return [
            'status' => true,
            'provider_status' => 'sent',
        ];
    }

    private function verifyCachedOtp(string $mobile, string $otp): bool
    {
        $cached = Cache::get($this->cacheKey($mobile));

        if (!$cached || !isset($cached['hash'])) {
            return false;
        }

        $valid = hash_equals(
            $cached['hash'],
            hash_hmac('sha256', $otp, (string) config('app.key'))
        );

        if ($valid) {
            Cache::forget($this->cacheKey($mobile));
        }

        return $valid;
    }

    private function storeOtp(string $mobile, string $otp): void
    {
        Cache::put($this->cacheKey($mobile), [
            'hash' => hash_hmac('sha256', $otp, (string) config('app.key')),
        ], now()->addMinutes((int) config('services.realtime_otp.ttl_minutes', 10)));
    }

    private function buildRealtimePayload(string $mobile, string $otp, string $message): array
    {
        $payload = [];
        $mobileField = (string) config('services.realtime_otp.mobile_field', 'mobile');
        $messageField = (string) config('services.realtime_otp.message_field', 'message');
        $otpField = config('services.realtime_otp.otp_field');

        $payload[$mobileField] = config('services.realtime_otp.include_country_code', true)
            ? '91' . $mobile
            : $mobile;
        $payload[$messageField] = $message;

        if ($otpField) {
            $payload[$otpField] = $otp;
        }

        $extra = config('services.realtime_otp.extra', []);

        return array_merge(is_array($extra) ? $extra : [], $payload);
    }

    private function cacheKey(string $mobile): string
    {
        return 'customer_otp:' . sha1($mobile);
    }
}
