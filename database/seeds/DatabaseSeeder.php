<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 50)->create();
        $this->call(LocationsTableSeeder::class);

        factory(Order::class, 20)->create();   

    }
}
