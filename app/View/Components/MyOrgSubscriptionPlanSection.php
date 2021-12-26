<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Modules\OrgSubscription\Entities\OrgSubscriptionCheckout;

class MyOrgSubscriptionPlanSection extends Component
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }


    public function render()
    {
        $plans = OrgSubscriptionCheckout::where('user_id', Auth::user()->id)->with('plan', 'plan.assign')->get();
        return view(theme('components.my-org-subscription-plan-section'), compact('plans'));
    }
}
