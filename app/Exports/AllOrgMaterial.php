<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Org\Entities\OrgMaterial;

class AllOrgMaterial implements FromView
{
    public function view(): View
    {
        $materials = OrgMaterial::with('user')->get();
        return view('org::exports.all_materials', [
            'materials' => $materials
        ]);
    }
}
