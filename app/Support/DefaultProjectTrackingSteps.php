<?php

namespace App\Support;

use Illuminate\Support\Collection;

class DefaultProjectTrackingSteps
{
    public static function order(): Collection
    {
        return self::commonOrder();
    }

    public static function commonOrder(): Collection
    {
        return collect([
            self::step('order', 1, 'Requirement Submitted', 'Your requirement has been submitted successfully.', 'completed'),
            self::step('order', 2, 'Under Review', 'Our team is reviewing your requirement.', 'completed'),
            self::step('order', 3, 'Call Scheduled / Team Contacted You', 'Our representative has reached out to you within 24 working hours.', 'completed'),
        ]);
    }

    public static function execution(): Collection
    {
        return collect();
    }

    public static function all(): Collection
    {
        return self::order()->merge(self::execution());
    }

    public static function orderWithAdminSteps(Collection $adminSteps): Collection
    {
        return self::commonOrder()->merge(self::renumberAdminOrderSteps($adminSteps));
    }

    public static function allWithAdminSteps(Collection $adminSteps): Collection
    {
        $orderSteps = self::orderWithAdminSteps($adminSteps->where('tab_type', 'order')->values());
        $executionSteps = $adminSteps->where('tab_type', 'execution')->values();

        return $orderSteps->merge($executionSteps);
    }

    private static function renumberAdminOrderSteps(Collection $steps): Collection
    {
        return $steps->values()->map(function ($step, $index) {
            $step = clone $step;
            $step->step_order = $index + 4;

            return $step;
        });
    }

    private static function step(
        string $tabType,
        int $order,
        string $title,
        ?string $description,
        string $status,
        string $type = 'normal',
        ?string $buttonText = null
    ): object {
        return (object) [
            'tab_type' => $tabType,
            'step_order' => $order,
            'step_title' => $title,
            'step_description' => $description,
            'step_type' => $type,
            'status' => $status,
            'status_default' => $status,
            'button_text' => $buttonText,
            'input_value' => null,
        ];
    }
}
