<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Hector company',
            'rut' => '77.231.446-7',
            'email' => 'hector@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
        Company::create([
            'name' => 'Ricardo company',
            'rut' => '77.2234.4456-7',
            'email' => 'ricardo@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
        Company::create([
            'name' => 'Patricia company',
            'rut' => '77.344.456-7',
            'email' => 'patricia@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
        Company::create([
            'name' => 'Karen company',
            'rut' => '77.234.434-4',
            'email' => 'karen@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
        Company::create([
            'name' => 'Maria company',
            'rut' => '77.234.456-6',
            'email' => 'maria@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
        Company::create([
            'name' => 'Cesar company',
            'rut' => '77.234.456-2',
            'email' => 'cesar@company.com',
            'phone' => '995774087',
            'representante-legal' => 'Luis Andrade'
        ]);
    }
}
