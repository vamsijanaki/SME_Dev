<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Org\Entities\OrgBranch;

class AllOrgBranch implements FromView
{
    public function view(): View
    {
        $branches = OrgBranch::where('parent_id', '0')->orderBy('order', 'asc')->get();
        return view('org::exports.all_branches', [
            'branches' => $branches
        ]);
    }
}
