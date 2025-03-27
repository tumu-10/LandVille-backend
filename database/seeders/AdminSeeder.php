<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = User::where('email','kagimujayp01@gmail.com')->first();
    	if(!$admin){
        	$admin = new User;
        }
        $admin->first_name = "Kagimu";
        $admin->last_name = "JohnPaul";
        $admin->username = "jayp";
        $admin->email = "kagimujayp01@gmail.com";
        $admin->password = Hash::make("12345");
        $admin->position = 'Senior Developer';
        $admin->role = "admin";
        $admin->save();

        $admin2 = User::where('email','sam@gmail.com ')->first();
        if(!$admin2){
            $admin2 = new User;
        }
        $admin2->first_name = "sam";
        $admin2->last_name = "tumusiime";
        $admin2->username = "sam";
        $admin2->email = "sam@gmail.com ";
        $admin2->password = Hash::make("12345");
        $admin2->role = "admin";
        $admin2->position = "administrator";
        $admin2->save();
    }
}
