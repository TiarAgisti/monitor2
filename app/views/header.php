<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>MANAGEMENT REPORT - PAN BROTHERS TBK</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" /> -->
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>vendor/themify-icons/themify-icons.min.css">
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link href="<?php echo SERVER_PUBLIC; ?>vendor/toastr/toastr.min.css" rel="stylesheet" media="screen">     
        <link href="<?php echo SERVER_PUBLIC; ?>vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo SERVER_PUBLIC; ?>vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo SERVER_PUBLIC; ?>vendor/sweetalert/sweet-alert.css" rel="stylesheet" media="screen">
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/sweetalert/ie9.css" rel="stylesheet" media="screen">
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>assets/css/styles.css">
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>assets/css/plugins.css">
		<link rel="stylesheet" href="<?php echo SERVER_PUBLIC; ?>assets/css/themes/theme-3.css" id="skin_color" />
		<!-- end: CLIP-TWO CSS -->

		
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo SERVER_PUBLIC; ?>vendor/dropzone/css/dropzone.css" rel="stylesheet" media="screen">

	</head>
	<!-- end: HEAD -->
	<style>
		.main-login .logo img {
			width: 20%;
		}

		.navbar-brand img {
			width: 130%;
		}
		.navbar-brand span {
			font-size: 12px;
		}

		select.input-sm, select.form-group-sm .form-control {
		    height: 30px;
		    line-height: 20px;
		}
		.datepicker {
		    padding: 0;
		}
		.modal-dialog {
		    margin: 10px auto;
		}
		.modal-lg {
		    width: 80%;
		}
		.modal-body {
		    overflow-y: auto;
			height: 500px;
		}
		.note-editor textarea {
			min-height: 100px;
		    height: 100px;
		}

		.user-right td .edit-user-info {
		    visibility: hidden;
		}

		.user-right tr:hover .edit-user-info {
		    visibility: visible;
		}


		.sales-report .row .tabbable .tab-content .tab-pane {
			height: 300px;
		}

		@media (max-width: 767px) {
			.sales-report .row .tabbable .tab-content .tab-pane {
				height: 100%;
			}
		}
				
	</style>
	<?php if(info_page()['title'] == 'login'): ?>
		<body class="login">
	<?php else: ?>
		<body>
			<div id="app">
				<?php is_sidebar(); ?>
				<div class="app-content">
					<?php is_navbar(); ?>
					<div class="main-content" >
	<?php endif; ?>
	