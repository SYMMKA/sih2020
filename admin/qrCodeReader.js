var cameraId = '';
Html5Qrcode.getCameras().then(devices => {
	/**
	 * devices would be an array of objects of type:
	 * { id: "id", label: "label" }
	 */
	if (devices && devices.length) {
		cameraId = devices[0].id;
		console.log(cameraId);
		// .. use this to start scanning.
	}
}).catch(err => {
	// handle err
});

const html5QrCode = new Html5Qrcode("reader");
$('#qrread').on('click', () => {
	status = $('#qrread').val();
	if(status == 'start') {
		stopQRcode();
	} else {
		startQRcode();
	}
})

function startQRcode() {
	html5QrCode.start(
		cameraId,     // retreived in the previous step.
		{
			fps: 10,    // sets the framerate to 10 frame per second
			qrbox: 250  // sets only 250 X 250 region of viewfinder to
			// scannable, rest shaded.
		},
		qrCodeMessage => {
			// do something when code is read. For example:
			console.log(`QR Code detected: ${qrCodeMessage}`);
			var qrInfo = JSON.parse(qrCodeMessage);
			if(qrInfo.BookID || qrInfo.ShelfID) {
				stopQRcode();
				if(qrInfo.BookID)
					var ID = qrInfo.BookID;
				else if(qrInfo.ShelfID)
					var ID = qrInfo.ShelfID;
				searchQR(ID);
			}
		},
		errorMessage => {
			// parse error, ideally ignore it. For example:
			console.log(`QR Code no longer in front of camera.`);
		})
		.catch(err => {
			// Start failed, handle it. For example,
			console.log(`Unable to start scanning, error: ${err}`);
		});
	setTimeout( ()=> {
		$('#qrread').val('start');
		$('#qrread').html('Close');
	},150);
}

function stopQRcode() {
	html5QrCode.stop().then(ignore => {
		// QR Code scanning is stopped.
	}).catch(err => {
		// Stop failed, handle it.
	});
	$('#qrread').val('stop');
	$('#qrread').html('Scan');
}