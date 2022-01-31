<?php

namespace Database\Seeders;

use App\Models\Show;
use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Show::create([
            "name" => 'Breaking Bad',
        ], [
            "name" => 'Better Call Saul',
        ]);
    }
}
