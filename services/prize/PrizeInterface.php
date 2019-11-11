<?php

namespace app\services\prize;

interface PrizeInterface
{
    /**
     * Generates a prize value
     */
    public function generate();

    /**
     * Refuses a prize
     */
    public function refuse($model);
}