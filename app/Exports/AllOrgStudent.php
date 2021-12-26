<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllOrgStudent implements FromView
{
    public function view(): View
    {
        $students = User::where('role_id', 3)->where('teach_via', 1)->get();
        return view('org::exports.all_students', [
            'students' => $students
        ]);
    }
}
