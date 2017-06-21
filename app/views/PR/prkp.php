<?php
	
?>
<div class="wrap-content container" id="container">
	<?php is_title('Bill Of Material (BOM)', ''); ?> <!-- Title is here!!! -->
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
				
				<div class="col-md-1 col-sm-5">
					<label>
						&nbsp;
					</label>
					<button type="button" id="btncari" class="btn btn-default btn-primary btn-sm btn-form-filter form-control">Search</button>
				</div>
				<!-- add by tiar -->
				<div class="col-md-2 col-sm-5">
					<label>
						&nbsp;
					</label>
					<button type="button" id="btnExportPDF" class="btn btn-default btn-primary btn-sm btn-form-filter form-control">Export PDF</button>
				</div>
				<!-- end add -->
			</div>
		</form>
		<div class="row">
			<div class="panel panel-white no-radius">
				<div class="panel-heading border-bottom">
					<!--<h1 class="panel-title"></h1> comment by tiar-->
					<label>R M S/ Item # </label>
					<label>&nbsp;</label>
					<input type="text" id="txtFilter">
					<button type="button" id="btncariDetail" class="btn btn-default btn-primary">Search</button>
					<!-- <button type="button" id="btnReset" class="btn btn-default btn-primary">Reset</button> -->
				</div>
				<div class="panel-body">
					<table id="tbl_prkp" class="dataTable table table-bordered table-hover table-full-width nowrap" width="150%" data-table="tblprkp">
						<thead>
							<tr>
								<th>Check</th>
								<th>Notes</th>
								<th>KPNo</th>
								<th>PNo</th>
								<th>Position</th>
								<th>R M S/ Item #</th>
								<th>Description</th>
								<th>Supplier</th>
								<th>Garment Color</th>
								<th>Item Color</th>
								<th>Gmt Size</th>
								<th>Item size/width</th>
								<th>Garment Qty</th>
								<th>Cons</th>
								<th>Allw</th>
								<th>PR Qty</th>
								<th>UOM</th>
								<th>PONo</th>
								<!-- <th>Is Send</th> -->
							</tr>
						</thead>
					</table>
				</div>
				<div class="panel-footer">
					NOTE Untuk KP : <button type="button" id="btnNotes" style="width:20%;" class="btn btn-default btn-primary btn-sm btn-form-filter form-control">NOTES</button>
					<button type="button" id="btnSend" style="width:30%;" class="btn btn-default btn-primary btn-sm btn-form-filter form-control">Send Notes Detail</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- add by tiar -->
<style media="all" type="text/css">
	.alignRight { text-align: right; }
</style>




