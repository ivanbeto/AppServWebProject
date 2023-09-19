<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Pagina inicial de una tienda virtual de articulos de gaming">
	<meta name="keywords" content="Videojuegos, Gaming, Coleccionables, Funko, PS4, XBOX, PC">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--Link para poder hacer uso de iconos de redes sociales-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Para el titulo-->
	<link href="https://fonts.googleapis.com/css2?family=Tomorrow&display=swap" rel="stylesheet">
	<!--Para los parrafos y textos planos-->
	<link href="https://fonts.googleapis.com/css2?family=Alef&display=swap" rel="stylesheet">
	<!--Para la barra de navegacion-->
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&family=Raleway:ital,wght@1,200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Tourney:ital,wght@1,100&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="images/logoFireGaming.png">
	<title>Fire Gaming - Resumen de compra</title>
</head>

<body>
<div class="titulo">
		<a class="logo" href="index.html">
			<img id="logoFG" src="images/logoFireGaming.png">
		</a><br>
		<h1 id="nombres">Fire Gaming</h1><br>
		<h3 id="nombres">Resumen de pedido</h3>
	</div>
<?php
$cantidad = $_POST[cantidad];
$select = $_POST[select];
echo "<span style='color:white;'>Seleccionaste el articulo $select con una cantidad de $cantidad <br></span>";

function dispError()
{ return mysql_error() . "(" . mysql_errno() . ")" ; }
$db_cnx   = mysqli_connect("localhost:3306", "root","adminbeto", "bd22");
$cnx_rslt = mysqli_connect_errno();

if ($cnx_rslt == 0)
   { //echo "Conexion a DB Server exitosa <br><br>"; 
   }
  else
   { echo "<span style='color:white;'>Error de Conexion al DB Server: "  . $cnx_rslt . " " . mysqli_connect_error()
       . "<br><br></span>" ; exit; }

$sql = "select * from productos where id_producto = " . $select;
$result = mysqli_query($db_cnx, $sql);
if($result->num_rows>0){
	while($fila=$result->fetch_assoc()){
		$name = $fila['nombre_P'];
		$precio = $fila['precio'];
		$disponibilidad = $fila['disponibles'];
	}
}

if($disponibilidad>=$cantidad){
	echo "<span style='color:white;'>Producto: " . $name . "<br></span>";
	echo "<span style='color:white;'>Precio: " . $precio . "<br></span>";
	$total = $cantidad * $precio;
	echo "<span style='color:white;'>Total: " . $total . "<br></span>";
	// Se le pasa NULL al inicio porque con el AUTO_INCREMENT se coloca solo el pedido
	$sql = "insert into pedidos values ( NULL, 1, ". $select . ", ". $cantidad .", ". $total .")";
	$result = mysqli_query($db_cnx, $sql);
	//echo "Resultado =  $result " . mysqli_error($db_cnx) . "<br>";

}else{
	if($disponibilidad == 0){
		echo "<span style='color:white;'>Lo siento, este artículo esta agotado <br></span>";
	}else{
		echo "<span style='color:white;'>Lo siento, el inventario no cubre su pedido, actualmente contamos con " . $disponibilidad ."<br></span>";
	}
	
}
date_default_timezone_set('America/Mexico_City');
$date = date('d/m/y', time());
echo "<span style='color:white;'>Pedido realizado en fecha: ".$date."<br></span>";
?>
</body>
<footer>
	<div class="grid-final">
		<div class="item-foot">
		   <h5>Informacion de la compania</h5>
		   <ul style="color: blue;">
		     <li><a href="about.html">Sobre Nosotros</a></li>
		     <li><a href="#">Trabaja con Nosotros</a></li>
            </ul>
		</div>
		<div class="item-foot">
			<h5>Redes sociales</h5>
			<ul style="color: blue;">
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Instagram</a></li>
				<li><a href="#">Twitter</a></li>
			</ul>
		</div>
		<div class="item-foot"></div>
	</div>

	<h4>Fire Gaming México Company. 2022.
	Todos los derechos reservados</h4>
</footer>
</html>