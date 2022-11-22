<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            "القاهرة",
             "الجيزة",
             "الأسكندرية",
             "الدقهلية",
             "البحر الأحمر",
             "البحيرة",
             "الفيوم",
             "الغربية",
             "الإسماعيلية",
             "المنوفية",
             "المنيا",
             "القليوبية",
             "الوادي الجديد",
             "السويس",
             "أسوان",
             "أسيوط",
             "بني سويف",
             "بور سعيد",
             "دمياط",
             "الشرقية",
             "جنوب سيناء",
             "كفر الشيخ",
             "مرسي مطروح",
             "الأقصر",
             "قنا",
             "شمال سيناء",
             "سوهاج"
         ];


         foreach ($cities as $city) {
             City::create(
                 [
                     'name' => $city,
                 ],
             );
         }
    }
}
