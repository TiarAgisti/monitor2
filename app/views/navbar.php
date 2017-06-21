<?php 
	//$user = new Userpassword; 
	 //var_dump($_SESSION);
	// var_dump($_SESSION['user']);
	$arrUser = [$_SESSION['nik'],$_SESSION['fty']];
	//$user_detail = $user->username($arrUser)['items']->fetch_assoc();
	$fullname = $_SESSION['fullName'];
	// $fullname = $_SESSION['nik'];
	// var_dump($fullname);
?>

<!-- start: TOP NAVBAR -->
<header class="navbar navbar-default navbar-static-top">
	<!-- start: NAVBAR HEADER -->
	<div class="navbar-header">
		<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
			<i class="ti-align-justify"></i>
		</a>
		<a class="navbar-brand" href="<?php echo SERVER_NAME; ?>">
			<img src="<?php echo SERVER_PUBLIC; ?>assets/images/logo.png" alt="ERP Pan Brothers Tbk"/>
			<!-- <span class="margin-left-10">PT PAN BROTHERS TBK</span> -->
		</a>
		<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
			<i class="ti-align-justify"></i>
		</a>
		<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<i class="ti-view-grid"></i>
		</a>
	</div>
	<!-- end: NAVBAR HEADER -->
	<!-- start: NAVBAR COLLAPSE -->
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-right">
			<!-- start: USER OPTIONS DROPDOWN -->
			<li class="dropdown current-user">
				<a href class="dropdown-toggle" data-toggle="dropdown">
					<!-- <img src="<?php echo SERVER_PUBLIC; ?>assets/images/avatar-1.jpg" alt="<?php echo $fullname; ?>">  -->
					<span class="username"><?php echo $fullname; ?> <i class="ti-angle-down"></i></i></span>
				</a>
				<ul class="dropdown-menu dropdown-dark">
					<!-- <li>
						<a href="pages_user_profile.html">
							My Profile
						</a>
					</li> -->
					<li>
						<a href="javascript:;" class="btn-logout">
							Log Out
						</a>
					</li>
				</ul>
			</li>
			<!-- end: USER OPTIONS DROPDOWN -->
		</ul>
		<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
		<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<div class="arrow-left"></div>
			<div class="arrow-right"></div>
		</div>
		<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
	</div>
	<a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
		&nbsp;
	</a>
	<!-- end: NAVBAR COLLAPSE -->
</header>
<!-- end: TOP NAVBAR -->