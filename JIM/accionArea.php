<?php include("conexionBD.php");
session_start();
if (isset($_SESSION["agreg_area1"]))
    unset($_SESSION["agreg_area1"]);
else if (isset($_SESSION["edit_area1"]))
    unset($_SESSION["edit_area1"]);
else if (isset($_SESSION["elim_area1"]))
    unset($_SESSION["elim_area1"]);
if (isset($_POST["Agregar"]))
    $_SESSION["agreg_area1"] = 1;
else if (isset($_POST["Editar"]))
    $_SESSION["edit_area1"] = 1;
else if (isset($_POST["Eliminar"]))
    $_SESSION["elim_area1"] = $_POST["Eliminar"];
if (isset($_SESSION["agreg_area1"]))
{
    $nombre = addslashes($_POST["Nombre"]);
    $num = addslashes($_POST["Ncolaboradores"]);
    if ($nombre == "")
    {
        echo '<script type="text/javascript">alert("Ingrese el nombre")</script>';
        echo "<script> history.go(-1); </script>"; 
    }
    else if ($num == "")
    {
        echo '<script type="text/javascript">alert("Ingrese el numero de colaboradores")</script>';
        echo "<script> history.go(-1); </script>";
    }
    else
    {
        $bd = new conexionBD();
        $bd->sentencia = "INSERT INTO areas(nombre_area,horario,num_colaboradores) VALUES('".$nombre."',time '17:00:00',".(integer)$num.");";
        $rs = $bd->Consultar();
        $bd->FreeResult($rs);
        $bd->Cerrar();
        echo '<script type="text/javascript">alert("Area agregada.")</script>';
        echo "<script> history.go(-2); </script>";
    }
}
else if (isset($_SESSION["edit_area1"]))
{
    $nombre = addslashes($_POST["Nombre"]);
    $num = addslashes($_POST["Ncolaboradores"]);
    if ($nombre == "")
    {
        echo '<script type="text/javascript">alert("Ingrese el nombre")</script>';
        echo "<script> history.go(-1); </script>"; 
    }
    else if ($num == "")
    {
        echo '<script type="text/javascript">alert("Ingrese el numero de colaboradores")</script>';
        echo "<script> history.go(-1); </script>";
    }
    else
    {
        $bd = new conexionBD();
        $bd->sentencia = "UPDATE areas SET nombre_area='".$nombre."',num_colaboradores=".(integer)$num." WHERE id_area=".$_SESSION["id_area"].";";
        $rs = $bd->Consultar();
        $bd->FreeResult($rs);
        $bd->Cerrar();
        echo '<script type="text/javascript">alert("Area editada.")</script>';
        echo "<script> history.go(-2); </script>";
    }
}
else if (isset($_SESSION["elim_area1"]))
{
    if ($_SESSION["elim_area1"] == "No")
        echo "<script> history.go(-2); </script>";
    else
    {
        $bd = new conexionBD();
        $bd->sentencia = "DELETE FROM areas WHERE id_area=".$_SESSION["id_area"].";";
        $rs = $bd->Consultar();
        $bd->FreeResult($rs);
        $bd->Cerrar();
        echo '<script type="text/javascript">alert("Area eliminada.")</script>';
        echo "<script> history.go(-2); </script>";
    }
}
?>