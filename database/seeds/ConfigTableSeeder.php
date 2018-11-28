<?php

use App\Models\Config\Config;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Config::insert([
            ['key' => 'site_name', 'value' => 'Tourism'],
            ['key' => 'company_email', 'value' => 'zrshishir@gmail.com'],
            ['key' => 'company_address', 'value' => 'mirpur, Dhaka, Bangladesh'],
            ['key' => 'sidebar_theme', 'value' => 'red-light'],
            ['key' => 'privacy', 'value' => 'Please update you privacy policy. This is dummy text.'],
            ['key' => 'termCondition', 'value' => "<p>Please update you Terms And Condition. This is dummy text. Once you <a href='/privacy'>update</a>, your content will appear here</p>
"],
            ['key' => 'QUEUE_DRIVER', 'value' => 'sync'],
            ['key' => 'copyright', 'value' => "Copyright © 2018 <a href='//zrshishir.com'>zrshishir.com</a>"],
            ['key' => 'cron', 'value' => ""],
            ['key' => 'disqusShortname', 'value' => "Tourism"],
            ['key' => 'offline_message', 'value' => "This is under maintenance"],
            ['key' => 'enable_registration', 'value' => 1],
            ['key' => 'enable_social_login', 'value' => 1],
        ]);
    }
}
