<?php

use Illuminate\Database\Seeder;

class UserAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids =[1,2,3,4,5];

        foreach($user_ids as $user_id){
            $address = factory(\App\Models\User\Address::class, 1)->create(['user_id'=>$user_id]);
        }

    }
}
