<?php

namespace App\Console\Commands;

use App\City;
use App\District;
use App\Province;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetupCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup cities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Province::truncate();
        City::truncate();
        District::truncate();

        if ($this->hasOption('legacy'))
        {
            $this->legacy();
        }
        else {
            $this->setupCities();
        }
    }

    private function setupCities()
    {
        $this->setProvinces();
        $this->setRegencies();
        $this->setDistricts();
    }

    private function setProvinces()
    {
        $provinceFile = fopen(resource_path('data/provinces.csv'), 'r');

        $provinces = [];

        while(!feof($provinceFile))
        {
            $line = fgetcsv($provinceFile);

            $provinces[] = [
                'id' => $line[0],
                'name' => ucwords(strtolower($line[1])),
            ];
        }

        fclose($provinceFile);

        foreach($provinces as $province)
        {
            if (is_null($province['id']))
            {
                continue;
            }
            Province::create([
                'id' => $province['id'],
                'name' => $province['name'],
            ]);
        }

        $this->info("Provinces added!");
    }

    private function setRegencies()
    {
        $file = fopen(resource_path('data/regencies.csv'), 'r');

        $items = [];

        while(!feof($file))
        {
            $line = fgetcsv($file);

            if (is_null($line[0]))
            {
                continue;
            }

            $name = (strtolower($line[2]));
            $regency = false;

            if (str_contains(strtolower($name), 'kabupaten '))
            {
                $name = str_replace('kabupaten ', '', $name);
                $regency = true;
            }

            if (str_contains(strtolower($name), 'kota '))
            {
                $name = str_replace('kota ', '', $name)." kota";

                $regency = false;
            }

            $items[] = [
                'id' => $line[0],
                'province_id' => $line[1],
                'name' => ucwords($name),
//                'regency' => $regency,
            ];
        }

        fclose($file);

        DB::table('cities')->insert($items);

        $this->info("cities added!");
    }

    private function setDistricts()
    {
        $file = fopen(resource_path('data/districts.csv'), 'r');

        $items = [];

        while(!feof($file))
        {
            $line = fgetcsv($file);

            if (is_null($line[0]))
            {
                continue;
            }

            $items[] = [
                'id' => $line[0],
                'city_id' => $line[1],
                'name' => ucwords(strtolower($line[2])),
            ];
        }

        fclose($file);

        DB::table('districts')->insert($items);

        $this->info("Districts added!");
    }

    private function legacy()
    {
        $psa_text = file_get_contents(resource_path('data/provinces_cities.txt'));

        $provinceItems = json_decode($psa_text, true);

        foreach($provinceItems as $provinceItem)
        {
            $province = Province::create(['name' => $provinceItem['name'], 'id' => $provinceItem['id']]);
            $this->line("Provinsi #".$provinceItem['id']." ".$provinceItem['name']." has ".count($provinceItem['cities']), null, 'vv');

            foreach($provinceItem['cities'] as $city)
            {
                if (City::where('name', $city['name'])->count() > 0)
                {
                    continue;
                }
                $city = City::create([
                    'name' => $city['name'],
                    'id' => $city['id'],
                    'province_id' => $provinceItem['id'],
                ]);
                $this->line("Added city ".$city['name'], null, 'vv');

            }
        }
    }
}
