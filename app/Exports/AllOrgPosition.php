<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Org\Entities\OrgPosition;

class AllOrgPosition implements FromView
{
    public function view(): View
    {
        $positions = OrgPosition::orderBy('order', 'asc')->get();
        return view('org::exports.all_positions', [
            'positions' => $positions
        ]);
    }
}
