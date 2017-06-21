
<!-- start: LOGIN -->
<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="logo margin-top-30">
			<img src="<?php echo SERVER_PUBLIC; ?>assets/images/logo___.png" alt="ERP Pan Brothers Tbk"/>
			<span>PT PANBROTHERS TBK</span>
		</div>
		<!-- start: LOGIN BOX -->
		<div class="box-login margin-top-10">
			<form class="form-login" action="" method="POST">
				<fieldset>
					<legend>
						Sign in to your account
					</legend>
					<p>
						Please enter your nik and password to log in.
					</p>
					<!-- <div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" name="username" placeholder="Username">
							<i class="fa fa-user"></i> </span>
					</div> -->
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" name="username" placeholder="Your Nik">
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control password" name="password" placeholder="Password">
							<i class="fa fa-lock"></i>
							<!-- <a class="forgot" href="<?php echo SERVER_NAME; ?>login/forgot">
								I forgot my password
							</a> </span> -->
					</div>
					<div class="form-actions">
						<!-- <div class="checkbox clip-check check-primary">
							<input type="checkbox" id="remember" value="1">
							<label for="remember">
								Keep me signed in
							</label>
						</div> -->
						<a href="http://192.168.100.109/" class="btn btn-primary btn-o"> 
                            <i class="fa fa-home"></i> 
                            Home
                        </a>    
						<button type="submit" class="btn btn-primary pull-right">
							Login <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
					<!-- <div class="new-account">
						Don't have an account yet?
						<a href="<?php echo SERVER_NAME; ?>login/registration">
							Create an account
						</a>
					</div> -->
					<div class="new-account">
						Can't login?
						<a href="<?php echo SERVER_NAME; ?>login/upgrade">
							Upgrade account
						</a>
					</div>
					
				</fieldset>
			</form>
			<div>
				Need help? 
				<a href="<?php echo SERVER_NAME; ?>documentation">
					Documentation
				</a>
			</div>
			<!-- start: COPYRIGHT -->
			<?php copyright(); ?>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: LOGIN BOX -->
	</div>
</div>
<!-- end: LOGIN -->
