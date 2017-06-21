<?php
	$mastercompany = $data['mastercompany']->ftycode()['items'];
	
	$curdate = date('Y-m-d', strtotime('-1 month'));
	$curdate2 = date('Y-m-d', strtotime('+2 month'));
?>
<div class="wrap-content container" id="container">
<!-- start: PAGE TITLE -->
	<?php is_title('Monitoring', 'Monitoring Line'); ?>
	<!-- end: PAGE TITLE -->
	<!-- start: YOUR CONTENT HERE -->
	<div class="container-fluid container-fullw bg-white">
		<form class="form-filter" role="form">
			<div class="row">
				<div class="col-md-4 col-sm-5">
					<label>
						Factory
					</label>
					<select id="fFactory" class="input-group form-control input-sm">
						<?php while($item = $mastercompany->fetch_assoc()): ?>
							<option value="<?php echo $item['ftycode']; ?>"><?php echo $item['Company']; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-3 col-sm-1">
					<div class="form-group">
						<label>
							Delivery Date Range
						</label>
						<div class="input-group input-daterange datepicker">
							<input class="form-control input-sm" type="text" id="tglfrom" value="<?php echo $curdate; ?>">
							<span class="input-group-addon bg-primary">to</span>
							<input class="form-control input-sm" type="text" id="tglto" value="<?php echo $curdate2; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-1 col-sm-1">
					<label>
						&nbsp;
					</label>
					<button class="btn btn-default btn-primary btn-sm btn-form-filter form-control" data-target="line" id="btnmont" type="button">Filter</button>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="panel panel-white no-radius">
				<div class="panel-heading border-bottom">
					<h4 class="panel-title">Line Monitoring</h4>
				</div>
				<div class="panel-body">
					<table id="monitor" class="dataTable table table-bordered table-hover table-full-width" width="100%" data-table="montline">
						<thead>
							<tr>
								<th>Line</th>
								<th>KP#</th>
								<th>First Del Date</th>
								<th>Qty Order</th>
								<th>Qty Cut</th>
								<th>Today QC</th>
								<th>Qty Sew</th>
								<th>Qty QC</th>
								<th>Qty Pack</th>
								<th>Shipped</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="panel-footer">
					
				</div>
			</div>
		</div>
	</div>
	<!-- end: YOUR CONTENT HERE -->
</div>
<!-- add by tiar -->
<style media="all" type="text/css">
	.alignRight { text-align: right; }
</style>
<!-- add by tiar -->