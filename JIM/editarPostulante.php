<?php
        include("conexionBD.php");
        session_start ();
        $idPostulante=addslashes($_POST["Postulante"]);
        if (isset($_POST['Descartar']))
        {
            $bd = new conexionBD();
            $bd->sentencia = "select * from colaboradores where id_colaborador=".$idPostulante.";";
            $rs = $bd->Consultar();
            for ($i = 0; $i < $bd->TotalRows($rs); $i++)
            {
                $fila = $bd->NextRow($rs);
                if ($fila["id_area1"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion1='f' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
                else if ($fila["id_area2"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion2='f' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
                if ($fila["id_area3"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion3='f' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
            }
            $bd->FreeResult($rs);
            echo "<script> history.go(-1); </script>";
             
        }
        else if (isset($_POST['Seleccionar'])) {
            $bd = new conexionBD();
            $bd->sentencia = "select * from colaboradores where id_colaborador=".$idPostulante.";";
            $rs = $bd->Consultar();
            for ($i = 0; $i < $bd->TotalRows($rs); $i++)
            {
                $fila = $bd->NextRow($rs);
                if ($fila["id_area1"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion1='t' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
                else if ($fila["id_area2"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion2='t' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
                if ($fila["id_area3"]==$_SESSION["Area_postulante"]){
                    $bd2 = new conexionBD();
                    $bd2->sentencia = "update colaboradores set seleccion3='t' where id_colaborador=".$idPostulante.";";
                    $rs2 = $bd2->Consultar();
                    //$bd2->FreeResult($rs);
                }
            }
            $bd->FreeResult($rs);
            echo "<script> history.go(-1); </script>";
        }
        