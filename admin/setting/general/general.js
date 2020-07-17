$(document).ready(function () {
    orgValues();

    $("#SaveGeneral").on("click", function () {
        var issuePeriod = $("#issuePeriod").val();
        var reservePeriod = $("#reservePeriod").val();
        var issueLimit = $("#issueLimit").val();
        var reserveLimit = $("#reserveLimit").val();
        var dueFineAmount = $("#dueFineAmount").val();
        var issuePoint = $("#issuePoint").val();
        var returnPoint = $("#returnPoint").val();
        var duePoint = $("#duePoint").val();
        var ratingPoint = $("#ratingPoint").val();
        if (
            issueLimit != "" &&
            issuePeriod != "" &&
            issuePoint != "" &&
            ratingPoint != "" &&
            reserveLimit != "" &&
            reservePeriod != "" &&
            returnPoint != "" &&
            dueFineAmount != "" &&
            duePoint != ""
        ) {
            console.log(issuePeriod);
            $.ajax({
                url: "setting/general/general.php",
                method: "POST",
                dataType: "text",
                data: {
                    issuePeriod: issuePeriod,
                    reservePeriod: reservePeriod,
                    issueLimit: issueLimit,
                    reserveLimit: reserveLimit,
                    dueFineAmount: dueFineAmount,
                    issuePoint: issuePoint,
                    returnPoint: returnPoint,
                    duePoint: duePoint,
                    ratingPoint: ratingPoint,
                },
                success: function (data) {
                    alert(data);
                },
                error: function (error) {
                    alert(error);
                },
            });
        } else {
            alert("Please fill and submit");
        }
    });
});

// gets org values
function orgValues() {
    $.ajax({
        url: "setting/general/getOrgSettings.php",
        success: function (data) {
            data = JSON.parse(data);
            $("#issuePeriod").val(data.issuePeriod);
            $("#reservePeriod").val(data.reservePeriod);
            $("#issueLimit").val(data.issueNum);
            $("#reserveLimit").val(data.reserveNum);
            $("#dueFineAmount").val(data.dueFine);
            $("#issuePoint").val(data.issuePoint);
            $("#returnPoint").val(data.returnPoint);
            $("#duePoint").val(data.duePoint);
            $("#ratingPoint").val(data.ratingPoint);
        },
    });
}
