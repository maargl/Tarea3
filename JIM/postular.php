
<?php include("conexionBD.php"); ?>
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
		<title>Bienvedinos a Jim</title>
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
                                                         <li>
								<a href="/JIM/postular.php">Postular</a>
							</li>
							
						</ul>
						<br class="clear" />
					</div>
				</div>
				<div id="main">
					<div id="sidebar">
						<h2>
							login
						</h2>
						<p>
							<form action="validarUsuario.php" method="post">
                                                            rol: <input type="text" name="Usuario"></input><br/>
                                                            Clave: <input type="password" name="Contrasenna"></input><br/>                      
                                                            <input type="submit" value="Enviar"></input>    
                                                            <input type="reset" value="Borrar"></input>
                                                        </form>
                                                        						</p>
						<h3>
							Menu
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="/JIM/index.php">Home</a>
							</li>
                                                        <li>
								<a href="/JIM/postular.php">Postular</a>
							</li>
							
						</ul> 
					</div>
					<div id="content">
						<div id="box1">
							<b><h2> Postulacion </h2></b>
                                                        <table>
                                                        <form action="validarPostulacion.php" method="post">
                                                            <tr><td> Nombre : <input type="text" name="Nombre"></input></tr></td>
                                                            <tr><td>ROL USM : <input type="text" name="Rol"></input></tr></td>                   
                                                            <tr><td>RUT : <input type="text" name="Rut"></input></tr></td>
                                                            <tr><td>Carrera : <select name="Carrera">
                                                <?php
                                                    $bd = new conexionBD();
                                                    $bd->sentencia = "SELECT id_carrera,nombre_carrera FROM carreras;";
                                                    $rs = $bd->Consultar();
                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                    {
                                                        $fila = $bd->NextRow($rs);
                                                        echo '<option value='.$fila["id_carrera"].'>'.$fila["nombre_carrera"].'</option>';
                                                    }
                                                    $bd->FreeResult($rs);
                                                ?>
                                                        </select></tr></td>
                                                            <tr><td>Correo electronico : <input type="text" name="Correo"></input></tr></td>
                                                            <tr><td>Telefono : <input type="text" name="Telefono"></input></tr></td>
                                                            <tr><td>Preferencia 1 : <select name="Preferencia1">
                                                <?php
                                                    $bd->sentencia = "SELECT id_area,nombre_area FROM areas;";
                                                    $rs = $bd->Consultar();
                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                    {
                                                        $fila = $bd->NextRow($rs);
                                                        echo '<option value='.$fila["id_area"].'>'.$fila["nombre_area"].'</option>';
                                                    }
                                                    $bd->FreeResult($rs);
                                                ?>
                                                </select></tr></td>
                                                        <tr><td> Preferencia 2 : <select name="Preferencia2">
                                                         <option value=0> - </option> 
                                                 <?php
                                                    $bd->sentencia = "SELECT id_area,nombre_area FROM areas;";
                                                    $rs = $bd->Consultar();
                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                    {
                                                        $fila = $bd->NextRow($rs);
                                                        echo '<option value='.$fila["id_area"].'>'.$fila["nombre_area"].'</option>';
                                                    }
                                                    $bd->FreeResult($rs);
                                                    ?>
                                                    </select></tr></td>
                                                        <tr><td>Preferencia 3 : <select name="Preferencia3">
                                                        <option value=0> - </option>
                                            <?php
                                            $bd->sentencia = "SELECT id_area,nombre_area FROM areas;";
                                            $rs = $bd->Consultar();
                                            for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                            {
                                                $fila = $bd->NextRow($rs);
                                                echo '<option value='.$fila["id_area"].'>'.$fila["nombre_area"].'</option>';
                                            }
                                            $bd->FreeResult($rs);
                                            $bd->Cerrar();
                                            ?>
                                                </select></tr></td>
                                                <tr><td>Contrasenna : <input type="password" name="Contrasenna"></input></tr></td>
                                                <tr><td><input type="submit" value="Enviar"></input></tr></td>
                                                </table>
                                                    </form>
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
