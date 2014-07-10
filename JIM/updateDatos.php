<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start ();
        include("conexionBD.php");
        if ($_SESSION["User_tipo"]!=NULL) 
        {
        
        $nombre = addslashes($_POST["Nombre"]);
        $contrasenna = addslashes($_POST["Contrasenna"]);
        $rol = addslashes($_POST["Rol"]);
        $rut = addslashes($_POST["Rut"]);
        $carrera = addslashes($_POST["Carrera"]);
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
        else if ($fono == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su Telefono")</script>';
            echo "<script> history.go(-1); </script>";
        }
        else if ($contrasenna == "")
        {
            echo '<script type="text/javascript">alert("Ingrese su Contrasenna")</script>';
            echo "<script> history.back(-1); </script>";
        }
        else
        {
            if ($talla != ""){
                $bd = new conexionBD();
                $bd->sentencia = "update coordinadores set nombre='".$nombre."', rol='".$rol."', rut='".$rut."', telefono='".$fono."', contrasenna='".$contrasenna."', id_carrera=".$carrera.", id_area=".$area.",talla_polera='".$talla."' where id_coordinador=".$_SESSION["User_id"].";";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
                echo '<script type="text/javascript">alert("Edicion exitosa")</script>';
            }
            else{
                $bd = new conexionBD();
                $bd->sentencia = "update coordinadores set nombre='".$nombre."',rol='".$rol."',rut='".$rut."',telefono='".$fono."',contrasenna='".$contrasenna."',id_carrera=".$carrera.",id_area=".$area." where id_coordinador=".$_SESSION["User_id"].";";
                $rs = $bd->Consultar();
                $bd->FreeResult($rs);
                echo '<script type="text/javascript">alert("Edicion exitosa")</script>';
            }
            
             
            $bd->Cerrar();
             echo "<script> history.go(-2); </script>";
        }
        }
        else{
            $talla = addslashes($_POST["Talla"]);
            $bd = new conexionBD();
            $bd->sentencia = "update colaboradores set talla_polera='".$talla."' where id_colaborador=".$_SESSION["User_id"].";";
            $rs = $bd->Consultar();
            $bd->FreeResult($rs);
            echo '<script type="text/javascript">alert("Edicion exitosa")</script>';
            $bd->Cerrar();
            echo "<script> history.go(-2); </script>";
        }
        
        ?>
    </body>
</html>
