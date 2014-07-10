<?php
session_start ();
include("conexionBD.php");
$area=$_SESSION["User_area"];
if (isset($_POST['Seguir'])){
    $area=addslashes($_POST["Area"]);
}
//$_SESSION["Area_postulante"]=$area;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Jim 2015</title>
        <link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript">
        function pregunta(){
            if (confirm('¿Estas seguro de descartar?')){
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
                                                            Colaboradores
							</h2>
							<p>
                                                           <table  border="1" align="center">
                                                            <form name=form1 action="editarColaborador.php" method="post">
                                                                <tr>
                                                                    <th>
                                                                        Selec
                                                                    </th>
                                                                    <th>
                                                                        Nombre
                                                                    </th>
                                                                    <th>
                                                                        Carrera
                                                                    </th>
                                                                    <th>
                                                                        Correo 
                                                                    </th>
                                                                    <th>
                                                                        Telefono
                                                                    </th>
                                                                    <th>
                                                                        talla
                                                                    </th>
                                                                    <th>
                                                                        seleccionado
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                                if ($area=="0"){
                                                                    $bd = new conexionBD();
                                                                    $bd->sentencia = "select * from colaboradores where (seleccion1='t' or seleccion2='t'or seleccion3='t') and id_carrera in (select id_carrera from carreras where campus='".$_SESSION["Campus"]."') order by nombre asc";
                                                                    $rs = $bd->Consultar();
                                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                                    {
                                                                        $fila = $bd->NextRow($rs);
                                                                        echo"<tr>";
                                                                        echo '<td><input type="radio" name="Colaborador" value="'.$fila["id_colaborador"].'"></td>';
                                                                        echo '<td>'.$fila["nombre"].'</td>';
                                                                        $bd2 = new conexionBD();
                                                                        $bd2->sentencia = "select nombre_carrera from carreras where id_carrera=".$fila["id_carrera"].";";
                                                                        $rs2 = $bd2->Consultar();
                                                                        if ($bd2->TotalRows($rs2) > 0)
                                                                        {
                                                                            $fila2 = $bd2->NextRow($rs2);
                                                                            echo '<td>'.$fila2["nombre_carrera"].'</td>';
                                                                        }
                                                                        echo '<td>'.$fila["correo_electronico"].'</td>';
                                                                        echo '<td>'.$fila["telefono"].'</td>';
                                                                        if ($fila["talla_polera"]!=""){
                                                                            echo '<td>'.$fila["talla_polera"].'</td>';
                                                                        }
                                                                        else{
                                                                            echo '<td>no seleccionado</td>';
                                                                        }
                                                                        $a="";
                                                                        if ($fila["seleccion1"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area1"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' - ';
                                                                            }
                                                                        }
                                                                        if ($fila["seleccion2"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area2"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' - ';
                                                                            }
                                                                        }
                                                                        if ($fila["seleccion3"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area3"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' ';
                                                                            }
                                                                        }
                                                                        echo '<td>'.$a.'</td>';
                                                                        echo "</tr>";
                                                                    }
                                                                    $bd->FreeResult($rs);
                                                                }
                                                                else{
                                                                    $bd = new conexionBD();
                                                                    $bd->sentencia = "select * from colaboradores where ((id_area1=".$area." and seleccion1='t') or (id_area2=".$area." and seleccion2='t')or (id_area3=".$area." and seleccion3='t')) and id_carrera in (select id_carrera from carreras where campus='".$_SESSION["Campus"]."') order by nombre asc";
                                                                    $rs = $bd->Consultar();
                                                                    for ($i = 0; $i < $bd->TotalRows($rs); $i++)
                                                                    {
                                                                        $fila = $bd->NextRow($rs);
                                                                        echo"<tr>";
                                                                        echo '<td><input type="radio" name="Colaborador" value="'.$fila["id_colaborador"].'"></td>';
                                                                        echo '<td>'.$fila["nombre"].'</td>';
                                                                        $bd2 = new conexionBD();
                                                                        $bd2->sentencia = "select nombre_carrera from carreras where id_carrera=".$fila["id_carrera"].";";
                                                                        $rs2 = $bd2->Consultar();
                                                                        if ($bd2->TotalRows($rs2) > 0)
                                                                        {
                                                                            $fila2 = $bd2->NextRow($rs2);
                                                                            echo '<td>'.$fila2["nombre_carrera"].'</td>';
                                                                        }
                                                                        echo '<td>'.$fila["correo_electronico"].'</td>';
                                                                        echo '<td>'.$fila["telefono"].'</td>';
                                                                        if ($fila["talla_polera"]!=""){
                                                                            echo '<td>'.$fila["talla_polera"].'</td>';
                                                                        }
                                                                        else{
                                                                            echo '<td>no seleccionado</td>';
                                                                        }
                                                                        $a="";
                                                                        if ($fila["seleccion1"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area1"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' - ';
                                                                            }
                                                                        }
                                                                        if ($fila["seleccion2"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area2"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' - ';
                                                                            }
                                                                        }
                                                                        if ($fila["seleccion3"]=="t"){
                                                                            $bd2 = new conexionBD();
                                                                            $bd2->sentencia = "select nombre_area from areas where id_area=".$fila["id_area3"].";";
                                                                            $rs2 = $bd2->Consultar();
                                                                            if ($bd2->TotalRows($rs2) > 0)
                                                                            {
                                                                                $fila2 = $bd2->NextRow($rs2);
                                                                                $a.=$fila2["nombre_area"].' ';
                                                                            }
                                                                        }
                                                                        echo '<td>'.$a.'</td>';
                                                                        echo "</tr>";
                                                                    }
                                                                    $bd->FreeResult($rs);
                                                                 }
                                                                 
                                                     
                                                ?>
                                                                  </table>
                                                                  Talla: <select name="Talla">
                                                                      <option value="S">S</option>
                                                                      <option value="M">M</option>
                                                                      <option value="L">L</option>
                                                                      <option value="XL">XL</option>
                                                                      </select>
                                                                 <br/><input name="Editar" type="submit" value="Editar Talla"></input>
                                                                    </form>
                                                                        
                                                    
                                                           
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
