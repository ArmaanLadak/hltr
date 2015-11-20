<!DOCTYPE html>
<html dir="ltr" lang="en" class="off-canvas">
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>How Long to Read</title>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="./css/theme-responsive.css">
<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=RobotoDraft:100,300,400,500,700" rel=
    "stylesheet">
<script type="text/javascript">
    $(function () {
      $(document).ready(function(){
        var Size = screen.height;
			if(Size == 600)
				{
					  $(".mid_container").css('min-height',420);
				}
			if(Size == 768)
				{
					  $(".mid_container").css('min-height',664);
				}
			if(Size == 800)
				{
					  $(".mid_container").css('min-height',543);
				}
			if(Size == 832)
				{
					  $(".mid_container").css('min-height',563);
				}	
			if(Size == 900)
				{
					  $(".mid_container").css('min-height',800);
				}	
			if(Size == 1050)
				{
					  $(".mid_container").css('min-height',949);
				}
			if(Size == 1080)
				{
					  $(".mid_container").css('min-height',982);
				}	
				
      });
    });
  </script>
</head>
<body class="fs12 page-home ">
<div id="page-container">
<?php include_once('header.php'); ?>
<?php include_once("analyticstracking.php") ?>
</div>
<section class="pav-showcase mid_container" id="pavo-showcase">
   <div class="container" >
	   <div class="row-fluid" style="margin-bottom:20px; text-align:center;">
		   <div class="span12">
			   <img width="200px" src="images/logo.png">
			   <div class="spacer10"></div>
			   <h2 style="color:white;">How Long to Read</h2>
			   <div class="spacer10"></div>
			   <form action="search_result.php" method="get">
			   <input type="text" class="span8" name="search_keyword" id="search_keyword" autofocus="autofocus" size="21" maxlength="120" style="margin:0; height:43px;" placeholder="Search over 12 million books">
			   <input type="submit" class="btn btn-default btn-large" value="Search">
			   </form>
			   <div style="margin-top:60px;"> <p style="margin-top:20px;text-align:center">Search over 12 million books and find your reading time for each one.</p></div>
		   </div>
	   </div>
   </div>
</section>
	<div class="myFooter">
			<?php include_once('footer.php'); ?>
	</div>	
