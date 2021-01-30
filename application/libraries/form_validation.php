<?php 
if( ! defined('BASEPATH') ) exit('No direct script access allowed');


$config = array(

	'ranking_put' => array(
			array( 'field'=>'nombre', 'label'=>'nombre','rules'=>'trim|required|min_length[2]|max_length[255]' ),
			array( 'field'=>'intentos', 'label'=>'intentos','rules'=>'required' )
		)


);




?>