<?php

use Illuminate\Database\Seeder;
use Lib\Models\Setting;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $settings = config("settings");
      foreach($settings as $setting){
        foreach($setting as $key=>$value)
          Setting::create(["key"=>"{$setting}::{$key}","value"=>$value]);
      }
    }
}