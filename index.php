<!DOCTYPE html>
<html dir="ltr" lang="en" class="off-canvas">
<head>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "042fe7c8-61a0-432b-9f9a-3808a2ef5415", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="Search over 12 million books and find your reading time for each one with How Long to Read.">
<meta charset="UTF-8">
<title>How Long to Read</title>
<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
<!--<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="./css/theme-responsive.css">-->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=RobotoDraft:100,300,400,500,700" rel="stylesheet">
</head>

<body>
<div class="wrapper">
<?php include_once('header.php'); ?>
<?php include_once("analyticstracking.php") ?>
<div class="container">
	<div class="row-fluid" style="margin-bottom:20px; text-align:center;">
		<div class="span12">
			<img style="width:500px;height:auto;max-width:100%" src="http://www.howlongtoreadthis.com/images/logo.png">
			<div class="spacer10"></div>
			<h2 style="color:white;">How Long to Read</h2>
			<div class="spacer10"></div>
			<form action="search_result.php" method="get">
    				<div class="form-group">
					<input type="text" class="form-control" name="search_keyword" id="search_keyword" style="height:45px;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px" autofocus="autofocus" maxlength="120" placeholder="Search over 12 million books">
    				</div>
    				<center><input type="submit" class="btn btn-default btn-large" value="Search"></center>
  			</form>
			<div style="margin-top:60px;"> 
				<p style="margin-top:20px;text-align:center">Search over 12 million books and find your reading time for each one.</p></div>
		 	</div>
		</div>
	</div>
	<div class="push"></div>
</div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>
