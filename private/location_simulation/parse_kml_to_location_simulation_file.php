<?php

// load some constant
require_once dirname(dirname(__DIR__)) . '/tests/bootstrap.php';
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$test_input_folder = __DIR__;
$test_output_folder = \SMUtil\File::join($test_input_folder, 'output');
// create output folder if not exists;
if (!\SMUtil\File::exists($test_output_folder)) {
    mkdir($test_output_folder);
}

// source: 
// https://www.google.com/maps/d/edit?mid=1F9lpKh22MjI1WUuv2Z4-edt06myTaV8&ll=22.33752992932125%2C114.14652630731976&z=22
// save to local and re-run this script
$input_file = \SMUtil\File::join($test_input_folder, 'location_simulation.kml');

$extractor = new \SMGeo\Extractor\Kml($input_file);

// each market should have its own layer
$markets = ['HK'];

foreach ($markets as $market) {
    saveMarketPolylineAsFile($extractor, $market, $test_output_folder);
}

function saveMarketPolylineAsFile($extractor, string $market,  string $output_folder)
{
    $polylines = $extractor->polylines($market, \SMGeo\Extractor\Kml::RETURN_FORMAT_ARRAY);

    foreach ($polylines as $polyline) {
        $layer_name = $polyline->name();

        $output_file = \SMUtil\File::join($output_folder, $layer_name . '.txt');
        $polyline = $polyline->asString();
        // split by ";" output use new line as separator
        $polyline = str_replace(';', "\n", $polyline);

        file_put_contents($output_file, $polyline);
    }

  
}

