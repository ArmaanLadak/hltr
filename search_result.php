<title>Search How Long to Read</title>
<?php
//http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&Operation=ItemSearch&SubscriptionId=AKIAJYBVAMUBM4SB4CAA&AssociateTag=http://associates-amazon.s3.amazonaws.com/scratchpad/index.html&Version=2011-08-01&SearchIndex=Books&Condition=All&Keywords=books&ResponseGroup=Images,ItemAttributes,Offers
include_once('curl.php');

if(isset($_GET['search_keyword'])){
	$searchKeyword	=	isset($_GET['search_keyword'])? trim($_GET['search_keyword']):'';
	$condition		=	isset($_GET['condition'])? trim($_GET['condition']):'All';
	$anyCategory	=	isset($_GET['any_category'])? $_GET['any_category']:'';
	$responseGroup	=	'SearchBins, Images,ItemAttributes, Reviews';
	$page			=	isset($_GET['page'])? $_GET['page']:1;

	$xml_response	=	curlRequest($searchKeyword, $condition, $anyCategory, $responseGroup, $page);
	$objXml 		= 	new SimpleXMLElement($xml_response);
	$objResult		=	$objXml->children()->Items->Item;
	$objSearchBins	=	$objXml->children()->Items->SearchBinSets->SearchBinSet->Bin;
	/*print('<pre>');
	print_r($objXml);	
	print('</pre>');*/
	$responseGroup	=	'OfferSummary';
	$xml_response	=	curlRequest($searchKeyword, $condition, $anyCategory, $responseGroup, $page);
	$objXml 		= 	new SimpleXMLElement($xml_response);
	$offerSummery	=	$objXml->children()->Items->Item;
	$TotalPages		=	(int)$objXml->children()->Items->TotalPages;

		$arrConditions	=	array();
	foreach($offerSummery as $conditions){
		foreach($conditions->OfferSummary as $key=>$val){
			foreach($val as $key1=>$val1){
				if($key1 != 'LowestNewPrice' && $key1 != 'LowestUsedPrice'){
					$arrConditions[$key1][]	=	(int)$val1;
				}
			}
		}
	}
	$TotalNew			=	isset($arrConditions['TotalNew'])? '('.array_sum($arrConditions['TotalNew']).')':'';
	$TotalUsed			=	isset($arrConditions['TotalUsed'])? '('.array_sum($arrConditions['TotalUsed']).')':'';
	$TotalCollectible	=	isset($arrConditions['TotalCollectible'])? '('.array_sum($arrConditions['TotalCollectible']).')':'';
	$TotalRefurbished	=	isset($arrConditions['TotalRefurbished'])? '('.array_sum($arrConditions['TotalRefurbished']).')':'';
}
?>
<!DOCTYPE html>

<html dir="ltr" lang="en" class="off-canvas">
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>Search Results</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=RobotoDraft:100,300,400,500,700" rel=
    "stylesheet">
<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>
<link rel="stylesheet" type="text/css" href="./css/newstyles.css">

</head>

<body>
<div class="wrapper" style="margin-bottom:1px">
	<?php include_once('header.php'); ?>
	<?php include_once('search_header.php'); ?>

	<div class="container">
		<?php
		if(isset($_GET['search_keyword'])){
			$i	=	0;
			if(!empty($objResult)){
				foreach($objResult as $arrBooksInfo){ //print_r($arrBooksInfo);
					if($i%3 == 0){ ?>
						<br>
					<?php	} ?>
					<a href="book_details.php?asin=<?php echo ((string)$arrBooksInfo->ASIN); ?>&ean=<?php echo ((string)$arrBooksInfo->ItemAttributes->EAN); ?>">
						<div class="span4" style="background:white;padding:3px">
							<div class="span4">
								<img src="<?php echo $arrBooksInfo->LargeImage->URL; ?>" />
							</div>
							<div class="span4">
								<h4><?php echo $arrBooksInfo->ItemAttributes->Title; ?></h4>
								<div>
									<div class="pull-left">
									Author:
									</div>
									<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->Author; ?></div>
								</div>
								<div>
									<div class="pull-left">
									Pages:
									</div>
									<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->NumberOfPages; ?></div>
								</div>
								<div>
									<div class="pull-left">
									Words (Approximate):
									</div>
									<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->NumberOfPages * 255; ?></div>
								</div>
								<div class="span4" style="float:left; margin-right:10px;font-weight:bold;"> 
									<?php echo ($arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice != '')? $arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice:'0.00'; ?> 
								</div>
							</div>
						</div>
					</a>
					<?php
					$i++;
				}
			}
			else{
					echo '<div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only"><b>Error:</b></span>
					No books were found that matched your search. Make sure you typed the title correctly. If you\'re seeing this often, it means the site is under heavy load and the server is not responding properly.
					</div>';
				}
			$totalPages	 =	'';
			$currUrl	=	$_SERVER['REQUEST_URI'];
			$currUrl	=	explode('&', $currUrl);
			$currPage	=	'';
			$TotalPages	=	($TotalPages > 99)? 100:$TotalPages;
			echo'<div class="myNav">';		
			$i = 0;
			foreach($currUrl as $arrExtVariables){	
					if(strpos($arrExtVariables, 'page') !== false){
						$currPage	=	isset($currUrl[$i])? filter_var($currUrl[$i], FILTER_SANITIZE_NUMBER_INT):'';
						unset ($currUrl[$i]);
					}
					$i++;
				}
			if($TotalPages >= 15){
					$totalPages = '';
					if($currPage > 1){
						$totalPages .= '<a class="active" href="'.implode('&', $currUrl).'&page=1">1</a>...';
					}
					for($i=$currPage;$i<=($currPage+10);$i++){
						//if($i < 10 || $i > ($TotalPages - 10)){
						$totalPages	.=	'<a class="active" href="'.implode('&', $currUrl).'&page='.$i.'">'.$i.'</a> | ';
						//}
					}
					$totalPages .= '...<a class="active" href="'.implode('&', $currUrl).'&page='.$TotalPages.'">'.$TotalPages.'</a>';
					echo '<div class="spacer10"></div>'.$totalPages;
				}
			else{
					if($TotalPages > 1){
						$totalPages = '';
						for($i=1;$i<=($TotalPages);$i++){
							//if($i < 10 || $i > ($TotalPages - 10)){
							$totalPages	.=	'<a href="'.implode('&', $currUrl).'&page='.$i.'">'.$i.'</a> | ';
							//}
						}
						echo '<div class="spacer10"></div>'.$totalPages;
					}
				}
			echo'</div>';
		} ?>
	</div>
	<div class="push"></div>
</div>
<?php include_once('footer.php'); ?>

<script>
$('document').ready(function(){
	$('#search_button').click(function(){
		$('#filter_form').submit();
	});
});
</script>
</body>
</html>
