<?php

function is_menu($menu= null,$submenu=null){
	$menu_title = $menu[0];
	$menu_icon = $menu[1];

	$menu_link = (!$menu[2] == null)? $menu[2] : 'javascript:;';

	$sub_menu = (!$submenu == null)? '<i class="icon-arrow">': '';

	// var_dump($submenu);

	echo'<li>
			<a href="'.$menu_link.'">
				<div class="item-content">
					<div class="item-media">
						<i class="ti-'.$menu_icon.'"></i>
					</div>
					<div class="item-inner">
						<span class="title"> '.$menu_title.' </span>'.$sub_menu.'</i>
					</div>
				</div>
			</a>';

			if (!$submenu == null) {
				is_submenu($submenu);
			}

	echo '</li>';
// for active menu use j.cookies

}

function is_submenu($submenu){
	echo '<ul class="sub-menu">';
		foreach ($submenu as $k => $v) {
			if (is_array($v)) {
				echo '<li>';
					echo '<a href="javascript:;">
										<span>'.$k.'</span> <i class="icon-arrow"></i>
									</a>';
					echo '<ul class="sub-menu">';
					foreach ($v as $kv => $vv) {
						echo '<li>
								<a href="'.$vv.'">
									'.$kv.'
								</a>
							</li>';
					}
						
					echo '</ul>';
				echo '</li>';
			} else {
				echo '<li>
					<a href="'.$v.'">
						<span class="title"> '.$k.' </span>
					</a>
				</li>';
			}
		}
	echo '</ul>';
}

function is_menuFeature($menu){
	echo '<li>
			<a href="'.$menu[2].'">
				<div class="item-content">
					<div class="item-media">
						<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-'.$menu[0].' fa-stack-1x fa-inverse"></i> </span>
					</div>
					<div class="item-inner">
						<span class="title"> '.$menu[1].' </span>
					</div>
				</div>
			</a>
		</li>';
}