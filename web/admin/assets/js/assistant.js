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
        str += '            <img src="assets/images/assistant/b_logo.png">';
    } else {
        str += '            <img src="assets/images/assistant/user-logo.png">';
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

var goto = ["goto", "go", "navigate", "open", "start", "find"];
var search = ["search", "find"];
var home = ["home", "index", "homepage"];
var add = [
    "add",
    "addbook",
    "addbooks",
    "ad",
    "addd",
    "address",
    "advik",
    "advics",
    "adword",
    "adwords",
    "art",
];
var manage = [
    "manage",
    "searchbook",
    "edit",
    "library",
    "issue",
    "return",
    "manager",
    "management",
];
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
var general = [
    "general",
    "issue",
    "reserve",
    "due",
    "fine",
    "rating",
    "point",
    "points",
];
var privileges = ["privilege", "privileges", "clearance", "access"];
var timeTable = ["time", "table", "schedule", "timing", "timings"];
var generateQR = ["qr", "qrcode", "q", "are"];
var admins = ["admin", "admins"];
var manageUsers = ["user", "users"];
var importAny = ["import", "importing"];
var openBook = [
    "1",
    "one",
    "2",
    "two",
    "3",
    "three",
    "4",
    "four",
    "5",
    "five",
    "6",
    "six",
    "7",
    "seven",
    "8",
    "eight",
    "9",
    "nine",
    "10",
    "ten",
];

function talkToDialogFlowApi(message) {
    $("#loading").hide();
    enableInput();
    var mess_arr = message.toLowerCase().trim().split(" ");
    
    var settingsAll = [];
    settingsAll = settingsAll.concat(
        general,
        privileges,
        timeTable,
        generateQR,
        admins,
        manageUsers,
        importAny
    );
    var all = [];
    all = all.concat(
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
    if (
        window.location.href.substring(
            window.location.href.lastIndexOf("/") + 1
        ) == "settings.php" &&
        settingsAll.filter((value) => mess_arr.includes(value)).length
    )
        settingsFunction(mess_arr);
    else if (search.indexOf(mess_arr[0]) == 0) searchBook(mess_arr);
    else if (
        chat == 1 &&
        openBook.filter((value) => mess_arr.includes(value)).length
    )
        openBookModal(mess_arr);
    else if (
        goto.filter((value) => mess_arr.includes(value)).length ||
        all.includes(mess_arr[0])
    )
        openPage(mess_arr);
    else {
        // error response
        setTimeout(() => {
            generateMessage("Pardon!", "bot");
            startRecognition();
        }, 1000);
    }

    // autofill open book
    //if (message.toLowerCase().indexOf("book") == 0) 
    // close form
    // page navigation
}

function searchBook(searchArr) {
    
    //if(searchArr.length < 1)
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
                setTimeout(() => {
                    generateMessage("Pardon!", "bot");
                    startRecognition();
                }, 1000);
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
        } else {
            // error response
            setTimeout(() => {
                generateMessage("Pardon!", "bot");
                startRecognition();
            }, 1000);
        }
    }
}

function openPage(arr) {
    
    
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
        setTimeout(() => {
            generateMessage("Pardon!", "bot");
            startRecognition();
        }, 1000);
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

$("#chat-circle").click(function () {
    // voice button
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
    startRecognition();
});

$(".chat-box-toggle").click(function () {
    // X close
    $("#chat-circle").toggle("scale");
    $(".chat-box").toggle("scale");
    stopRecognition();
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

$("#chat-submit").click(function (event) {
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
            text += event.results[i][0].transcript.replace('.', "");
        }
        
        sendChatMessage(text);
        stopRecognition();
    };
    recognition.onend = function () {
        stopRecognition();
    };
    recognition.lang = "en-IN";
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
    if (recognition)
        $("#mic")
            .removeClass("fa fa-microphone")
            .addClass("fa fa-microphone-slash");
    else
        $("#mic")
            .removeClass("fa fa-microphone-slash")
            .addClass("fa fa-microphone");
}

initializeSession();
