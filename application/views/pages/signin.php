<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div class="main">
<!-- Material form login -->
<div class="card">

	<h5 class="card-header info-color white-text text-center py-4">
		<strong>Sign in</strong>
	</h5>

	<!--Card content-->
	<div class="card-body px-lg-5 pt-0">

		<!-- Form -->
		<form class="text-center" style="color: #757575;" action="<?= site_url('post_login'); ?>" method = "post">
			<?php if (isset($message) && isset($class)){ ?>
				<div class="alert <?php echo $class;?>" style="margin-top: 5px;"><?php echo $message;?></div>
			<?php } ?>
			<!-- Email -->
			<div class="md-form">
				<input type="email"  class="form-control" name="email" required>
				<label>E-mail</label>
			</div>

			<!-- Password -->
			<div class="md-form">
				<input type="password" class="form-control" name="password" required>
				<label>Password</label>
			</div>

			<div class="d-flex justify-content-around">
				<div>
					<!-- Remember me -->
					<div class="form-check">
						<input type="checkbox" class="form-check-input">
						<label class="form-check-label">Remember me</label>
					</div>
				</div>
				<div>
					<!-- Forgot password -->
					<a href="">Forgot password?</a>
				</div>
			</div>

			<!-- Sign in button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Sign in</button>

			<!-- Register -->
			<p>Not a member?
				<a href="<?= site_url('register'); ?>">Register</a>
			</p>

			<!-- Social login -->
			<p>or sign in with:</p>
			<a type="button" class="btn-floating btn-fb btn-sm">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a type="button" class="btn-floating btn-tw btn-sm">
				<i class="fab fa-twitter"></i>
			</a>
			<a type="button" class="btn-floating btn-li btn-sm">
				<i class="fab fa-linkedin-in"></i>
			</a>
			<a type="button" class="btn-floating btn-git btn-sm">
				<i class="fab fa-github"></i>
			</a>

		</form>
		<!-- Form -->

	</div>

</div>
<!-- Material form login -->
</div>

<?php
require DOC_ROOT_PATH . "test_p/application/views/layout/footer.php";
?>
