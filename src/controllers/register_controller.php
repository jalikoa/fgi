<?php
/**
 * Future guardians initiative 
 *
 * @see       https://github.com/jalikoa/fgi/ The future guardians repository
 * @author    Calvince Owino Jalikoa (Kenya) <d34calvo@gmail.com>
 * @copyright 2024 - 2025 Calvince Owino CEO Jalsoft
 * @license   Thi programe is written for the specific needs of future guardians initiative and no part can be taken away without prior permissions
 * CEO JalSoft Calvince Owino
 * @see contact at +254799311413
 */
  require_once "../src/config/db_config.php";
  require_once "../src/models/register_model.php";
  require_once "../src/helpers/sanitation.php";
  use jalikoa\FGIprogramme\register;
if (isset($_POST["register"])){
    $register = new register();
    $firstname = sanitize($_POST["firstname"]);
    $lastname = sanitize($_POST["lastname"]);
    $username = sanitize($_POST["username"]);
    $phone = sanitize($_POST["userphone"]);
    $email = sanitize($_POST["useremail"]);
    $country = sanitize($_POST["usercountry"]);
    $bio = sanitize($_POST["userbio"]);
    $status = 0;
    $role = 1;
    $fblink = sanitize($_POST["userfblink"]);
    $password = password_hash(sanitize($_POST["userpassword"]),PASSWORD_BCRYPT);
    $th = $register->setCred($firstname,$lastname,$username,$phone,$email,$bio,$password,$status,$role,$fblink,$country);
      if(!$register->check_user_exists($conn)){
        // Adding the logics here now to help validate the image uploade the profile picture 
       $regRes = $register->register_user($conn);
       if($regRes){
        if($register->send_otp()){
          echo json_encode(["success" => true,"message" => "Registration successfull you can now login after verifying account.","uid" => base64_encode($register->getI($conn))]);
        } else {
          echo json_encode(["success" => false,"message" => "Your were registered but there was a problem sending email please contact us at info@futureguardians.com for help"]);
        }
       }
      } else {
        echo json_encode(["success" => false,"message" => "Sorry user exists with the provided credentials"]);
      }
    } else {
        echo json_encode(["success" => false,"message" => "Please note that your first name,last name,username,phone,email,password and country are required "]);    
}