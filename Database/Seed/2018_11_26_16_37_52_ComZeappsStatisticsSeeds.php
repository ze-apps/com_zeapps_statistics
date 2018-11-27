<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\com_zeapps_statistics\Models\Soca as OpportunityModel;


class ComZeappsStatisticsSeeds
{
    public function run()
    {
        Capsule::table('zeapps_modules')->insert([
            'module_id' => "com_zeapps_statistics",
            'label' => "com_zeapps_statistics",
            'active' => "1",
            'version' => "1.0.0",
            'last_sql' => "0",
            'dependencies' => "",
            'missing_dependencies' => "",
            'created_at'=>'2018-01-01',
            'updated_at'=>'2018-01-01',
        ]);

    }
}
