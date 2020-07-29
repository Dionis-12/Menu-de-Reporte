<?php

// Conexión a la BD SQL SERVER
// $srv="L3GCAMJ01GFQK\SQL";
$srv = "(local)";
$opc = array("Database"=>"Broadcast", "UID"=>"Dionis", "PWD"=>"123");
// $opc= array("Database"=>"Broadcast", "UID"=>"CCanales", "PWD"=>"2536_Iso");
$con = sqlsrv_connect($srv, $opc); 
if ($con) {
         //echo "Conexión establecida.<br />";
    } else {
         echo "Conexión no se pudo establecer.<br />";
         die ( print_r( sqlsrv_errors(), true));
    }

if (date('D') == 'Mon' || date('D') == 'Tue') { 
  $sql = "SELECT fecha, canal, count(*) as Cantidad
          FROM Broadcast_call
          WHERE canal in ('AA', 'ASI', 'CDS', 'CC', 'MM') 
          and CONVERT(date, Fecha)>= convert (date, getdate() -30 )
          GROUP BY fecha, canal
          ORDER BY fecha, Cantidad asc";
} else {
  $sql = "SELECT fecha, canal, count(*) as Cantidad
          FROM Broadcast_call
          WHERE canal in ('AA', 'ASI', 'CDS', 'CC', 'MM') 
          and CONVERT(date, Fecha)>= convert (date, getdate() -29 )
          GROUP BY fecha, canal
          ORDER BY fecha, Cantidad asc";
}

$res = sqlsrv_query($con, $sql);

if ( $con === false ) {
     die ( print_r( sqlsrv_errors(), true));
    }

?>