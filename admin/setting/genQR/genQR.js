// load book dropdown
var bookIDoption = document.getElementById("bookID");
$.ajax({
	type: "POST",
	url: "setting/genQR/bookID.php",
	contentType: false, // Dont delete this (jQuery 1.6+)
	processData: false, // Dont delete this
	success: function (data) {
		var data = JSON.parse(data);
		var i = 0;
		for (var key in data) {
			bookIDoption.options[i] = new Option(key + " - " + data[key], key);
			i++;
		}
		//$('#bookID option').attr("selected","selected");
		$(".selectpicker").selectpicker("refresh");
	},
	//Other options
});

// load shelf dropdown
var shelfIDoption = document.getElementById("shelfID");
$.ajax({
	type: "POST",
	url: "setting/genQR/shelfID.php",
	contentType: false, // Dont delete this (jQuery 1.6+)
	processData: false, // Dont delete this
	success: function (data) {
		var data = JSON.parse(data);
		var i = 0;
		for (var key in data) {
			shelfIDoption.options[i] = new Option(data[key], data[key]);
			i++;
		}
		//$('#shelfID option').attr("selected","selected");
		$(".selectpicker").selectpicker("refresh");
	},
	//Other options
});

function bookQR(){
	if (document.getElementById("bookID").value == "") {
		alert("Select atleast one book");
	} else {
		var bookIDs = JSON.stringify($('#bookID').val());
		var formData = new FormData();
		formData.append("bookIDs", bookIDs);

		$.ajax({
			type: "POST",
			url: "setting/genQR/copyID.php",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				var qrData;
				var data = JSON.parse(data);
				for(var bookID in data){
					data[bookID].forEach(copyID => {
						qrData = {
							"Type": "Book",
							"BookID": bookID,
							"CopyID": copyID
						};
						qrData = JSON.stringify(qrData);
						// QR code
						console.log(qrData);
					});
				}
			}
		});
	}
}

function shelfQR(){
	if (document.getElementById("shelfID").value == "") {
		alert("Select atleast one shelf");
	} else {
		var shelfID = $('#shelfID').val();
		var qrData;
		shelfID.forEach(element => {
			qrData = {
				"Type": "Shelf",
				"ShelfID": element
			};
			qrData = JSON.stringify(qrData);
			// QR code
			console.log(qrData);
		});
	}
}