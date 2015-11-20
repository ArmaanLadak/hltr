<?php
session_start();
if(isset($_POST['submit'])){
	$name 		= 	trim($_POST['name']);
	$from 		= 	trim($_POST['email']);
	$subject 	= 	trim($_POST['subject']);
	$msgBody	= 	$name.",\r\n\n".trim($_POST['message'])."\r\n\n"."Regards,\r\n\n team \r\n www.howlongtoreadthis.com";
	$to			=	'sputnik4024@gmail.com';
	
	$headers	= 	'From: ' .$from. "\r\n" .
					'Reply-To: ' .$to. "\r\n" .
					'X-Mailer: PHP/' . phpversion();

	$send		=	mail($to, $subject, $msgBody, $headers);
	if($send){
		$_SESSION['sent_mail']	=	'Your message has been sent and we will get back to you as soon as possible.';
		header('Location: '.$_SERVER['PHP_SELF']);
		exit;
	}
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en" class="off-canvas">
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="./css/theme-responsive.css">
<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
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
	Contact Us
	</div>
	
	<div class="span12 title">
	<?php
		if(isset($_SESSION['sent_mail'])){
			echo($_SESSION['sent_mail'].'<br>');
			unset($_SESSION['sent_mail']);
		}
	?>
	<br>

	<div class="alert">
	If you have any questions/comments about the site or would like to partner with us please contact us using the form below.
	</div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div style="margin:0px!important; padding:0px !important;" class="span12">
		<div class="span10">
			<div class="span12">
				<div class="span4">
					<label style="font-size:14px">Name</label>
				</div>
				<div class="span8">
					<input style="height:20px padding:5px; border:2px solid #ccc; 
-webkit-border-radius: 5px;
border-radius: 5px; !important;" type="text" name="name">
				</div>	
			</div>
		</div>
		<div class="span2"></div>
	</div>
	<div style="margin:0px!important; padding:0px !important;" class="span12">
		<div class="span10">
			<div class="span12">
				<div class="span4">
					<label style="font-size:14px">Email</label>
				</div>
				<div class="span8">
					<input style="height:20px padding:5px; border:2px solid #ccc; 
-webkit-border-radius: 5px;
border-radius: 5px; !important;" type="text" name="email">
				</div>	
			</div>
		</div>	
		<div class="span2"></div>
	</div>
	<div style="margin:0px!important; padding:0px !important;" class="span12">
		<div class="span10">
			<div class="span12">
				<div class="span4">
					<label style="font-size:14px">Subject</label>
				</div>
				<div class="span8">
					<input style="height:20px padding:5px; border:2px solid #ccc; 
-webkit-border-radius: 5px;
border-radius: 5px; !important;" type="text" name="subject">
				</div>	
			</div>
		</div>	
		<div class="span2"></div>
	</div>
	<div style="margin:0px!important; padding:0px !important;" class="span12">
		<div class="span10">
			<div class="span12">
				<div class="span4">
					<label style="font-size:14px">Message</label>
				</div>
				<div class="span8">
					<textarea width="400px" height="300px" name="message" style="padding:5px; border:2px solid #ccc; 
-webkit-border-radius: 5px;
border-radius: 5px;"></textarea>
				</div>	
			</div>
		</div>	
		<div class="span2"></div>
	</div>
	<div style="margin:0px!important; padding:0px !important;" class="span12">
		<div class="span10">
			<input type="submit" name="submit" value="Submit" style="padding:5px; border:2px solid #ccc; 
-webkit-border-radius: 5px;
border-radius: 5px;">
		</div>	
		<div class="span2"></div>
	</div>
	</form>
	</p>
	</div>
   </div>
   </div>
   </div>
</section>
<?php include_once('footer.php'); ?>
