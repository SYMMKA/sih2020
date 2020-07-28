function startGreeting() {
    var status = location.search.substring(1);
    if (status == "chat") {
        var message = `Which book do you want to add ?<br><br>`;
        for (var i = 1; i <= lastID; i++)
            message +=
                `<button type="button" onclick="sendChatMessage(this.textContent)" class="btn btn-blue btn-sm mb-1 mr-1 chat_voiceAssistant" style="width:80px">Book ` +
                i +
                `</button>`;
        generateMessage(message, "bot");

        $(".chat_voiceAssistant").on("click", function () {
            var message = "Opening form";
            //generateMessage(message, "user");
            generateMessage(message, "bot");
        });
    }
}

function openBookModal(bookArr) {
    console.log("openBookModal");
    if (bookArr.includes("1")) autoFill("0");
    if (bookArr.includes("2")) autoFill("1");
    if (bookArr.includes("3")) autoFill("2");
    if (bookArr.includes("4")) autoFill("3");
    if (bookArr.includes("5")) autoFill("4");
    if (bookArr.includes("6")) autoFill("5");
    if (bookArr.includes("7")) autoFill("6");
    if (bookArr.includes("8")) autoFill("7");
    if (bookArr.includes("9")) autoFill("8");
    setTimeout(() => {
        $(".chat-box-toggle").click();
        $(".bd-example-modal-xl").modal("show");
        generateMessage("Form opened", "bot");
    }, 2000);
}
