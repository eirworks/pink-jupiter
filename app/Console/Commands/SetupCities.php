<?php

namespace App\Console\Commands;

use App\City;
use App\Province;
use Illuminate\Console\Command;

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

        $psa_text = file_get_contents(resource_path('data/provinces_cities.txt'));

        $provinceItems = json_decode($psa_text, true);

        foreach($provinceItems as $provinceItem)
        {
            $province = Province::create(['name' => $provinceItem['name'], 'id' => $provinceItem['id']]);
            $this->line("Provinsi #".$provinceItem['id']." ".$provinceItem['name']." has ".count($provinceItem['cities']), null, 'vv');

            foreach($provinceItem['cities'] as $city)
            {
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
