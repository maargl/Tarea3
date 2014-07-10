<?php
        include("conexionBD.php");
        session_start ();
        $idColaborador=addslashes($_POST["Colaborador"]);
        $talla=addslashes($_POST["Talla"]);
        echo $talla;
        echo $idColaborador;
        if (isset($_POST['Colaborador']))
        {
            $bd = new conexionBD();
            $bd->sentencia = "update colaboradores set talla_polera='".$talla."' where id_colaborador=".$idColaborador.";";
            $rs = $bd->Consultar();
            
            $bd->FreeResult($rs);
            echo "<script> history.go(-1); </script>";
        }
        