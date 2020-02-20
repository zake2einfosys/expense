<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div style="width: 40%; margin-left:30%;margin-top:30px">
	<!-- Material form register -->
	<div class="card">

		<h5 class="card-header info-color white-text text-center py-4">
			<strong>Create transaction</strong>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<div class="errormsg text-center" style="color: red;margin-top: 5px;font-family: 'Calibri Light'"></div>
			<form id="registration_form" enctype="multipart/form-data" class="text-center" style="color: #757575;" action="<?= site_url('insertt'); ?>" method = "post"">
			<?php if (isset($message) && isset($class)){ ?>
				<div class="alert <?php echo $class;?>" style="margin-top: 5px;"><?php echo $message;?></div>
			<?php } ?>

			<!-- Last name -->
			<div class="md-form">
						<input type="text" id="transactiontitle" class="form-control" name="transactiontitle">
						<label for="transactiontitle">Enter transaction name</label>
						<input type="hidden" name="gid" value="<?= $group_id; ?>">
					
			</div>




			<!-- Sign up button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Next</button>

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

