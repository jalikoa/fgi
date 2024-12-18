<?php
use jalikoa\FGIprogramme\Auth;
session_start();
if(isset($_GET["auth"])){
    require_once "../../src/config/db_config.php";
    require_once "../../src/middlewares/auth_middleware.php";
    
    $auth = htmlspecialchars($_GET["auth"]);
    if(!isset($_SESSION[$auth])){
        header("location:../login.html");
    }
    $auth = new Auth;
    $sessid = $_GET["auth"];
    $uid = $_SESSION[$sessid];
    if(!$auth->auth_admin($uid,$conn)){
        header("location:../users/dashboard.php?auth='$sessid'");
    }
} else {
    header("location:../login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- This is the beginning of the spinner body it will spin as the page loads info -->
    <div class="spinner-holder d-flex" id="loaderIndicator">
        <div class="spinner-border text-primary spin-style"></div>
     </div>
    <!-- This is the beginning of the header -->
    <header class="bg-future-green">
        <div class="container-fluid d-flex dnav">
            <a href="dashboard.html" class="logo-holder">
                <a href="./dashboard.html" class="navbar-brand"><center class="d-flex align-items-center"><img src="../favicon.png" alt="" class="rounded-corners mb-2 mt-1 header-initiative_logo"><h5 class="ms-3 p-0 fgi">Future Guardians initiative</h3></center></a>
            </a>
            <div class="not-prof-sec mt-3 d-flex flex-direction-row p-0">
                <span class="ms-3 me-3 position-relative notii" data-bs-toggle="dropdown">
                    <span class="badge position-absolute top-0 end-0 bg-primary mt-1">4</span>
                    <i class="bi mt-3 bi-bell-fill"></i>
                </span>
                <!-- Beginning of the notification dropdown -->
                 <div class="dropdown">
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">
                            <p class="text-primary text-small m-0 p-0" id="notificationIndicator">
                                4 new Notifications 
                            </p>
                        </li>
                        <hr class="dropdown-divider">
                        <li class="dropdown-item">
                            <a href="" class="d-flex">
                                <div class="img-section">
                                    <img src="../assets/img/default.png" alt="">
                                </div>
                                <div class="info-sec">
                                   <p class="m-0 p-0 text-success">
                                    Henry sent feedback
                                   </p>
                                <div class="dd-description">
                                    <span class="text-small text-info">02:33 saturday 12/09/2023 </span>
                                </div>
                                </div>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li class="dropdown-item">
                            <a href="" class="d-flex">
                                <div class="img-section">
                                    <img src="../assets/img/default.png" alt="">
                                </div>
                                <div class="info-sec">
                                   <p class="m-0 p-0 text-success">
                                    Henry sent feedback
                                   </p>
                                <div class="dd-description">
                                    <span class="text-small text-info">02:33 saturday 12/09/2023 </span>
                                </div>
                                </div>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li class="dropdown-item">
                            <a href="" class="d-flex">
                                <div class="img-section">
                                    <img src="../assets/img/default.png" alt="">
                                </div>
                                <div class="info-sec">
                                   <p class="m-0 p-0 text-success">
                                    Henry sent feedback
                                   </p>
                                <div class="dd-description">
                                    <span class="text-small text-info">02:33 saturday 12/09/2023 </span>
                                </div>
                                </div>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li class="dropdown-item">
                            <a href="" class="d-flex">
                                <div class="img-section">
                                    <img src="../assets/img/default.png" alt="">
                                </div>
                                <div class="info-sec">
                                   <p class="m-0 p-0 text-success">
                                    Henry sent feedback
                                   </p>
                                <div class="dd-description">
                                    <span class="text-small text-info">02:33 saturday 12/09/2023 </span>
                                </div>
                                </div>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        <center><a href="" class="mb-1 mt-3">Show all</a></center>&nbsp;
                    </ul>
                 </div>
                 <!-- End of the notification dropdown -->
                 <span class="ms-3 me-3 position-relative notii" data-bs-target="#messages" data-bs-toggle="dropdown">
                    <span class="badge position-absolute top-0 end-0 bg-warning mt-1">4</span>
                    <i class="bi mt-3 bi-chat-dots-fill"></i>
                </span>
                <div class="dropdown" id="messages">
                    <ul class="dropdown-menu">
                        <p class="m-0 p-0 text-info">
                            4 new messages
                        </p>
                        <li class="dropdown-item"></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <div class="prof-holder border-0 d-flex flex-direction-row" data-bs-toggle="dropdown">
                        <span class="me-1 p-0 userName">Calvince Owino</span>
                        <img class="m-0" src="../assets/img/messages-3.jpg" alt="">
                    </div>
                    <ul class="dropdown-menu text-muted">
                        <li class="dropdown-item">
                            <center><img class="m-0 prof-pic-preview" src="../assets/img/messages-3.jpg" alt="" id="prof-pic-holder"></center>
                        </li>
                        <center>
                            <p class="m-1 text-secondary p-0 m-0 fw-medium" id="name-holder">Calvince Owino</p>
                            <p class="m-1 text-secondary p-0 m-0 fw-medium" id="user-type">Admin</p>
                        </center>
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="" class="text-secondary"><i class="bi bi-pencil-square"></i> Edit profile</a>
                        </li>
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="" class="text-secondary"><i class="bi bi-gear-fill"></i> Profile settings</a>
                        </li>
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="" class="text-secondary"><i class="bi bi-box-arrow-right"></i>Logout</a>
                        </li>
                        <hr class="dropdow-divider">
                    </ul>
                </div>
            </div>
        </div>
    </header>
     <!-- This is the end of the header -->
    <!-- This is the beginning of the navbar in phone -->
    <nav>
        <Section>
            
        </Section>
    </nav>
    <!-- This is thr beginnig of the nav in the desktop versions -->
    <div class="nav-sidebar">
        <ul class="navbar-container">
            <li class="navbar-item alert alert-success border-0">
                <a href="./dashboard.html" class="navbar-link fw-medium text-muted"><i class="bi bi-house-door-fill"></i> Home</a>
            </li>
            <li class="navbar-item">
                <a href="./discussions.html" class="navbar-link fw-medium text-secondary"><i class="bi bi-person-lines-fill"></i> Discussions</a>
            </li>
            <li class="navbar-item">
                <a href="./users.html" class="navbar-link fw-medium text-secondary"><i class="bi bi-people-fill"></i> Users</a>
            </li>
            <li class="navbar-item">
                <a href="./activities.html" class="navbar-link fw-medium text-secondary"><i class="bi bi-tropical-storm"></i> Activities</a>
            </li>
            <li class="navbar-item">
                <a href="./donations.html" class="navbar-link fw-medium text-secondary"><img src="../assets/img/Coin Hand.png" class="nav-image" alt=""> Donations</a>
            </li>
            <li class="navbar-item">
                <a href="./queries.html" class="navbar-link fw-medium text-secondary"><i class="bi bi-chat-right-dots"></i> Queries</a>
            </li>
            <li class="navbar-item">
                <a href="./members.php?auth=<?php echo $sessid;?>" class="navbar-link fw-medium text-secondary"><i class="bi bi-people"></i> Members</a>
            </li>
            <li class="navbar-item">
                <a href="./resources.html?images='1'" class="navbar-link fw-medium text-secondary"><i class="bi bi-image-fill"></i> Images</a>
            </li>
            <li class="navbar-item">
                <a href="./resources.html?books='1'" class="navbar-link fw-medium text-secondary"><i class="bi bi-book-half"></i> Books</a>
            </li>
            <li class="navbar-item">
                <a href="./resources.html?videos='1'" class="navbar-link fw-medium text-secondary"><i class="bi bi-camera-reels"></i> Videos</a>
            </li>
        </ul>
    </div>
    <div class="main-body">
        <div class="">
            <h4 class="text-secondary">
                Admin
            </h4>
            <!-- This is the beginning of the division that has the cards for the display of the overview of the site -->
            <div class="col w-100 cadi-bebaji d-flex">
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Users</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,198</p>
                    </div>
                </div>
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Discussions</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,000</p>
                    </div>
                </div>
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Members</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,000</p>
                    </div>
                </div>
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Books</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,000</p>
                    </div>
                </div>
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Videos</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,000</p>
                    </div>
                </div>
                <div class="card border-0 pt-1 ps-1 pe-1 pb-1 dd-container">
                    <div class="img-holder mt-1"><img src="../assets/img/People.png" alt=""></div>
                    <div class="card-desc ms-3 me-2">
                        <h6 class="text-success fw-bold">Images</h6>
                        <p id="totalUsers" class="text-secondary fw-medium">Total: 12,000</p>
                    </div>
                </div>
                </div>
            </div>
            <!-- This is the end of the cards that show the admin some of the site overview -->        
         <div class="row mt-2">
            <!-- This div has some of the fascinating features that is analytics of the site then plus the recent activities -->
            <div class="col col-12 col-sm-6">
                <div class="card w-100 border-0 shadow mt-1 position-relative">
                    <i class="bi bi-three-dots-vertical position-absolute top-0 end-0 m-1" data-bs-toggle="dropdown"></i>
                    <!-- Dropdown -->
                    <div class="dropdown">
                         <ul class="dropdown-menu">
                            <h6 class="text-secondary ms-2 mt-1">
                                Filter
                            </h6>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-down-alt"></i> Date ASC</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-up"></i> Date DESC</a></li>
                            <hr>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-alpha-down"></i> A-Z</a></li>
                            <hr>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-alpha-down-alt"></i> Z-A</a></li>
                        </ul>
                    </div>
  
                    <h5 class="text-info ms-2 mt-2">
                        Recent Resources
                    </h5>
                    <p class="text-danger m-3 fw-medium">No recents</p>
                </div> 
            </div>
            <div class="col col-12 col-sm-6">
                <div class="card w-100 border-0 shadow mt-1 position-relative">
                    <i class="bi bi-three-dots-vertical position-absolute top-0 end-0 m-1" data-bs-toggle="dropdown"></i>
                    <!-- Dropdown -->
                    <div class="dropdown">
                         <ul class="dropdown-menu">
                            <h6 class="text-secondary ms-2 mt-1">
                                Filter
                            </h6>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-down-alt"></i> Date ASC</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-up"></i> Date DESC</a></li>
                            <hr>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-alpha-down"></i> A-Z</a></li>
                            <hr>
                            <li><a class="dropdown-item text-secondary" href="#"><i class="bi bi-sort-alpha-down-alt"></i> Z-A</a></li>
                        </ul>
                    </div>
  
                    <h5 class="text-info ms-2 mt-2">
                        Recent activities
                    </h5>
                    <p class="text-danger m-3 fw-medium">No recent Activity</p>
                    <div class="alert alert-warning  alert-dismissible fade show me-1 ms-1 mt-1" role="alert">
                        <p class="mb-0">Added new member</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <div class="alert alert-danger  alert-dismissible fade show me-1 ms-1 mt-1" role="alert">
                        <p class="mb-0">Deleted a member</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <div class="alert alert-info  alert-dismissible fade show me-1 ms-1 mt-1" role="alert">
                        <p class="mb-0">Added a book</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <div class="alert alert-success alert-dismissible fade show me-1 ms-1 mt-1" role="alert">
                        <p class="mb-0">Added a new user</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div> 
            </div>
         </div>
    </div>
    
</body>
<script>
    const sessid = '<?php echo $sessid?>';
</script>
<script src="../assets/js/aos.js"></script>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/aosInit.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/sweetalert2@11.js"></script>
</html>