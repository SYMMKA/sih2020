$(document).ready(function () {
    $("#savePass").on("click", changePass);
});
function changePass() {
    password = $("#inputPass").val();
    $.ajax({
        type: "POST",
        url: "changeCred/account.php",
        data: {
            password: password,
        },
        success: function (data) {
            if (data != "success") alert(data);
            location.reload();
        },
        error: function (data) {
            alert(data);
        },
    });
}
