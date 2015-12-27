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
<meta name="description" content="Find out how long you'll take to read <?php echo $objResult->ItemAttributes->Title; ?> and 12 million other books on How Long to Read.">
<title>How Long to Read <?php echo $objResult->ItemAttributes->Title; ?></title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=RobotoDraft:100,300,400,500,700" rel=
    "stylesheet">
<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>
<link rel="stylesheet" type="text/css" href="./css/newstyles.css">
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

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="wrapper-details">
	<?php include_once('header.php');?>


	<?php if(isset($_GET['asin']) && isset($_GET['ean'])){
		if(!empty($objResult)){
			foreach($objResult as $arrBooksInfo){ ?>
			<div class="container" style="background:white;padding:25px;width:100%">
				<div class="container-inner">
					<div class="pull-left">
						<h1 style="font-size:20px"><b>How Long to Read <?php echo $arrBooksInfo->ItemAttributes->Title; ?></b></h1>
					</div>
					<div class="pull-right">
						<form method="get" action="search_result.php">
							<input type="text" maxlength="120" size="21" id="search_keyword" name="search_keyword" class="form-control" placeholder="Search" style="margin-top:10px">
						</form>
					</div>
				</div>
			</div>
				<div class="container">
					<div class="col-sm-6">
						<div id="container" style="margin:20px">
							<?php 
								$nop	=	$arrBooksInfo->ItemAttributes->NumberOfPages * 255;
								$wpm	=	$nop/300;
								$wph	=	floor($wpm/60);
								$wpm	%=	60;						
							?>
							<p id="average_text" style="color:white;font-size:18px">The average reader, reading at a speed of 300 WPM, would take approximately <span style="color:#015645;"><?php echo $wph; ?> hours</span> and <span style="color:#015645;"><?php echo $wpm; ?> minutes</span> to finish  <a href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></a></p>
						</div>
						<div class="well well-lg">
							<a href="<?php echo $objResult->DetailPageURL; ?>" target="_blank"><center><img src="<?php echo $arrBooksInfo->LargeImage->URL; ?>" height="200px" class="img-responsive" alt="How long to read <?php echo $arrBooksInfo->ItemAttributes->Title; ?>"></center></a>
						<br>
							<h3 align="left"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></h3>
							<h4 align="left">by <?php echo $arrBooksInfo->ItemAttributes->Author; ?></h4>
							<h4 align="left"><?php echo ($arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice != '')? $arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice:'0.00'; ?> <a class="buy" href="<?php echo $objResult->DetailPageURL; ?>" target="_blank">on Amazon.com</a></h4>
						</div>
					</div>
					<div class="col-sm-6">
						<div id="container" style="margin:20px">
							<p style="color:white;font-size:18px">To find out how long it will take <span style="color:#015645;">you</span> to read <a href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank"><?php echo $arrBooksInfo->ItemAttributes->Title; ?>,</a> time yourself while you read the following sample paragraph</p>
						</div>
						<div class="alert alert-info" role="alert">
							<b>Heads up!</b> You should read the sample as you would read a book, so don't speedread.
						</div>
						<div class="well well-lg">
							<p>
								<?php
									$totalWordCnt	=	$arrBooksInfo->ItemAttributes->NumberOfPages * 255;
									$contectWordCnt	=	str_word_count(substr($arrBooksInfo->EditorialReviews->EditorialReview->Content, 0, 730));
									echo isset($arrBooksInfo->EditorialReviews->EditorialReview->Content)? substr($arrBooksInfo->EditorialReviews->EditorialReview->Content, 0, 730):'No Description'; ?>.... 
							</p>
							<div style="text-align:center" class="timer"> 
								<a class="start btn btn-primary btn-lg" onClick="return false;">Start Reading Speed Timer</a>
								<a class="stop hide btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onClick="return false;">Start Reading Speed Timer</a>
								<div class="spacer10"></div>
								<!--amazon button-->
								<a class="amazon" href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank">
									<center><div class="amazon-button"><img src="http://howlongtoreadthis.com/azon.png" style="width:27px;margin-right:12px"></img>Check it out on Amazon</div></center>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
		}
	} ?>


	<div id="myModal" class="modal fade" role="dialog" style="margin:100px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Reading Time</h4>
	        </div>
	        <div class="modal-body">
				<p id="modalMessage"></p>
				<br>
				<div class="fb-share-button" data-href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-layout="box_count"></div>
				<script type="text/javascript" src="//www.redditstatic.com/button/button3.js"></script>
				<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_28.png" /></a>
			<!-- Please call pinit.js only once per page -->
				<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
			</div>
			<div class="modal-footer">
				<button class="pull-left btn btn-default" data-dismiss="modal">Close</button>
				<div class="pull-right amazon-button" style="margin:0px;width:200px"><a class="amazon" href="<?php echo $arrBooksInfo->DetailPageURL; ?>" target="_blank"><img src="http://howlongtoreadthis.com/azon.png" style="width:20px;margin-right:12px"></img>Buy on Amazon</a></div>
			</div>
		</div>
	</div>


	<div class="push-details"></div>
</div>
<?php include_once('bookdetails_footer.php'); ?>






<script>
	$(document).ready(function(){
		var expiration_date = new Date();
			expiration_date.setFullYear(expiration_date.getFullYear() + 1);
		
			var startTimer;
			var timeTotal;
		$('.timer .start').click(function(){
			$('.timer').find('.stop').text('1 sec');
			var timer	=	$(this);
			timer.addClass('hide');
			
			$('.timer .stop').removeClass('hide');
			$('.timer .lap').addClass('hide');
			var i = 1;
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
			var currentSpeed	=	(sortContent / currentTime);
			
			var fullContent	=	<?php echo($totalWordCnt); ?>;
			var totalTime =	(fullContent / currentSpeed);
			var totalHours = Math.floor(totalTime / 60);
			var totalMinutes = Math.floor(totalTime%60);
			if (totalHours != 1){
				var msgHours = "s";
			}
			else {
				var msgHours = "";
			}
			if (totalMinutes != 1){
				var msgMinutes = "s";
			}
			else {
				var msgMinutes = "";
			}
			if (lapTime != 1){
				var msgSeconds = "s";
			}
			else {
				var msgSeconds = "";
			}
			//alert(currentSpeed +'---'+totalTime);
			
			$("#modalMessage").html('You read <?php echo $contectWordCnt; ?> words in '+lapTime+'ond'+msgSeconds+' and your average speed is '+Math.ceil(currentSpeed)+' words per minute. It will take you '+totalHours+' hour'+msgHours+' and '+totalMinutes+' minute'+msgMinutes+' to complete this book.');
			$('.clock').text('1 sec');
			
			document.cookie = "setAvgWPM_<?php echo $asinId; ?> = "+Math.ceil(currentSpeed)+"; expires=" + expiration_date.toGMTString();
			document.cookie = "setAvgTim_<?php echo $asinId; ?> = "+Math.ceil(totalTime)+"; expires=" + expiration_date.toGMTString();
		});
		
		//set value value			
		if(document.cookie.indexOf("setAvgWPM_<?php echo $asinId; ?>") >= 0 && document.cookie.indexOf("setAvgTim_<?php echo $asinId; ?>") >= 0){
			//var getAllCookies	=	document.cookie.split(';');
			//var getAvgWPM		=	getAllCookies[0].split('=');
			var	getAvgWPM		=	getCookie("setAvgWPM_<?php echo $asinId; ?>");//getAvgWPM[1];
				
			//var getAvgTime		=	getAllCookies[1].split('=');
			var	getAvgTime		=	getCookie("setAvgTim_<?php echo $asinId; ?>");//getAvgTime[1];
			if (math.floor(getAvgTime/60) != 1){
				var msgHours = "s";
			}
			else {
				var msgHours = "";
			}
			if (math.floor(getAvgTime%60) != 1){
				var msgMinutes = "s";
			}
			else {
				var msgMinutes = "";
			}
			var bookText	=	"According to your saved average speed of "+getAvgWPM+" WPM, you will take <span style='color:#015645;'>"+math.floor(getAvgTime/60)+" hour"+msgHours+"</span> and <span style='color:#015645;>"+math.floor(getAvgTime%60)+" minute"+msgMinutes+"</span> to finish <span style='color:#015645;'><?php echo $objResult->ItemAttributes->Title; ?></span>";
				$("#average_text").html(bookText);
		}
	});

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}
</script>
</body>
</html>
