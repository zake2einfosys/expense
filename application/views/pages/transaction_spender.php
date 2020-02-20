<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div style="width: 40%; margin-left:30%;margin-top:30px">
	<!-- Material form register -->
	<div class="card">
    
        <h5 class="card-header info-color white-text text-center py-4">
			<strong><?= $title; ?> <i class="fa fa-check-circle" style="font-size:15px"></i></strong>
		</h5>
		<h5 class="card-header info-color white-text text-center py-4">
			<strong>PLEASE ENTER SPENDERS NAMES</strong>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<div class="errormsg text-center" style="color: red;margin-top: 5px;font-family: 'Calibri Light'"></div>
			<form id="registration_form" enctype="multipart/form-data" class="text-center" style="color: #757575;" action="<?= site_url(''); ?>" method = "post">
			<?php if (isset($message) && isset($class)){ ?>
				<div class="alert <?php echo $class;?>" style="margin-top: 5px;"><?php echo $message;?></div>
			<?php } ?>
            
            <div id='TextBoxesGroup'>

            <!-- form material -->
            <div id="TextBoxDiv1">
            
            
            <div class="form-row">
			<div class="col">
            <div class="md-form">
           
           
                <div class="form-group">
                <select class="form-control" id="friend1" name="friend1">
                    <option value="" disabled selected>Choose Friend</option>
                    <option>Friend one</option>
                    <option>Friend two</option>
                    <option>Friend tri</option>
                    <option>Friend fur</option>
                </select>
                </div>
            </div>
            </div>
            <div class="col">
            <div class="md-form">
						<input type="text" id="textbox1" class="form-control" name="textbox1">
						<label for="textbox1">Enter item</label>
            </div>
            </div>
            <div class="col">
            <div class="md-form">
						<input type="number" id="price1" class="form-control" name="price1">
						<label for="price1">Enter price</label>
            </div>
            </div>
            </div>
           

            </div> 
            <!-- form material -->
            </div>
			
            <div>
            <input class="btn btn-outline-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type='button' value='Add' id='addButton'>
            <input class="btn btn-outline-danger btn-rounded btn-block my-4 waves-effect z-depth-0" type='button' value='Remove' id='removeButton'>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){

    var counter = 2;

    //add button
	$("#addButton").click(function () {
	
    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var formrow = $(document.createElement('div')).attr("class","form-row");
                
	newTextBoxDiv.after().html('' +'<input type="text" name="textbox' + counter + '" id="textbox' + counter + '" value="" >');
    newTextBoxDiv.appendTo("#TextBoxesGroup");

	counter++;
     });

     //remove button
     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
    //get all values
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
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

