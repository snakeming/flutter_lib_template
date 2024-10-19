<?php

namespace SMFlutterLibTemplate;


class GitChecker {
    private $base_folder;

    private $uncommitted_project = [];
    private $non_git_output = [];

    public function __construct($base_folder = '/Users/cliff/Documents/GitHub') {
        $this->base_folder = $base_folder;
    }

    private $target_project = [];

    public function setTargetProject($target_project) {
        $this->target_project = $target_project;
    }


    public function checkUncommittedGit() {
        $folders = array_filter(scandir($this->base_folder), function($folder) {
            return $folder !== '.' && $folder !== '..';
        });

        $uncommitted_folders = [];
        $non_git_folders = [];
        $committed_folders = [];

        foreach ($folders as $folder) {
            $full_path = $this->base_folder . '/' . $folder;
            if (!is_dir($full_path)) {
                continue;
            }

            // check only if $git_folder (project name) exists in $target_project
            if (!in_array($folder, $this->target_project)) {
                continue;
            }


            $git_folder = $full_path . '/.git';
            if (!is_dir($git_folder)) {
                $non_git_folders[] = $folder;
                continue;
            }
            $output = shell_exec("cd $full_path && git status");
            if (strpos($output, 'nothing to commit, working tree clean') === false) {
                $uncommitted_folders[] = $folder;
            } else {
                $committed_folders[] = $folder;
            }
        }

        // $this->uncommitted_project[] = "Uncommitted folders: " . PHP_EOL;
        foreach ($uncommitted_folders as $folder) {
            $this->uncommitted_project[] = $folder;
        }

        // $this->uncommitted_project[] = PHP_EOL . PHP_EOL;

        $this->non_git_output[] = "Non-git folders: " . PHP_EOL;
        foreach ($non_git_folders as $folder) {
            $this->non_git_output[] = $folder . PHP_EOL;
        }
        
        // $this->uncommitted_project[] = "Committed folders: " . PHP_EOL;
        // foreach ($committed_folders as $folder) {
        //     $this->uncommitted_project[] = $folder . PHP_EOL;
        // }
    }


    public function uncommittedProject(){
        return $this->uncommitted_project;
    }
}

