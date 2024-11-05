<?php

# source: sm-php-headless-builder
# src/ChildProject/ProjectSourceHelper.php
namespace SMFlutterLibTemplate;


/**
 * the child project config is generated 
 * `gen_child_project_config.php` 
 */
class ProjectSourceHelper{

    /**
     * get build child project sequence from yaml config. 
     * this build sequence MUST start from least dependency first
     * @return array
     */
    /**
     * @testFunction testProjectSourceHelperGetBuildProjectSequence
     */
    public static function getBuildProjectSequence(int $project_type=ProjectType::DART):array{

        $root_path = Config::rootPath();

        // read 'build_project_sequence' yaml config
        $yaml_path = \SMUtil\File::join($root_path, 'config', 'build_project_sequence_dart.yaml');
        if ($project_type == ProjectType::FLUTTER){
            $yaml_path = \SMUtil\File::join($root_path, 'config', 'build_project_sequence_flutter.yaml');
        }

        $yaml = file_get_contents($yaml_path);
        $config = \Symfony\Component\Yaml\Yaml::parse($yaml);
        return $config['build_sequence'];
    }


    // /**
    //  * find project name from (default: ~/child_project/source) folder
    //  *
    //  * @return array array of project name(string)
    //  * project name example 'SMVas'
    //  */
    // public static function getProjectNameFromFolder(string $source_folder = './source/'):array{
    // // find all file name under './source/' folder using scandir
    // $files = scandir($source_folder);
    // // ignore . and ..

    // $result = [];
    // foreach ($files as $file){
    //     if ($file == '.' || $file == '..'){
    //         continue;
    //     }
    //     // skip directory
    //     if (is_dir($source_folder . $file)){
    //         continue;
    //     }
        
    //     if (is_file($source_folder . $file)){
            

    //         // if filename end with .ini
    //         if (substr($file, -5) == '.yaml'){
    //             // remove .yaml
    //             $result[] = substr($file, 0, -5);
    //         }
            
    //     }
    // }
    // return $result;
    // }




    // /**
    //  * get child project latest git tag,
    //  * show in 'related child project'
    //  *
    //  * @param string $child_project_root_folder absolute path of child project
    //  * @return string
    //  */
    // public static function getChildProjectGitLatestTag(string | null  $child_project_root_folder):string{

    //     if (is_null($child_project_root_folder)){
    //     return 'unknown';
    //     }

    //     //$child_project_root_folder = '/Users/cliff/Documents/smgit/sm-php-common'; // for test
    //     // $git_latest_tag_sh_command = 'latest_tag.sh';
    //     // if git is not has tag yet,
    //     // it would return 'fatal: No names found, cannot describe anything.'
    //     $git_latest_tag_sh_command = 'git describe --tags $(git rev-list --tags --max-count=1)';
    //     // run the shell script inside child project
    //     $cmd = "cd $child_project_root_folder && $git_latest_tag_sh_command";

    //     //echo "Running: $cmd\n";

    //     $output = @shell_exec($cmd);

    //     // trim the output
    //     if ($output != null){
    //     $output = trim($output);
    //     return $output;
    //     }
    //     print_r(['Tag not found'=> $child_project_root_folder]);

    //     return 'Tag not found';
    // }


   
}