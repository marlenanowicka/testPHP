<?php

require './config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $name = trim($_POST['name']);
  $surname = trim($_POST['surname']);
  $email = trim($_POST['email']);
  $phone_number = trim($_POST['phone_number']);
  $zip = trim($_POST['zip']);
  $address = trim($_POST['address']);
  $city = trim($_POST['city']);
  $is_friend = $_POST['is_friend'] ? 1 : 0;
  $filename = "";
  $error = FALSE;


  if (!$error) {
    $sql = "INSERT INTO `tbl_contacts` ( `name`, `surname`, `phone_number`, `email`, `address`, `zip`, `city`, `is_friend` ) VALUES "
            . "( :fname, :surname, :phone_number, :email, :address, :zip, :city, :is_friend)";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":fname", $name);
      $stmt->bindValue(":surname", $surname);
      $stmt->bindValue(":phone_number", $phone_number);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":address", $address);
      $stmt->bindValue(":zip", $zip);
      $stmt->bindValue(":city", $city);
      $stmt->bindValue(":is_friend", $is_friend);


      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Contact added successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add contact.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }
  header("location:index.php");
} elseif ( $mode == "update_old" ) {
  
  $name = trim($_POST['name']);
  $surname = trim($_POST['surname']);
  $email = trim($_POST['email']);
  $phone_number = trim($_POST['phone_number']);
  $zip = trim($_POST['zip']);
  $address = trim($_POST['address']);
  $city = trim($_POST['city']);
  $cid = trim($_POST['cid']);
  $is_friend = $_POST['is_friend'] ? 1 : 0;
  $filename = "";
  $error = FALSE;

  if (!$error) {
    $sql = "UPDATE `tbl_contacts` SET `name` = :name, `surname` = :surname,  `phone_number` = :phone_number, `email` = :email, `address` = :address,  `zip` = :zip, `city` = :city, `is_friend` = :is_friend  "
            . "WHERE id = :cid ";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":surname", $surname);
      $stmt->bindValue(":phone_number", $phone_number);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":address", $address);
      $stmt->bindValue(":zip", $zip);
      $stmt->bindValue(":city", $city);
      $stmt->bindValue(":cid", $cid);
      $stmt->bindValue(":is_friend", $is_friend);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Contact updated successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "No changes made to contact.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "Failed to upload image.";
  }
  header("location:index.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);
   
   $sql = "DELETE FROM `tbl_contacts` WHERE id = :cid";
   try {
     
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":cid", $cid);
        
       $stmt->execute();  
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Contact deleted successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "Failed to delete contact.";
      }
     
   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }
   
   header("location:index.php?pagenum=".$_GET['pagenum']);
}
?>