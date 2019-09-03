<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = app(Faker\Generator::class);
        $users = factory(User::class)->times(10)->make()->each(function($users) use ($faker){
        });
        $users->makeVisible(['password','remember_token','created_at','updated_at'])->toArray();
        User::insert($users->toArray());
    }
}
