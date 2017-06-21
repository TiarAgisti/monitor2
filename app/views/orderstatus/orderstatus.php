<?php
	
?>
<div class="wrap-content container" id="container">
	<?php is_title('Order status', 'List Order Status'); ?> <!-- Title is here!!! -->
	<div class="container-fluid container-fullw bg-white">
		<form class="form-filter" role="form">
			<div class="row">
				<div class="col-md-3 col-sm-5">
					<label>
						Buyer
					</label>
					<select id="buyer" class="js-example-basic-multiple form-control input-sm">
					</select>
				</div>
				<div class="col-md-3 col-sm-5">
					<label>
						Style
					</label>
					<select id="style" class="js-example-basic-multiple form-control input-sm" disabled>
					</select>
				</div>
				<div class="col-md-3 col-sm-5">
					<label>
						KP
					</label>
					<select id="kpno" class="js-example-basic-multiple form-control input-sm" disabled>
					</select>
				</div>
				
				<div class="col-md-2 col-sm-5">
					<label>
						&nbsp;
					</label>
					<button type="button" id="btncari2" class="btn btn-default btn-primary btn-sm btn-form-filter form-control">Search</button>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="panel panel-white no-radius">
				<div class="panel-heading border-bottom">
					<!--<h4 class="panel-title"></h4> comment by tiar-->
				</div>
				<div class="panel-body">
					<table id="tbl_orderstatus" class="dataTable table table-bordered table-hover table-full-width nowrap" width="150%" data-table="tblorderstatus">
						<thead>
							<tr>
								<!--<th>Buyer</th> comment by tiar 11 januari 2017-->
								<th>Season</th>
								<!--<th>Style#</th>
								<th>KP#</th> comment by tiar 11 januari 2017-->
								<th>Item Description</th>
								<th>Buyer PO</th>
								<th>Qty</th>
								<th>Unit</th>
								<th>Material</th>
								<th>Destination</th>
								<th>Delivery Date</th>
							</tr>
						</thead>
						<!-- add by tiar -->
						 <tfoot>
							<tr>
								<th colspan="8" style="text-align:left" id="grandTotal">Grand Total Qty</th>
								<!--<th id=qty></th>-->
							</tr>
        				</tfoot>
						<!-- end -->
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- add by tiar -->
<style media="all" type="text/css">
	.alignRight { text-align: right; }
</style>
<!-- add by tiar -->

