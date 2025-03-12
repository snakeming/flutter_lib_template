<?php

// load some constant
require_once dirname(dirname(__DIR__)) . '/tests/bootstrap.php';
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

/**
 * run copy_location_simulation_data.php, under
 * ~/Document/GitHub/ folder
 * to copy location simulation data (txt files) to projects
 * 
 * update 
 * lib/location_simulator_util.dart of flutter_sm_map
 * defaultLocationSimulationFile() to enabled the new simulation data.
 * 
 */


/**
 * each kml file in source folder will generate a txt file to output folder
 * it will use the 'Route' folder, which could have multiple polylines,
 * and join all of them to a single txt file
 */
$base_folder = __DIR__;
$test_input_folder = \SMUtil\File::join($base_folder, 'source');
$test_output_folder = \SMUtil\File::join($base_folder, 'output');

// if source folder not exists, prompt and exit
if (!\SMUtil\File::exists($test_input_folder)) {
    echo "Source folder not exists: $test_input_folder\n";
    exit;
}

// list all *.kml files in source folder 
// @var array $kml_files array of full path of kml files
$kml_files = \SMUtil\Folder::files($test_input_folder, ['kml']);

// if no kml files found, prompt and exit
if (count($kml_files) == 0) {
    echo "No kml files found in source folder: $test_input_folder\n";
    exit;
}




// create output folder if not exists;
if (!\SMUtil\File::exists($test_output_folder)) {
    mkdir($test_output_folder);
}


// source: 
// https://www.google.com/maps/d/edit?mid=1F9lpKh22MjI1WUuv2Z4-edt06myTaV8&ll=22.33752992932125%2C114.14652630731976&z=22
// save to local and re-run this script
//$input_file = \SMUtil\File::join($test_input_folder, 'location_simulation.kml');
foreach ($kml_files as $input_file) {
    $extractor = new \SMGeo\Extractor\Kml($input_file);

    $polylines = $extractor->polylines('Route', \SMGeo\Extractor\Kml::RETURN_FORMAT_ARRAY);

    // if no polylines found, prompt and continue
    if (count($polylines) == 0) {
        echo "No polylines found in $input_file, ONLY read polyline from 'Route' layer.\n";
        continue;
    }

    $txt_format_polylines = [];
    foreach ($polylines as $polyline) {
        

        // $output_file = \SMUtil\File::join($test_output_folder, $layer_name . '.txt');
        // $polyline = $polyline->asString();
        // // split by ";" output use new line as separator
        // $polyline = str_replace(';', "\n", $polyline);

        // file_put_contents($output_file, $polyline);
        //echo $polyline->asString()."\n";
        $txt_format_polylines[] = $polyline->asString();
    }

    // join all polyline to a single route.
    // like the rider drive from point A to point B to point C
    $result = implode(";", $txt_format_polylines);
    // convert ";" to new line
    $result = str_replace(';', "\n", $result);

    // count the number of lines in the result
    $lines = explode("\n", $result);
   

    $file_name = basename($input_file);
    echo "Processing $file_name with  " . count($lines) . " points \n";
    // save to output folder
    // get the file name from input file
    $output_file = \SMUtil\File::join($test_output_folder, basename($input_file, '.kml') . '.txt');
    file_put_contents($output_file, $result);
    
}

