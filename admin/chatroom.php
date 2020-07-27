<?php
include("session.php");
include("db.php");
?>
<html lang="en">

<head>
  <title>Chat</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
  <link rel="stylesheet" href="assets/node_modules/shards-ui/dist/css/shards.min.css" />
  <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/css/common.css" />
  <!-- <link rel="stylesheet" href="./assets/css/chat.sass" /> -->
  <style>
    :root {
      --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      --msger-bg: #fff;
      --border: 2px solid #ddd;
      --left-msg-bg: #f6f4f2;
      --right-msg-bg: #fe4a49;
    }

    .msger {
      display: flex;
      flex-flow: column wrap;
      justify-content: space-between;
      width: 100%;
      height: 88vh;
      border-radius: 10px;
      background: var(--msger-bg);
    }

    .msger-header {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      border-bottom: var(--border);
      background: #fe4a49;
      color: #666;
      border-radius: 10px;
    }

    .msger-chat {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
      background-color: #4ad7d1;
      margin-top: -10px;
    }

    .msger-chat::-webkit-scrollbar {
      width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
      background: #ddd;
    }

    .msger-chat::-webkit-scrollbar-thumb {
      background: #bdbdbd;
    }

    .msg {
      display: flex;
      align-items: flex-end;
      margin-bottom: 10px;
    }

    .msg:last-of-type {
      margin: 0;
    }

    .msg-img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
      background: #ddd;
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      border-radius: 50%;
    }

    .msg-bubble {
      max-width: 450px;
      padding: 15px;
      border-radius: 15px;
      background: var(--left-msg-bg);
    }

    .msg-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .msg-info-name {
      margin-right: 10px;
      font-weight: bold;
    }

    .msg-info-time {
      font-size: 0.85em;
    }

    .left-msg .msg-bubble {
      border-bottom-left-radius: 0;
    }

    .right-msg {
      flex-direction: row-reverse;
    }

    .right-msg .msg-bubble {
      background: var(--right-msg-bg);
      color: #fff;
      border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
      margin: 0 0 0 10px;
    }

    .msger-inputarea {
      display: flex;
      padding: 10px;
      background: #eee;
    }

    .msger-inputarea * {
      padding: 10px;
      border-radius: 3px;
      font-size: 1em;
    }

    .msger-input {
      flex: 1;
      background: #fff;
    }
  </style>
</head>

<body>
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

  <div class="container-fluid" style="padding-top: 10vh;">
    <div class="msger">
      <div class="msger-header">
        <h3 class="msger-header-title font-weight-bold text-white">
          Chatroom
        </h3>
        <div class="msger-header-options">
          <span><button type="button" class="btn btn-blue" data-toggle="modal" data-target="#block">Block</button></span>
        </div>
      </div>
      <textarea name="" id="adminID" hidden><?= $_SESSION['adminID'] ?></textarea>
      <div class="msger-chat" id="chatDB">
        <?php
        $query = "SELECT * FROM `chats`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $i = 0;
        while ($row = $stmt->fetchObject()) {
          $id[$i] = $row->id;
          $stud_ID[$i] = $row->stud_ID;
          $name[$i] = $row->name;
          $time[$i] = date('d/m/Y H:i', $row->time);
          $message[$i] = $row->message;
        ?>
          <?php if ($_SESSION['adminID'] == $stud_ID[$i]) { ?>
            <div class="msg right-msg">
              <div id="<?= $id[$i] ?>" class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name"><?= $name[$i] ?></div>
                  <div class="msg-info-time"><?= $time[$i] ?></div>
                </div>

                <div class="msg-text">
                  <?= $message[$i] ?>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="msg left-msg">
              <div id="<?= $id[$i] ?>" class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name"><?= $name[$i] ?></div>
                  <div class="msg-info-time"><?= $time[$i] ?></div>
                </div>

                <div class="msg-text">
                  <?= $message[$i] ?>
                </div>
              </div>
            </div>
        <?php }
          $i++;
        }
        ?>
      </div>
      <div class="msger-inputarea">
        <input id="message-to-send" type="text" class="msger-input form-control" placeholder="Enter your message...">
        <button type="button" class="btn btn-orange ml-2" onclick="sendMsg()" id="send">Send</button>
      </div>
    </div>

    <!-- BLOCK MODAL -->
    <div name="block" id="block" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" id="" style="
                    max-height: 100vh !important;
                    max-width: 90vw !important;
                " />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Block</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <!--SELECT PICKER----------------->
              <div class="col-12 row mb-4">
                <label class="col-form-label col-sm-3" for="blockList">Blocked</label>
                <div class="col-sm-6">
                  <select class="selectpicker w-100" name="" id="blockList" multiple data-live-search="true" data-actions-box="true">
                  </select>
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-blue btn-block" id="unblockUser">Unblock</button>
                </div>
              </div>
              <div class="col-12 row">
                <label class="col-form-label col-sm-3" for="notBlockList">Not Blocked</label>
                <div class="col-sm-6">
                  <select class="selectpicker w-100" name="" id="notBlockList" multiple data-live-search="true" data-actions-box="true">
                  </select>
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-blue btn-block" id="blockUser">Block</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-blue" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-orange" id="" data-dismiss="modal">
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    /* Scroll to last message*/
    var objDiv = document.getElementById("chatDB");
    objDiv.scrollTop = objDiv.scrollHeight;
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  <script src="./assets/js/common.js"></script>
  <script src="chat/chat.js"></script>
</body>

</html>