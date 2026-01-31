<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'users.view'],
            ['name' => 'users.create'],
            ['name' => 'users.update'],

            ['name' => 'roles.view'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],

            ['name' => 'permissions.view'],
            ['name' => 'permissions.create'],
            ['name' => 'permissions.update'],

            ['name' => 'new_stocks.view'],
            ['name' => 'new_stocks.create'],
            ['name' => 'new_stocks.update'],

            ['name' => 'inventories.view'],
            ['name' => 'inventories.create'],
            ['name' => 'inventories.update'],

            ['name' => 'schools.view'],
            ['name' => 'schools.create'],
            ['name' => 'schools.update'],

            ['name' => 'bookshops.view'],
            ['name' => 'bookshops.create'],
            ['name' => 'bookshops.update'],

            ['name' => 'requisitions.view'],
            ['name' => 'requisitions.create'],
            ['name' => 'requisitions.update'],

            ['name' => 'returns.view'],
            ['name' => 'returns.create'],
            ['name' => 'returns.update'],

            ['name' => 'requests.view'],
            ['name' => 'requests.create'],
            ['name' => 'requests.update'],

            ['name' => 'sales.view'],
            ['name' => 'sales.create'],
            ['name' => 'sales.update'],

            ['name' => 'invoices.view'],
            ['name' => 'invoices.create'],
            ['name' => 'invoices.update'],

            ['name' => 'payments.view'],
            ['name' => 'payments.create'],
            ['name' => 'payments.update'],

            ['name' => 'zonal_sales_officers.view'],
            ['name' => 'zonal_sales_officers.create'],
            ['name' => 'zonal_sales_officers.update'],

            ['name' => 'zones.view'],
            ['name' => 'zones.create'],
            ['name' => 'zones.update'],

            ['name' => 'territories.view'],
            ['name' => 'territories.create'],
            ['name' => 'territories.update'],

            ['name' => 'subjects.view'],
            ['name' => 'subjects.create'],
            ['name' => 'subjects.update'],

            ['name' => 'levels.view'],
            ['name' => 'levels.create'],
            ['name' => 'levels.update'],

            ['name' => 'books.view'],
            ['name' => 'books.create'],
            ['name' => 'books.update'],

            ['name' => 'reports.view'],

            ['name' => 'dashboards.operational'],
            ['name' => 'dashboards.financial'],
        ];

        $time_stamp = Carbon::now()->toDateTimeString();

        foreach ($data as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name'], 'guard_name' => 'web'],
                ['created_at' => $time_stamp, 'updated_at' => $time_stamp]
            );
        }
    }
}
