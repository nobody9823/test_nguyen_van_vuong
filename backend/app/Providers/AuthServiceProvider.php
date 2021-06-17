<?php

namespace App\Providers;

use App\Models\MessageContent;
use App\Models\Option;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Plan;
use App\Models\Project;
use App\Models\UserPlanCheering;
use App\Policies\MessageContentPolicy;
use App\Policies\OptionPolicy;
use App\Policies\PlanPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\UserPlanCheeringPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Project::class => ProjectPolicy::class,
        Plan::class => PlanPolicy::class,
        UserPlanCheering::class => UserPlanCheeringPolicy::class,
        MessageContent::class => MessageContentPolicy::class,
        Option::class => OptionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
