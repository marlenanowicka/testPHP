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
      <li class="active">View Contacts</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">View Contact</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="name"><span class="required">*</span>Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="Name" value="<?php echo $results[0]["name"] ?>" id="name" class="form-control" name="name"><span id="name_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="surname"><span class="required">*</span>Surname:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["surname"] ?>" placeholder="Surname" id="surname" class="form-control" name="surname"><span id="surname_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Email:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["email"] ?>" placeholder="Email" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="phone_number"><span class="required">*</span>Phone number:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["phone_number"] ?>" placeholder="Phone Number" id="phone_number" class="form-control" name="phone_number"><span id="phone_number_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="zip">Zip:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["zip"] ?>" placeholder="Phone Number" id="zip" class="form-control" name="zip"><span id="zip_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="address">Address:</label>
              <div class="col-lg-5">
                <textarea id="address" readonly="" name="address" rows="3" class="form-control"><?php echo $results[0]["address"] ?></textarea>
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>