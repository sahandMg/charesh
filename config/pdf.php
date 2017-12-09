<?php
/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 11/16/17
 * Time: 11:03 PM
 */return [
    'mode'                 => '',
    'format'               => 'A4',
    'default_font_size'    => '15',
    'default_font'         => 'Koodak',
    'margin_left'          => 10,
    'margin_right'         => 10,
    'margin_top'           => 50,
    'margin_bottom'        => 10,
    'margin_header'        => 0,
    'margin_footer'        => 0,
    'orientation'          => 'P',
    'title'                => 'بلیط مسابقه',
    'author'               => 'ChallengeBaazar',
    'display_mode'         => 'fullpage',



    'custom_font_path' => base_path('/fonts'), // don't forget the trailing slash!
    'custom_font_data' => [
        'Koodak' => [
            // regular font
            'B'  => 'Koodak.ttf',       // optional: bold font
//        'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
//        'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
            //'useOTL' => 0xFF,		      // required for complicated langs like Persian, Arabic and Chinese
            //'useKashida' => 75,		      // required for complicated langs like Persian, Arabic and Chinese
        ]
        // ...add as many as you want.
    ]

];
