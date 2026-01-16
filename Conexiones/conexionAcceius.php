<?php


$serverName = "172.16.1.8";
//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

$connectionInfo = array( "Database"=>"acceius", "UID"=>"dperead", "PWD"=>"3k39NKzbex87gHJ","CharacterSet" => "UTF-8");
$connAcceius = sqlsrv_connect( $serverName, $connectionInfo);

if( $connAcceius ) {
    //echo "Se Conecto Correctamente.<br />";
}else{
    var_dump (  "No se ha Podido Conectar con acceius.<br />" . print_r( sqlsrv_errors(), true ));
    die( print_r( sqlsrv_errors(), true));
}
if ( sqlsrv_begin_transaction( $connAcceius ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
}
?>
