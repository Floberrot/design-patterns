<?php

namespace App\SOLID\OCP\Good;

class CustomerPromotionRule implements PromotionRuleInterface
{

    public function calculate(): int
    {
        // here we can implement the logic to calculate the promotion
        return 10;
    }
}
