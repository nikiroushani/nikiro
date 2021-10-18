<div class="container h-75 d-flex align-items-center">
	<div class="row w-100">
		<div class="col">
			<?php echo form_open(base_url().'login/check_login'); ?>
				<h2 class="text-center">Log In</h2>       
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" required="required" name="email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" required="required" name="password">
				</div>
				<div class="form-group">
				<?php echo $error; ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-outline-dark btn-block">Log in</button>
				</div>
				
			<?php echo form_close(); ?>
		</div>
		
		<div class="col">
		<?php echo form_open(base_url().'login/check_registration'); ?>
				<h2 class="text-center">Register</h2>       
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Email" required="required" name="regemail">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" required="required" name="regpassword">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirm Password" required="required" name="confirmpassword">
				</div>
				<div class="form-group">
				<?php echo $regerror; ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-outline-dark btn-block">Register</button>
				</div>   
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
