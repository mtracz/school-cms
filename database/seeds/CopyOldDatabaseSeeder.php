<?php

use Illuminate\Database\Seeder;

class CopyOldDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CopyOldArticlesSeeder::class);
        $this->call(CopyOldNewsSeeder::class);
        //$this->call(CopyOldSettingsSeeder::class);
    }
}
