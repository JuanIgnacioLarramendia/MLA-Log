<!--- Breve interfaz visual de HTML para proveer a la pagina de un boton capaz de volver a generar consultas -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

// Utilizado para validar si la variable esta definida
if(isset($_GET['user'])){
}

//Creacion de variables a utilizar y apertura del archivo output
$var = $_REQUEST['user'];
$separador =",";
$users = explode($separador,$var);
$cont=0;
$tam= sizeof($users);
$log = fopen("log.txt","a") or die("Error al crear");

//Se abre un ciclo para realizar el output con cada usuario solicitado 
    foreach($users as $user){
        fwrite($log,$user."\n");
        fwrite($log,"--------------------------------\n");
        $url = "https://api.mercadolibre.com/sites/MLA/search?seller_id=".$user;
        $json = file_get_contents($url);
        $data = json_decode($json,true);
        $items = $data["results"];
        //Se abre nuevamente un ciclo para recorrer cada detalle solicitado en el output
        foreach($items as $item){
            fwrite($log,$item["id"]);
            fwrite($log,"\n");
            fwrite($log,$item["title"]);
            fwrite($log,"\n");
            fwrite($log,$item["category_id"]);
            fwrite($log,"\n");
            fwrite($log,$item["domain_id"]);
            fwrite($log,"\n");
            fwrite($log,"--------------------------------\n");
        }
    }
    //Cierre del archivo
    fclose($log);
    echo "Se creo el archivo correctamente."
?>

<br>
<button type="submit"><a href="index.html">Nueva consulta</a></button>
</body>
</html>
