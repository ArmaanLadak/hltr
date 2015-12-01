<div class="container">
	<form action="search_result.php" method="get" id="filter_form">
		<div class="row" style="margin-top:20px; margin-bottom:20px;">
			<div class="span5" style="text-align:left;">
				<input type="text" style="height:34px;" name="search_keyword" id="search_keyword" value="<?php echo $searchKeyword; ?>">
			</div>
			<div class="span4">
				<?php if(isset($_GET['search_keyword'])){ >?
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
			<div class="span3" style="text-align:center;"> 
				<input type="submit" class="btn btn-default btn-large" value="Search">
			</div>
		</div>
	</form>
</div>
/div>
