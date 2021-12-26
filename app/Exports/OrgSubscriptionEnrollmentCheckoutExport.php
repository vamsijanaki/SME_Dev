<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\OrgSubscription\Entities\OrgSubscriptionCheckout;

class OrgSubscriptionEnrollmentCheckoutExport implements FromView
{
    public function view(): View
    {
        $students = OrgSubscriptionCheckout:: with('plan', 'user')->latest()->get();
        return view('orgsubscription::enrollment.export',compact('students'));
    }
}
