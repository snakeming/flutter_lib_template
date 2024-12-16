<?php


// some dummy (mock) class are used by multiple child project.
// besides the class, it could have companion data files.
// this script manage the copy of the class and data files to the child project


//=========== Configuration ============

// Test env
$config_file = __DIR__ . '/config/TestEnv.ini';

// Geofence
// $config_file = __DIR__ . '/config/Geofence.ini';

// $config_file = __DIR__ . '/config/DomainDataSource.ini';
// $config_file = __DIR__ . '/config/DartSpTaskMangerOnly.ini';
// $config_file = __DIR__ . '/config/DartSpTaskMangerAndDependent.ini';

// $config_file = __DIR__ . '/config/FlutterSpWidgetExampleOnly.ini';

// loginManager not completed yet
// $config_file = __DIR__ . '/config/LoginManagerTestHelper.ini';
// $config_file = __DIR__ . '/config/DummyPartnerOnlyData.ini';
// dummy tenant setting
// $config_file = __DIR__ . '/config/Tenant.ini';

// dart_smart_parcel ONLY
// $config_file = __DIR__ . '/config/DartSmartParcelOnly.ini';

// $config_file = __DIR__ . '/config/DummyPartnerOrder.ini';


$config = parse_ini_file($config_file);

// Base folder: /Users/cliff/Documents/GitHub/dart_sp_test_helper
$base_folder = dirname(dirname(dirname(__DIR__))).'/dart_sp_test_helper/lib';

// project root: /Users/cliff/Documents/GitHub/
$projects_root = dirname(dirname($base_folder));
echo "Base folder: $base_folder\n";

$dry_run = false; // false to do the actual copy


//=========== End of configuration ============

$verbose = true; //$config['verbose'] ?? false;
if ($dry_run){
    echo "Dry run mode\n";
    // force verbose to be true
    $verbose = true;
}


copyTestClass($base_folder, $projects_root, $config, $verbose, $dry_run);


function copyTestClass($base_folder, $projects_root, $config, bool $verbose, bool $dry_run){
   
    $projects = $config['project']; 

    foreach ($projects as $project){
        $paths = $config['path'];

        // path should be array, loop through each path
        // if it is string, convert to array
        if (!is_array($paths)){
            $paths = [$paths];
        }

        foreach ($paths as $path){
            $source_file = $base_folder . '/' . $path;
            
            // if $project ends with '/example`, it is an example project, append 'lib'
            if (substr($project, -8) == '/example'){
                $project_output_file = $projects_root . '/' . $project . '/lib/' . $path;
            } else {
                $project_output_file = $projects_root . '/' . $project . '/test/' . $path;
            }

         
            if ($verbose){
                echo "Copying $source_file to $project_output_file\n";
            }
            // echo "  (A)Copying file: $source_file to $project_output_file\n";
            if ($dry_run == false){
                copy($source_file, $project_output_file);
            }
        }
        
        $data_folder = $config['data_folder'] ?? null;
        if ($data_folder != null){
            $source_data_folder = $base_folder . '/' . $data_folder;
            // $project_output_data_folder = $projects_root . '/' . $project . '/' . $data_folder;
            if (substr($project, -8) == '/example'){
                $project_output_data_folder = $projects_root . '/' . $project . '/lib/' . $data_folder;
            } else {
                $project_output_data_folder = $projects_root . '/' . $project . '/test/' . $data_folder;
            }
            if ($verbose){
                echo "[A]Copying Files from folder: $source_data_folder to $project_output_data_folder\n";
            }
            copyFilesInFolder($source_data_folder, $project_output_data_folder, $verbose, $dry_run);
        }

        // if data_file, should be array, is not null, copy each file
        $data_files = $config['data_file'] ?? null;
        if ($data_files != null){
            if (!is_array($data_files)){
                $data_files = [$data_files];
            }
            foreach ($data_files as $data_file){
                $source_data_file = $base_folder . '/' . $data_file;
                $project_output_data_file = $projects_root . '/' . $project . '/' . $data_file;
                if ($verbose){
                    echo "[B]Copying $source_data_file to $project_output_data_file\n";
                }
                if ($dry_run == false){
                    copy($source_data_file, $project_output_data_file);
                }
            }
        }
    }
}

function copyFilesInFolder($source_folder, $output_folder, bool $verbose, bool $dry_run){
    $files = scandir($source_folder);
    foreach ($files as $file){
        if ($file == '.' || $file == '..'){
            continue;
        }
        if (is_file($source_folder . '/' . $file)){
            if ($verbose){
                echo "[C]Copying file: $source_folder/$file to $output_folder/$file\n";
            }
            if ($dry_run == false){
                copy($source_folder . '/' . $file, $output_folder . '/' . $file);
            }
        }
        // if it is folder, recursively copy
        if (is_dir($source_folder . '/' . $file)){
            $new_output_folder = $output_folder . '/' . $file;
            if (!file_exists($new_output_folder)){
                mkdir($new_output_folder, 0777, true);
            }
            copyFilesInFolder($source_folder . '/' . $file, $new_output_folder, $verbose, $dry_run);
        }
    }
}