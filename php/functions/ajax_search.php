<?php

function ajax_search($js_function,$id_result,$class = '',$id = '') {
    return '
    <input type="text" '
    .(($class == "") ? '' : ' class="'.$class.'" ')
    .(($id == "") ? '' : ' id="'.$id.'" ')    
    .' onclick="'.$js_function.'" onkeyup="'.$js_function.'">
    <div id="results_ajax_search"></div>
    <div id="'.$id_result.'"></div>';
}

function returnAjaxSearch($id,$text,$table,$condition) {

    // Utiliza tu lógica de consulta aquí, la siguiente es un ejemplo simplificado
    $connection = new Connection();
    $conn = $connection->connect();
    
    // Consulta SQL para buscar nombres en la base de datos
    $sql = "SELECT $id, $text FROM $table WHERE $condition LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtén todos los resultados en lugar de solo uno
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Almacena resultados en un array
    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'id' => $row[$id],
            'text' => $row[$text]
        );
    }
    
    drawButtonsAjaxSearch($data,'vertical-buttons','#selected_button_data');

}

function drawButtonsAjaxSearch($data, $class)
{
    echo '<div class="' . $class . '">';

    foreach ($data as $button) {
        echo '<button type="button" id="' . $button['id'] . '" onclick="draw_result_ajax_search(`cod_pers`,\'' . $button['id'] . '\', \'' . $button['text'] . '\')">' . $button['text'] . '</button>';
    }

    echo '</div>';
    
}