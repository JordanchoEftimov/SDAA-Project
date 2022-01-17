<?php

namespace Database\Seeders;

use App\Models\BusStop;
use Illuminate\Database\Seeder;

class BusStopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusStop::truncate();

        $csvFile = fopen(base_path("database/data/bus_stops.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                BusStop::create([
                    "number" => $data['1'],
                    "name" => $data['2'],
                    "lat" => $data['3'],
                    "lon" => $data['4']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
