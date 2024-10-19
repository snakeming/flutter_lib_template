<?php


require_once  dirname(__DIR__) . '/tests/bootstrap.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';


$template_folder = \SMUtil\File::join(\SMFlutterLibTemplate\Config::rootPath(), 'dart_project_template');
$copier = new \SMFlutterLibTemplate\ProjectCopier('dart', $template_folder);

$files = $copier->scanFiles();
// print_r($files);    



$target_projects = \SMFlutterLibTemplate\ProjectSourceHelper::getBuildProjectSequence();

// list out the target project

foreach ($target_projects as $project){
    echo 'Updating project: '. $project . PHP_EOL;

    // get projectRootPath
    $projectInfo = new \SMFlutterLibTemplate\ProjectInfo($project);
    // echo $projectInfo->projectRootPath() . PHP_EOL;


    $copier->run($project, $projectInfo->projectRootPath());

}