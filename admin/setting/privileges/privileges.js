$(document).ready(function () {
    orgValues();

    $("#SavePrivileges").on("click", function () {
        var issueAccess = $("input[name='issueAccess']:checked").val();
        var returnAccess = $("input[name='returnAccess']:checked").val();
        var addBookAccess = $("input[name='addBookAccess']:checked").val();
        var updateBookAccess = $(
            "input[name='updateBookAccess']:checked"
        ).val();
        var shelfModifyAccess = $(
            "input[name='shelfModifyAccess']:checked"
        ).val();
        var bookShelfAccess = $("input[name='bookShelfAccess']:checked").val();
        var semBranchModifyAccess = $(
            "input[name='semBranchModifyAccess']:checked"
        ).val();
        var bookSemBranchAccess = $(
            "input[name='bookSemBranchAccess']:checked"
        ).val();
        var settingsAccess = $("input[name='settingsAccess']:checked").val();
        $.ajax({
            url: "setting/privileges/privileges.php",
            method: "POST",
            dataType: "text",
            data: {
                issueAccess: issueAccess,
                returnAccess: returnAccess,
                addBookAccess: addBookAccess,
                updateBookAccess: updateBookAccess,
                shelfModifyAccess: shelfModifyAccess,
                bookShelfAccess: bookShelfAccess,
                semBranchModifyAccess: semBranchModifyAccess,
                bookSemBranchAccess: bookSemBranchAccess,
                settingsAccess: settingsAccess,
            },
            success: function (data) {
                alert(data);
            },
            error: function (error) {
                alert(error);
            },
        });
    });
});
