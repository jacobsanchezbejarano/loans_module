<?php
//Include functions
include 'php/config.php';
include 'php/functions/ajax_search.php';

//Include classes
include 'php/classes/class.connection.php';
include 'php/classes/class.pagos.php';
include 'php/classes/class.prestamos.php';
include 'php/classes/class.staffs.php';
include 'php/classes/class.htmlManager.php';


$HTML = new HtmlManager();
echo $HTML->buildHTML();

?>