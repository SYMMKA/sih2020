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
  <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
  <link rel="stylesheet" href="./assets/node_modules/shards-ui/dist/css/shards.min.css" />
  <!-- <script
    src="https://kit.fontawesome.com/97f3c2998d.js"
    crossorigin="anonymous"
  ></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./assets/css/common.css" />
  <!-- <link rel="stylesheet" href="./assets/css/chat.sass" /> -->
  <style>
    :root {
      --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      --msger-bg: #fff;
      --border: 2px solid #ddd;
      --left-msg-bg: #ececec;
      --right-msg-bg: #579ffb;
    }

    html {
      box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
      margin: 0;
      padding: 0;
      box-sizing: inherit;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: var(--body-bg);
      font-family: Helvetica, sans-serif;
    }

    .msger {
      display: flex;
      flex-flow: column wrap;
      justify-content: space-between;
      width: 100%;
      max-width: 867px;
      margin: 25px 10px;
      height: calc(100% - 50px);
      border: var(--border);
      border-radius: 5px;
      background: var(--msger-bg);
      box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
    }

    .msger-header {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      border-bottom: var(--border);
      background: #eee;
      color: #666;
    }

    .msger-chat {
      flex: 1;
      overflow-y: auto;
      padding: 10px;
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
      border-top: var(--border);
      background: #eee;
    }

    .msger-inputarea * {
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 1em;
    }

    .msger-input {
      flex: 1;
      background: #ddd;
    }

    .msger-send-btn {
      margin-left: 10px;
      background: rgb(0, 196, 65);
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.23s;
    }

    .msger-send-btn:hover {
      background: rgb(0, 180, 50);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="background-color: transparent;">
    <div class="container">
      <a class="navbar-brand" href="#">Library Management System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Manage</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Shelf <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container" style="padding-top: 150px;">
    <section class="msger">
      <header class="msger-header">
        <div class="msger-header-title">
          CHATROOM
        </div>
        <div class="msger-header-options">
          <span><button type="button" class="btn btn-blue" data-toggle="modal" data-target="#block">Block</button></span>
        </div>
      </header>
      <textarea name="" id="adminID" hidden><?= $_SESSION['adminID'] ?></textarea>
      <main class="msger-chat" id="chatDB">
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
      </main>
      <form class="msger-inputarea">
        <input id="message-to-send" type="text" class="msger-input" placeholder="Enter your message...">
        <button type="button" class="msger-send-btn" onclick="sendMsg()" id="send">Send</button>
      </form>
    </section>

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
              <div class="">
                <label for="blockList">Blocked</label>
                <select class="selectpicker w-100" name="" id="blockList" multiple data-live-search="true" data-actions-box="true">
                </select>
              </div>
			  <button class="btn btn-blue" id="unblockUser">Unblock</button>

              <div class="">
                <label for="notBlockList">Not Blocked</label>
                <select class="selectpicker w-100" name="" id="notBlockList" multiple data-live-search="true" data-actions-box="true">
                </select>
              </div>
			  <button class="btn btn-blue" id="blockUser">Block</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-info" id="" data-dismiss="modal">
          Save Changes
        </button>
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