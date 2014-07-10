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
        //echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        include("conexionBD.php");
        $nombre = addslashes($_POST["Nombre"]);
        $contrasenna = addslashes($_POST["Contrasenna"]);
        $rol = addslashes($_POST["Rol"]);
        $rut = addslashes($_POST["Rut"]);
        $carrera = addslashes($_POST["Carrera"]);
        $correo = addslashes($_POST["Correo"]);
        $fono = addslashes($_POST["Telefono"]);
        $p1 = addslashes($_POST["Preferencia1"]);
        $p2 = addslashes($_POST["Preferencia2"]);
        $p3 = addslashes($_POST["Preferencia3"]);
        if ($nombre == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su nombre")</script>';
            echo "<script> history.go(-1); </script>"; 
        }
        else if ($rol == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su ROL USM")</script>';
            echo "<script> history.back(); </script>";
        }
        else if ($rut == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su RUT")</script>';
            echo "<script> history.go(-1); </script>";
        }
        else if ($correo == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su Correo electronico")</script>';
            echo "<script> history.back(); </script>";
        }
        else if ($fono == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su Telefono")</script>';
            echo "<script> history.go(-1); </script>";
        }
        else if ($contrasenna == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su Contrasenna")</script>';
            echo "<script> history.back(); </script>";
        }
        else
        {
            $bd = new conexionBD();
            if ($p2 == 0 && $p3 == 0)
            {
                $bd->sentencia = "INSERT INTO colaboradores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area1)
VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$p1.");";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            else if ($p3 == 0)
            {
                $bd->sentencia = "INSERT INTO colaboradores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area1,id_area2)
VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$p1.",".$p2.");";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            else if ($p2 == 0)
            {
                $bd->sentencia = "INSERT INTO colaboradores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area1,id_area2)
VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$p1.",".$p3.");";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            else
            {
                $bd->sentencia = "INSERT INTO colaboradores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area1,id_area2,id_area3)
VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$p1.",".$p2.",".$p3.");";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            $bd->Cerrar();
            echo '<script type="text/javascript">alert("Postulacion exitosa")</script>';
            echo "<script> history.go(-2); </script>";
        }
        ?>
    </body>
</html>
