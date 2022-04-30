<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');

	$sql1="SELECT Category, AVG(Rating) Rating FROM `google_playstore` WHERE Rating != 0 GROUP BY Category;";
	$sql2="SELECT DeveloperId, AVG(Rating) Rating FROM `google_playstore` WHERE Rating != 0 GROUP BY DeveloperId;";
	$sql3="SELECT ContentRating, AVG(Rating) Rating FROM `google_playstore` WHERE Rating != 0 GROUP BY ContentRating;";
	$result1=mysqli_query($conexion,$sql1);
	$result2=mysqli_query($conexion,$sql2);
	$result3=mysqli_query($conexion,$sql3);
	foreach ($result1 as $data) {
    	$category[] = $data['Category'];
		$Rating1[] = $data['Rating'];
	}	
	foreach ($result2 as $data) {
		$DeveloperId[] = $data['DeveloperId'];
		$Rating2[] = $data['Rating'];
	}	
	foreach ($result3 as $data) {
		$ContentRating[] = $data['ContentRating'];
		$Rating3[] = $data['Rating'];
	}	
 
	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
 	
	$dataPoints1 = array();	
	$dataPoints2 = array();	
	$dataPoints3 = array();	
	
	for ($i = 0; $i < count($category); $i++) {
		array_push($dataPoints1, array("label"=> $category[$i], "y"=> $Rating1[$i])); 
	}
	for ($i = 0; $i < count($DeveloperId); $i++) {
		array_push($dataPoints2, array("label"=> $DeveloperId[$i], "y"=> $Rating2[$i])); 
	}
	for ($i = 0; $i < count($ContentRating); $i++) {
		array_push($dataPoints3, array("label"=> $ContentRating[$i], "y"=> $Rating3[$i])); 
	}


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
	 
<script type="text/javascript">
	var subjectObject1 = {
  "Front-end": {
    "HTML": ["Links", "Images", "Tables", "Lists"],
    "CSS": ["Borders", "Margins", "Backgrounds", "Float"],
    "JavaScript": ["Variables", "Operators", "Functions", "Conditions"]    
  },
  "Back-end": {
    "PHP": ["Variables", "Strings", "Arrays"],
    "SQL": ["SELECT", "UPDATE", "DELETE"]
  }
}
			var subjectObject = {
  "Category": 
    ["5",
    "10",
    "20",
	"30",
	"40",
	"48"]
  ,
  "Developer": [
    "5",
    "20",
    "50",
	"100",
	"500",
	"1000",
	"60035"
  ],
  "Content Rating": [
    "2",
    "4",
    "6"
  ]
}
		
window.onload = function () {
 				 	var amountData = document.getElementById('Amount');
					var TypeData = document.getElementById('rows');
				
				  for (var x in subjectObject) {
					TypeData.options[TypeData.options.length] = new Option(x, x);
				  }
				  TypeData.onchange = function() {
					//empty Chapters- and Topics- dropdowns
					amountData.length = 1;
					//display correct values
					var z = subjectObject[TypeData.value];
					for (var i = 0; i < z.length; i++) {
					  amountData.options[amountData.options.length] = new Option(z[i], z[i]);
					}
				  }
				  
				
				amountData.addEventListener( "change",  function(){
				var am = parseInt(amountData.options[amountData.selectedIndex].value);
				console.log(am);
				
				var type = TypeData.options[TypeData.selectedIndex].value
				switch(type) {
				  case "Category":
					var dataJSon= <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
					break;
				  case "Developer":
					var dataJSon= <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
					break;
				  case "Content Rating":
					var dataJSon= <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;
					break;
				  default:
					// code block
				}
					
				
				var dataJS = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS[i]=dataJSon[i];
				}
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					zoomEnabled: true,
					theme: "dark1",
					options: {
								maintainAspectRatio: false
							},
					title:{
						text: "Ratings"
					},
					axisY: {
						title: "Rating"
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					data: [{
						type: "stepArea",
						dataPoints: dataJS
					}]
				});

					chart.render();
					
			});
	
	
	var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					zoomEnabled: true,
					theme: "dark1",
					options: {
								maintainAspectRatio: false
							},
					title:{
						text: "Ratings"
					},
					axisY: {
						title: "Rating"
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					data: [{
						type: "stepArea",
						dataPoints: 0
					}]
				});
					chart.render();
		
	}

					
					
 
	
</script>	
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


	<div>Rating vs:
  <select id="rows" name="DataRow">
	<option value="" selected disabled hidden>Choose here</option>
  </select>  
</div>
	<div>Amount of data to show:
  <select id="Amount" name="Cantidad">
	<option value="" selected disabled hidden>Select previous first</option>
  </select>  
</div>
<div id="chartContainer" style="height: 605px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <footer class="secondary_header footer">
	  
    <div class="copyright">&copy;2021 - <strong>SIMPLE Theme</strong></div>
  </footer>
</div>
</body>
</html>
