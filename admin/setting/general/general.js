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
		var UPIaddress = $("#UPIaddress").val();
		if (
			(issueLimit != "" &&
			issuePeriod != "" &&
			issuePoint != "" &&
			ratingPoint != "" &&
			reserveLimit != "" &&
			reservePeriod != "" &&
			returnPoint != "" &&
			dueFineAmount != "" &&
			duePoint != "" &&
			teacherIssuePeriod != "" &&
			teacherReservePeriod != "" &&
			teacherIssueLimit != "" &&
			teacherReserveLimit != "" &&
			teacherDueFineAmount != "" &&
			teacherIssuePoint != "" &&
			teacherReturnPoint != "" &&
			teacherDuePoint != "" &&
			teacherRatingPoint != "" &&
			UPIaddress != "")
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
function orgGeneralValues(){
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

			// UPI for payment
			$("#UPIaddress").val(data.UPIaddress);
		}
	});
}