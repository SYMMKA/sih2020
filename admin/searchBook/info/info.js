function autoFillInfo(i) {
	var issued = reserved = available = 0;
	var formdata = new FormData();
	formdata.append('bookID', bookID[i]);
	$.ajax({
		type: "POST",
		url: "searchBook/info/info.php",
		data: formdata,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var copyIDQR = document.getElementById("copyIDQR");
			var i = 0;
			copyIDQR.options.length = 0;
			data = JSON.parse(data);
			data.forEach(element => {
				if(element.status == "issued")
					issued++;
				else if (element.status == "reserved" && element.returnTime > element.currentTime)
					reserved++;
				else
					available++;
				copyIDQR.options[i] = new Option(element.copyID, element.copyID);
				i++;
			});
			document.getElementById('issued').textContent = issued;
			document.getElementById('reserved').textContent = reserved;
			document.getElementById('available').textContent = available;

			$('#copyIDQR option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});

	document.getElementById('bookIDInfo').textContent = bookID[i];
	document.getElementById('bookTitleInfo').textContent = title[i];
	document.getElementById('bookAuthorInfo').textContent = author[i];
	document.getElementById('bookISBNInfo').textContent = isbn[i];
	document.getElementById('bookRatingInfo').textContent = star[i];
	document.getElementById('bookQuantityInfo').textContent = quantity[i]; //physical
	document.getElementById('bookCategory1Info').textContent = Category1[i];
	document.getElementById('bookCategory2Info').textContent = Category2[i];
	document.getElementById('bookCategory3Info').textContent = Category3[i];
	document.getElementById('bookCategory4Info').textContent = Category4[i];
	document.getElementById('bookPublisherInfo').textContent = publisher[i];
	document.getElementById('bookPagesInfo').textContent = pages[i]; //book
	document.getElementById('bookPriceInfo').textContent = price[i];
	document.getElementById('bookDate_of_publicationInfo').textContent = date_of_publication[i];
	if(book[i] == 1)
		document.getElementById('bookBookInfo').textContent = "Book";
	else
		document.getElementById('bookBookInfo').textContent = "Audio";
	if(digital[i] == 1)
		document.getElementById('bookDigitalInfo').textContent = "Digital";
	else
		document.getElementById('bookDigitalInfo').textContent = "Physical";
	if (imgLink[i]) {
		document.getElementById('bookimgLinkInfo').src = imgLink[i];
		document.getElementById('bookimgLinkInfo').hidden = false;
	}
	if(parseInt(book[i]) == 1)
		document.getElementById("groupPagesInfo").hidden = false;
	else
		document.getElementById("groupPagesInfo").hidden = true;

	if(parseInt(digital[i]) == 1){
		document.getElementById("groupQuantityInfo").hidden = true;
	}
	else {
		document.getElementById("groupQuantityInfo").hidden = false;
	}
}

$('#genQRcode').click(() =>{
	var copyIDObj = $('#copyIDQR').val();
	var bookID = $('#bookIDInfo').text();
	copyIDObj.forEach(copyID => {
		var qrData = {
			"Type": "Book",
			"BookID": bookID,
			"CopyID": copyID
		};
		qrData = JSON.stringify(qrData);
		console.log(qrData);
	});
});