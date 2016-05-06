<html>

    <head>

	<?php    
	    $root = $_SERVER['DOCUMENT_ROOT'];
	    $root .= "/wip/atelier-bek.be.www";
	
	    include_once($root . "php/meta.php");
	?>

	<link rel="stylesheet/less" type="text/css" href="css/reset.less" />
	<link rel="stylesheet" type="text/css" href="lib/jquery-ui-1.11.4/jquery-ui-custom.css" />
	<link rel="stylesheet" type="text/css" href="fonts/output-stylesheet.css" />
	<link rel="stylesheet/less" type="text/css" href="css/styles-post.less" />
	
	<script type="text/javascript" src="lib/less.min.js"></script>
	<script type="text/javascript" src="lib/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>

    </head>

  <body>
    
    <?php include "php/vars.php"; ?>
    
    <?php include "php/content.php"; ?>
    
    <?php include "php/nav.php"; ?>
    
    <?php include "php/send.php"; ?>

  </body>

    <script type="text/javascript" src="js/searchsortfilter.js"></script>
    <script type="text/javascript" src="js/datas.js"></script>

</html>
