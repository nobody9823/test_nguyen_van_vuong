<?php

namespace App\Services\Payment;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

trait includedPlans {

    public function includedPlansByArrayPlan(array $array_plan)
    {
        $plans = $this->updatePlans($array_plan);

        $this->includedPlans()->attach($plans->pluck('id'));
    }

    protected function getPlansByIds($plan_ids)
    {
        return Plan::whereIn('id', $plan_ids)->get();
    }

    protected function updatePlans(array $array_plan)
    {
        $plans = $this->getPlansByIds(array_keys($array_plan));

        foreach($plans as $plan){
            $plan->limit_of_supporters = $array_plan[$plan->id];
            $plan->save();
        }
        return $plans;
    }
}
