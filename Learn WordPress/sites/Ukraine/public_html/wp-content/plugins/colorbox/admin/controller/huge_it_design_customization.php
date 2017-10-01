<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include_once(HUGEIT_PLUGIN_DIR."/admin/model/huge_it_design_customization.php");
class Controller {
	public $model;
	public function __construct()  
    {  
        $this->model = new Model();
    } 
	public function invoke()
	{
		$i = $_GET['task'];
		switch ($i) {
			default:
			$colorboxlist = $this->model->getcolorboxList();
			if($_GET['hugeit_task'] == 'save'){
				$colorboxlist = $this->model->getcolorboxSave();
			}
			include_once(HUGEIT_PLUGIN_DIR."/admin/view/huge_it_design_customization.php");
			break;
		}
	}
}
