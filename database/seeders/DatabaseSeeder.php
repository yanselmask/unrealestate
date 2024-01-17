<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\FrontSection;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Category
        $this->call(CategorySeeder::class);
        //Currency
        $this->call(CurrencySeeder::class);
        $home = Page::create([
            'title' => 'Home'
        ]);
        //Currency
        $this->call(MenuSeeder::class);
        //ListingAsSeeder
        $this->call(ListingAsSeeder::class);

        $hero = FrontSection::create([
            'heading' => 'Easy way to find a perfect property',
            'key' => 'hero',
            'theme' => 'default',
            'content' => json_decode('[{"data": {"image": "https://finder.createx.studio/img/real-estate/hero-image.jpg", "heading": "Easy way to find a perfect property", "description": "We provide a complete service for the sale, purchase or rental of real estate. We have been operating more than 10 years. Search millions of apartments and houses on Finder."}, "type": "hero"}]')
        ]);
        $categories = FrontSection::create([
            'heading' => 'Categories',
            'key' => 'category',
            'theme' => 'default',
            'content' => json_decode('[{"data": {"categories": [{"category": "1"}, {"category": "2"}, {"category": "3"}, {"category": "4"}, {"category": "5"}]}, "type": "category"}]')
        ]);
        $services = FrontSection::create([
            'heading' => 'Categories',
            'key' => 'service',
            'theme' => 'default',
            'content' => json_decode('[{"data": {"services": [{"image": "https://finder.createx.studio/img/real-estate/illustrations/buy.svg", "heading": "Buy a property", "btn_link": "#", "btn_text": "Find a home", "btn_target": "_self", "description": "Blandit lorem dictum in velit. Et nisi at faucibus mauris pretium enim. Risus sapien nisi aliquam egestas leo dignissim."}, {"image": "https://finder.createx.studio/img/real-estate/illustrations/sell.svg", "heading": "Sell a property", "btn_link": "#", "btn_text": "Place an ad", "btn_target": "_self", "description": "Amet, cras orci justo, tortor nisl aliquet. Enim tincidunt tellus nunc, nulla arcu posuere quis. Velit turpis orci venenatis."}, {"image": "https://finder.createx.studio/img/real-estate/illustrations/rent.svg", "heading": "Rent a property", "btn_link": "#", "btn_text": "Find a rental", "btn_target": "_self", "description": "Sed sed aliquet sed id purus malesuada congue viverra. Habitant quis lacus, volutpat natoque ipsum iaculis cursus."}]}, "type": "service"}]')
        ]);
        $calculate = FrontSection::create([
            'heading' => 'Сalculate the cost of your property',
            'key' => 'calculator',
            'theme' => 'default',
            'content' => json_decode('[{"data": {"image": "https://finder.createx.studio/img/real-estate/illustrations/calculator.svg", "modal": "yes", "heading": "Сalculate the cost of your property", "btn_link": "#", "btn_text": "<i class=\"fi-calculator me-2\"></I> Calculate", "btn_target": "_self", "description": "Real estate appraisal is a procedure that allows you to determine the average market value of real estate (apartment, house, land, etc.). Сalculate the cost of your property with our new Calculation Service."}, "type": "calculator"}]')
        ]);
        $partner = FrontSection::create([
            'heading' => 'Our partners',
            'key' => 'partner',
            'theme' => 'default',
            'content' => json_decode('[{"data": {"logos": [{"gray": "https://finder.createx.studio/img/real-estate/brands/01_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/01_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/02_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/02_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/03_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/03_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/04_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/04_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/05_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/05_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/06_gray.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/06_color.svg"}, {"gray": "https://finder.createx.studio/img/real-estate/brands/trustpilot.svg", "link": "#", "color": "https://finder.createx.studio/img/real-estate/brands/trustpilot.svg"}], "heading": "Our partners"}, "type": "partner"}]')
        ]);

        $home->sections()->sync([$hero->id, $categories->id, $services->id, $calculate->id, $partner->id]);
    }
}
