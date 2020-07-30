<?php
//include connection file 
include("session.php");
include("db.php");

$adminID = $_SESSION['adminID'];

// check clearance level required
$accessSQL = "SELECT `value` FROM `setting` WHERE `setting`.`parameter` = 'settingsAccess'";
$accessstmt = $conn->prepare($accessSQL);
$accessstmt->execute();
$access = (int)$accessstmt->fetchObject()->value;

// check admin clearance level
$adminLevelSQL = "SELECT `clearance` FROM `adminlogin` WHERE `adminlogin`.`userID` = :adminID ";
$adminLevelstmt = $conn->prepare($adminLevelSQL);
$adminLevelstmt->bindParam(':adminID', $adminID);
$adminLevelstmt->execute();
$adminLevel = (int)$adminLevelstmt->fetchObject()->clearance;

if ($access > $adminLevel) {
    $conn = null;
    session_start();
    $_SESSION['AccessError'] = "WARNING: Access not granted.";
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
    <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/common.css" />
    <link rel="stylesheet" href="assets/css/chat.css" />

</head>

<body>
    <!-- chatbot code here -->
    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
    </div>
    <div class="chat-box">
        <div class="chat-box-header">
            <strong>AlphaBot</strong>
            <span class="chat-box-toggle">
                <i class="fa fa-close" title="close" style="margin-top: -12px;"></i>
            </span>
            <span class="chat-header-refresh" id="refresh"><i class="fa fa-refresh" title="startover"></i></span>
        </div>
        <div class="chat-box-body">
            <div class="chat-box-overlay"></div>
            <div class="chat-logs"></div>
        </div>
        <div id="loading" style="position: fixed; bottom: 60px; margin-top: 30px; margin-left: 10px">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="chat-input">
            <form id="chatBotForm">
                <input type="text" id="chat-input" autofocus placeholder="Send a question or response..." />
                <button type="submit" class="chat-submit" id="chat-submit">
                    <span id="micSpan">
                        <i class="fa fa-microphone" style="color: black;" id="mic"></i>
                        <!-- <i class="material-icons">send</i> -->
                    </span>
                </button>
            </form>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">
                            <div class="d-flex">
                                <i class="fa fa-home mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Home</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex">
                                <i class="fa fa-book mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Library</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="manageBooks.php">Manage Books</a>
                            <a class="dropdown-item" href="addBooks.php">Add Books</a>
                            <a class="dropdown-item" href="shelf.php">Shelf</a>
                            <a class="dropdown-item" href="record.php">Record</a>
                            <a class="dropdown-item" href="syllabus.php">Syllabus</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="chatroom.php">
                            <div class="d-flex">
                                <i class="fa fa-comment mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Chatroom</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="settings.php">
                            <div class="d-flex">
                                <i class="fa fa-cog mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Settings</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex">
                                <i class="fa fa-user-circle mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">My Profile</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font-weight-bold" href="#"><?= $adminID ?> </a>
                            <div class="dropdown-divider"></div>
                            <a class="btn dropdown-item" data-toggle="modal" data-target="#changePassword">Change password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><button class="btn btn-danger btn-block">Logout</button></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- change password -->
    <div class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="changePassword">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <label for="inputPass1" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPass1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPass2" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPass2" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange" data-dismiss="modal" id="savePass">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container pt-4 mb-4" style="margin-top: 10vh;">
            <div class="jumbotron shadow bg-green">
                <div class="row justify-content-center">
                    <div class="row col-12 col-lg-8">
                        <h2 class="heading font-weight-bold">
                            Settings.
                        </h2>
                        <p class="lead">
                            Customize AlphaByte as per your library needs here.
                        </p>
                    </div>
                    <div class="col-sm-4 d-none d-lg-block">
                        <img class="img" src="assets/FINAL MEDIA/undraw_reading_0re1.svg" alt="" style="
                                    height: auto;
                                    width: 100%;
                                    max-width: 340px;
                                " />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        <a class="nav-link" id="privileges-tab" data-toggle="tab" href="#privileges" role="tab" aria-controls="privileges" aria-selected="false">Privileges</a>
                        <a class="nav-link" id="timeTable-tab" data-toggle="tab" href="#timeTable" role="tab" aria-controls="timeTable" aria-selected="false">Time Table</a>
                        <a class="nav-link" id="genQR-tab" data-toggle="tab" href="#genQR" role="tab" aria-controls="genQR" aria-selected="false">Generate QR</a>
                        <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admins" role="tab" aria-controls="admins" aria-selected="false">Admins</a>
                        <a class="nav-link" id="manage-tab" data-toggle="tab" href="#manage" role="tab" aria-controls="manage" aria-selected="false">Manage Users</a>
                        <a class="nav-link" id="import-tab" data-toggle="tab" href="#import" role="tab" aria-controls="import" aria-selected="false">Import</a>
                    </div>
                </div>
                <div class="col-8 col-md-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <form>
                                <h4 class="p-3 mb-4 bg-offwhite rounded">
                                    General Settings
                                </h4>
                                <h5 class="font-weight-bold mb-4 bg-light p-2 rounded">
                                    For Students
                                </h5>
                                <div class="form-group row">
                                    <label for="issuePeriod" class="col-sm-4 col-form-label">Issue Period</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="issuePeriod" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="reservePeriod" class="col-sm-4 col-form-label">Reserve Period</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="reservePeriod" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="issueLimit" class="col-sm-4 col-form-label">Issue Limit</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="issueLimit" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="reserveLimit" class="col-sm-4 col-form-label">Reserve Limit</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="reserveLimit" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dueFineAmount" class="col-sm-4 col-form-label">Due Fine Amount</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="dueFineAmount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="issuePoint" class="col-sm-4 col-form-label">Issue Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="issuePoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="returnPoint" class="col-sm-4 col-form-label">Return Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="returnPoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="duePoint" class="col-sm-4 col-form-label">Due Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="duePoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ratingPoint" class="col-sm-4 col-form-label">Rating Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="ratingPoint" />
                                    </div>
                                </div>
                                <h5 class="font-weight-bold mb-4 bg-light p-2 rounded">
                                    For Teachers
                                </h5>
                                <div class="form-group row">
                                    <label for="teacherIssuePeriod" class="col-sm-4 col-form-label">Issue Period</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherIssuePeriod" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherReservePeriod" class="col-sm-4 col-form-label">Reserve Period</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherReservePeriod" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherIssueLimit" class="col-sm-4 col-form-label">Issue Limit</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherIssueLimit" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherReserveLimit" class="col-sm-4 col-form-label">Reserve Limit</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherReserveLimit" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherDueFineAmount" class="col-sm-4 col-form-label">Due Fine Amount</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherDueFineAmount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherIssuePoint" class="col-sm-4 col-form-label">Issue Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherIssuePoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherReturnPoint" class="col-sm-4 col-form-label">Return Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherReturnPoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherDuePoint" class="col-sm-4 col-form-label">Due Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherDuePoint" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="teacherRatingPoint" class="col-sm-4 col-form-label">Rating Point</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="0" id="teacherRatingPoint" />
                                    </div>
                                </div>
                                <h5 class="font-weight-bold mb-4 bg-light p-2 rounded">
                                    For Due Payment
                                </h5>
                                <div class="form-group row">
                                    <label for="UPIaddress" class="col-sm-4 col-form-label">UPI Address</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" id="UPIaddress" />
                                    </div>
                                </div>
                                <div class="p-3 mb-5 bg-offwhite rounded">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-blue" onclick="orgGeneralValues()">
                                            Reset
                                        </button>
                                        <button type="button" class="btn btn-orange" id="saveGeneral">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="privileges" role="tabpanel" aria-labelledby="privileges-tab">
                            <form>
                                <h4 class="p-3 mb-4 bg-offwhite rounded">
                                    Privileges
                                </h4>
                                <div class="form-group row">
                                    <label for="issueAccess" class="col-sm-4 col-form-label">Issue Access</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="issueAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="returnAccess" class="col-sm-4 col-form-label">Reserve Access</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="returnAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="addBookAccess" class="col-sm-4 col-form-label">Add Book</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="addBookAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="updateBookAccess" class="col-sm-4 col-form-label">Update Book</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="updateBookAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shelfModifyAccess" class="col-sm-4 col-form-label">Shelf Modify</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="shelfModifyAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bookShelfAccess" class="col-sm-4 col-form-label">Books in Shelf</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="bookShelfAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="semBranchModifyAccess" class="col-sm-4 col-form-label">Sem-Branch</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="semBranchModifyAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bookSemBranchAccess" class="col-sm-4 col-form-label">Recommend Books</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="bookSemBranchAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="settingsAccess" class="col-sm-4 col-form-label">Settings Page</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="settingsAccess" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="settingsAccess" class="col-sm-4 col-form-label">Settings Admin</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" min="1" id="settingsAdminAccess" />
                                    </div>
                                </div>
                                <div class="p-3 mb-5 bg-offwhite rounded">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-blue" onclick="orgPrivilegeValues()">
                                            Reset
                                        </button>
                                        <button type="button" class="btn btn-orange" id="savePrivilege">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="genQR" role="tabpanel" aria-labelledby="genQR-tab">
                            <h4 class="p-3 mb-4 bg-offwhite rounded">
                                Generate QR code
                            </h4>
                            <div class="form-group row">
                                <label for="bookID" class="col-sm-3 col-form-label">Book ID</label>
                                <div class="col-sm-6">
                                    <select class="selectpicker w-100" name="bookID" id="bookID" multiple data-live-search="true" data-actions-box="true">
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-orange" onclick="bookQR()">
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="shelfID" class="col-sm-3 col-form-label">Shelf ID</label>
                                <div class="col-sm-6">
                                    <select class="selectpicker w-100" name="shelfID" id="shelfID" multiple data-live-search="true" data-actions-box="true">
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-orange" onclick="shelfQR()">
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <form id="qrForm" method="post" action="genQR.php" target="_blank">
                                <input type="hidden" id="typeQR" name="typeQR" />
                                <input type="hidden" id="qrIDs" name="qrIDs" />
                            </form>
                        </div>
                        <div class="tab-pane fade" id="timeTable" role="tabpanel" aria-labelledby="timeTable-tab">
                            <form>
                                <h4 class="p-3 mb-4 bg-offwhite rounded">
                                    Time Table
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="thead text-white btn-orange">
                                            <tr>
                                                <th scope="col">Days</th>
                                                <th scope="col">
                                                    Start Time
                                                </th>
                                                <th scope="col">
                                                    End Time
                                                </th>
                                                <th scope="col">Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Monday</th>
                                                <td>
                                                    <input type="time" class="form-control" name="mondayStartTime" id="mondayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="mondayEndTime" id="mondayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="mondayComment" id="mondayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tuesday</th>
                                                <td>
                                                    <input type="time" class="form-control" name="tuesdayStartTime" id="tuesdayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="tuesdayEndTime" id="tuesdayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tuesdayComment" id="tuesdayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Wednesday
                                                </th>
                                                <td>
                                                    <input type="time" class="form-control" name="wednesdayStartTime" id="wednesdayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="wednesdayEndTime" id="wednesdayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="wednesdayComment" id="wednesdayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Thursday
                                                </th>
                                                <td>
                                                    <input type="time" class="form-control" name="thursdayStartTime" id="thursdayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="thursdayEndTime" id="thursdayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="thursdayComment" id="thursdayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Friday</th>
                                                <td>
                                                    <input type="time" class="form-control" name="fridayStartTime" id="fridayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="fridayEndTime" id="fridayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="fridayComment" id="fridayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Saturday
                                                </th>
                                                <td>
                                                    <input type="time" class="form-control" name="saturdayStartTime" id="saturdayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="saturdayEndTime" id="saturdayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="saturdayComment" id="saturdayComment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sunday</th>
                                                <td>
                                                    <input type="time" class="form-control" name="sundayStartTime" id="sundayStartTime" />
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="sundayEndTime" id="sundayEndTime" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="sundayComment" id="sundayComment" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-3 mb-5 bg-offwhite rounded">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-blue" onclick="orgTimeTableValues()">
                                            Reset
                                        </button>
                                        <button type="button" class="btn btn-orange" id="saveTimeTable">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="admins" role="tabpanel" aria-labelledby="admins-tab">
                            <form>
                                <h4 class="p-3 mb-4 bg-offwhite rounded">
                                    Admins
                                </h4>
                                <div id="adminClearance"></div>
                                <div class="p-3 mb-5 bg-offwhite rounded">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-blue" onclick="orgAdminValues()">
                                            Reset
                                        </button>
                                        <button type="button" class="btn btn-orange" id="saveAdmins">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manage-tab">
                            <h4 class="p-3 mb-4 bg-offwhite rounded">
                                Manage User Settings
                            </h4>
                            <div class="form-group row">
                                <label for="adminoruser" class="col-sm-4 col-form-label">Select User</label>
                                <div class="col-sm-8">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="typeAdmin" name="adminoruser" class="custom-control-input" value="admin" />
                                        <label class="custom-control-label" for="typeAdmin">Admin</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="typeuser" name="adminoruser" class="custom-control-input" value="user" />
                                        <label class="custom-control-label" for="typeuser">User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="addordelete" class="col-sm-4 col-form-label">Select Operation</label>
                                <div class="col-sm-8">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="typeAdd" name="addordelete" class="custom-control-input" value="add" />
                                        <label class="custom-control-label" for="typeAdd">Add</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="typeDelete" name="addordelete" class="custom-control-input" value="delete" />
                                        <label class="custom-control-label" for="typeDelete">Delete</label>
                                    </div>
                                </div>
                            </div>
                            <div id="showAddAdmin">
                                <div class="form-group row">
                                    <label for="adminID" class="col-sm-4 col-form-label">Admin ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="adminID" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adminFirstName" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="adminFirstName" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adminLastName" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="adminLastName" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adminLastName" class="col-sm-4 col-form-label">Admin Access</label>
                                    <div class="col-sm-8">
                                        <input type="number" min="0" class="form-control" id="adminAccess" />
                                    </div>
                                </div>
                            </div>
                            <div id="showAddUser">
                                <div class="form-group row">
                                    <label for="stuortea" class="col-sm-4 col-form-label">Select Operation</label>
                                    <div class="col-sm-8">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="typeStudent" name="stuortea" class="custom-control-input" value="student" />
                                            <label class="custom-control-label" for="typeStudent">Student</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="typeTeacher" name="stuortea" class="custom-control-input" value="teacher" />
                                            <label class="custom-control-label" for="typeTeacher">Teacher</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userID" class="col-sm-4 col-form-label">User ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="userID" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userName" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="userName" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userEmail" class="col-sm-4 col-form-label">E-Mail</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="userEmail" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="userMobile" class="col-sm-4 col-form-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="userMobile" />
                                    </div>
                                </div>
                            </div>
                            <div id="showDeleteAdmin">
                                <div class="form-group row">
                                    <label for="deleteAdmin" class="col-sm-4 col-form-label">Select Admin</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" title="Select admins to delete " id="deleteAdmin" multiple data-live-search="true" data-actions-box="true">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="showDeleteUser">
                                <div class="form-group row">
                                    <label for="deleteUser" class="col-sm-4 col-form-label">Select User</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" title="Select users to delete " id="deleteUser" multiple data-live-search="true" data-actions-box="true">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 mb-5 bg-offwhite rounded">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-blue">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-orange" id="saveManageUser">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="import" role="tabpanel" aria-labelledby="import-tab">
                            <h4 class="p-3 mb-4 bg-offwhite rounded">
                                Import
                            </h4>
                            <div class="form-group row">
                                <label for="bookImport" class="col-sm-3 col-form-label">Books</label>
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bookCSV">
                                        <label class="custom-file-label" for="bookCSV">Choose file</label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <button id="bookImport" type="submit" class="btn btn-orange btn-block">
                                        Import Books
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="studentsImport" class="col-sm-3 col-form-label">Students</label>
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="studentsCSV">
                                        <label class="custom-file-label" for="studentsCSV">Choose file</label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <button id="studentsImport" type="submit" class="btn btn-orange btn-block">
                                        Import Students
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teachersImport" class="col-sm-3 col-form-label">Teachers</label>
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="teachersCSV">
                                        <label class="custom-file-label" for="teachersCSV">Choose file</label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <button id="teachersImport" type="submit" class="btn btn-orange btn-block">
                                        Import Teachers
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adminsImport" class="col-sm-3 col-form-label">Admins</label>
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="adminsCSV">
                                        <label class="custom-file-label" for="adminsCSV">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button id="adminsImport" type="submit" class="btn btn-orange btn-block">
                                        Import Admins
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="assets/node_modules/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="./assets/js/common.js"></script>
    <script src="./assets/js/voice-search.js"></script>
    <script src="setting/navigation.js"></script>
    <script src="assets/js/assistant.js"></script>
    <script src="changeCred/changeCred.js"></script>
    <script src="setting/general/general.js"></script>
    <script src="setting/privileges/privileges.js"></script>
    <script src="setting/genQR/genQR.js"></script>
    <script src="setting/admins/admins.js"></script>
    <script src="setting/import/import.js"></script>
    <script src="setting/manageUsers/manageUsers.js"></script>
    <script src="setting/timeTable/timeTable.js"></script>
</body>

</html>