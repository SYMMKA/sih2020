function startGreeting() {
    var message = "Settings Page";
    generateMessage(message, "bot");
}

function openGeneral(bookArr) {
    console.log("openBookModal");
    if (bookArr.includes("general")) $("#general-tab").tab("show");
}
