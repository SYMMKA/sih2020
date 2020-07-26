$(document).ready(function () {
	orgPrivilegeValues();

	$("#savePrivilege").on("click", function () {
		var issueAccess = $("#issueAccess").val();
		var returnAccess = $("#returnAccess").val();
		var addBookAccess = $("#addBookAccess").val();
		var updateBookAccess = $("#updateBookAccess").val();
		var shelfModifyAccess = $("#shelfModifyAccess").val();
		var bookShelfAccess = $("#bookShelfAccess").val();
		var semBranchModifyAccess = $("#semBranchModifyAccess").val();
		var bookSemBranchAccess = $("#bookSemBranchAccess").val();
		var settingsAccess = $("#settingsAccess").val();
		var settingsAdminAccess = $("#settingsAdminAccess").val();
		if (
			(addBookAccess != "" &&
			issueAccess != "" &&
			bookShelfAccess != "" &&
			settingsAccess != "" &&
			settingsAdminAccess != "" &&
			updateBookAccess != "" &&
			returnAccess != "" &&
			semBranchModifyAccess != "" &&
			shelfModifyAccess != "" &&
			bookSemBranchAccess != "")
		) {
			$.ajax({
				url: "setting/privileges/privileges.php",
				method: "POST",
				dataType: "text",
				data: {
					addBookAccess: addBookAccess,
					issueAccess: issueAccess,
					bookShelfAccess: bookShelfAccess,
					settingsAccess: settingsAccess,
					settingsAdminAccess: settingsAdminAccess,
					updateBookAccess: updateBookAccess,
					returnAccess: returnAccess,
					semBranchModifyAccess: semBranchModifyAccess,
					shelfModifyAccess: shelfModifyAccess,
					bookSemBranchAccess: bookSemBranchAccess,
				},
				success: function (data) {
					if(data)
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
function orgPrivilegeValues(){
	$.ajax({
		url: "setting/privileges/getOrgPrivileges.php",
		success: function (data) {
			data = JSON.parse(data);
			$("#issueAccess").val(data.issueAccess);
			$("#returnAccess").val(data.returnAccess);
			$("#addBookAccess").val(data.addBookAccess);
			$("#updateBookAccess").val(data.updateBookAccess);
			$("#shelfModifyAccess").val(data.shelfModifyAccess);
			$("#bookShelfAccess").val(data.bookShelfAccess);
			$("#semBranchModifyAccess").val(data.semBranchModifyAccess);
			$("#bookSemBranchAccess").val(data.bookSemBranchAccess);
			$("#settingsAccess").val(data.settingsAccess);
			$("#settingsAdminAccess").val(data.settingsAdminAccess);
		}
	});
}