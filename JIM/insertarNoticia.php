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
            $bd->sentencia = "INSERT INTO noticias(titular, contenido,fecha, id_area,id_coordinador) VALUES('".$titular."','".$contenido."','".$fecha."',".$area.",".$_SESSION["User_id"].");";
            $rs = $bd->Consultar();
            $bd->FreeResult($rs);
            
             
            $bd->Cerrar();
            echo '<script type="text/javascript">alert("Insercion exitosa")</script>';
            echo "<script> history.go(-2); </script>";
        }
        
        ?>
    </body>
</html>
