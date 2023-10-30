<?php
class EnlacesPaginas2
{

    public static function enlacesPaginasModel2($enlacesModelo2)
    {

        $views = ["estacion_moldeado", "estacion_terminacion", "estacion_almacen"];

        $modulo2 = "";
        if (in_array($enlacesModelo2, $views)) {
            $modulo2 = "vistas/modulos/" . $enlacesModelo2 . ".php";
        } else {
            $modulo2 = "vistas/modulos/estaciones.php";
        }
        return $modulo2;
    }
}
