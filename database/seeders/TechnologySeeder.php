<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['html','css','js','vue','bootstap','php','laravel'];
        foreach ($technologies as $technology_name) {
            $technology = new Technology();
            $technology->name = $technology_name;
            $technology->slug = str::slug($technology_name);
            $technology->save();
        }
    }
}
