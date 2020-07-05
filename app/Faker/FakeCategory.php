<?php


namespace App\Faker;


use Faker\Provider\Base;

class FakeCategory extends Base
{
    public function serviceCategories()
    {
        return ucwords($this->servicesPrefix()).' '.$this->serviceObject();
    }

    public function servicesPrefix()
    {
        return $this->generator->randomElement(['service', 'servis', 'reparasi', 'tukang', 'jasa']);
    }

    public function serviceObject()
    {
        return $this->generator
            ->randomElement([
                'AC',
                'Antena',
                'Kulkas',
                'Lampu',
                'Mobil',
                'Parabola',
                'Pompa Air',
                'Radio',
                'Sepeda Motor',
                'TV',
            ]);
    }

    public function shoppingCategories() {
        return trim("Jual Beli ".$this->serviceObject().' '.$this->generator->randomElement(['murah', 'baru', 'impor', 'bekas', '']));
    }
}
