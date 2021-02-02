<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Rankingp extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Ranking_model');
    }

    public function ranking_put()
    {
        $data = $this->put();
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('intentos', 'intentos', 'required');

        if ($this->form_validation->run()) {

            $ranking = $this->Ranking_model->limpiar_datos($data);

            if ($this->db->insert('ranking', $data)) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro insertado correctamente',
                    'ranking_id' => $this->db->insert_id(),
                );
                $this->response($respuesta);
            } else {
                $respuesta = array(
                    'err' => TRUE,
                    'mensaje' => 'Error al insertar',
                    'error' => $this->db->error_message(),
                );
                $this->response($respuesta, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Existen errores en el envío de información',
                'errores' => $this->form_validation->get_errores_arreglo()
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->response($data);
    }
}
