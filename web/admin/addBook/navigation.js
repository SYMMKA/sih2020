function startGreeting() {
    if (chat == 1) {
        var message = `Which book do you want to add ?<br><br>`;
        for (var i = 1; i <= length; i++)
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
    
    
    var num = ["1", "one", "2", "two", "3", "three", "4", "four", "5", "five", "6", "six", "7", "seven", "8", "eight", "9", "nine", "10", "ten"];
    if (num.filter((value) => bookArr.includes(value)).length) {
        if (bookArr.includes("1") || bookArr.includes("one")) autoFill("0");
        else if (bookArr.includes("2") || bookArr.includes("two")) autoFill("1");
        else if (bookArr.includes("3") || bookArr.includes("three")) autoFill("2");
        else if (bookArr.includes("4") || bookArr.includes("four")) autoFill("3");
        else if (bookArr.includes("5") || bookArr.includes("five")) autoFill("4");
        else if (bookArr.includes("6") || bookArr.includes("six")) autoFill("5");
        else if (bookArr.includes("7") || bookArr.includes("seven")) autoFill("6");
        else if (bookArr.includes("8") || bookArr.includes("eight")) autoFill("7");
        else if (bookArr.includes("9") || bookArr.includes("nine")) autoFill("8");

        setTimeout(() => {
            $(".chat-box-toggle").click();
            $(".bd-example-modal-xl").modal("show");
            generateMessage("Form opened", "bot");
        }, 2000);
    } else {
        setTimeout(() => {
            generateMessage("Pardon!", "bot");
            startRecognition();
        }, 1000);
    }
}
