$(function () {
    var INDEX = 0;
    var recognition;

    var initializeSession = function () {
        $(".chat-logs").empty();
        //uniqueSessionId = getUniqueChatSessionId();
        startGreeting();
        setInterval(function () {
            enableInput();
        }, 1000);

        $("#loading").hide();
    };

    function sendChatMessage(message) {
        $("#loading").show();
        talkToDialogFlowApi(message);
        generateMessage(message, "user");
    }

    function generateMessage(msg, type) {
        INDEX++;
        var str = "";
        str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg " + type + '">';
        str += '          <span class="msg-avatar">';
        if (type === "bot") {
            str += '            <img src="b_logo.png">';
        } else {
            str += '            <img src="user-logo.png">';
        }

        str += "          </span>";
        str += '          <div class="cm-msg-text">';
        str += msg;
        str += "          </div>";
        str += "        </div>";
        $(".chat-logs").append(str);
        $("#cm-msg-" + INDEX)
            .hide()
            .fadeIn(300);
        if (type === "user") {
            $("#chat-input").val("");
        }
        $(".chat-logs")
            .stop()
            .animate(
                {
                    scrollTop: $(".chat-logs")[0].scrollHeight,
                },
                1000
            );
    }

    function startGreeting() {
        var status = location.search.substring(1);
        if (status == "chat") {
            var message = `Which book do you want to add ?<br><br>`;
            for (var i = 1; i <= lastID; i++)
                message +=
                    `<button type="button" data-open="modal" data-target=".bd-example-modal-xl" onclick="autoFill(` +
                    (i - 1) +
                    `)" class="btn btn-primary btn-sm mb-1 mr-1 chat_voiceAssistant" style="width:80px">Book ` +
                    i +
                    `</button>`;
            generateMessage(message, "bot");
            $(".chat_voiceAssistant").on("click", function () {
                var message = "book opened";
                //generateMessage(message, "user");
                generateMessage(message, "bot");
            });
        }
    }

    var goto = ["goto", "go", "navigate", "open", "start"];
    var search = ["search", "find"];
    var home = ["home", "index", "homepage"];
    var add = ["add", "addbook", "addbooks", "ad", "addd"];
    var manage = ["manage", "searchbook", "edit", "library"];
    var shelf = ["shelves", "shelf", "rack", "racks"];
    var settings = ["settings", "setting", "change", "update"];
    var logout = ["logout", "log", "sign", "signout", "exit"];
    var record = [
        "record",
        "records",
        "report",
        "reports",
        "receipt",
        "receipts",
        "bill",
        "bills",
        "fine",
        "due",
        "outstanding",
        "defaulters",
        "payment",
    ];
    var achievement = [
        "achievement",
        "achievements",
        "leaderboard",
        "leaderboards",
        "point",
        "points",
        "ranks",
        "ranking",
    ];
    var chat = ["chat", "chatroom", "talk"];
    var syllabus = [
        "syllabus",
        "portion",
        "recommended",
        "recommendations",
        "sem",
        "branch",
        "university",
        "term",
    ];
    var help = [
        "docs",
        "help",
        "error",
        "document",
        "documentation",
        "documentations",
    ];

    function talkToDialogFlowApi(message) {
        $("#loading").hide();
        enableInput();
        var status = location.search.substring(1);
        mess_arr = message.toLowerCase().trim().split(" ");
        console.log(mess_arr);
        var all = [];
        all = all.concat(
            goto,
            search,
            home,
            add,
            manage,
            shelf,
            settings,
            logout,
            record,
            achievement,
            chat,
            syllabus,
            help
        );
        console.log(all);
        if (
            goto.filter((value) => mess_arr.includes(value)).length ||
            all.includes(mess_arr[0])
        )
            openPage(mess_arr);
        if (search.indexOf(mess_arr[0]) == 0) searchBook(mess_arr);
        if (status == "chat") openBookModal(mess_arr);

        // autofill open book
        //if (message.toLowerCase().indexOf("book") == 0) console.log("good");
        // close form
        // page navigation
    }

    function openBookModal(bookArr) {
        console.log("openBookModal");
        $(".bd-example-modal-xl").modal("show");
        if (bookArr.includes("1")) autoFill("0");
        if (bookArr.includes("2")) autoFill("1");
        if (bookArr.includes("3")) autoFill("2");
        if (bookArr.includes("4")) autoFill("3");
        if (bookArr.includes("5")) autoFill("4");
        if (bookArr.includes("6")) autoFill("5");
        if (bookArr.includes("7")) autoFill("6");
        if (bookArr.includes("8")) autoFill("7");
        if (bookArr.includes("9")) autoFill("8");
        generateMessage("book opened", "bot");
    }

    function searchBook(searchArr) {
        console.log("searchBook");
        var n = searchArr.lastIndexOf("in");
        if (n == -1) {
            var search = searchArr.slice(1, searchArr.length).join(" ");
            var relURL = window.location.href.substring(
                window.location.href.lastIndexOf("/") + 1
            );
            switch (relURL) {
                case "addBooks.php":
                    window.location.href = "addBooks.php?q=" + search + "";
                    break;
                case "manageBooks.php":
                    window.location.href = "manageBooks.php?q=" + search + "";
                    break;
                case "shelf.php":
                    window.location.href = "shelf.php?q=" + search + "";
                    break;
                default:
                    // error response
                    break;
            }
        } else {
            var last = searchArr.slice(n + 1, searchArr.length);
            var search = searchArr.slice(1, n).join(" ");
            if (last.filter((value) => add.includes(value)).length) {
                window.location.href = "addBooks.php?q=" + search + "";
            } else if (last.filter((value) => manage.includes(value)).length) {
                window.location.href = "manageBooks.php?q=" + search + "";
            } else if (last.filter((value) => shelf.includes(value)).length) {
                window.location.href = "shelf.php?q=" + search + "";
            }
        }
    }

    function openPage(arr) {
        console.log("openPage");
        console.log(arr.filter((value) => home.includes(value)));
        if (arr.filter((value) => home.includes(value)).length) {
            window.location.href = "home.php";
        } else if (arr.filter((value) => manage.includes(value)).length) {
            window.location.href = "manageBooks.php";
        } else if (arr.filter((value) => add.includes(value)).length) {
            window.location.href = "addBooks.php";
        } else if (arr.filter((value) => shelf.includes(value)).length) {
            window.location.href = "shelf.php";
        } else if (arr.filter((value) => record.includes(value)).length) {
            window.location.href = "record.php";
        } else if (arr.filter((value) => syllabus.includes(value)).length) {
            window.location.href = "syllabus.php";
        } else if (arr.filter((value) => chat.includes(value)).length) {
            window.location.href = "chatroom.php";
        } else if (arr.filter((value) => achievement.includes(value)).length) {
            window.location.href = "achievement.php";
        } else if (arr.filter((value) => help.includes(value)).length) {
            window.location.href = "docs.php";
        } else if (arr.filter((value) => settings.includes(value)).length) {
            window.location.href = "settings.php";
        } else if (arr.filter((value) => logout.includes(value)).length) {
            window.location.href = "logout.php";
        } else {
            // error response
            console.log("chatbot failed");
        }
    }

    var enableInput = function () {
        $("#chat-input").focus();
        $("#chatBotForm").children().prop("disabled", false);
        $("#micSpan").show();
    };

    var disableInput = function () {
        $("#chatBotForm").children().prop("disabled", true);
        $("#micSpan").hide();
    };

    $(document).delegate(".chat-btn", "click", function () {
        var msg = $(this).attr("chat-value");
        enableInput();

        talkToDialogFlowApi(msg);
        generateMessage(msg, "user");
    });

    $("#chat-circle, #tip-tool").click(function () {
        $(".tool_tip").remove();
        $("#chat-circle").toggle("scale");
        $(".chat-box").toggle("scale");
        $(".chat-logs")
            .stop()
            .animate(
                {
                    scrollTop: $(".chat-logs")[0].scrollHeight,
                },
                1000
            );
    });

    $(".chat-box-toggle").click(function () {
        $("#chat-circle").toggle("scale");
        $(".chat-box").toggle("scale");
    });

    $("#chat-submit").click(function (e) {
        e.preventDefault();
        var msg = $("#chat-input").val();
        if (msg.trim() === "") {
            return false;
        }

        sendChatMessage(msg);
    });

    $("#refresh").click(function () {
        initializeSession();
    });

    $("#mic").click(function (event) {
        switchRecognition();
    });

    function stopRecognition() {
        if (recognition) {
            recognition.stop();
            recognition = null;
        }

        updateRec();
    }

    function startRecognition() {
        recognition = new webkitSpeechRecognition();
        recognition.onstart = function (event) {
            updateRec();
        };
        recognition.onresult = function (event) {
            var text = "";
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                text += event.results[i][0].transcript;
            }
            console.log(text);
            sendChatMessage(text);
            stopRecognition();
        };
        recognition.onend = function () {
            stopRecognition();
        };
        recognition.lang = "en-US";
        recognition.start();
    }

    function switchRecognition() {
        if (recognition) {
            stopRecognition();
        } else {
            startRecognition();
        }
    }

    function updateRec() {
        $("#mic").text(recognition ? "stop" : "mic");
    }

    // function getUniqueChatSessionId() {
    //     var s4 = function () {
    //         return Math.floor((1 + Math.random()) * 0x10000)
    //             .toString(16)
    //             .substring(1);
    //     };
    //     return (
    //         s4() +
    //         s4() +
    //         "-" +
    //         s4() +
    //         "-" +
    //         s4() +
    //         "-" +
    //         s4() +
    //         "-" +
    //         s4() +
    //         s4() +
    //         s4()
    //     );
    // }

    initializeSession();
});
