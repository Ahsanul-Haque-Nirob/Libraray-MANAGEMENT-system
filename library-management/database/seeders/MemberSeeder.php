<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Alice Johnson',  'email' => 'alice@example.com',  'phone' => '555-0101', 'address' => '123 Maple St, Springfield', 'status' => 'active'],
            ['name' => 'Bob Smith',      'email' => 'bob@example.com',    'phone' => '555-0102', 'address' => '456 Oak Ave, Shelbyville',   'status' => 'active'],
            ['name' => 'Carol White',    'email' => 'carol@example.com',  'phone' => '555-0103', 'address' => '789 Pine Rd, Capital City',  'status' => 'active'],
            ['name' => 'David Brown',    'email' => 'david@example.com',  'phone' => '555-0104', 'address' => '321 Elm Blvd, Ogdenville',   'status' => 'inactive'],
            ['name' => 'Eva Martinez',   'email' => 'eva@example.com',    'phone' => '555-0105', 'address' => '654 Cedar Ln, North Haverbrook', 'status' => 'active'],
        ];

        foreach ($members as $data) {
            Member::create([
                'member_code'      => 'LIB-' . strtoupper(uniqid()),
                'name'             => $data['name'],
                'email'            => $data['email'],
                'phone'            => $data['phone'],
                'address'          => $data['address'],
                'membership_start' => now()->subYear()->toDateString(),
                'membership_end'   => now()->addYear()->toDateString(),
                'status'           => $data['status'],
            ]);
        }

        // Extra random members
        Member::factory(15)->active()->create();
    }
}
