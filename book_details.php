<?php
include_once('curl.php');
if(isset($_GET['asin']) && isset($_GET['ean'])){
	$eanId	=	trim($_GET['ean']);
	$asinId	=	trim($_GET['asin']);

	$anyCategory		=	isset($_GET['any_category'])? $_GET['any_category']:'';
	$responseGroup		=	'Images,ItemAttributes, EditorialReview';
	$condition			=	'All';

	$xml_response		=	curlItemLookups($condition, $anyCategory, $responseGroup, $eanId, $asinId);
	$objXml 			= 	new SimpleXMLElement($xml_response);
	$objResult			=	$objXml->children()->Items->Item;
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en" class="off-canvas">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta charset="UTF-8">
<title>How Long to Read <?php echo $objResult->ItemAttributes->Title; ?></title>
<meta name="keywords" content="<?php echo $objResult->ItemAttributes->Title; ?>, how long to read <?php echo $objResult->ItemAttributes->Title; ?>" />
<meta name="description" content="Find out how long you'll take to read <?php echo $objResult->ItemAttributes->Title; ?>, and over 12 million other books on How Long to Read." />
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
  <?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
</head>
<body class="fs12 page-home ">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page-container">
	<?php include_once('header.php'); ?>
	<?php
		if(isset($_GET['asin']) && isset($_GET['ean'])){
			$i	=	0;
			if(!empty($objResult)){
			foreach($objResult as $arrBooksInfo){ //print('<pre>'); print_r($arrBooksInfo); print('</pre>');
	?>		
	<header id="header">    
		<div id="headerbottom">
			<div class="container">
				<div class="container-inner">
					<div class="pull-left" style="margin-top:20px;">
						<div class="" style="float:left;">
							<h3><b>How Long to Read <?php echo $arrBooksInfo->ItemAttributes->Title; ?></b></h3>
						</div>
					</div>
					<div class="search-cart pull-right">
						<div class="div3" style="margin-top:15px; margin-bottom:20px;">
							<form method="get" action="search_result.php">
								<input type="text" maxlength="120" size="21" autofocus="autofocus" id="search_keyword" name="search_keyword" class="tftextinput">
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header> 
</div>
<section class="pav-showcase mid_container" id="pavo-showcase">
	<div class="container" >
		<?php
				if($i%2 == 0){ ?>
			<div class="spacer10"></div>
		<?php	} ?>
		<div class="row-fluid" style="margin-bottom:20px;">
			<div class="span6">
				<div id="banner">
					<?php 
						$nop	=	$arrBooksInfo->ItemAttributes->NumberOfPages * 255;
						$wpm	=	1/300;
						$wpm	=	$wpm * $nop;
						$wph	=	floor($wpm/60);
						$wpm	%=	60;						
					?>
					<p id="average_text">The average reader, at a speed of 300 WPM would take <span style="color:#015645;"><?php echo $wph; ?> hours and <?php echo $wpm; ?> minutes</span> to finish  <span style="color:#015645;"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></span></p>
				</div>
				<div class="well" align="middle">
					<a href="<?php echo $objResult->DetailPageURL; ?>" target="_blank"><img src="<?php echo $arrBooksInfo->LargeImage->URL; ?>" height="200px" class="img-responsive" alt="How long to read <?php echo $arrBooksInfo->ItemAttributes->Title; ?>"></a>
					<h3 align="left"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></h3>
					<h4 align="left">by <?php echo $arrBooksInfo->ItemAttributes->Author; ?></h4>
					<h4 align="left"><?php echo ($arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice != '')? $arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice:'0.00'; ?> <a href="<?php echo $objResult->DetailPageURL; ?>" target="_blank"</a> on Amazon.com</h4>
					</h4>
					</h3>
				</div>
			</div>
			<div class="span6">
				<div id="banner">
					<p><span style="color:#ffffff;">To find out how long it will take you to read</span> <span style="color:#015645;"><a href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></a></span>, read the following sample paragraph and press to stop when you're done reading.</p>
				</div>
				<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
  <b>Heads up!</b> Make sure to read the reading sample at the same speed as you would read a book, and not try to speedread.
</div>
				<div class="well">
					<p style="color:#6c6969;">
						<?php
							$totalWordCnt	=	$arrBooksInfo->ItemAttributes->NumberOfPages * 255;							
							$contectWordCnt	=	str_word_count(substr($arrBooksInfo->EditorialReviews->EditorialReview->Content, 0, 730));
							echo isset($arrBooksInfo->EditorialReviews->EditorialReview->Content)? substr($arrBooksInfo->EditorialReviews->EditorialReview->Content, 0, 730):'No Content !'; ?>.... 
					</p>
                    <div style="text-align:center" class="timer"> 
						<span class="lap hide"></span>
						<div class="clr"></div>
						<a href="" class="start button-big" onClick="return false;">Start Reading Speed Timer</a>
						<a href="" class="stop hide button-big" onClick="return false;" style="height:20px; width:90px" >0 sec</a>
						<div class="spacer10"></div>
						<?php
							//$buyOnAmazon	=	($arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice != '')? 'Buy on Amazon for '.$arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice:'Buy on Amazon';
						?>
						<a href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank" class="button-big custome_btn_big"><?php //echo $buyOnAmazon; ?></a>
						
			</div>
		</div>
		<?php
			$i++;
			}
			}
		} ?>
	</div>
</section>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<!--<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
		<h3 id="myModalLabel">Modal header</h3>
	</div>-->
	<div class="modal-body">
		<p></p><div class="fb-share-button" data-href="<?php
  echo curPageURL();
?>" data-layout="box_count"></div>
<script type="text/javascript" src="//www.redditstatic.com/button/button3.js"></script>
<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_28.png" /></a>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
	</div>
	<div class="modal-footer">
		
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<a href="<?php echo $objResult->DetailPageURL; ?>" target="_blank" class="btn btn-primary">Buy on Amazon<?php echo $buyOnAmazon; ?></a>
	</div>
</div>

<?php include_once('bookdetails_footer.php'); ?>
<script>
	$(document).ready(function(){
		var expiration_date = new Date();
			expiration_date.setFullYear(expiration_date.getFullYear() + 1);
		
			var startTimer;
			var timeTotal;
		$('.timer .start').click(function(){
			$('.timer').find('.stop').text('0 sec');
			var timer	=	$(this);
			timer.addClass('hide');
			
			$('.timer .stop').removeClass('hide');
			$('.timer .lap').addClass('hide');
			var i = 0;
				startTimer	=	setInterval(function(){
									i++;
									var newTime		=	i+' sec';
										timeTotal	=	i;
									if(i > 59){
										var Minuts	=	i / 60;
											Minuts	=	Math.floor(Minuts);
												
										var Seconds	=	i % 60;	
										var newTime	=	Minuts+' minutes '+Seconds+' sec';
										timeTotal	=	(Minuts * 60 + Seconds);
									}
									$('.timer').find('.stop').text(newTime);
								}, 1000);									
		});
		
		$('.timer .stop').click(function(){
			clearInterval(startTimer);
			$(this).addClass('hide');
			$('.timer .start').removeClass('hide');
			var lapTime		=	$('.timer .stop').text();
			/*var totalTime	=	(<?php echo($totalWordCnt); ?>) * timeTotal;				
				totalTime	=	totalTime / (60 * 60);
				totalTime	=	Math.ceil(totalTime);*/
			
			var sortContent	=	<?php echo $contectWordCnt; ?>;
			var currentTime	=	(timeTotal / 60);
			var currentSped	=	(sortContent / currentTime);
			
			var fullContent	=	<?php echo($totalWordCnt); ?>;
			var totalTm		=	(fullContent / currentSped);
			//alert(currentSped +'---'+totalTm);
			
			$("#myModal").modal({ keyboard: false }).find('.modal-body p').text('You read <?php echo $contectWordCnt; ?> words in '+lapTime+'onds and your average speed is '+Math.ceil(currentSped)+' words per minute. You will take '+Math.floor(totalTm / 60)+' hours and '+Math.ceil(totalTm % 60)+' minutes to complete this book.');
			$('.clock').text('0 sec');
			
			document.cookie = "setAvgWPM_<?php echo $asinId; ?> = "+Math.ceil(currentSped)+"; expires=" + expiration_date.toGMTString();
			document.cookie = "setAvgTim_<?php echo $asinId; ?> = "+Math.ceil(totalTm)+"; expires=" + expiration_date.toGMTString();
		});
		
		//set value value			
		if(document.cookie.indexOf("setAvgWPM_<?php echo $asinId; ?>") >= 0 && document.cookie.indexOf("setAvgTim_<?php echo $asinId; ?>") >= 0){
			//var getAllCookies	=	document.cookie.split(';');
			//var getAvgWPM		=	getAllCookies[0].split('=');
			var	getAvgWPM		=	getCookie("setAvgWPM_<?php echo $asinId; ?>");//getAvgWPM[1];
				
			//var getAvgTime		=	getAllCookies[1].split('=');
			var	getAvgTime		=	getCookie("setAvgTim_<?php echo $asinId; ?>");//getAvgTime[1];
			var bookText	=	"According to your saved average speed of "+getAvgWPM+" WPM, you will take <span style='color:#015645;'>"+getAvgTime+" minutes</span> to finish <span style='color:#015645;'><?php echo $objResult->ItemAttributes->Title; ?></span>";
				$("#average_text").html(bookText);
		}
	});

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}
</script>
