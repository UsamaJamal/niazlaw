<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(HomePageSettingSeeder::class);
        $this->call(HeroSlideSeeder::class);
        $this->call(BlogContentSeeder::class);
        $this->call(CapabilitySeeder::class);
        $this->call(AdditionalCapabilitySeeder::class);
         $this->call(BlogPostSeeder::class);
                 $this->call(StaticPageSeeder::class);
        $this->call(CareerSeeder::class);
    }
}
