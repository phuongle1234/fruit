<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::factory(20)->create();
       
       User::create([ 'name' => 'Dev', 'email' => 'test@test.com', 'password' => Hash::make( 'password' )  ]);

       // insert Category
       Category::insert([
        [ 'name' => 'Apple', 'created_at' => Carbon::now()  ],
        [ 'name' => 'Blueberry', 'created_at' => Carbon::now() ],
        [ 'name' => 'Cherry', 'created_at' => Carbon::now() ],
        [ 'name' => 'Kiwano', 'created_at' => Carbon::now() ],
        [ 'name' => 'Banana', 'created_at' => Carbon::now() ],
        [ 'name' => 'Cherry', 'created_at' => Carbon::now() ],
        [ 'name' => 'Apricot', 'created_at' => Carbon::now() ],
        [ 'name' => 'Strawberry', 'created_at' => Carbon::now() ]
       ]);

    }
}
