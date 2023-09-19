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
	<title>Fire Gaming - Resultado de busqueda</title>

</head>
<body>
	<div class="titulo">
		<a class="logo" href="index.html">
			<img id="logoFG" src="images/logoFireGaming.png">
		</a><br>
		<h1 id="nombres">Fire Gaming</h1><br>
		<h3 id="nombres">Tu tienda ideal gamer</h3>
	</div>
	
	<h2 style="font-family: 'Alef',sans-serif; color: yellow;"><?php echo "Resultado de la Búsqueda"; ?></h2>
<?php 
function dispError()
{ return mysql_error() . "(" . mysql_errno() . ")" ; }
$db_cnx   = mysqli_connect("localhost:3306", "root","adminbeto", "bd22");
$cnx_rslt = mysqli_connect_errno();

if ($cnx_rslt == 0)
   { //echo "Conexion a DB Server exitosa <br><br>"; 
   }
  else
   { echo "Error de Conexion al DB Server: "  . $cnx_rslt . " " . mysqli_connect_error()
       . "<br><br>" ; exit; }

$busqueda = $_POST[barraBusqueda];
echo "<span style='color:white;'>Buscaste: " .$busqueda ."<br></span>";
if ($busqueda == 'funko' || $busqueda == 'funkos'){
	$sql = "SELECT * FROM PRODUCTOS WHERE tipo = 'Coleccionable'";
}elseif ($busqueda == 'juegos de play' || $busqueda == 'juegos play' || $busqueda == 'juegos PS4') {
	# code...
	$sql = "SELECT * FROM PRODUCTOS WHERE tipo = 'Consola PlayStation'";
}elseif ($busqueda == 'juegos xbox' || $busqueda == 'xbox'){
	$sql = "SELECT * FROM PRODUCTOS WHERE tipo = 'Consola XBOX'";
}elseif ($busqueda == 'juegos switch' || $busqueda == 'nintendo switch' || $busqueda == 'juegos nintendo'){
	$sql = "SELECT * FROM PRODUCTOS WHERE tipo = 'Consola Nintendo Switch'";
}else {
	# code...
	$sql = "SELECT * FROM PRODUCTOS WHERE nombre_P LIKE '%".$busqueda."%'";
}
$resultado = mysqli_query($db_cnx,$sql);
echo "<span style='color:white;'> Resultados de la búsqueda: <br><br></span>";
if($resultado->num_rows>0){
	while($fila=$resultado->fetch_assoc()){
		$name = $fila['nombre_P'];
		$precio = $fila['precio'];
		$tipo = $fila['tipo'];
		$disponibilidad = $fila['disponibles'];
		echo "<span style='color:white;'> Producto:" . $name ." - Precio: ".$precio." - Tipo: ".$tipo." - Disponibles: ".$disponibilidad. " <br><br></span>";
	}
}else{
	echo "<span style='color:white;'> No logramos encontrarlo, no somos tan buenos buscando... <br><br></span>";
}
date_default_timezone_set('America/Mexico_City');
$date = date('d/m/y', time());
echo "<span style='color:white;'>Busqueda realizada en fecha: ".$date."<br></span>";
?>
</body>

<footer>
	<div class="grid-final">
		<div class="item-foot">
		   <h5>Informacion de la compañia</h5>
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
