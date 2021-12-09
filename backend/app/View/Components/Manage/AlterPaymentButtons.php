<?php

namespace App\View\Components\Manage;

use App\Models\Project;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class AlterPaymentButtons extends Component
{
    public $payments;
    public $project;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($payments)
    {
        $this->payments = $payments;
        $this->project = Project::find(Request::get('project'))->getLoadIncludedPaymentsCountAndSumPrice();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manage.alter-payment-buttons');
    }
}
