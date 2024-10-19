<?php

namespace SMFlutterLibTemplate;

class ProjectCopier{

    

    public function __construct(
        private string $type, // dart or flutter
        private string $source_folder,
        private bool $dry_run = false
    ){

    }


    public function scanFiles():array{
        $files = $this->scanSourceFolderAndFiles($this->source_folder);
        // convert $files to a dictionary with
        // full_path, file_name (relative to source_folder), file_name_without_extension
        $files = array_map(function($file){
            $file_name = str_replace($this->source_folder . '/', '', $file);
            $file_name_without_extension = pathinfo($file_name, PATHINFO_FILENAME);
            return [
                'full_path' => $file,
                'file_name' => $file_name,
                'file_name_without_extension' => $file_name_without_extension
            ];
        }, $files);
        return $files;
    }
    

    /**
     * find all files in the source folder, recursively
     */
    public static function scanSourceFolderAndFiles(string $base_folder){
        $folders = array_filter(scandir($base_folder), function($folder) {
            return $folder !== '.' && $folder !== '..';
        });

        $files = [];
        foreach ($folders as $folder) {
            $full_path = $base_folder . '/' . $folder;
            if (!is_dir($full_path)) {
                $files[] = $full_path;
            }else{
                $files = array_merge($files, self::scanSourceFolderAndFiles($full_path));
            }
        }
        return $files;
    }


    private array | null $source_files = null;
        
    public function run(string $project_name, string $target_folder){
        if ($this->source_files === null){
            $this->source_files = $this->scanFiles();
        }

        $source_files = $this->source_files;
        // foreach files, find the source file and target file path
        foreach ($source_files as $source_file){
            $source_file_path = $source_file['full_path'];
            $target_file_path = $this->getTargetFilePath($source_file, $project_name, $target_folder);
            $this->copyFile($source_file_path, $target_file_path);
        }
    }

    public function getTargetFilePath(array $source_file, string $project_name, string $target_folder){
        $source_file_name = $source_file['file_name'];
        $source_file_name_without_extension = $source_file['file_name_without_extension'];
        $source_file_name_extension = pathinfo($source_file_name, PATHINFO_EXTENSION);
        $target_file_name = str_replace('project_name', $project_name, $source_file_name);
        $target_file_name = str_replace('project_name_without_extension', $project_name, $target_file_name);
        $target_file_name = str_replace('project_name_extension', $project_name, $target_file_name);
        $target_file_path = $target_folder . '/' . $target_file_name;
        return $target_file_path;
    }


    public function copyFile(string $source_file_path, string $target_file_path){
        $target_folder = dirname($target_file_path);
        if (!is_dir($target_folder)){
            mkdir($target_folder, 0777, true);
        }
        if ($this->dry_run){
            echo "copy $source_file_path to $target_file_path" . PHP_EOL;
            return;
        }
        copy($source_file_path, $target_file_path);
        
    }



 

}