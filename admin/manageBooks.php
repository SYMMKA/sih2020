<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Books</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/node_modules/shards-ui/dist/css/shards.min.css" />
    <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/common.css" />
</head>

<body>
    <button type="button" class="btn btn-orange voice-button" style="
                width: 60px;
                height: 60px;
                border-radius: 50%;
                position: fixed;
                bottom: 2rem;
                right: 1.5rem;
                cursor: pointer;
                box-shadow: 0px 2px 5px #666;
                z-index: 9999;
            ">
        <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
    </button>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-book" aria-hidden="true"></i>
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
                        <a class="nav-link" href="chatroom.php"><i class="fa fa-comment" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
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
    <!-- main section -->
    <section>
        <div class="container pt-4 mb-4" style="margin-top: 10vh;">
            <div class="jumbotron shadow bg-green">
                <div class="row justify-content-center">
                    <div class="row col-12 col-lg-8">
                        <h2 class="heading font-weight-bold">
                            Manage Books
                        </h2>
                        <p class="lead">
                            This is a simple hero unit, a simple
                            jumbotron-style component for calling extra
                            attention to featured content or information.
                        </p>
                        <div class="col-12 row">
                            <div class="col-12 col-sm-7 col-md-8">
                                <div class="search-form">
                                    <input class="form-control mb-2" type="search" name="searchByVoice" id="searchByVoice" placeholder="Search" aria-label="Search">
                                    <div id="reader"></div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-4">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-orange mr-2 mb-2" id="voiceSearchSubmit">
                                        search
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" value="stop" class="btn btn-success mb-2" id="qrread">
                                        <i class="fa fa-qrcode" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="reader" style="width:500px"></div>
                        <div class="col-sm-5 col-md-3">
                            <button type="button" value="stop" class="btn btn-orange btn-block" id="qrread">Scan</button>
                        </div>
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
    <!-- search section -->
    <section class="container">
        <h1 class="text-center pt-4 mb-5">Your Books</h1>
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-6 filter">
            <div class="col mb-4">
                <select class="custom-select" size="1" name="mainCategorySelect1" id="mainCategorySelect1">
                    <option value="">-- Category 1--</option>
                </select>
            </div>
            <div class="col mb-4">
                <select class="custom-select" size="1" name="mainCategorySelect2" id="mainCategorySelect2">
                    <option value="">-- Category 2--</option>
                </select>
            </div>
            <div class="col mb-4">
                <select class="custom-select" size="1" name="mainCategorySelect3" id="mainCategorySelect3">
                    <option value="">-- Category 3--</option>
                </select>
            </div>
            <div class="col mb-4">
                <select class="custom-select" size="1" name="mainCategorySelect4" id="mainCategorySelect4">
                    <option value="">-- Category 4--</option>
                </select>
            </div>
            <div class="col mb-4">
                <select class="custom-select" name="book_audio" id="book_audio">
                    <option value="">All</option>
                    <option value="1">Book</option>
                    <option value="0">Audio</option>
                </select>
            </div>
            <div class="col mb-4">
                <select class="custom-select" name="dig_phy" id="dig_phy">
                    <option value="">All</option>
                    <option value="0">Physical</option>
                    <option value="1">Digital</option>
                </select>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="result">
        </div>
    </section>
    <!-- display Copy Modal-->
    <div name="displayCopy" id="displayCopy" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="displayBookCopies" style="max-height:100vh !important; max-width:90vw !important;">
        </div>
        <!-- Outside modal -->
        <form id="issueBookForm">
        </form>
        <form id="returnBookForm">
        </form>
        <form id="deleteCopyForm">
            <div id='deleteCopyFormDiv'></div>
        </form>
    </div>
    <!-- update Modal-->
    <div name="updateBook" id="updateBook" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-height:100vh !important; max-width:90vw !important;">
            <div class=" modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetUpdateForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row" style="height: 500px; overflow-y: scroll;">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="" type="hidden" id="bookimgLinkUpdate" style="height: 20vw;">
                                <div class="card-body ">
                                    <h4 class="card-title text-center" id="booktitleUpdate"></h4>
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-4 font-weight-bold">Author:</div>
                                            <div class="col-8" id="bookauthorUpdate"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 font-weight-bold">BookID:</div>
                                            <div class="col-8" id="bookIDUpdate"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 font-weight-bold">ISBN:</div>
                                            <div class="col-8" id="bookisbnUpdate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="form-group row">
                                <label for="updateTitle" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control update-form" name="updateTitle" id="updateTitle" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="updateAuthor" class="col-sm-2 col-form-label">Author</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control update-form" name="updateAuthor" id="updateAuthor" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="updateISBN" class="col-sm-2 col-form-label">ISBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control update-form" name="updateISBN" id="updateISBN" />
                                </div>
                            </div>
                            <div class="form-group row" id="categoryDisplay">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10" id="category"></div>
                            </div>
                            <div class="form-group row">
                                <label for="updatepublisher" class="col-sm-2 col-form-label">Publisher</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control update-form" name="updatepublisher" id="updatepublisher" />
                                </div>
                            </div>
                            <div class="form-group row" id="pageCountGroup">
                                <label for="updatepageCount" class="col-sm-2 col-form-label">Page Count</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control update-form" name="updatepageCount" id="updatepageCount" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="updatepublishedDate" class="col-sm-2 col-form-label">Publisher
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control update-form" name="updatepublishedDate" id="updatepublishedDate" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="updateimgLink" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <img class="mb-2" name="updateimgLink" id="updateimgLink" hidden="true" src="" alt="your image" width="100px" height="100px" />
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input update-form" id="updateimgFile">
                                        <label class="custom-file-label" for="updateimgFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="quantityGroup">
                                <label for="updateaddcopies" class="col-sm-2 col-form-label">Add Copies</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control update-form" id="updateaddcopies" name="updateaddcopies" placeholder="Number of copies" min="0" />
                                </div>
                            </div>
                            <div class="form-group row" id="mediaGroup">
                                <label for="updateimageFile" class="col-sm-2 col-form-label">Change File</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input update-form" id="mediaFile">
                                        <label class="custom-file-label" id="mediaFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Receipt</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" id="receiptFile" />
                                    <div class="invalid-feedback">
                                        Import File
                                    </div>
                                </div>
                            </div>
                            <div id="copyInfo">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blue" data-dismiss="modal" id="closeUpdateForm">Close</button>
                    <button type="button" data-dismiss="modal" class="btn btn-orange" id="updateBookForm">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- info modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="moreInfo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" style="max-height:100vh !important; max-width:90vw !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 mb-4">
                                <img id="bookimgLinkInfo" src="" alt="" srcset="" class="" style="height:90%; width:90%;">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">BookID:</div>
                                    <div class="col-8" id="bookIDInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Title:</div>
                                    <div class="col-8" id="bookTitleInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Author:</div>
                                    <div class="col-8" id="bookAuthorInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">ISBN:</div>
                                    <div class="col-8" id="bookISBNInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Rating:</div>
                                    <div class="col-8" id="bookRatingInfo"></div>
                                </div>
                                <div class="row no-gutters" id="groupQuantityInfo">
                                    <div class="col-4 font-weight-bold">Quantity:</div>
                                    <div class="col-8" id="bookQuantityInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Category1:</div>
                                    <div class="col-8" id="bookCategory1Info"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Category2:</div>
                                    <div class="col-8" id="bookCategory2Info"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Category3:</div>
                                    <div class="col-8" id="bookCategory3Info"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Category4:</div>
                                    <div class="col-8" id="bookCategory4Info"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Publisher:</div>
                                    <div class="col-8" id="bookPublisherInfo"></div>
                                </div>
                                <div class="row no-gutters" id="groupPagesInfo">
                                    <div class="col-4 font-weight-bold">Pages:</div>
                                    <div class="col-8" id="bookPagesInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Date of publication:</div>
                                    <div class="col-8" id="bookDate_of_publicationInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Type:</div>
                                    <div class="col-8" id="bookBookInfo"></div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 font-weight-bold">Format:</div>
                                    <div class="col-8" id="bookDigitalInfo"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-2">
                                <div class="row no-gutters justify-content-center text-center h-100 align-items-stretch">
                                    <div class="col-12">
                                        <h4>Issued: <a id="issued"></a></h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>Reserved: <a id="reserved"></a></h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>Available: <a id="available"></a></h4>
                                    </div>
                                    <div class="col-12">
                                        <select class="selectpicker w-100 mb-2" name="copyIDQR" id="copyIDQR" multiple data-live-search="true" data-actions-box="true" data-style="btn-blue">
                                        </select>
                                        <button class="btn btn-orange btn-block" id="genQRcode">
                                            QR code
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <form id="qrForm" method="post" action="genQR.php">
                                <input type="hidden" id="typeQR" name="typeQR" />
                                <input type="hidden" id="qrIDs" name="qrIDs" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        var bookID = [];
        var title = [];
        var author = [];
        var isbn = [];
        var star = [];
        var quantity = [];
        var Category1 = [];
        var Category2 = [];
        var Category3 = [];
        var Category4 = [];
        var publisher = [];
        var pages = [];
        var imgLink = [];
        var date_of_publication = [];
        var book = [];
        var digital = [];
    </script>
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="catName.js"></script>
    <script src="filter.js"></script>
    <script src="searchBook/autoFill.js"></script>
    <script src="searchBook/info/info.js"></script>
    <script src="searchBook/issueBook/autoFill.js"></script>
    <script src="searchBook/returnBook/autoFill.js"></script>
    <script src="searchBook/updateBook/autoFill.js"></script>
    <script src="searchBook/deleteCopy/autoFill.js"></script>
    <script src="searchBook/issueBook/uploadDB.js"></script>
    <script src="searchBook/returnBook/uploadDB.js"></script>
    <script src="searchBook/updateBook/uploadDB.js"></script>
    <script src="searchBook/deleteCopy/uploadDB.js"></script>
    <script src="./assets/js/common.js"></script>
    <script src="changeCred/changeCred.js"></script>
    <script src="./assets/js/voice-search.js"></script>
    <script src="manageBooks/manageBooks.js"></script>
    <script src="assets/node_modules/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="qrCodeReader.js"></script>
    <script>
        function loadCat() {
            var mainCategorySelect1 = document.getElementById("mainCategorySelect1");
            var mainCategorySelect2 = document.getElementById("mainCategorySelect2");
            var mainCategorySelect3 = document.getElementById("mainCategorySelect3");
            var mainCategorySelect4 = document.getElementById("mainCategorySelect4");
            loadCategory(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4);
        }
        loadCat();
    </script>
    <?php
    if (isset($_GET['q'])) {
        $searchq = $_GET['q'];
        echo "<script>
                console.log('" . $searchq . "');
                document.getElementById('searchByVoice').value = '" . $searchq . "';
                searchMain();
		     </script>";
    }
    ?>

</body>

</html>