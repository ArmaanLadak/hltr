<?php
function curlRequest($searchKeyword, $condition, $anyCategory, $responseGroup, $page){
	$AWS_ACCESS_KEY_ID 		= 'AKIAJJEOYOHBMPEE3DEA';
	$AWS_SECRET_ACCESS_KEY 	= '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';

	$base_url 	= 	"http://webservices.amazon.com/onca/xml?";
	$timeStam	=	gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
	$nameValuePairs	=	array(	'Service'		=>	'AWSECommerceService',
								'Operation'		=>	'ItemSearch',
								'AWSAccessKeyId'=>	'AKIAJJEOYOHBMPEE3DEA',
								'AssociateTag'	=>	'mechakeyboadv-20',//'http://associates-amazon.s3.amazonaws.com/scratchpad/index.html',
								'Version'		=>	'2011-08-01',								
								'SearchIndex'	=>	"Books",
								'BrowseNode'	=> 	$anyCategory,
								'Condition'		=>	$condition,
								'Keywords'		=>	$searchKeyword,
								'ItemPage'		=>	$page,
								'Availability'	=>	'Available',
								'ResponseGroup'	=>	$responseGroup,
								'Timestamp'		=>	$timeStam//'2014-08-03T09:14:10.000Z'
							);//numeric and alpa numeric
							
	$sortedPairs	=	array();
	foreach(array_keys($nameValuePairs) as $key){
		$sortedPairs[] = $key."=".str_replace('%7E', '~', rawurlencode($nameValuePairs[$key]));
	}
	sort($sortedPairs);

	$stringToSign	=	"GET\nwebservices.amazon.com\n/onca/xml\n".implode('&',$sortedPairs);

	// Sign the request
	$signature = hash_hmac("sha256",$stringToSign,$AWS_SECRET_ACCESS_KEY,true);

	// Base64 encode the signature and make it URL safe
	$signature = base64_encode($signature);
	$signature = str_replace('+','%2B',$signature);
	$signature = str_replace('=','%3D',$signature);

	$url = $base_url.implode('&',$sortedPairs)."&Signature=".$signature;


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	$xml_response 	= 	curl_exec($ch);
	return($xml_response);
}

function curlItemLookups($condition = 'All', $anyCategory, $responseGroup, $eanId, $asinId){
	$AWS_ACCESS_KEY_ID 		= 'AKIAJJEOYOHBMPEE3DEA';
	$AWS_SECRET_ACCESS_KEY 	= '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';
	
		$idType	=	'ASIN';
		$itemId	=	$asinId;
	/*if($eanId !='' && $asinId != ''){		
		$idType	=	'EAN';
		$itemId	=	$eanId;
	}*/

	$base_url = "http://webservices.amazon.com/onca/xml?";
	$timeStam	=	gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
	$nameValuePairs	=	array(	'Service'		=>	'AWSECommerceService',
								'Operation'		=>	'ItemLookup',
								'AWSAccessKeyId'=>	'AKIAJJEOYOHBMPEE3DEA',
								'AssociateTag'	=>	'mechakeyboadv-20',//'http://associates-amazon.s3.amazonaws.com/scratchpad/index.html',
								'ItemId'		=>	$itemId,
								'IdType'		=>	$idType,
								'Version'		=>	'2011-08-01',
								'Condition'		=>	$condition,
								'ResponseGroup'	=>	$responseGroup,
								'Timestamp'		=>	$timeStam//'2014-08-03T09:14:10.000Z'
							);//numeric and alpa numeric
	
	if($eanId !='' && $idType != 'ASIN'){	
		$nameValuePairs	=	array_merge($nameValuePairs, array('SearchIndex'	=>	"Books"));
	}
	/*print('<pre>');
	print_r($nameValuePairs);
	exit;*/
	$sortedPairs	=	array();
	foreach(array_keys($nameValuePairs) as $key){
		$sortedPairs[] = $key."=".str_replace('%7E', '~', rawurlencode($nameValuePairs[$key]));
	}
	sort($sortedPairs);

	$stringToSign	=	"GET\nwebservices.amazon.com\n/onca/xml\n".implode('&',$sortedPairs);

	// Sign the request
	$signature = hash_hmac("sha256",$stringToSign,$AWS_SECRET_ACCESS_KEY,true);

	// Base64 encode the signature and make it URL safe
	$signature = base64_encode($signature);
	$signature = str_replace('+','%2B',$signature);
	$signature = str_replace('=','%3D',$signature);

	$url = $base_url.implode('&',$sortedPairs)."&Signature=".$signature;


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	$xml_response 	= 	curl_exec($ch);
	return($xml_response);
}
?>
