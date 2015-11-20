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
<title>Book</title>
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
					  $(".mid_container").css('min-height',1000);
				}
			if(Size == 768)
				{
					  $(".mid_container").css('min-height',1000);
				}
			if(Size == 800)
				{
					  $(".mid_container").css('min-height',1000);
				}
			if(Size == 832)
				{
					  $(".mid_container").css('min-height',1000);
				}	
			if(Size == 900)
				{
					  $(".mid_container").css('min-height',1000);
				}	
			if(Size == 1050)
				{
					  $(".mid_container").css('min-height',1300);
				}
			if(Size == 1080)
				{
					  $(".mid_container").css('min-height',982);
				}	
				
      });
    });
  </script>
<style>.btn-primary { padding: 4px 15px; } </style>
</head>
<body class="fs12 page-home ">
<div id="page-container">
	<?php include_once('header.php'); ?>
	<header id="header">
		<div id="headerbottom">
			<div class="container">
				<div class="container-inner">
					<form action="" method="get" id="filter_form">
					<div class="row" style="margin-top:20px; margin-bottom:20px;">
						<div class="span4" style="text-align:right;">
							<input type="text" style="height:34px;" name="search_keyword" id="search_keyword" value="<?php echo $searchKeyword; ?>" class="span11">
						</div>
						<div class="span2">
							<select name="condition" id="condition">
								<option value="All">All</option>
								<option value="New">New <?php if(isset($TotalNew)) echo $TotalNew; ?></option>
								<option value="Used">Used <?php if(isset($TotalUsed)) echo $TotalUsed; ?></option>
								<option value="Collectible">Collectible <?php if(isset($TotalCollectible)) echo $TotalCollectible; ?></option>
								<option value="Refurbished">Refurbished <?php if(isset($TotalRefurbished)) echo $TotalRefurbished; ?></option>
							</select>
						</div>
						<div class="span3">
							<?php if(isset($_GET['search_keyword'])){ ?>
							<select name="any_category" id="any_category">
								<option value="">All Categories</option>
								<?php
								if(!empty($objSearchBins)){
								foreach($objSearchBins as $arrBin){
								?>
								<option value="<?php echo $arrBin->BinParameter->Value; ?>"><?php echo $arrBin->BinName.' ('.$arrBin->BinItemCount.')'; ?></option>
								<?php }
								}?>
							</select>
							<?php } ?>
						</div>
						<div class="span2" style="text-align:center;"> 
							<a class="btn btn-default btn-mini" href="#" style="margin-bottom:10px; " id="search_button">Search </a>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
  </header>
</div>

<section style="background-image:url(Pav%20Decor_files/bg04.png); background-repeat:repeat;" class="pav-showcase mid_container" id="columns">
	<div class="container">
		<div class="row box-product">
			<?php
			if(isset($_GET['search_keyword'])){

				$i	=	0;
				if(!empty($objResult)){
				foreach($objResult as $arrBooksInfo){ //print_r($arrBooksInfo);
					if($i%3 == 0){ ?>
				<div class="spacer10"></div>
			<?php	} ?>
			<div class="span4 product-block" style="width:31.203%">
				<div class="product-inner">
					<div class="image">
						<br>
						<a href="book_details.php?asin=<?php echo ((string)$arrBooksInfo->ASIN); ?>&ean=<?php echo ((string)$arrBooksInfo->ItemAttributes->EAN); ?>">
							<img src="<?php echo $arrBooksInfo->LargeImage->URL; ?>" />
						</a>
					</div>
					<div class="product-meta" style="color:#000;">
						<div>
							<div class="pull-left">
							
							</div>
							<br>
							<a href="book_details.php?asin=<?php echo ((string)$arrBooksInfo->ASIN); ?>&ean=<?php echo ((string)$arrBooksInfo->ItemAttributes->EAN); ?>"><?php echo $arrBooksInfo->ItemAttributes->Title; ?></a>
						</div>
						<div class="clearfix"></div>
						<div>
							<div class="pull-left">
							Author:
							</div>
							<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->Author; ?></div>
						</div>
						<div class="clearfix"></div>
						<div>
							<div class="pull-left">
							Number Of Pages:
							</div>
							<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->NumberOfPages; ?></div>
						</div>
						<div class="clearfix"></div>
						<div>
							<div class="pull-left">
							Number Of Words (Approximate):
							</div>
							<div class="pull-right"><?php echo $arrBooksInfo->ItemAttributes->NumberOfPages * 255; ?></div>
						</div>
						<div class="clearfix"></div>
						<?php 
							if(!empty($arrBooksInfo->ItemAttributes->Languages->Language)){
							foreach($arrBooksInfo->ItemAttributes->Languages->Language as $arrLanguags){
								if($arrLanguags->Type != 'Unknown'){ ?>							
								<div>
									<div class="pull-left">
									<?php echo $arrLanguags->Type; ?>:
									</div>
									<div class="pull-right"><?php echo $arrLanguags->Name; ?></div>
								</div>
								<div class="clearfix"></div>
							<?php
								}
							} 
							}
						?>
						
						<div class="price" style="float:left; margin-right:10px;font-weight:bold;"> <?php echo ($arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice != '')? $arrBooksInfo->ItemAttributes->ListPrice->FormattedPrice:'0.00'; ?> </div>
						<div class="rating" style="float:left;">
							<img alt="Based on 1 reviews." src="./images/stars-5.png">
						</div>
					</div>
				</div>
			</div>
			<?php
				$i++;
				}
				}else{
					echo '<div class="alert alert-danger" role="alert">
  					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  					<span class="sr-only"><b>Error:</b></span>
  					No books were found that matched your search. Make sure you typed the title correctly. If you\'re seeing this often, the site is under heavy load and the server is not responding properly.
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
				}else{
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
	</div>
</section>
<?php include_once('footer.php'); ?>
<script>
$('document').ready(function(){
	$('#search_button').click(function(){
		$('#filter_form').submit();
	});
});
</script>
