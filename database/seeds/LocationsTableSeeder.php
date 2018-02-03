<?php

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map( 'str_getcsv', file( public_path('act_comercial.csv') ) );
        
        foreach ($csv as $row)
        {
            Location::create([
                'access_code' => $row[0],
                'address' => utf8_encode($row[1]),
                'epigraph_iae' => $row[2],
                'epigraph_desc' => utf8_encode($row[3]),
                'lat' => (double) str_replace(',', '.', $row[4]),
                'lng' => (double) str_replace(',', '.', $row[5]),
            ]);
        }
    }
}
