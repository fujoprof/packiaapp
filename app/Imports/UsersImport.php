<?php

namespace App\Imports;

use App\Models\User;
use App\Models\User_Permission;
use App\Models\Profile_Detail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Step 1: Insert user data
        $user = User::create([
            "first_name" => $row['first_name'],
            "middle_name" => $row['middle_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "address" => $row['address'],
            "phone_number" => $row['phone_number'],
            'date_of_birth' => Carbon::createFromFormat('d/m/Y', $row['date_of_birth'])->format('Y-m-d'),
            "gender" => $row['gender'],
            "password" => Hash::make($row['password'])
        ]);
        // Step 2: Retrieve the ID of the inserted user
        $userId = $user->id;

        // Step 3: Insert a permission for the user
        User_Permission::create([
            "user_id" => $userId,
            "permission_id" => 2, // Assuming permission_id 5 is for a specific permission
            'created_at' => now(), // Provide created_at timestamp
            'updated_at' => now(), // Provide updated_at timestamp
        ]);

        // Step 3: Insert a permission for the user
        Profile_Detail::create([
            "user_id" => $userId,
            "biography" => "Update your Bio here.........", // Assuming permission_id 5 is for a specific permission
            'created_at' => now(), // Provide created_at timestamp
            'updated_at' => now(), // Provide updated_at timestamp
        ]);

        // Return null to prevent duplicate entries in the users table
        return null;
    }
}
