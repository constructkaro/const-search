<?php

namespace App\Support;

use Illuminate\Support\Collection;

class DefaultProjectTrackingSteps
{
    public static function order(): Collection
    {
        return collect([
            self::step('order', 1, 'Requirement Submitted', 'Your requirement has been submitted successfully.', 'completed'),
            self::step('order', 2, 'Under Review', 'Our team is reviewing your requirement.', 'completed'),
            self::step('order', 3, 'Call Scheduled / Team Contacted You', 'Our representative has reached out to you within 24 working hours.', 'completed'),
            self::step('order', 4, 'Do you want ConstructKaro to execute your project?', null, 'pending', 'choice'),
            self::step('order', 5, 'Rate Discussion', 'We will discuss pricing, scope, and execution details with you.', 'pending', 'choice'),
            self::step('order', 6, 'Agreement Sent to Email', 'Please check your email and complete the agreement signing.', 'locked', 'download', 'Download Agreement'),
            self::step('order', 7, 'Payment Stage', 'Please complete payment to proceed.', 'locked', 'payment', 'Payment'),
            self::step('order', 8, 'Work Will Start Within 7 Days', 'Our team will begin work at your site shortly.', 'locked'),
        ]);
    }

    public static function execution(): Collection
    {
        return collect([
            self::step('execution', 1, 'Site Visit Completed', 'Engineer visited site, measurements verified, site condition checked.', 'completed'),
            self::step('execution', 2, 'Final Design & Planning Approved', 'Design and planning will be reviewed and approved before execution.', 'completed'),
            self::step('execution', 3, 'BOQ & Budget Finalized', 'Material list, cost estimate, and project scope will be confirmed.', 'completed'),
            self::step('execution', 4, 'Foundation Work Started', 'Excavation, layout marking, and structural base work will begin.', 'pending'),
            self::step('execution', 5, 'Structure Work', 'Columns, beams, slab, wall construction, and structural frame work will progress.', 'locked'),
            self::step('execution', 6, 'Finishing Work', 'Plastering, flooring, painting, plumbing, and electrical work will be tracked.', 'locked'),
            self::step('execution', 7, 'Final Quality Check', 'Quality inspection, safety verification, and final review will be completed.', 'locked'),
            self::step('execution', 8, 'Project Completed', 'Your project is ready.', 'locked'),
        ]);
    }

    public static function all(): Collection
    {
        return self::order()->merge(self::execution());
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
