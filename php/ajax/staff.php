<?php

include '../config.php';
//Include classes
include '../classes/class.connection.php';
include '../classes/class.prestamos.php';
include '../classes/class.pagos.php';

//Include functions
include '../functions/ajax_search.php';

$valid_request = true;

if($valid_request) {
    if(isset($_POST['buscar_term'])) {
        $searchTerm = $_POST['term'];
        if(!empty($searchTerm)) returnAjaxSearch('cod_pers','name','personal'," name LIKE '%$searchTerm%' ");
    }
}

