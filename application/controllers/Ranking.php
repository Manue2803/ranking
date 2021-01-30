<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		$this->load->database();
	}
	
	public function ranking10() {
		$query = $this->db->query('SELECT id,nombre,intentos FROM ranking order by intentos asc limit 10');
		
		$respuesta = array(
			'err' => FALSE,
			'mensaje' => 'Registros leidos correctamente',
			'total_registros' => $query->num_rows(),
			'ranking' => $query->result(),
		);
		
		echo json_encode($respuesta);
	}
	
	public function ranking_id($id) {
		$query = $this->db->query('SELECT * FROM ranking where id='.$id);
		$fila = $query->row();
		if (isset($fila)) {
			$respuesta = array (
				'err' => FALSE,
				'mensaje' => 'Registros leidos correctamente',
				'total_registros' => 1,
				'ranking' => $fila,
			);
		} else {
			$respuesta = array (
				'err' => TRUE,
				'mensaje' => 'No existe ranking con dicha id',
				'total_registros' => 0,
				'ranking' => null,
			);
		}
		
		echo json_encode($respuesta);
	}
	
}
