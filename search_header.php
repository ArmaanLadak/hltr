<div class="row">
	<form action="search_result.php" method="get" id="filter_form" class="form-inline" role="form" style="margin:8px">
		<center><div class="col-sm-9" style="margin:5px 15px 5px 15px">
			<input type="text" class="form-control" name="search_keyword" id="search_keyword" value="<?php echo $searchKeyword; ?>" placeholder="Search" style="width:100%">
		</div></center>
		<center><div class="col-sm-2" style="margin:5px 0px 5px 0px">
			<input type="submit" class="btn btn-default btn-large" value="Search">
		</div></center>
	</form>
</div>
