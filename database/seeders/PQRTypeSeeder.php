<?php

namespace Database\Seeders;

use App\Models\PQRType;
use Illuminate\Database\Seeder;

class PQRTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pqrTypes = [
            'Petición',
            'Queja',
            'Reclamo',
        ];

        foreach ($pqrTypes as $pqrType) {
            PQRType::create(['name' => $pqrType]);
        }
    }
}
