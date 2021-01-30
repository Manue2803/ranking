<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking_model extends CI_Model {
	
	public $id;
	public $nombre;
	public $intentos;
	
	public function get_ranking($id) {
		$this->load->database();
		$this->db->where(array('id' => $id, 'activo' => 1));
		$query = $this->db->get('ranking');

		$fila = $query->custom_row_object(0, 'Ranking_model');

		if (isset($fila)) {
			$fila->id = intval($fila->id);
			$fila->nombre = intval($fila->nombre);
			$fila->intentos = intval($fila->intentos);
		}

		return $fila;
	}

	public function limpiar_datos($data_sucia) {
		foreach ($data_sucia as $nombre_campo => $valor) {
			if (property_exists('Ranking_model', $nombre_campo)) {
				$this->$nombre_campo = $valor;
			}
		}

		if ($this->id == NULL) {
			$this->id = 1;
		}
		return $this;
	}
	
}
