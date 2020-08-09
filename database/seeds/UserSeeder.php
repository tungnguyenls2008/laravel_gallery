<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        factory(User::class, 10)->create();
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
