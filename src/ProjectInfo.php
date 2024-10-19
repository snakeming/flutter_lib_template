<?php
namespace SMFlutterLibTemplate;

/**
 * ~/bootstrap/smart_parcel/child_project
 * is a tool set to gen child project from smart parcel (ts-type) model
 * 
 * 
 */
class ProjectInfo{


    
    /**
     * @testFunction testProjectInfo__construct
     */
    public function __construct(
        private $project_name,
        private string | null $root_path = null)
    {
        // if root path is not provided, use the default root path
        if ($this->root_path == null){
            $current_project_root = \SMFlutterLibTemplate\Config::rootPath();
            $this->root_path = \SMUtil\File::join(dirname($current_project_root), $project_name);
        }
    }

    /**
     * @testFunction testProjectInfoProjectRootPath
     */
    public function projectRootPath():string{
        return $this->root_path;
    }
    // public function createOutputFolderIfNotExist(){
    //     $output_folder = $this->outputFolder();
    //     if (!file_exists($output_folder)) {
    //         mkdir($output_folder);
    //     }
    //     $sub_folders = ['project_models_description', 
    //         'project_description',
    //         'model_description',
    //         'related_doc',
    //         'related_model_doc'];

    //     foreach ($sub_folders as $sub_folder){
    //         $full_path = \SMUtil\File::join($output_folder, $sub_folder);
    //         if (!file_exists($full_path)) {
    //             mkdir($full_path);
    //         }
    //     }


    // }


   
}