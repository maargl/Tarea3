<!DOCTYPE html>

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
        $area = addslashes($_POST["Area"]);
        $talla = addslashes($_POST["Talla"]);
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
            if ($talla != ""){
                $bd = new conexionBD();
                $bd->sentencia = "INSERT INTO coordinadores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area,talla_polera,id_tipo) VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$area.",'".$talla."',2);";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            else{
                $bd = new conexionBD();
                $bd->sentencia = "INSERT INTO coordinadores(nombre,rol,rut,telefono,correo_electronico,contrasenna,id_carrera,id_area,id_tipo) VALUES('".$nombre."','".$rol."','".$rut."','".$fono."','".$correo."','".$contrasenna."',".$carrera.",".$area.",2);";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
            }
            
             
            $bd->Cerrar();
            echo '<script type="text/javascript">alert("Insercion exitosa")</script>';
            echo "<script> history.go(-2); </script>";
        }
        
        ?>
    </body>
</html>
