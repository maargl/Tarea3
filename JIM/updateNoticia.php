<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        include("conexionBD.php");
        $titular = addslashes($_POST["Titular"]);
        $contenido = addslashes($_POST["Contenido"]);
        $fecha = addslashes($_POST["Fecha"]);
        $area = addslashes($_POST["Area"]);
        if ($titular == "")
        {
            echo '<script type="text/javascript">alert("Ingrese titular")</script>';
            echo "<script> history.go(-1); </script>"; 
        }
        else if ($contenido == "")
        {
            echo '<script type="text/javascript">alert("Ingrese contenido")</script>';
            echo "<script> history.back(); </script>";
        }
        else if ($fecha == "")
        {
            echo '<script type="text/javascript">alert("Ingrese fecha")</script>';
            echo "<script> history.go(-1); </script>";
        }
        else
        {
            $bd = new conexionBD();
            $bd->sentencia = "update noticias set titular='".$titular."', contenido='".$contenido."', fecha='".$fecha."',id_area=".$area." where id_noticia='".$_SESSION["id_noticia"]."';";
            $rs = $bd->Consultar();
            $bd->FreeResult($rs);
            echo '<script type="text/javascript">alert("Edicion exitosa")</script>';
            $bd->Cerrar();
             echo "<script> history.go(-2); </script>";
        }
        
        ?>
    </body>
</html>
