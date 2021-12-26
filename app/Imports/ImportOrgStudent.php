<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportOrgStudent implements ToModel, WithStartRow, WithHeadingRow, WithValidation
{

    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email',
            'employee_id' => 'required|unique:users,employee_id',
            'position_code' => 'required',
            'name' => 'required',
            'org_chart_code' => 'required',
        ];

    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'The Email has already been taken',
            'employee_id.unique' => 'The Employee ID has already been taken',
            'email.required' => 'Email is required',
            'name.required' => 'Name is required',
            'employee_id.required' => 'Employee ID is required',
            'position_code.required' => 'Position Code is required',
            'org_chart_code.required' => 'Org Chart Code is required',
        ];
    }

    public function model(array $row)
    {
        $name = $row['name'];
        $org_chart_code = $row['org_chart_code'];
        $position_code = $row['position_code'];
        $email = $row['email'];
        $employee_id = $row['employee_id'];
        $birthday = $row['birthday'] ?? null;
        $start_working_date = $row['start_working_date'] ?? null;
        $gender = $row['gender'] ?? null;
        $phone = $row['phone'] ?? null;


        $new_student = new User([
            'name' => $name,
            'org_chart_code' => $org_chart_code,
            'org_position_code' => $position_code,
            'email' => strtolower($email),
            'employee_id' => $employee_id,
            'dob' => $birthday,
            'start_working_date' => $start_working_date,
            'gender' => $gender,
            'phone ' => $phone,
            'password ' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        send_email($new_student, 'Offline_Enrolled', ['email' => $new_student->email]);

        return $new_student;
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
