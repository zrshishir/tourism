<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ConfigTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(LocalesTableSeeder::class);
        // $this->call(PackageTableSeeder::class);
        // $this->call(PageDesignTableSeeder::class);
        // if(env('APP_ENV', false) == 'demo') {
        //     $this->call(UsersTableSeeder::class);
        // }
        // $this->call(CustomerGroupTableSeeder::class);
       
        // $this->call(TicketStatusTableSeeder::class);
        // $this->call(MailProviderTabelSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        // $this->call(FrontEndTableSeeder::class);
        

        Model::reguard();
    }
}
