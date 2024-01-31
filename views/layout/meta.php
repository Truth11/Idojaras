<title><?php echo $title . ' . ' . $slogen; ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta charset="utf-8" />
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $descr; ?> description" />
<meta name="news_keywords" content="<?php echo $keywords; ?>" />
<meta name="robots" content="index, follow" />
<meta name="resource-type" content="document" />
<meta name="Author" content="info@<?php echo $domain; ?>" />
<meta name="generator" content="<?php echo $domain; ?>" />
<meta name="Publisher" content="info@<?php echo $domain; ?>" />
<meta name="copyright" content="<?php echo $domain; ?>" />
<meta name="language" content="US" />
<meta name="content-language" content="US" />
<meta http-equiv="Content-Language" content="US" />

<meta property="og:image" content="https://<?php echo $domain; ?>/fblogo.jpg" />
<!--<link rel="canonical" href="">
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />-->



<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- CSS only -->
<link href="css/style.css" rel="stylesheet" >

<!-- Chart -->
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Temperature"
	},
	axisY: {
		title: "",
		valueFormatString: "#0,,.",
		suffix: "°C",
		prefix: ""
	},
	data: [{
		type: "spline",
		markerSize: 5,
		xValueFormatString: "YYYY",
		yValueFormatString: "$#,##0.##",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart.render();
 
}
</script>