$(document).ready(function () {
	$("#showAddAdmin").addClass("d-none");
	$("#showAddUser").addClass("d-none");
	$("#showDeleteAdmin").addClass("d-none");
	$("#showDeleteUser").addClass("d-none");

	$("input[name=adminoruser]").on("change", function () {
		$("#showAddAdmin").addClass("d-none");
		$("#showAddUser").addClass("d-none");
		$("#showDeleteAdmin").addClass("d-none");
		$("#showDeleteUser").addClass("d-none");

		if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			$("#showAddAdmin").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			$("#showAddUser").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			loadAdmin();
			$("#showDeleteAdmin").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			loadUser();
			$("#showDeleteUser").removeClass("d-none");
		} else {
			console.log("error");
		}
	});

	$("input[name=addordelete]").on("change", function () {
		$("#showAddAdmin").addClass("d-none");
		$("#showAddUser").addClass("d-none");
		$("#showDeleteAdmin").addClass("d-none");
		$("#showDeleteUser").addClass("d-none");

		if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			$("#showAddAdmin").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			$("#showAddUser").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			loadAdmin();
			$("#showDeleteAdmin").removeClass("d-none");
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			loadUser();
			$("#showDeleteUser").removeClass("d-none");
		} else {
			console.log("error");
		}
	});

	// save input
	$("#saveManageUser").on("click", function () {
		if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			var adminID = $("#adminID").val();
			var adminFirstName = $("#adminFirstName").val();
			var adminLastName = $("#adminLastName").val();
			var adminAccess = $("#adminAccess").val();
			var formData = new FormData();
			formData.append('adminID', adminID);
			formData.append('adminFirstName', adminFirstName);
			formData.append('adminLastName', adminLastName);
			formData.append('adminAccess', adminAccess);
			$.ajax({
				url: "setting/manageUsers/addAdmin.php",
				method: "POST",
				data: formData,
				contentType: false, // Dont delete this (jQuery 1.6+)
				processData: false, // Dont delete this
				success: function (data) {
					console.log(data);
				},
				error: function (error) {
					alert(error);
				},
			});
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "add"
		) {
			if($("input[name=stuortea]:checked").val()) {
				var userID = $("#userID").val();
				var userName = $("#userName").val();
				var userEmail = $("#userEmail").val();
				var userMobile = $("#userMobile").val();
				var type = $("input[name=stuortea]:checked").val();
				var formData = new FormData();
				formData.append('userID', userID);
				formData.append('userName', userName);
				formData.append('userEmail', userEmail);
				formData.append('userMobile', userMobile);
				formData.append('type', type);
				$.ajax({
					url: "setting/manageUsers/addUser.php",
					method: "POST",
					data: formData,
					contentType: false, // Dont delete this (jQuery 1.6+)
					processData: false, // Dont delete this
					success: function (data) {
						console.log(data);
					},
					error: function (error) {
						alert(error);
					},
				});
			} else {
				console.log("error");
			}
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"admin" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			if($("#deleteAdmin").val() != '') {
				var deleteAdmin = $("#deleteAdmin").val();
				deleteAdmin = JSON.stringify(deleteAdmin);
				var formData = new FormData();
				formData.append('deleteAdmin', deleteAdmin);
				$.ajax({
					url: "setting/manageUsers/deleteAdmin.php",
					method: "POST",
					data: formData,
					contentType: false, // Dont delete this (jQuery 1.6+)
					processData: false, // Dont delete this
					success: function (data) {
						console.log(data);
					},
					error: function (error) {
						alert(error);
					},
				});
			} else {
				console.log("Select atleast one admin to delete");
			}
		} else if (
			$("input[name=adminoruser]:checked").val() ==
			"user" &&
			$("input[name=addordelete]:checked").val() == "delete"
		) {
			if($("#deleteUser").val() != '') {
				var deleteUser = $("#deleteUser").val();
				deleteUser = JSON.stringify(deleteUser);
				var formData = new FormData();
				formData.append('deleteUser', deleteUser);
				$.ajax({
					url: "setting/manageUsers/deleteUser.php",
					method: "POST",
					data: formData,
					contentType: false, // Dont delete this (jQuery 1.6+)
					processData: false, // Dont delete this
					success: function (data) {
						console.log(data);
					},
					error: function (error) {
						alert(error);
					},
				});
			} else {
				console.log("Select atleast one user to delete");
			}
		} else {
			console.log("error");
		}
	});
});

// load admins
function loadAdmin() {
	var adminIDoption = document.getElementById("deleteAdmin");
	$.ajax({
		type: "POST",
		url: "setting/manageUsers/adminID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			$("#deleteAdmin").empty();
			for (var key in data) {
				adminIDoption.options[i] = new Option(data[key], data[key]);
				i++;
			}
			//$('#deleteAdmin option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}

// load users
function loadUser() {
	var userIDoption = document.getElementById("deleteUser");
	$.ajax({
		type: "POST",
		url: "setting/manageUsers/userID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			$("#deleteUser").empty();
			for (var key in data) {
				userIDoption.options[i] = new Option(data[key], data[key]);
				i++;
			}
			//$('#deleteUser option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}