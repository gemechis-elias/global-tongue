<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

   
    public function run()
    {
        //
        DB::table('payments')->delete();
        $data = [
            [
                'course_id' => "1",
                'is_confirmed' => false,
                'amount' => "1500",
                'transaction_no' => "TOASD028H12lAHBSX"
            ]
        ];
        Payment::insert($data);
    }
}
