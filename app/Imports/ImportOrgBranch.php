<?php

namespace App\Imports;

use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Org\Entities\OrgBranch;

class ImportOrgBranch implements ToModel, WithStartRow, WithHeadingRow
{
    public function model(array $row)
    {
        $parent_id = 0;
        if (empty($row['name'])) {
            Toastr::error('Group Name is required','Error');
            return null;
        }
        if (empty($row['code'])) {
            Toastr::error('Group Code is required','Error');
            return null;
        }
        if (!empty($row['parent_code'])) {
            $parent = OrgBranch::where('code', $row['parent_code'])->first();
            if (!$parent) {
                Toastr::error($row['parent_code'] . ' Is a invalid parent code','Error');
                return null;
            } else {
                $parent_id = $parent->id;
            }
        }

        $check = OrgBranch::where('code', $row['code'])->first();
        if ($check) {
            Toastr::error($row['code'] . ' Is a already added','Error');
            return null;
        }


        return new OrgBranch([
            'group' => $row['name'],
            'code' => $row['code'],
            'parent_id' => $parent_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
