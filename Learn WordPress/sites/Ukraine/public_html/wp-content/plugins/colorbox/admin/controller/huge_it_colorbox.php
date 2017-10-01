<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include_once(HUGEIT_PLUGIN_DIR_1."/admin/model/huge_it_colorbox.php");
class Controller {
	public $model;
	public function __construct()  
    {  
        $this->model = new Model();
    } 
	public function invoke()
	{
			$colorboxlist = $this->model->getcolorboxList();
			if(isset($_GET['hugeit_task'])){
				if($_GET['hugeit_task'] == 'save'){
					$colorboxlist = $this->model->getcolorboxSave();
				}
			}
			include_once(HUGEIT_PLUGIN_DIR_1."/admin/view/huge_it_colorbox.php");
	}
}
