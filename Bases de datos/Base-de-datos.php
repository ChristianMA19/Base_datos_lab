<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HackZit - Bases de Datos</title>
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
  <header>
    <div class="primary_header">
		
      <h1 class="title" >HackZit - Bases de Datos</h1>
    </div>
    <nav class="secondary_header" id="menu">
      <ul>
		  <li><img src="images/logo_transparent.png"  class="logo"></li>
        <li><a href="index.html" class="nav-enlace">Home Page</a></li>
        <li><a href="grafico1.php" class="nav-enlace">Grafico 1</a></li>
		  <li><a href="grafico2.php" class="nav-enlace">Grafico 2</a></li>
		<li><a href="grafico3.php" class="nav-enlace">Grafico 3</a></li>
		<li><a href="grafico.php" class="nav-enlace">Grafico 4</a></li>
		  <li><a href="Base-de-datos.php" class="nav-enlace">Base de Datos</a></li>
		  <li><a href="https://www.uninorte.edu.co/" class="nav-enlace">Universidad del Norte</a></li>
		  
      </ul>
    </nav>
  </header>

<table border="1" align="center" bordercolor=#FFFFFF >
	<tr bgcolor="#FFFFFF">
	  	<td>App Name</td>
	  	<td>Category</td>
	  	<td>Rating</td>
		<td>Rating Count</td>
	  	<td>Installs</td>
		<td>Size</td>
	  	<td>Developer Id</td>
		<td>Content Rating</td>
	</tr>
	<?php
	$sql="SELECT * FROM `google_playstore` LIMIT 1000";
	$result=mysqli_query($conexion,$sql); while($mostrar=mysqli_fetch_array($result)){
	?>
	<tr bgcolor="#FFFFFF">
		<td><?php echo $mostrar['AppName']?></td>
	  	<td><?php echo $mostrar['Category']?></td>
	  	<td><?php echo $mostrar['Rating']?></td>
		<td><?php echo $mostrar['RatingCount']?></td>
		<td><?php echo $mostrar['Installs']?></td>
		<td><?php echo $mostrar['Size']?></td>
		<td><?php echo $mostrar['DeveloperId']?></td>
		<td><?php echo $mostrar['ContentRating']?></td>
	</tr>
	<?php
	}
	?>
</table>
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2021 - <strong>SIMPLE Theme</strong></div>
  </footer>
</div>
</body>
</html>
