<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportRegularStudent implements ToModel, WithStartRow, WithHeadingRow, WithValidation
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ];

    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'The Email has already been taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum 8 character',
        ];
    }

    public function model(array $row)
    {
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];

        $new_student = new User([
            'name' => $name,
            'email' => strtolower($email),
            'password ' => Hash::make($password),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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
