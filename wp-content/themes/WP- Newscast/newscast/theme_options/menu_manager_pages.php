<?php

$pageinfo = array('full_name' => 'Menu Manager Pages', 'optionname'=>'menu', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

"Menu Manager Pages" =>	array(	"name" => "Menu Manager Pages",
							"desc" => "This tool controlls your site menu. descriptions will only be shown on first level menu items",
							"database_table" => "main_menu_pages",
							"type" => "menu",
							"initial" => '',
							"attr" => 'id="nav"',
							"heading" => array("Controlls"=>"174px",'Name'=>'196px', "Description"=>"196px","Link"=>'196px'),
							"controlls" => array('delete','right','left','down','up'),
							"tables" => array(	"id"=>"hidden", 
												"lft"=>"hidden", 
												"rgt"=>"hidden", 
												"Name" => "input",
												"Description" => "input", 
												"Link" =>"multi_link"
												)
							)
					);

$options_page = new kriesi_menu_manager($options, $pageinfo);
$k_option['custom']['kriesi_menu_pages'] = new kriesi_menu_display($options);