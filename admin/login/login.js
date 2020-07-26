$(document).ready(function () {
    $("#loginButton").on("click", function () {
        inputEmail = $("#inputEmail").val();
        inputPassword = $("#inputPassword").val();
        $.ajax({
            type: "POST",
            url: "login/login.php",
            data: {
                inputEmail: inputEmail,
                inputPassword: inputPassword,
            },
            success: function (data) {
                if (data != "success") {
                    alert("invalid id or password");
                } else {
                    window.location.href = "home.php";
                }
            },
            error: function (data) {
                alert(data);
            },
        });
    });
});
