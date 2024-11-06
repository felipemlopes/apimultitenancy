<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'name' => 'gfcustomizados',
            'db_connection' => 'gf',
            'db_name' => 'gfcustomizados',
            'db_user' => 'root',
            'db_password' => '',
            'db_host' => '127.0.0.1',
            'db_port' => '3306',
        ]);
        Tenant::create([
            'name' => 'devgfbd',
            'db_connection' => 'devgf',
            'db_name' => 'devgfbd',
            'db_user' => 'root',
            'db_password' => '',
            'db_host' => '127.0.0.1',
            'db_port' => '3306',
        ]);
    }
}
