<?php

require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM tbl_contacts WHERE 1 AND id = :cid";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>

<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> Contacts</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> New Contact</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["profile_pic"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["id"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="name"><span class="required">*</span>Name:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["name"] ?>" placeholder="Name" id="name" class="form-control" name="name"><span id="name_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="surname"><span class="required">*</span>Surname:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["surname"] ?>" placeholder="Surname" id="surname" class="form-control" name="surname"><span id="surname_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Email:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["email"] ?>" placeholder="Email" id="email_id" class="form-control" name="email"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="phone_number"><span class="required">*</span>Phone number:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["phone_number"] ?>" placeholder="Phone Number" id="phone_number" class="form-control" name="phone_number"><span id="phone_number_err" class="error"></span>
                <span class="help-block">Maximum of 9 digits only and only numbers.</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="zip">Zip:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["zip"] ?>" placeholder="Phone Number" id="zip" class="form-control" name="zip"><span id="zip_err" class="error"></span>
                <span class="help-block">Maximum of 6 digits only and only numbers.</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="address">Address:</label>
              <div class="col-lg-5">
                <textarea id="address" name="address" rows="3" class="form-control"><?php echo $results[0]["address"] ?></textarea>
              </div>
            </div>

            <div class="form-group">
                  <label class="col-lg-4 control-label" for="address">Is Friend:</label>
                  <div class="col-lg-5">
                    <input type="checkbox" <?php echo $results[0]["is_friend"] == 1 ? 'checked="checked"': '' ?> id="is_friend" name="is_friend" class="form-control">
                  </div>
              </div>
            
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-primary" type="submit">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
	
	// the fade out effect on hover
	$('.error').hover(function() {
		$(this).fadeOut(200);  
	});
	
	
	$("#contact_form").submit(function() {
		$('.error').fadeOut(200);  
		if(!validateForm()) {
            // go to the top of form first
            $(window).scrollTop($("#contact_form").offset().top);
			return false;
		}     
		return true;
    });

});

function validateForm() {
	 var errCnt = 0;
	 
	 var name = $.trim( $("#name").val());
     var surname = $.trim( $("#surname").val());
	 var email_id = $.trim( $("#email_id").val());
	 var phone_number = $.trim( $("#phone_number").val());
	 var zip = $.trim( $("#zip").val());
     
	 var profile_pic =  $.trim( $("#profile_pic").val());

	// validate name
	if (name == "" ) {
		$("#name_err").html("Enter your first name.");
		$('#name_err').fadeIn("fast");
		errCnt++;
	}  else if (name.length <= 2 ) {
		$("#name_err").html("Enter atleast 3 letter.");
		$('#name_err').fadeIn("fast");
		errCnt++;
	}
    
    if (surname == "" ) {
		$("#surname_err").html("Enter your last name.");
		$('#surname_err').fadeIn("fast");
		errCnt++;
	}  else if (surname.length <= 2 ) {
		$("#surname_err").html("Enter atleast 3 letter.");
		$('#surname_err').fadeIn("fast");
		errCnt++;
	}
    
    if (!isValidEmail(email_id)) {
		$("#email_id_err").html("Enter valid email.");
		$('#email_id_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (phone_number == "" ) {
		$("#phone_number_err").html("Enter phone number.");
		$('#phone_number_err').fadeIn("fast");
		errCnt++;
	}  else if (phone_number.length != 9 ) {
		$("#phone_number_err").html("Enter 9 digits only.");
		$('#phone_number_err').fadeIn("fast");
		errCnt++;
	} else if ( !$.isNumeric(phone_number) ) {
		$("#phone_number_err").html("Must be digits only.");
		$('#phone_number_err').fadeIn("fast");
		errCnt++;
	}
    
    if (zip.length > 0) {
      if (zip.length != 5 ) {
		$("#zip_err").html("Enter 5 digits only.");
		$('#zip_err').fadeIn("fast");
		errCnt++;
	} else if ( !$.isNumeric(zip) ) {
		$("#zip_err").html("Must be digits only.");
		$('#zip_err').fadeIn("fast");
		errCnt++;
	}
    }
	if(errCnt > 0) return false; else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>