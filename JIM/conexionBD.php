<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class conexionBD
        {
            var $conexion;
            var $sentencia;
            function conexionBD()
            {
                $this->conexion = pg_connect("host=127.0.0.1 dbname=JIM port=5432 user=postgres password=jeremy");
                if (!$this->conexion)
                {
                    echo "Error conectando con el servidor de bases de datos.";
                    exit; 
                }
            }
            function Consultar(){
                @$resultado = pg_query($this->conexion, $this->sentencia);
                if ($resultado)
                    return $resultado;
                else
                {
                    echo "<b>Error en consulta:</b> ".pg_last_error($this->conexion);
                    exit;
                }
            }
            function TotalRows($resultado)
            {
                return pg_num_rows($resultado);
            }
            function NextRow($resultado)
            {
                return pg_fetch_array($resultado);
            }
            function FreeResult($resultado)
            {
                pg_free_result($resultado);
            }
            function Cerrar()
            {
                pg_close($this->conexion);
            }
        }
        ?>
    </body>
</html>
