<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div class="main">
<!-- Material form register -->
<div class="card">

	<h5 class="card-header info-color white-text text-center py-4">
		<strong>Sign up</strong>
	</h5>

	<!--Card content-->
	<div class="card-body px-lg-5 pt-0">

		<!-- Form -->
		<div class="errormsg text-center" style="color: red;margin-top: 5px;font-family: 'Calibri Light'"></div>
		<form id="registration_form" enctype="multipart/form-data" class="text-center" style="color: #757575;" action="<?= site_url('register_user'); ?>" method = "post"">
		<?php if (isset($message)){ ?>
		<div class="alert alert-danger"><?php echo $message;?></div>
		<?php } ?>
			<div class="form-row">
				<div class="col">
					<!-- First name -->
					<div class="md-form">
						<input type="text" id="first_name" class="form-control" name="fname">
						<label for="first_name">First name</label>
					</div>
				</div>
				<div class="col">
					<!-- Last name -->
					<div class="md-form">
						<input type="text" id="last_name" class="form-control" name="lname">
						<label for="last_name">Last name</label>
					</div>
				</div>
			</div>

			<!-- E-mail -->
			<div class="md-form mt-0">
				<input type="email" id="email" class="form-control" name="email">
				<label for="email">E-mail</label>
			</div>

			<!-- Password -->
			<div class="md-form">
				<input type="password" id="Password_one_id" class="form-control" name="password">
				<label for="Password_one_id">Password</label>
				<small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
					At least 5 characters and 1 digit
				</small>
			</div>

		<!-- confirmed Password -->
		<div class="md-form">
			<input type="password" id="password2" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" name="password2">
			<label for="password2">Confirm Password</label>
		</div>

			<!-- Phone number -->
			<div class="md-form">
				<input type="password" id="materialRegisterFormPhone" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock" name="phone">
				<label for="materialRegisterFormPhone">Phone number</label>

			</div>
		<div class="md-form">
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="picture_upload" name="picture_upload"
				   aria-describedby="inputGroupFileAddon01">
			<label class="custom-file-label" for="picture_upload">Choose file</label>
		</div>
		</div>

			<!-- Newsletter -->
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="materialRegisterFormNewsletter">
				<label class="form-check-label" for="materialRegisterFormNewsletter">Subscribe to our newsletter</label>
			</div>

			<!-- Sign up button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Sign up</button>

			<!-- Social register -->
			<p>or sign up with:</p>

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

			<hr>

			<!-- Terms of service -->
			<p>By clicking
				<em>Sign up</em> you agree to our
				<a href="" target="_blank">terms of service</a>
			</p>
		</form>
		<!-- Form -->

	</div>

</div>
<!-- Material form register -->
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>


    $('form[id="registration_form"]').validate({
        showErrors: function(errorMap, errorList) {
            $(".errormsg").html($.map(errorList, function (el) {
                return el.message;
            }).join(" <br>"));
        },
        wrapper: "span",
        rules: {
            fname: 'required',
            lname: 'required',
			phone:'required',
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5,
            },
			password2 : {
                required:true,
                equalTo: "#Password_one_id"
            },
            picture_upload :{
                required:true,
                accept:"image/*"
            }
        },
        messages: {
            fname: 'First name is required',
            lname: 'Last name is required',
            email: 'Enter a valid email',
			phone: 'phone no required',
            password: {
                minlength: 'Password must be at least 8 characters long',
				required: 'Password is required'
            },
            password2: {
                required: 'Confirm Password is required',
				equalTo: 'Please enter the same password as above'
            },
            picture_upload:{
                required: 'Please upload your picture'
			}
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


</script>
<?php
require DOC_ROOT_PATH . "test_p/application/views/layout/footer.php";
?>
