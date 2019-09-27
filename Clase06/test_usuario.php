<?php
include_once ("usuario.php");
include_once ("AccesoDatos.php");
$loginData = isset($_POST["usuario_json"]) ? $_POST["usuario_json"] : NULL;

$objeto = json_decode($loginData);

$usuario = new usuario();

$obj = new stdClass();

$obj->existe = $usuario->ExisteEnBD($objeto->correo,$objeto->clave);
if($obj->existe)
{
    $obj->correo = $objeto->correo;
    $obj->clave = $objeto->clave;
}

echo json_encode($obj);
//entra json con correo y clave y sale un json con true o false