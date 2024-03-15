<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            'Dumbo Raya',
            'Dungingi',
            'Hulonthalangi',
            'Kota Barat',
            'Kota Selatan',
            'Kota Tengah',
            'Kota Timur',
            'Kota Utara',
            'Sipatana'
        ];

        foreach ($districts as $district) {
            $data = District::where('name', $district)->exists();

            if ($data) {
                return;
            }

            District::create([
                'name' => $district
            ]);
        }
    }
}
