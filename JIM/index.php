<?php include("conexionBD.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Jim 2015</title>
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
                                                    if (!isset($_SESSION["User_id"]))
                                                    {?>
                                                        <form action="validarUsuario.php" method="post">
                                                            Correo electronico: <input type="text" name="Correo"></input><br/>
                                                            Clave: <input type="password" name="Contrasenna"></input><br/>                      
                                                            <input type="submit" value="Enviar"></input>    
                                                            <input type="reset" value="Borrar"></input>
                                                        </form>
                                                    <?php }
                                                    else{
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
								JIM 2015
							</h2>
							<p>
							<?php if (isset($_SESSION["User_id"]) and ($_SESSION["User_tipo"]== NULL)){
                                                                    $bd = new conexionBD();
                                                                    $bd->sentencia = "select * from colaboradores where id_colaborador=".$_SESSION["User_id"];
                                                                    $rs = $bd->Consultar();
                                                                    $sel1;
                                                                    $sel2;
                                                                    $sel3;
                                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                                    {
                                                                        $fila = $bd->NextRow($rs);
                                                                        $sel1= $fila["seleccion1"];
                                                                        $sel2= $fila["seleccion2"];
                                                                        $sel3= $fila["seleccion3"];
                                                                    }
                                                                    $bd->FreeResult($rs);
                                                                    if ($sel1==$sel2 and $sel2==$sel3 and $sel3="f"){
                                                                        echo "Aun no estas seleccionado! ";
                                                                    }
                                                                    else{
                                                                        $bd = new conexionBD();
                                                                        $ids="select * from noticias where";
                                                                        if ($sel1=="t"){
                                                                            $ids.=" id_area=".$_SESSION["User_area1"];
                                                                        }
                                                                        if ($sel2=="t"){
                                                                            if ($sel1=="t"){
                                                                                $ids.=" or";
                                                                            }
                                                                            $ids.=" id_area=".$_SESSION["User_area2"];
                                                                        }
                                                                        if ($sel3=="t"){
                                                                            if ($sel1=="t" or $sel2="t"){
                                                                                $ids.=" or";
                                                                            }
                                                                            $ids.=" id_area=".$_SESSION["User_area3"];
                                                                        }
                                                                        
                                                                        $bd->sentencia = $ids." order by id_noticia desc;";
                                                                        $rs = $bd->Consultar();
                                                                        echo '<table frame="below" border="1">';
                                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                                        {
                                                                            $fila = $bd->NextRow($rs);
                                                                            echo '<tr><td>*'.$fila["titular"].' :<br/>'.$fila["contenido"].'</td></tr>';
                                                                        }
                                                                        echo '</table>';
                                                                        $bd->FreeResult($rs);
                                                                    }
                                                                    
                                                                }
                                                                else{?>
                                                                
                                                                Hola, esta pagina esta creada con el proposito de organizar la Jornada de 
                                                                insercion mechona de nuestra universidad.
                                                                Si quieres ser parte, te invitamos a postular, haciendo clic en postular
                                                                <br/><---
                                                                <br/>
                                                                <img class="left" src="images/pic1.jpg" width="500" height="400" alt="" />
                                                               <?php
                                                               
                                                                }?>
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
    </body>
</html>
