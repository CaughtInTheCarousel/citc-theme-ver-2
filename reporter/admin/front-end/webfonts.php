<html>
<head>
<?php

//setup some vars
$font_family = isset($_GET['font_family']) ? $_GET['font_family'] : 'Open Sans';
$font_size = isset($_GET['font_size']) ? $_GET['font_size'] : '18px';
$font_height = isset($_GET['line_height']) ? $_GET['line_height'] : '1.4em';
$font_color = isset($_GET['font_color']) ? $_GET['font_color'] : '333333';
$font_weight = isset($_GET['font_weight']) ? $_GET['font_weight'] : 'normal';

$family = preg_replace('/\:.*/', '', preg_replace('/\&.*/', '', $font_family) );

?>
<link href='http://fonts.googleapis.com/css?family=<?php echo $font_family ?>' rel='stylesheet' type='text/css'>
<style>
body {
	background: #fdfdfd;
}
span {
	font-family: <?php echo $family ?>;
	font-size: <?php echo $font_size ?>;
	line-height: <?php echo $font_height ?>;
	color: <?php echo $font_color ?>;
}
</style>
</head>
<body>
	<span>The quick brown fox jumps over the lazy dog.</span>
</body>
</html>

