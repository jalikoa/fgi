<?php
    require_once "../src/config/db_config.php";
    require_once "../src/models/register_model.php";
    require_once "../src/helpers/sanitation.php";
    require_once "../src/middlewares/auth_middleware.php";
    require_once "../src/models/users_model.php";
    // Auth user logged in
    // Auth user is admin
    // Auth user verified account
    use jalikoa\FGIprogramme\reister;
    use jalikoa\FGIprogramme\Auth;
    use jalikoa\FGIprogramme\users;
if(isset($_POST["adduser"])){
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
        echo json_encode(["success" => true,"message" => "Registration successfull the user can now login after verifying the account.","uid" => base64_encode($register->getI($conn))]);
       }
      } else {
        echo json_encode(["success" => false,"message" => "Sorry user exists with the provided credentials"]);
      }
}
if(isset($_POST["deleteuser"])){
    $userid = sanitize($_POST["userid"]);
    $usermodel = new users();
    if($usermodel->check_u_exists($conn,$userid)){
        if($usermodel->deleteUser($conn,$userid)){
            echo json_encode(["success" => true,"message" => "User deleted succesfully"]);
        } else {
            echo json_encode(["success" => false,"message" => "User not deleted please try again later"]);
        }
    }else{
        echo json_encode(["success" => false,"message" => "sorry no user exists with the credentials that you have provided"]);
    }
}
if(isset($_POST["fetchusers"])){
        $limit = sanitize($_POST["limit"]);
        $usermodel = new users();
        if($usermodel->fetch_users($conn,$limit)){
           echo json_encode(["success" => true,"message" => "users list fetched succesfully","list" => $usermodel->get_users_list()]);
        } else {
            echo json_encode(["success" => false,"message" => "Sorry no user is found in the database"]);
        }
}
if(isset($_POST["blockuser"])){
    $userid = sanitize($_POST["userid"]);
    $sessid = sanitize($_POST["sessid"]);
    $usermodel = new user();
    $auth = new Auth();
    if($auth->check_logged_in($sessid)){
        if($auth->auth_admin($userid,$conn)){
            if($usermodel->check_u_exists($conn,$userid)){
                if($usermodel->unblockUser($conn,$usid)){
                    echo json_encode(["success" => true,"message" => "User succesfully blocked"]);
                } else {
                    echo json_encode(["success" => false,"message" => "An uncaught exception occurred please try again later please"]);
                }
            } else {
                echo json_encode(["success" => false,"message" => "Sorry the user you are trying to block does not exist in the database"]);
            }
        } else {
            echo json_encode(["success" => false,"message" => "Action denied ! Only admins can do this !"]);
        }
    } else {
        echo json_encode(["success" => false,"message" => "Please ensure that you log in to procceed"]);
    }
}
if(isset($_POSt["unblockuser"])){
    $userid = sanitize($_POST["userid"]);
    $sessid = sanitize($_POST["sessid"]);
    $usermodel = new user();
    $auth = new Auth();
    if($auth->check_logged_in($sessid)){
        if($auth->auth_admin($userid,$conn)){
            if($usermodel->check_u_exists($conn,$userid)){
                if($usermodel->blockUser($conn,$usid)){
                    echo json_encode(["success" => true,"message" => "User succesfully unblocked"]);
                } else {
                    echo json_encode(["success" => false,"message" => "An uncaught exception occurred please try again later please"]);
                }
            } else {
                echo json_encode(["success" => false,"message" => "Sorry the user you are trying to unblock does not exist in the database"]);
            }
        } else {
            echo json_encode(["success" => false,"message" => "Action denied ! Only admins can do this !"]);
        }
    } else {
        echo json_encode(["success" => false,"message" => "Please ensure that you log in to procceed"]);
    }

}
if(isset($_POST["gettotalusers"])){
    $sessid = sanitize($_POST["sessid"]);
    $usermodel = new user();
    $auth = new Auth();
    if($auth->check_logged_in($sessid)){
        if($usermodel->fetch_total_users($conn)){
            echo json_encode(["success" => true,"message" => "Total users fetched","total" => $usermodel->getTotal()]);
        } else {
            echo json_encode(["success" => false,"message" => "Sorry could not get users list"]);
        }
    } else {
        echo json_encode(["success" => false,"message" => "Please login to continue"]);
    }
}