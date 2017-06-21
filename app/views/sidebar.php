<!-- sidebar -->
<div class="sidebar app-aside" id="sidebar">
	<div class="sidebar-container perfect-scrollbar">
		<nav>
		<?php //var_dump($_SESSION); ?>
			<!-- start: MAIN NAVIGATION MENU -->
			<div class="navbar-title">
				<span>Main Navigation</span>
			</div>
			<ul class="main-navigation-menu">
				<!-- class active open with jquery cookies -->
				<?php 
				/****************************************************************
				is_menu : title menu, icon menu, link/url menu if have submenu fill with null
				is_submenu : array structure title and link/url || array for submenu level (max level 3)
				*******************************************************************/
					$menuDashboard = array('Dashboard','home',SERVER_NAME);
					is_menu($menuDashboard);

					// ================= Menu Sidebar Dashboard ==================
					$subMenu = array();

					// ===========================================================
					/*

					if ($_SESSION['dept'] == 'B10') {
						$menu = array('Accounting','more-alt',null);	
						// var_dump($_SESSION['level']);
						$subMenu['Request'] = ['Non Production'=>SERVER_NAME.'accounting/requestnon'];

						is_menu($menu,$subMenu);
					}
					unset($subMenu);

					// ================= Menu Sidebar Accounting ==================
					// ===========================================================


					if ($_SESSION['dept'] == 'A14') {
						$menu = array('Purchasing','more-alt',null);	
						// var_dump($_SESSION['level']);
						$subMenu['Request'] = ['Non Production'=>SERVER_NAME.'purchasing/requestnon'];

						is_menu($menu,$subMenu);
					}
					unset($subMenu);

					// ================= Menu Sidebar Purchasing ==================

					// MAR & A13
					if ($_SESSION['dept'] == 'MAR' OR $_SESSION['dept'] == 'A13' OR $_SESSION['level'] <= 5) {
						$menu = array('Marketing','more-alt',null);	
						// var_dump($_SESSION['level']);
						$subMenu['Report'] = ['Order'=>SERVER_NAME.'marketing/report/order'];

						is_menu($menu,$subMenu);
					}
					unset($subMenu);
					*/
					// ================= Menu sidebar ==================
					/* Menu Order */
					
					$menu = array('Production','desktop',null);	
					
					$subMenu = array('Bill Of Material (BOM)'=>SERVER_NAME.'purchase','Order Status'=>SERVER_NAME.'purchase/rptorder','Line Monitoring'=>SERVER_NAME.'monitor/line');
					is_menu($menu,$subMenu);
					unset($subMenu);
				?>
			</ul>
			<!-- end: MAIN NAVIGATION MENU -->
			
			<!-- start: DOCUMENTATION BUTTON -->
			<!-- <div class="wrapper">
				<a href="documentation.html" class="button-o">
					<i class="ti-help"></i>
					<span>Documentation</span>
				</a>
			</div> -->
			<!-- end: DOCUMENTATION BUTTON -->
		</nav>
	</div>
</div>
<!-- / sidebar -->