<?php

namespace App\SOLID\OCP\Good;

interface PromotionRuleInterface
{
    public function calculate(): int;
}
