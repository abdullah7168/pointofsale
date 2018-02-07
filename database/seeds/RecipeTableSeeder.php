<?php

use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            'rcp_name' => 'Chicken Roll Paratha',
            'rcp_dscp' => 'Marinate chicken boneless pieces in yogurt, salt, turmeric and chili powder, all spices. Mix it and set it aside for 15 minutes. Add green coriander leaves in it.',
            'rscp_ingts' => 'ingone,ingtwo,ingthree,ingfour',
            'rcp_cp' => '5.00',
            'rcp_sp' => '10.00',
            'rcp_cat_id' => '3',

        ]);
        DB::table('recipes')->insert([
            'rcp_name' => 'Lemony tuna & asparagus salad box',
            'rcp_dscp' => 'Marinate chicken boneless pieces in yogurt, salt, turmeric and chili powder, all spices. Mix it and set it aside for 15 minutes. Add green coriander leaves in it.',
            'rscp_ingts' => 'ingone,ingtwo,ingthree,ingfour',
            'rcp_cp' => '5.00',
            'rcp_sp' => '10.00',
            'rcp_cat_id' => '1',

        ]);
        DB::table('recipes')->insert([
            'rcp_name' => 'Chinese poached chicken & rice',
            'rcp_dscp' => 'Marinate chicken boneless pieces in yogurt, salt, turmeric and chili powder, all spices. Mix it and set it aside for 15 minutes. Add green coriander leaves in it.',
            'rscp_ingts' => 'ingone,ingtwo,ingthree,ingfour',
            'rcp_cp' => '5.00',
            'rcp_sp' => '10.00',
            'rcp_cat_id' => '6',

        ]);
    }
}
