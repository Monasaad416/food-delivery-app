<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ["name"=>"بنك مصر","account_no"=>"Mr9867548726765434d76567"],
            ["name"=>"البنك الاهلي","account_no"=>"AH9756748764321765756fhj"],
            ["name"=>"CIB","account_no"=>"cib763534687906654345678"],
            ["name"=>"QNB","account_no"=>"qnb34567890976543212"],

        ];

        foreach ($banks as $bank) {
            Bank::create(
                [
                    'name' => $bank['name'],
                    'account_no' => $bank['account_no'],
                ],
            );
        }
    }
}
