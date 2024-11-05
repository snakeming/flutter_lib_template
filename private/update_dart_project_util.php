<?php


require_once  dirname(__DIR__) . '/tests/bootstrap.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';


$template_folder = \SMUtil\File::join(\SMFlutterLibTemplate\Config::rootPath(), 'dart_project_template');

// copy file from template to target project
// see `dart_project_template`
// - coverage.sh
//
$copier = new \SMFlutterLibTemplate\ProjectCopier('dart', $template_folder);

$files = $copier->scanFiles();
// print_r($files);    


# see config/build_project_sequence.yaml
$target_projects = \SMFlutterLibTemplate\ProjectSourceHelper::getBuildProjectSequence();

// list out the target project

foreach ($target_projects as $project){
    echo 'Updating project: '. $project . PHP_EOL;

    // get projectRootPath
    $projectInfo = new \SMFlutterLibTemplate\ProjectInfo($project);
    // echo $projectInfo->projectRootPath() . PHP_EOL;

    // e.g. copy the coverage.sh to target dart project
    $copier->run($project, $projectInfo->projectRootPath());

}