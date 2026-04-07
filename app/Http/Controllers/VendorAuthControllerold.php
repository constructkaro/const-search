<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;
use Throwable;

class VendorAuthController extends Controller
{
    protected Client $twilio;
    protected string $verifySid;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $this->verifySid = config('services.twilio.verify_sid');
    }

    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'mobile' => ['required', 'digits:10'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $mobile = '+91' . $request->mobile;

        try {
            $verification = $this->twilio->verify->v2
                ->services($this->verifySid)
                ->verifications
                ->create($mobile, 'sms');

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully.',
                'verification_status' => $verification->status,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'mobile' => ['required', 'digits:10'],
                'otp' => ['required', 'digits_between:4,10'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $mobile = '+91' . $request->mobile;

        try {
            $check = $this->twilio->verify->v2
                ->services($this->verifySid)
                ->verificationChecks
                ->create([
                    'to' => $mobile,
                    'code' => $request->otp,
                ]);

            if ($check->status !== 'approved') {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expired OTP.',
                ], 422);
            }

            $vendor = Vendor::where('mobile', $request->mobile)->first();

            if ($vendor) {
                session(['vendor_id' => $vendor->id]);

                return response()->json([
                    'status' => true,
                    'message' => 'Mobile verified successfully.',
                    'redirect' => route('vendor.dashboard'),
                ]);
            }

            session(['vendor_mobile' => $request->mobile]);

            return response()->json([
                'status' => true,
                'message' => 'Mobile verified successfully. Please complete registration.',
                'redirect' => route('vendor.register.form'),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'OTP verification failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function vendor_dashboard(){
        return view('vendor.vendor_dashboard');
    }
}