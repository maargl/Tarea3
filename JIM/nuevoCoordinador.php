
<?php include("conexionBD.php"); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Jim</title>
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
							login
						</h2>
						<p>
							 <?php
                                                    session_start ();
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
                                                      <?php
                                                    if (!isset($_SESSION["User_id"]))
                                                    {?>
                                                        <li>
								<a href="/JIM/postular.php">Postular</a>
							</li>
                                                    
                                                    <?php }
                                                    else if ($_SESSION["User_tipo"]== "1"){
                                                    ?>
                                                         <li>
								<a href="/JIM/misDatos.php">Mis Datos</a>
							</li>
                                                         <li>
                                                             <a href="/JIM/Areas.php">Areas</a>
							</li>
                                                         <li>
								<a href="/JIM/coordinadorArea.php">Coord. Areas</a>
							</li>
                                                         <li>
								<a href="/JIM/Noticias.php">Noticias</a>
							</li>
                                                         <li>
								<a href="/JIM/menuPostulante.php">Postulantes</a>
							</li>
                                                         <li>
								<a href="/JIM/menuColaborador.php">Colaboradores</a>
							</li>
                                                        <li>
								<a href="/JIM/cerrar.php">Cerrar Sesion</a>
							</li>
                                                        
                                                    <?php }
                                                       else if ($_SESSION["User_tipo"]== "2"){
                                                    ?>
                                                         <li>
								<a href="/JIM/misDatos.php">Mis Datos</a>
							</li>
                                                        <li>
								<a href="/JIM/Noticias.php">Noticias</a>
							</li>
                                                         <li>
								<a href="/JIM/Postulantes.php">Postulantes</a>
							</li>
                                                         <li>
								<a href="/JIM/Colaboradores.php">Colaboradores</a>
							</li>
                                                        <li>
								<a href="/JIM/cerrar.php">Cerrar Sesion</a>
							</li>
                                                        
                                                    <?php }
                                                      else if($_SESSION["User_tipo"]== NULL) {
                                                          echo ' <li><a href="/JIM/misDatos2.php">Mis Datos</a></li>';
                                                          echo ' <li><a href="/JIM/cerrar.php">Cerrar Sesion</a></li>';
                                                      }                                      
                                                    ?>
						</ul> 
					</div>
					<div id="content">
						<div id="box1">
							<b><h2> Agregar Cordinador</h2></b>
                                                        <table>
                                                        <form action="insertarCoordinador.php" method="post">
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
                                                            <tr><td>Talla Polera : <input type="text" name="Talla"></input></tr></td>
                                                            <tr><td>Area  : <select name="Area">
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
                                                       
                                                <tr><td>Contrasenna : <input type="password" name="Contrasenna"></input></tr></td>
                                                <tr><td><input name="Enviar"  type="submit" value="Enviar"></input></tr></td>
                                                </form>
                                                </table>
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
