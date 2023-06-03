<?php

namespace Modules\Certificate\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CertificateDesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('certificate_design')->delete();

        DB::table('certificate_design')->insert(array (
            0 => 
            array (
                'id' => 1,
                'background_image' => '',
                'background_image_enable' => '1',
                'logo_image' => '',
                'logo_enable' => '1',
                'logo_position' => 'center',
                'logo_width' => '150',
                'logo_height' => '100',
                'border_one' => '15',
                'border_one_color' => '#0284A2',
                'border_one_enable' => '1',
                'border_two' => '15',
                'border_two_color' => '#0284A2',
                'border_two_enable' => '1',
                'width' => '',
                'height' => '',
                'title' => 'Certificate',
                'title_position' => 'center',
                'title_font_size' => '50',
                'title_font_color' => '#686F7A',
                'body' => __('This is to certify that [user] successfully completed [course] online course on'),
                'body_position' => 'center',
                'body_font_size' => '15',
                'body_font_color' => '#686F7A',
                'body_max_len' => '',
                'date_enable' => '1',
                'date_position' => 'center',
                'date_font_size' => '30',
                'date_font_color' => '#686F7A',
                'date_format' => '',
                'signature_image' => '',
                'signature_position' => 'center',
                'signature_height' => '100',
                'signature_width' => '150',
                'name' => 'Intructor',
                'name_position' => 'center',
                'name_font_size' => '50',
                'name_font_color' => '#686F7A',
                'for_course' => '',
                'for_quiz' => '',
                'default' => '',
                'widget1_enable' => 'logo',
                'widget2_enable' => 'date',
                'widget3_enable' => 'signature',
                'created_at' => '2020-04-05 11:24:24',
                'updated_at' => '2020-05-04 17:45:15',
            ),
        ));
    }
}
