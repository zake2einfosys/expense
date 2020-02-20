<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div class="main">
	<!-- Material form register -->
	<div class="card">

		<h5 class="card-header info-color white-text text-center py-4">
			<strong>Create group</strong>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<div class="errormsg text-center" style="color: red;margin-top: 5px;font-family: 'Calibri Light'"></div>
			<form id="registration_form" enctype="multipart/form-data" class="text-center" style="color: #757575;" action="<?= site_url('store_group'); ?>" method = "post"">
			<?php if (isset($message) && isset($class)){ ?>
				<div class="alert <?php echo $class;?>" style="margin-top: 5px;"><?php echo $message;?></div>
			<?php } ?>
					<!-- First name -->
					<div class="md-form">
						<input type="text" id="grouptitle" class="form-control" name="grouptitle">
						<label for="grouptitle">Enter group name</label>
					</div>

				<div class="md-form">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="group_picture_upload" name="group_picture_upload"
							   aria-describedby="inputGroupFileAddon01">
						<label class="custom-file-label" for="picture_upload">Choose file</label>
					</div>
				</div>





			<!-- Sign up button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Create</button>

			<!-- Terms of service -->

			</form>
			<!-- Form -->

			<!-- friend info -->

			<!-- friend info ends -->

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
            grouptitle: 'required',

            picture_upload :{
                required:true,
                accept:"image/*"
            }
        },
        messages: {
            grouptitle: 'group name is required',
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
