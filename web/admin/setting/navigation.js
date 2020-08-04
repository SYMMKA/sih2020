function startGreeting() {
    var message = "Settings Page";
    generateMessage(message, "bot");
}

function settingsFunction(mess_arr) {
    if (general.filter((value) => mess_arr.includes(value)).length)
        openGeneral();
    else if (privileges.filter((value) => mess_arr.includes(value)).length)
        openPrivileges();
    else if (timeTable.filter((value) => mess_arr.includes(value)).length)
        openTimeTable();
    else if (generateQR.filter((value) => mess_arr.includes(value)).length)
        openGenerateQR();
    else if (admins.filter((value) => mess_arr.includes(value)).length)
        openAdmins();
    else if (
        manageUsers.filter((value) => mess_arr.includes(value)).length &&
        mess_arr.includes("user")
    )
        openManageUsers();
    else if (importAny.filter((value) => mess_arr.includes(value)).length)
        openImportAny();
}

function openGeneral() {
    $("#general-tab").tab("show");
}

function openPrivileges() {
    $("#privileges-tab").tab("show");
}
function openTimeTable() {
    $("#timeTable-tab").tab("show");
}
function openGenerateQR() {
    $("#genQR-tab").tab("show");
}
function openAdmins() {
    $("#admin-tab").tab("show");
}
function openManageUsers() {
    $("#manage-tab").tab("show");
}
function openImportAny() {
    $("#import-tab").tab("show");
}
