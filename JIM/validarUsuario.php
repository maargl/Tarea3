<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        @session_start();
        include("conexionBD.php");
        
        $usuario = addslashes($_POST["Correo"]);
        $contrasenna = addslashes($_POST["Contrasenna"]);
        $bd = new conexionBD();
        $bd->sentencia = "SELECT * FROM coordinadores WHERE correo_electronico='$usuario' AND contrasenna='$contrasenna'";
        $rs = $bd->Consultar();
        if ($bd->TotalRows($rs) > 0)
        {
            $fila = $bd->NextRow($rs);
            $_SESSION["User_id"] = $fila["id_coordinador"];
            $_SESSION["User_tipo"] = $fila["id_tipo"];
            $_SESSION["User_nombre"] = $fila["nombre"];
            $_SESSION["User_area"] = $fila["id_area"];
            $_SESSION["Id_carrera"]=$fila["id_carrera"];
            $bd->FreeResult($rs);
            $bd->Cerrar();
            $bd2 = new conexionBD();
            $bd2->sentencia = "SELECT campus FROM carreras WHERE id_carrera=".$_SESSION["Id_carrera"]."";
            $rs2 = $bd2->Consultar();
            if ($bd2->TotalRows($rs2) > 0)
            {
                $fila2 = $bd2->NextRow($rs2);
                $_SESSION["Campus"] = $fila2["campus"];
                $bd2->FreeResult($rs);
                $bd2->Cerrar();
            }
            header('Location: index.php');
        }
        else
        {
            $bd->sentencia = "SELECT * FROM colaboradores WHERE correo_electronico='$usuario' AND contrasenna='$contrasenna'";
            $rs = $bd->Consultar();
            if ($bd->TotalRows($rs) > 0)
            {
                $fila = $bd->NextRow($rs);
                $_SESSION["User_id"] = $fila["id_colaborador"];
                $_SESSION["User_tipo"] = NULL;
                $_SESSION["User_area1"] = $fila["id_area1"];
                $_SESSION["User_area2"] = $fila["id_area2"];
                $_SESSION["User_area3"] = $fila["id_area3"];
                $_SESSION["User_nombre"] = $fila["nombre"];
                $_SESSION["Id_carrera"]=$fila["id_carrera"];
                $bd->FreeResult($rs);
                $bd->Cerrar();
                $bd2 = new conexionBD();
                $bd2->sentencia = "SELECT campus FROM carreras WHERE id_carrera=".$_SESSION["Id_carrera"]."";
                $rs2 = $bd2->Consultar();
                if ($bd2->TotalRows($rs2) > 0)
                {
                    $fila2 = $bd2->NextRow($rs2);
                    $_SESSION["Campus"] = $fila2["campus"];
                    $bd2->FreeResult($rs);
                    $bd2->Cerrar();
                }
                header('Location: index.php');
            }
            
            echo "Datos incorrectos o usted no esta registrado. <form action=".'"index.php"'." method=".'"post"'.">
                                                <input type=".'"submit"'." value=".'"Volver"'."></input>
                                            </form>";
            exit;
        }
        
        
        ?>
    </body>
</html>
