$(document).ready(function () {
  orgGeneralValues();

  $("#saveGeneral").on("click", function () {
    //student
    var issuePeriod = $("#issuePeriod").val();
    var reservePeriod = $("#reservePeriod").val();
    var issueLimit = $("#issueLimit").val();
    var reserveLimit = $("#reserveLimit").val();
    var dueFineAmount = $("#dueFineAmount").val();
    var issuePoint = $("#issuePoint").val();
    var returnPoint = $("#returnPoint").val();
    var duePoint = $("#duePoint").val();
    var ratingPoint = $("#ratingPoint").val();
    var lightDamageSt = $("#lightDamageSt").val();
    var mediumDamageSt = $("#mediumDamageSt").val();
    var heavyDamageSt = $("#heavyDamageSt").val();
    var lostSt = $("#lostSt").val();
    var UPIaddress = $("#UPIaddress").val();

    //teacher
    var teacherIssuePeriod = $("#teacherIssuePeriod").val();
    var teacherReservePeriod = $("#teacherReservePeriod").val();
    var teacherIssueLimit = $("#teacherIssueLimit").val();
    var teacherReserveLimit = $("#teacherReserveLimit").val();
    var teacherDueFineAmount = $("#teacherDueFineAmount").val();
    var teacherIssuePoint = $("#teacherIssuePoint").val();
    var teacherReturnPoint = $("#teacherReturnPoint").val();
    var teacherDuePoint = $("#teacherDuePoint").val();
    var teacherRatingPoint = $("#teacherRatingPoint").val();
    var lightDamageTr = $("#lightDamageTr").val();
    var mediumDamageTr = $("#mediumDamageTr").val();
    var heavyDamageTr = $("#heavyDamageTr").val();
    var lostTr = $("#lostTr").val();
    var UPIaddress = $("#UPIaddress").val();
    if (
      issueLimit != "" &&
      issuePeriod != "" &&
      issuePoint != "" &&
      ratingPoint != "" &&
      reserveLimit != "" &&
      reservePeriod != "" &&
      returnPoint != "" &&
      dueFineAmount != "" &&
      duePoint != "" &&
      lightDamageSt != "" &&
      mediumDamageSt != "" &&
      heavyDamageSt != "" &&
      lostSt != "" &&
      teacherIssuePeriod != "" &&
      teacherReservePeriod != "" &&
      teacherIssueLimit != "" &&
      teacherReserveLimit != "" &&
      teacherDueFineAmount != "" &&
      teacherIssuePoint != "" &&
      teacherReturnPoint != "" &&
      teacherDuePoint != "" &&
      teacherRatingPoint != "" &&
      lightDamageTr != "" &&
      mediumDamageTr != "" &&
      heavyDamageTr != "" &&
      lostTr != "" &&
      UPIaddress != ""
    ) {
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
          lightDamageSt: lightDamageSt,
          mediumDamageSt: mediumDamageSt,
          heavyDamageSt: heavyDamageSt,
          lostSt: lostSt,
          ratingPoint: ratingPoint,
          teacherIssuePeriod: teacherIssuePeriod,
          teacherReservePeriod: teacherReservePeriod,
          teacherIssueLimit: teacherIssueLimit,
          teacherReserveLimit: teacherReserveLimit,
          teacherDueFineAmount: teacherDueFineAmount,
          teacherIssuePoint: teacherIssuePoint,
          teacherReturnPoint: teacherReturnPoint,
          teacherDuePoint: teacherDuePoint,
          teacherRatingPoint: teacherRatingPoint,
          lightDamageTr: lightDamageTr,
          mediumDamageTr: mediumDamageTr,
          heavyDamageTr: heavyDamageTr,
          lostTr: lostTr,
          UPIaddress: UPIaddress,
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
function orgGeneralValues() {
  $.ajax({
    url: "setting/general/getOrgSettings.php",
    success: function (data) {
      data = JSON.parse(data);

      //student
      $("#issuePeriod").val(data.issuePeriod);
      $("#reservePeriod").val(data.reservePeriod);
      $("#issueLimit").val(data.issueNum);
      $("#reserveLimit").val(data.reserveNum);
      $("#dueFineAmount").val(data.dueFine);
      $("#issuePoint").val(data.issuePoint);
      $("#returnPoint").val(data.returnPoint);
      $("#duePoint").val(data.duePoint);
      $("#ratingPoint").val(data.ratingPoint);
      $("#lightDamageSt").val(data.lightDamageSt);
      $("#mediumDamageSt").val(data.mediumDamageSt);
      $("#heavyDamageSt").val(data.heavyDamageSt);
      $("#lostSt").val(data.lostSt);

      // teacher
      $("#teacherIssuePeriod").val(data.teacherIssuePeriod);
      $("#teacherReservePeriod").val(data.teacherReservePeriod);
      $("#teacherIssueLimit").val(data.teacherIssueNum);
      $("#teacherReserveLimit").val(data.teacherReserveNum);
      $("#teacherDueFineAmount").val(data.teacherDueFine);
      $("#teacherIssuePoint").val(data.teacherIssuePoint);

      $("#teacherReturnPoint").val(data.teacherReturnPoint);
      $("#teacherDuePoint").val(data.teacherDuePoint);
      $("#teacherRatingPoint").val(data.teacherRatingPoint);
      $("#lightDamageTr").val(data.lightDamageTr);
      $("#mediumDamageTr").val(data.mediumDamageTr);
      $("#heavyDamageTr").val(data.heavyDamageTr);
      $("#lostTr").val(data.lostTr);

      // UPI for payment
      $("#UPIaddress").val(data.UPIaddress);
    },
  });
}
