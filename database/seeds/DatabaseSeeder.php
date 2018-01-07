<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {

        $this->call(AccessibilitiesSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(OrientationsSeeder::class);
        $this->call(SiteSectorsSeeder::class);
        $this->call(StatisticsSeeder::class);
        $this->call(ThemesSeeder::class);
        $this->call(AdminsSeeder::class);
        $this->call(PanelTypesSeeder::class);
        $this->call(ActionTypesSeeder::class);
        $this->call(LayoutSeeder::class);
        // $this->call(NewsSeeder::class);
        $this->call(CopyOldDatabaseSeeder::class);
        $this->call(StaticPagesSeeder::class);
        
    }
}
