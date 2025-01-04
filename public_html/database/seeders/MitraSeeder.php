<?php

namespace Database\Seeders;

use App\Models\V1\Tani;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tani::create([
            'title' => 'sekarsari'
        ]);

        Tani::create([
            'title' => 'magersari'
        ]);
    }
}
