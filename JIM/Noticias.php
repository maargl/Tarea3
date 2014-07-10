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
        <script language="JavaScript">
        function pregunta(){
            if (confirm('¿Estas seguro de eliminar?')){
                return true;
            }
            else{
                return false;
            }
     }
        </script> 
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
                                                            Noticias
							</h2>
							<p>
                                                           <table>
                                                            <form name=form1 action="editarNoticia.php" method="post">
                                                                <tr><td>Seleccion de Noticia : <br/><br/>
                                                                         
                                                     <?php
                                                     if ($_SESSION["User_tipo"]==1){
                                                        $bd = new conexionBD();
                                                        $bd->sentencia = "select * from noticias order by id_noticia desc";
                                                        $rs = $bd->Consultar();
                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            echo '<input type="radio" name="Noticia" value="'.$fila["id_noticia"].'"> '.$fila["titular"].' :<br/>'.$fila["contenido"].'<br/><br/>';
                                                        }
                                                        $bd->FreeResult($rs);
                                                     }
                                                     else{
                                                         $bd = new conexionBD();
                                                        $bd->sentencia = "select * from noticias where id_area=".$_SESSION["User_area"]." order by id_noticia desc";
                                                        $rs = $bd->Consultar();
                                                        for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                        {
                                                            $fila = $bd->NextRow($rs);
                                                            echo '<input type="radio" name="Noticia" value="'.$fila["id_noticia"].'"> '.$fila["titular"].' :<br/>'.$fila["contenido"].'<br/><br/>';
                                                        }
                                                        $bd->FreeResult($rs);
                                                     }
                                                    
                                                ?>
                                                                    </td></tr> 
                                                                 <tr><td><input name="Editar" type="submit" value="Editar"></input>
                                                                     <input name="Eliminar" onclick="return pregunta()" type="submit" value="Eliminar"></input></td></tr>
                                                            </form>
                                                                <tr><td><br/><a href="/JIM/nuevaNoticia.php">Nueva Noticia</a></td></tr>
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
    </body>
</html>
