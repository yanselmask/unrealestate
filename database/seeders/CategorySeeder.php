<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Facility;
use App\Models\Outdoor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartament = Category::create([
            'title' => 'Apartament',
            'type' => 'property',
            'x_icon' => '<i class="fi-apartment"></i>'
        ]);
        $house = Category::create([
            'title' => 'House',
            'type' => 'property',
            'x_icon' => '<i class="fi-real-estate-house"></i>'
        ]);
        $commercial = Category::create([
            'title' => 'Commercial',
            'type' => 'property',
            'x_icon' => '<i class="fi-shop"></i>'
        ]);
        $dailyRental = Category::create([
            'title' => 'Daily Rental',
            'type' => 'property',
            'x_icon' => '<i class="fi-rent"></i>'
        ]);
        $newBuilding = Category::create([
            'title' => 'New Building',
            'type' => 'property',
            'x_icon' => '<i class="fi-house-chosen"></i>'
        ]);

        $amenitiesData = '[
    {"value":"WiFi","icon":"<i class=\"fi-wifi mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Air conditioning","icon":"<i class=\"fi-snowflake mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Parking place","icon":"<i class=\"fi-parking mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Heating","icon":"<i class=\"fi-thermometer mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Dishwasher","icon":"<i class=\"fi-dish mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Iron","icon":"<i class=\"fi-iron mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"No smocking","icon":"<li class=\"col\"><i class=\"fi-no-smoke mt-n1 me-2 fs-lg align-middle\"><\/i>No smocking<\/li>"},
    {"value":"Cats","icon":"<i class=\"fi-pet mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Double bed","icon":"<i class=\"fi-double-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Single bed","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Security cameras","icon":"<i class=\"fi-cctv mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"TV","icon":"<i class=\"fi-tv mt-n1 me-2 fs-lg align-middle\"><\/i>"},
    {"value":"Swimming pool","icon":"<i class=\"fi-swimming-pool mt-n1 me-2 fs-lg align-middle\"><\/i>"}
]';
        $amenities =  Facility::create([
            'name' => 'Amenities',
            'type' => 'checkbox',
            'values' => json_decode($amenitiesData, true)
        ]);
        $pets = Facility::create([
            'name' => 'Pets',
            'type' => 'checkbox',
            'values' => json_decode('[{"value":"Cats allowed","icon":null},{"value":"Dogs allowed","icon":null}]', true)
        ]);
        $parking = Facility::create([
            'name' => 'Parking spots',
            'type' => 'radio',
            'values' => json_decode('[{"value":"1","icon":"<i class=\"fi-parking mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"2","icon":"<i class=\"fi-parking mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"3","icon":"<i class=\"fi-parking mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"4","icon":"<i class=\"fi-parking mt-n1 me-2 fs-lg align-middle\"><\/i>"}]', true)
        ]);
        $bath = Facility::create([
            'name' => 'Bathrooms',
            'type' => 'radio',
            'values' => json_decode('[{"value":"1","icon":"<i class=\"fi-bath mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"2","icon":"<i class=\"fi-bath mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"3","icon":"<i class=\"fi-bath mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"4","icon":"<i class=\"fi-bath mt-n1 me-2 fs-lg align-middle\"><\/i>"}]', true)
        ]);
        $beds = Facility::create([
            'name' => 'Bedrooms',
            'type' => 'radio',
            'values' => json_decode('[{"value":"Studio","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"1","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"2","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"3","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"4","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"},{"value":"5","icon":"<i class=\"fi-bed mt-n1 me-2 fs-lg align-middle\"><\/i>"}]', true)
        ]);
        $area = Facility::create([
            'name' => 'Total area, sq.m',
            'type' => 'textbox',
            'values' => ''
        ]);

        Outdoor::create([
            'name' => 'Airpot',
            'icon' => '<i class="fi-plane"></i>'
        ]);

        Outdoor::create([
            'name' => 'Pool',
            'icon' => '<i class="fi-swimming-pool"></i>'
        ]);
        Outdoor::create([
            'name' => 'Bank',
            'icon' => '<i class="fi-museum"></i>'
        ]);
        Outdoor::create([
            'name' => 'Disco',
            'icon' => '<i class="fi-disco-ball"></i>'
        ]);
        Outdoor::create([
            'name' => 'Center',
            'icon' => '<i class="fi-apartment"></i>'
        ]);
        Outdoor::create([
            'name' => 'Pack',
            'icon' => '<i class="fi-mail"></i>'
        ]);
        Outdoor::create([
            'name' => 'Bar',
            'icon' => '<i class="fi-cup"></i>'
        ]);
        Outdoor::create([
            'name' => 'Restaurant',
            'icon' => '<i class="fi-glass"></i>'
        ]);
        Outdoor::create([
            'name' => 'Hospital',
            'icon' => '<i class="fi-heart-filled"></i>'
        ]);
    }
}
