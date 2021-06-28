<?php

namespace App\Services\Plan;

class CalculationForPrice {

    protected static $price_amount = 0;

    public static function getPriceAmount($plan_request, $plans)
    {
        foreach($plans as $plan){
            $price = $plan->price;
            $plan_amount = $plan_request[$plan->id];
            self::$price_amount += $price * $plan_amount;
        }
        return self::$price_amount;
    }
}