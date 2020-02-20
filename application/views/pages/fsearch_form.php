<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>
<style>
        .table-fixed{
        width: 100%;
    }
        tbody{
            height:500px;
            overflow-y:auto;
            }
        tbody{
            display:block;
        }
        .f_b{
            margin-top:10px;
        }


</style>

<div class="row">
<div class="main col-5" style="margin-left: 10%;">
<!-- Material form register -->
<div class="card">

	<h5 class="card-header info-color white-text text-center py-4">
		<strong>Search Friends</strong>
	</h5>

	<!--Card content-->
	<div class="card-body px-lg-5 pt-0">

		<!-- Form -->
		<div class="errormsg " style="margin-top: 5px;font-family: 'Calibri Light'"></div>
		<form id="registration_form" enctype="multipart/form-data" class="text-center" style="color: #757575;" action="<?= site_url('search_all_friends'); ?>" method = "post">
		<?php if (isset($message)){ ?>
		<div class="alert alert-danger"><?php echo $message;?></div>
		<?php } ?>

			<!-- Friend name -->
			<div class="md-form mt-0">
				<input type="text" id="friend name" class="form-control" name="f_name">
				<label for="email">Friend first name</label>
			</div>
            <div class="md-form mt-0">
            <select class="custom-select custom-select-sm" name="country">
            <option selected>Select Country</option>
            <option value="pakistan">pakistan</option>
            <option value="india">india</option>
            <option value="united state">united state</option>
            </select>
            </div>

		
			<!-- Sign up button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Find</button>

		</form>
		<!-- Form -->

	</div>

</div>
<td><a href="<?= site_url('show_groups'); ?>"class="btn btn-info" style="margin-top: 23px;float:right;"><i class="far fa-arrow-alt-circle-left" style="font-size:13px;margin-right:10px;"></i>BACK TO PROFILE</a></td>
                            

</div>

<div class="col-5 card" style="margin:30px">
<table class="table table-fixed">
						<tbody>
                        <?php 
                        if(isset($friends)){
                        foreach($friends as $friend){ 
                        ?>
							<tr>
									<td><img src="<?php echo base_url()?>/asset/images/<?= $friend -> picture; ?>" style="display: inline-block;width: 50px; height: 50px;margin: 3px;border-radius: 50%"></td>
									<td><p class="td" style="margin-top: 15px"><?= $friend -> fullname;?></p></td>
									<td>
                                        <form method="post" action="<?= site_url('send_friend_request'); ?>">
                                            <input type="hidden" id="Id" name="id" value="<?= $friend -> id;?>">
                                            <button class="btn btn-primary btn-sm" style="margin-top: 13px;" type="submit" name="submit">
                                        Send friend request</button>
                                        </form>   
                                    </tr>
                        <?php 
                            }
                                }else{ 
                                    if(isset($allfriends)){
                                foreach($allfriends as $allfriend){ 
                                    ?>
                                        <tr>
                                        <td><img src="<?php echo base_url()?>/asset/images/<?= $allfriend -> picture; ?>" style="display: inline-block;width: 50px; height: 50px;margin: 3px;border-radius: 50%"></td>
                                        <td><p class="td" style="margin-top: 15px"><?= $allfriend -> fullname;?></p></td>
                                        
                                        </tr>
                                        <?php }}} ?>
                            </tbody>
                        
                       
					</table>
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

// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});

</script>
<?php
require DOC_ROOT_PATH . "test_p/application/views/layout/footer.php";
?>
