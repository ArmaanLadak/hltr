<!DOCTYPE html>
<html dir="ltr" lang="en" class="off-canvas">
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>How it Works</title>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="./css/theme-responsive.css">
<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
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
</div>
<section class="pav-showcase mid_container" id="pavo-showcase">
   <div class="container" >
   <div class="row-fluid" style="margin-bottom:20px; min-height:500px;">
   <div class="span12">
	<div style="font-weight: bold; font-size: 25px; color:#ecf0f1;" class="span12 title">
	How it Works
	</div>
	<div class="span12 title">
	<br>
	<div class="well well-small">
	<p style="text-align:justify;font-size:14px; color:#34495e; line-height:2">
	<b>1. </b>How Long to Read is a search engine that allows you to find almost any book and get your reading time for each one. 
	Use the search bar on the home page to search for any of over 12 million books on How Long to Read.
	<br><br>
	<img src="HLTR_search.gif" alt="How to use How Long to Read">
	<br>
	<b><br>2. </b>On the search results page you'll find a general overview of all of the books matching your search term. Click on the book's cover image to go to its page and find your reading time for each one. 
	<br><br>
	<img src="howtouse1.png" alt="How to use How Long to Read">
	<br><br>
	<b>3. </b>Once you've found the book you're looking for on its page you will find the average readers reading time for the book, and on the right you will find a button to take a reading speed test and find your unique reading time for the book.
	<br><br>
	<img src="HLTR_test.gif" alt="How to use How Long to Read">
	<br><br>
	<b>4. </b>Once you're done reading click stop and in the popup your specific reading time will be displayed, along with your average reading speed. 
	Once you've taken the reading speed test your reading time for the book will be saved in your browser, so if you ever want to check your time again your reading time will be saved and ready to view.
	<br><br>
	<img src="howtouse3.png" alt="How to use How Long to Read">

	</p>
	</div>
	</div>
   </div>
   </div>
   </div>
</section>
<?php include_once('footer.php'); ?>
