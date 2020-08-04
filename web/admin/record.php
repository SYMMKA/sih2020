<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Records</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/node_modules/shards-ui/dist/css/shards.min.css" />
    <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/common.css" />
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
    <!-- navbar here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">LIBRARY MANAGEMENT SYSTEM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php" data-toggle="tooltip" data-placement="bottom" title="Home">
                            <div class="d-flex">
                                <i class="fa fa-home mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Home</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Library">
                            <div class="d-flex">
                                <i class="fa fa-book mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Library</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="manageBooks.php" title="Manage Books">Manage Books</a>
                            <a class="dropdown-item" href="addBooks.php" title="Add Books">Add Books</a>
                            <a class="dropdown-item" href="shelf.php" title="Shelf">Shelf</a>
                            <a class="dropdown-item" href="record.php" title="Records">Records</a>
                            <a class="dropdown-item" href="syllabus.php" title="Syllabus">Syllabus</a>
                            <a class="dropdown-item" href="achievement.php" title="achievements">Achievements</a>
                            <a class="dropdown-item" href="request.html" title="Book Requests">Book Requests</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="docs.html" data-toggle="tooltip" data-placement="bottom" title="Read Docs">
                            <div class="d-flex">
                                <i class="fa fa-question mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Read Docs</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="chatroom.php" data-toggle="tooltip" data-placement="bottom" title="Chatroom">
                            <div class="d-flex">
                                <i class="fa fa-comment mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Chatroom</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="settings.php" data-toggle="tooltip" data-placement="bottom" title="Settings">
                            <div class="d-flex">
                                <i class="fa fa-cog mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">Settings</h6>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown  active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" title="Profile" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex">
                                <i class="fa fa-user-circle mr-3 mr-lg-0" aria-hidden="true"></i>
                                <h6 class="d-block d-lg-none mb-0">My Profile</h6>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <div class="jumbotron shadow bg-green pt-4 pb-2">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading font-weight-bold">
                            Records
                        </h2>
                        <p class="lead">
                            Keep track of bills, dues and activities in your library here.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-sm-6 col-md-3 mb-2">
                    <div class="card h-100">
                        <a class="card-body btn-blue rounded stretched-link" id="due">
                            <h4 class="font-weight-bold text-white">
                                Fine Payment
                            </h4>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-2">
                    <div class="card h-100">
                        <a class="card-body btn-blue rounded stretched-link" id="currentlyIssued">
                            <h4 class="font-weight-bold text-white">
                                Currently Issued
                            </h4>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-2">
                    <div class="card h-100">
                        <a class="card-body btn-blue rounded stretched-link" id="receipt">
                            <h4 class="font-weight-bold text-white">
                                Billing Details
                            </h4>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-2">
                    <div class="card h-100">
                        <a class="card-body btn-blue rounded stretched-link" id="report" data-toggle="modal" data-target=".bd-example-modal-xl">
                            <h4 class="font-weight-bold text-white">
                                Report Table
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container" id="ResultDisplay"></div>
    </section>
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 90vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report Generation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h1 class="text-center mt-3 mb-5">
                                    Choose Details
                                </h1>
                                <form>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">User</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select" id="userType" onchange="changeAccess()">
                                                        <option selected id="admin" value="admin">Admin</option>
                                                        <option id="student" value="student">Student</option>
                                                        <option id="teacher" value="teacher">Teacher</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="container">
                                                <div class="form-group row">
                                                    <label for="bookID" class="col-sm-3 col-form-label">Book ID</label>
                                                    <div class="col-sm-9">
                                                        <select class="selectpicker w-100" name="bookID" id="bookID" multiple data-live-search="true" data-actions-box="true">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-sm-6" name="adminIDGroup" id="adminIDGroup">
                                            <div class="form-group row">
                                                <label for="adminID" class="col-sm-3 col-form-label">Admin ID</label>
                                                <div class="col-sm-9">
                                                    <select class="selectpicker w-100" name="adminID" id="adminID" multiple data-live-search="true" data-actions-box="true">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" name="userIDGroup" id="userIDGroup" hidden>
                                            <div class="container">
                                                <div class="form-group row">
                                                    <label for="userID" class="col-sm-3 col-form-label">User ID</label>
                                                    <div class="col-sm-9">
                                                        <select class="selectpicker w-100" name="userID" id="userID" multiple data-live-search="true" data-actions-box="true">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="startTime" class="col-sm-3 col-form-label">Start Time</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="startTime" id="startTime" placeholder="yyyy,mm,dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="container">
                                                <div class="form-group row">
                                                    <label for="endTime" class="col-sm-3 col-form-label">End Time</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="endTime" id="endTime" placeholder="yyyy,mm,dd">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 mb-3 text-center">
                                        <div class="col mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="add" id="checkAdd" />
                                                <label class="form-check-label" for="checkAdd">
                                                    Add
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="delete" id="checkDelete" />
                                                <label class="form-check-label" for="checkDelete">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="update" id="checkUpdate" />
                                                <label class="form-check-label" for="checkUpdate">
                                                    Update
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="issue" id="checkIssue" />
                                                <label class="form-check-label" for="checkIssue">
                                                    Issue
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="return" id="checkReturn" />
                                                <label class="form-check-label" for="checkReturn">
                                                    Return
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" id="report" onclick="generateReport()" class="btn btn-orange" data-dismiss="modal">
                                            Generate Report
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/node_modules/popper.js/dist/umd/popper-utils.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="jsPDF-master/dist/jspdf.min.js"></script>
    <script src="jsPDF-AutoTable-master/dist/jspdf.plugin.autotable.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="changeCred/changeCred.js"></script>
    <script src="assets/js/voice-search.js"></script>
    <script src="record/navigation.js"></script>
    <script src="assets/js/assistant.js"></script>
    <script src="record/due/payFine.js"></script>
    <script src="record/currentlyIssued/currentlyIssued.js"></script>
    <script src="record/receipt/receipt.js"></script>
    <script src="record/report/report.js"></script>
</body>

</html>