<?php

namespace App\SOLID\OCP\Bad;

class PromotionRule
{
    public function calculatePromotion(string $type): int
    {
        /// This method violates the Open/Closed Principle because it requires modification
        /// to add new promotion rules for different types.
        /// If a new type is added, we need to modify this method.
        return match ($type) {
            'employee' => 10,
            'invoice' => 5,
            'order' => 15,
            'report' => 20,
            'customer' => 8,
            'product' => 12,
            default => 0,
        };
    }
}
