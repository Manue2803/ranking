<?php

function paginar_todo($tabla, $pagina = 1, $por_pagina) {

    $CI =& get_instance();
    $CI -> load -> database();

    if (!isset($por_pagina)) {
        $por_pagina = 20;
    }

    if (!isset($pagina)) {
        $pagina = 1;
    }

    $total_ranking = $CI->db->count_all('ranking');
    $total_pag = ceil($total_ranking / $por_pagina);

    if ($pagina > $total_pag) {
        $pagina = $total_pag;
    }

    $pagina -= 1;
    $desde = $pagina * $por_pagina;

    if ($pagina >= $total_pag - 1) {
        $pag_siguiente = 1;
    } else {
        $pag_siguiente = $pagina + 2;
    }

    if ($pagina < 1) {
        $pag_anterior = $total_pag;
    } else {
        $pag_anterior = $pagina;
    }

    $query = $CI->db->get('ranking', $por_pagina, $desde);

    $respuesta = array(
        'err' => FALSE,
        'total_ranking' => $total_ranking,
        'total_pag' => $total_pag,
        'pag_actual' => $pagina + 1,
        'pag_siguiente' => $pag_siguiente,
        'pag_anterior' => $pag_anterior,
        $tabla => $query->result()
    );

    return $respuesta;
}