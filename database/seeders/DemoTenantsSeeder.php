<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stancl\Tenancy\Tenancy;
use Stancl\Tenancy\Database\Models\Tenant;


class DemoTenantsSeeder extends Seeder
{
    public function run(): void
    {
        // if not exists, create alpha & bravo
        foreach (['alpha', 'bravo'] as $id) {
            Tenant::firstOrCreate(['id' => $id]);
        }
    }
}
