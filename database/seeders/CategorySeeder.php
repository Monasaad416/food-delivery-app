<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "لحوم",
             "اسماك",
             "دجاج",
             "بيتزا",
             "فطائر",
             "حلويات",
             "مشروبات",
             "مقبلات",
         ];


         foreach ($categories as $cat) {
             Category::create(
                 [
                     'name' => $cat,
                 ],
             );
         }
    }
}
