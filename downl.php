<?php 
    
    $data = $_POST["data"];

    $filename = "libros.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=".$filename);


    $mostrar_columnas = false;
   
    foreach($data as $row) {
    if(!$mostrar_columnas) {
    echo implode("\t", array_keys($row)) . "\n";
    $mostrar_columnas = true;
    }
    echo implode("\t", array_values($row)) . "\n";
    }
   
?>