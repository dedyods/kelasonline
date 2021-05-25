<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->email = "administrator@online-class.test";
        $administrator->password = \Hash::make("12345678");
        $administrator->name = "Application Administrator";
        $administrator->level = "admin";
        $administrator->gender = "pria";
        $administrator->avatar = "none.png";
        $administrator->address = "Sidoarjo";
        $administrator->phone = "0857123456";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
