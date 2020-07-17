// gets org values
function orgValues() {
    $.ajax({
        url: "setting/general/getOrgSettings.php",
        success: function (data) {
            data = JSON.parse(data);
            //for general settings
            $("#issuePeriod").val(data.issuePeriod);
            $("#reservePeriod").val(data.reservePeriod);
            $("#issueLimit").val(data.issueNum);
            $("#reserveLimit").val(data.reserveNum);
            $("#dueFineAmount").val(data.dueFine);
            $("#issuePoint").val(data.issuePoint);
            $("#returnPoint").val(data.returnPoint);
            $("#duePoint").val(data.duePoint);
            $("#ratingPoint").val(data.ratingPoint);
            //for privileges settings
            if (data.issueAccess == 1) {
                $("#issueAccess1").prop("checked", true);
            } else {
                $("#issueAccess2").prop("checked", true);
            }
            if (data.returnAccess == 1) {
                $("#returnAccess1").prop("checked", true);
            } else {
                $("#returnAccess2").prop("checked", true);
            }
            if (data.addBookAccess == 1) {
                $("#addBookAccess1").prop("checked", true);
            } else {
                $("#addBookAccess2").prop("checked", true);
            }
            if (data.updateBookAccess == 1) {
                $("#updateBookAccess1").prop("checked", true);
            } else {
                $("#updateBookAccess2").prop("checked", true);
            }
            if (data.shelfModifyAccess == 1) {
                $("#shelfModifyAccess1").prop("checked", true);
            } else {
                $("#shelfModifyAccess2").prop("checked", true);
            }
            if (data.bookShelfAccess == 1) {
                $("#bookShelfAccess1").prop("checked", true);
            } else {
                $("#bookShelfAccess2").prop("checked", true);
            }
            if (data.semBranchModifyAccess == 1) {
                $("#semBranchModifyAccess1").prop("checked", true);
            } else {
                $("#semBranchModifyAccess2").prop("checked", true);
            }
            if (data.bookSemBranchAccess == 1) {
                $("#bookSemBranchAccess1").prop("checked", true);
            } else {
                $("#bookSemBranchAccess2").prop("checked", true);
            }
            if (data.settingsAccess == 1) {
                $("#settingsAccess1").prop("checked", true);
            } else {
                $("#settingsAccess2").prop("checked", true);
            }
        },
    });
}
