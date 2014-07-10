
<?php include("conexionBD.php"); 
session_start();
if (isset($_SESSION["agregar_area"]))
    unset($_SESSION["agregar_area"]);
else if (isset($_SESSION["editar_area"]))
    unset($_SESSION["editar_area"]);
else if (isset($_SESSION["eliminar_area"]))
    unset($_SESSION["eliminar_area"]);
if (isset($_POST["Agregar"]))
    $_SESSION["agregar_area"] = 1;
else if (isset($_POST["Editar"]))
    $_SESSION["editar_area"] = 1;
else if (isset($_POST["Eliminar"]))
    $_SESSION["eliminar_area"] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Coffeelike by nodethirtythree + Templated.org
	http://templated.org/ | @templatedorg
	Released under the Creative Commons Attribution 3.0 License.
	
	Note from the author: These templates take quite a bit of time to conceive,
	design, and finally code. So please, support our efforts by respecting our
	license: keep our footer credit links intact so people can find out about us
	and what we do. It's the right thing to do, and we'll love you for it :)
	
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Bienvenidos a Jim</title>
        <link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css" />
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
		<div id="bg">
			<div id="outer">
				<div id="header">
					<div id="logo">
						<h1>
							<a href="#">JIM</a>
						</h1>
					</div>
					<div id="nav">
						<ul>
							<li class="first active">
								<a href="/JIM/index.php">Home</a>
							</li>
							
						</ul>
						<br class="clear" />
					</div>
				</div>
				<div id="main">
					<div id="sidebar">
						<h2>
							Login
						</h2>
						<p>
							<?php
                                                        echo "Usuario: ";
                                                        echo $_SESSION["User_nombre"] ;
                                                        if ($_SESSION["User_tipo"]== NULL){
                                                            echo "<br/> colaborador";
                                                        }
                                                        else if ($_SESSION["User_tipo"]== "1"){
                                                            echo "<br/> Administrador General";
                                                        }
                                                        else if ($_SESSION["User_tipo"]== "2"){
                                                            echo "<br/> Administrador de Area";
                                                        }
                                                        ?>
                                                        						</p>
						<h3>
							Menu
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="/JIM/index.php">Home</a>
							</li>
							
						</ul> 
					</div>
					<div id="content">
						<div id="box1">
                                                    <?php if (isset($_SESSION["agregar_area"]))
                                                    {
                                                    ?>
							<b><h2> Agregar Area </h2></b>
                                                        <table>
                                                        <form action="accionArea.php" method="post">
                                                            <center><table>
                                                                <tr><td align="right" valign="top"><b>Nombre:</b></td>
                                                                    <td><input type="text" size="25" name="Nombre"> </td>
                                                                </tr>
                                                                <tr><td align="right" valign="top"><b>Numero estimado de colaboradores:</b></td>
                                                                    <td><input type="text" size="10" name="Ncolaboradores"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                    <td><input type="submit" name="Agregar" value="Enviar">
                                                                    <input type="reset" value="Borrar"></td> </td>
                                                                </tr>
                                                            </table></center>
                                                        </form>
                                                        </table>
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                        if (isset($_POST["seleccion"]))
                                                            $_SESSION["id_area"] = (integer)$_POST["seleccion"];
                                                        $bd = new conexionBD();
                                                        $bd->sentencia = "SELECT * FROM areas WHERE id_area=".$_SESSION["id_area"].";";
                                                        $rs = $bd->Consultar();
                                                        $nombre = "";
                                                        $num = "";
                                                        if ($bd->TotalRows($rs) > 0)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            $nombre = $fila["nombre_area"];
                                                            $num = $fila["num_colaboradores"];
                                                        }
                                                        $bd->FreeResult($rs);
                                                        $bd->Cerrar();
                                                        if (isset($_SESSION["editar_area"]))
                                                        {
                                                    ?>
                                                            <b><h2> Editar Area </h2></b>
                                                            <table>
                                                            <form action="accionArea.php" method="post">
                                                            <center><table>
                                                                <tr><td align="right" valign="top"><b>Nombre:</b></td>
                                                                    <?php echo '<td><input type="text" size="25" name="Nombre" value="'.$nombre.'"></td>'
                                                                    ?>
                                                                </tr>
                                                                <tr><td align="right" valign="top"><b>Numero estimado de colaboradores:</b></td>
                                                                    <?php echo '<td><input type="text" size="10" name="Ncolaboradores" value="'.$num.'"></td>' ?>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                    <td><input type="submit" name="Editar" value="Enviar">
                                                                    <input type="reset" value="Borrar"></td> </td>
                                                                </tr>
                                                            </table></center>
                                                            </form>
                                                            </table>
                                                    <?php
                                                        }
                                                        else if (isset($_SESSION["eliminar_area"]))
                                                        {
                                                    ?>
                                                            <form action="accionArea.php" method="post">
                                                                ¿Quieres eliminar <?php echo $nombre?> de Areas?
                                                                <input type="submit" name="Eliminar" value="Si">
                                                                <input type="submit" name="Eliminar" value="No">
                                                            </form>
                                                    <?php     
                                                        }
                                                    }
                                                    ?>
						</div>
						<br class="clear" />
					</div>
					<br class="clear" />
				</div>
			</div>
			<div id="copyright">
				&copy; Your Site Name | Design: <a href="http://templated.org/free-css-templates/coffeelike/">Jim</a> by <a href="http://nodethirtythree.com">nodethirtythree</a> + <a href="http://templated.org/">Templated.org</a>
			</div>
		</div>
    </body>
</html>