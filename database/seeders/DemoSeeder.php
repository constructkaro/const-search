<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Service;
class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $area = Area::create([
        'pincode' => '410202',
        'city' => 'Panvel',
        'state' => 'Maharashtra'
    ]);

    $service1 = Service::create(['name' => 'Plumbing']);
    $service2 = Service::create(['name' => 'AC Repair']);

    $area->services()->attach([
        $service1->id => ['is_available' => true],
        $service2->id => ['is_available' => true],
    ]);
}
}
