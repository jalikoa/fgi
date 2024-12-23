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
require_once "../src/helpers/sanitation.php";
require_once "../src/models/acc_man_model.php";
use jalikoa\FGIprogramme\manage_account;
if(isset($_POST["enter_otp"])){
    // Check and verify entered otp
    $userid = sanitize($_POST["userid"]);
    $uotp = sanitize($_POST["userotp"]);
    $otp_action = new manage_account();
    if ($otp_action->setCred_otp_action($userid,$uotp)){
            if($otp_action->check_u_exists($conn)){
                if($otp_action->verify_otp()){
                    if($otp_action->verify_account($conn)){
                        echo json_encode(["success" => true,"message" => "Account succefully verified you can now proceed and login"]);
                    } else {
                        echo json_encode(["success" => false,"message" => "An uncaught exception occurred please try again later"]);
                    }
                } else {
                    echo json_encode(["success" => false,"message" => "You have provided an incorrect otp.Check your email again please or request new one"]);
                }
            } else {
                echo json_encode(["success" => false,"message" => "Sorry we could not find your account"]);
            }
    } else {
        echo json_encode(["success" => false,"message" => "Sorry OTP field cannot be empty"]);
    }
    
}
if(isset($_POST["reset_password"])){
    // request otp and send

}