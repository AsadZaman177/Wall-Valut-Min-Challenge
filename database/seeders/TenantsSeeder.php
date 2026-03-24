<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <=2; $i++) {
             User::create([
                'crp_id' => Str::uuid(),
                'name' => 'Tenant'.$i,
                'email' => 'tenant'.$i.'@gmail.com',
                'password' => bcrypt('tenant1234'),
             ]);
        }
    }
}
