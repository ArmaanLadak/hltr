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
