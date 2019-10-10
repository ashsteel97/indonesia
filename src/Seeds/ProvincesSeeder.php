<?php

namespace Laravolt\Indonesia\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesSeeder extends Seeder
{
    public function run()
    {
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/provinces.csv';
        $header = ['id', 'name', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header);
        $data = array_map(function ($arr) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);
            return $arr + ['created_at' => now(), 'updated_at' => now()];
        }, $data);

        DB::table(config('laravolt.indonesia.table_prefix').'provinces')->insert($data);
    }
}
