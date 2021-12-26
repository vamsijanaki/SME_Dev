<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SampleOrgBranch implements FromView
{
    public function view(): View
    {
        return view('org::exports.sample');
    }
}
