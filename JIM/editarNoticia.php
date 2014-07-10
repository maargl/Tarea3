<!DOCTYPE html>

<html>
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
        <?php
        //echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        include("conexionBD.php");
        $idNoticia=addslashes($_POST["Noticia"]);
        if (isset($_POST['Eliminar']))
        {
             $rol=addslashes($_POST["Coordinadores"]);
             $bd = new conexionBD();
             $bd->sentencia = "delete from noticias where id_noticia =".$idNoticia.";";
             $rs = $bd->Consultar();
             $bd->FreeResult($rs);
             $bd->Cerrar();
            echo '<script type="text/javascript">alert("Eliminacion exitosa")</script>';
            echo "<script> history.go(-2); </script>";
             
        }
        else if (isset($_POST['Editar'])) 
        {?>
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
						</p><br/>
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
							<h2>
                                                            Edicion
							</h2>
							<p>
                                                        <table>
                                                        <form action="updateNoticia.php" method="post"  autocomplete="off">
                                                        <?php
                                                        
                                                        $_SESSION["id_noticia"] = $idNoticia;
                                                        $bd = new conexionBD();
                                                        $bd->sentencia = "select * from noticias where id_noticia=".$idNoticia."";
                                                        $rs = $bd->Consultar();
                                                        $carrera;
                                                        $area;
                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            echo "<tr><td> Titular : <br/><textarea type='text' name='Titular'>".$fila["titular"]."</textarea></tr></td>";
                                                            echo "<tr><td> Contenido : <br/><textarea type='text' name='Contenido' rows='10' cols='50'>".$fila["contenido"]."</textarea></tr></td>";
                                                            echo "<tr><td> Fecha : <input type='text' name='Fecha' value=".$fila["fecha"]."></input>'AAAA/MM/DD'</tr></td>";
                                                            $area=$fila["id_area"];
                                                            
                                                        }
                                                        $bd->FreeResult($rs);
                                                        ?>    
                                                            <tr><td>Area : <select name="Area">
                                                    <?php
                                                    if ($_SESSION["User_tipo"]== "1"){
                                                        $bd->sentencia = "SELECT id_area,nombre_area FROM areas;";
                                                        $rs = $bd->Consultar();
                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            echo '<option value='.$fila["id_area"].'>'.$fila["nombre_area"].'</option>';
                                                        }
                                                        $bd->FreeResult($rs);
                                                         
                                                    }
                                                    else if ($_SESSION["User_tipo"]== "2"){
                                                         $bd->sentencia = "SELECT id_area,nombre_area FROM areas where id_area=".$area.";";
                                                        $rs = $bd->Consultar();
                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            echo '<option value='.$fila["id_area"].'>'.$fila["nombre_area"].'</option>';
                                                        }
                                                        $bd->FreeResult($rs);
                                                    }
                                                         ?>
                                                </select></tr></td>
                                                       
                                                <tr><td><input name="Enviar"  type="submit" value="Enviar"></input></tr></td>
                                                </form>
                                                </table>
                                                            
							</p>
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
        
        
            
        <?php }
        else{
            header('Location: index.php');
        }
        ?>
    </body>
</html>