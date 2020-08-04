$(document).ready(function () {
    $("#savePass").on("click", changePass);
});
function changePass() {
    password = $("#inputPass1").val();
    password2 = $("#inputPass2").val();
    if (password == password2) {
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
    } else {
        alert("password not matching");
    }
}
