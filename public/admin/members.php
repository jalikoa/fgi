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
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <style>

    </style>
</head>
<body>
    <!-- This is the beginning of the spinner body it will spin as the page loads info -->
     <div class="spinner-holder d-flex" id="loaderIndicator">
        <div class="spinner-border text-primary spin-style"></div>
     </div>
    <!-- This is the beginning of the header -->
    <header class="bg-future-green">
        <div class="container-fluid d-flex dnav">
            <a href="index.html" class="logo-holder">
                <a href="./home.html" class="navbar-brand"><center class="d-flex align-items-center"><img src="../favicon.png" alt="" class="rounded-corners mb-2 mt-1 header-initiative_logo"><h5 class="ms-3 p-0 fgi">Future Guardians initiative</h3></center></a>
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
                            <a href="./profile.html" class="text-secondary"><i class="bi bi-pencil-square"></i> Edit profile</a>
                        </li>
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="./profile.html" class="text-secondary"><i class="bi bi-gear-fill"></i> Profile settings</a>
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
                <a href="./dashboard.php?auth=<?php echo $sessid?>" class="navbar-link fw-medium text-muted"><i class="bi bi-house-door-fill"></i> Home</a>
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
                <a href="./members.html" class="navbar-link fw-medium text-secondary"><i class="bi bi-people"></i> Members</a>
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
    <button class="btn btn-primary float-rbt-end" data-bs-toggle="modal" data-bs-target="#verticalycentered"><bi class="bi-plus-circle"></bi></button>
      <!-- Modal for adding or editing member -->
      <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <center><h5 class="modal-title text-success" id="activityToDo">Add new Member</h5></center>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addMemberForm">
                    <div class="form-group mt-1">
                        <label for="memberName">Name:</label>
                        <input type="text" id="memberName" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group mt-1">
                        <label for="memberEmail">Email:</label>
                        <input type="email" id="memberEmail" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group mt-1">
                        <label for="memberPhone">Phone:</label>
                        <input type="tel" id="memberPhone" class="form-control"  placeholder="Phone" required>
                    </div>
                    <div class="form-group mt-1">
                        <label for="memberCountry">Country:</label>
                        <input type="text" id="memberCountry" class="form-control"  placeholder="Country" required>
                    </div>
                    <div class="form-group mt-1">
                        <label for="memberRole">Role:</label>
                        <select name="role" id="memberRole" class="form-control" required>
                            <option value="">Select role</option>
                            <option value="chair">Chair</option>
                            <option value="assischair">Assistant Chair</option>
                            <option value="secretary">Secretary</option>
                            <option value="treasurer">Treasurer</option>
                            <option value="itsupport">IT & Support</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                    <div class="form-group m-2">
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" id="closeFormModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div><!-- End Modal add or edit-->
    <div class="main-body position-relative">
        <div class="dropdown position-absolute top-0 end-0">
            <button class="btn  me-5 rounded-pill btn-outline-primary" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a href="" class="dropdown-link text-secondary">Donload list</a>
                </li>
                <li class="dropdown-item">
                    <a href="" class="dropdown-link text-secondary">Add new</a>
                </li>
                <li class="dropdown-item">
                    <a href="" class="dropdown-link text-secondary">Clear members</a>
                </li>
            </ul>
        </div>
        <h4 class="text-secondary m-3" data-aos="fade-down" data-aos-delay="800">
            Dashboard/members
        </h4>
        <div class="row">
            <div class="col col-12 col-sm-8 col-md-6 col-lg-5">
                <form action="" role="form">
                    <div class="input-group" data-aos="fade-left" data-aos-delay="800">
                        <input type="text" id="searchTab" placeholder="Search member here by name or email" class="form-control" required>
                        <button class="btn btn-info"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col col-12 mt-2">
                <div class="form-group mb-2">
                    <select name="" id="entriesPerPage">
                        <option value="5">5</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="all">All</option>
                    </select><label for="entriesPerPage">&nbsp; entries per page</label>
                </div>
                <!-- Members list table begin -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Role</th>
                                <th>Action</th><!-- -Delete or edit member --->
                            </tr>
                        </thead>
                        <tbody id="membersListTable">
                            <tr>
                                <td>1</td>
                                <td>Calvince Owino</td>
                                <td>t313jaliko@gmail.com</td>
                                <td>+254799311413</td>
                                <td>Kenya</td>
                                <td>Member</td>
                                <td>
                                    <div class="m-0 p-0">
                                        <button class="btn btn-primary m-1"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger m-1"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td><!-- -Delete or edit member --->
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Calvince Owino</td>
                                <td>t313jaliko@gmail.com</td>
                                <td>+254799311413</td>
                                <td>Kenya</td>
                                <td>Member</td>
                                <td>
                                    <div class="m-0 p-0">
                                        <button class="btn btn-primary m-1"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger m-1"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td><!-- -Delete or edit member --->
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Calvince Owino</td>
                                <td>t313jaliko@gmail.com</td>
                                <td>+254799311413</td>
                                <td>Kenya</td>
                                <td>Member</td>
                                <td>
                                    <div class="m-0 p-0">
                                        <button class="btn btn-primary m-1"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger m-1"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td><!-- -Delete or edit member --->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Members list table end -->
            </div>
        </div>
        
    </div>
    
</body>
<script>
    const sessid = '<?php echo $sessid?>';
</script>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/aos.js"></script>
<script src="../assets/js/aosInit.js"></script>
<script src="../assets/js/members_handler.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/sweetalert2@11.js"></script>
</html>