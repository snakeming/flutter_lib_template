<?php


require_once  dirname(__DIR__) . '/tests/bootstrap.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';


$target_projects = \SMFlutterLibTemplate\ProjectSourceHelper::getBuildProjectSequence();

// list out the target project
// print_r($target_project);

// Usage
$base_folder = '/Users/cliff/Documents/GitHub';

$gitChecker = new \SMFlutterLibTemplate\GitChecker($base_folder);
$gitChecker->setTargetProject($target_projects);
$gitChecker->checkUncommittedGit();
$uncommitted_project = $gitChecker->uncommittedProject();
if (count($uncommitted_project) > 0) {
    foreach ($gitChecker->uncommittedProject() as $project) {
        echo $project . PHP_EOL;
    }
} else {
    $count = count($target_projects);
    echo 'All projects '.$count.' are committed' . PHP_EOL;
}


