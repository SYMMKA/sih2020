<?php

$typeQR = $_POST['typeQR'];
$qrIDs = $_POST['qrIDs'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- CSS Dependencies -->
        <link
            rel="stylesheet"
            href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="./assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css"
        />
        <link
            rel="stylesheet"
            href="./assets/node_modules/shards-ui/dist/css/shards.min.css"
        />
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        />
        <link rel="stylesheet" href="./assets/css/common.css" />
    </head>
    <body>
		<div id="QRdiv">
			<canvas id="QR" hidden></canvas>
			<div id="QRpdf" class="row"></div>
		</div>

		<!-- Optional JavaScript -->
		<!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
		<script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
		<script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
		<script src="assets/node_modules/qrious/dist/qrious.min.js"></script>
		<script>
			typeQR = <?php echo json_encode($typeQR); ?>;
			qrIDs = <?php echo json_encode($qrIDs); ?>;
			qrIDs = JSON.parse(qrIDs);
			if(typeQR == "Book") {
				bookQR();
			} else {
				copyQR();
			}

			function bookQR() {
				for(var bookID in qrIDs){
					qrIDs[bookID].forEach(copyID => {
						qrData = {
							"Type": "Book",
							"BookID": bookID,
							"CopyID": copyID
						};
						qrData = JSON.stringify(qrData);
						console.log(qrData);
						qr = new QRious({
							element: document.querySelector('canvas'),
							foreground: 'black',
							size: 100,
							value: qrData
						});
						console.log(qr.image);
						var qrDiv = document.createElement('tr');
						qrDiv.appendChild(qr.image);
						var labelDiv = document.createElement('tr');
						labelDiv.append(copyID);
						var mainDiv = document.createElement('table');
						mainDiv.className = "col";
						mainDiv.appendChild(qrDiv);
						mainDiv.appendChild(labelDiv);
						$("#QRpdf").append(mainDiv);
					});
				}
			}

			function copyQR() {
				qrIDs.forEach(shelfID => {
					qrData = {
						"Type": "Shelf",
						"ShelfID": shelfID
					};
					qrData = JSON.stringify(qrData);
					console.log(qrData);
					qr = new QRious({
						element: document.querySelector('canvas'),
						foreground: 'black',
						size: 100,
						value: qrData
					});
					console.log(qr.image);
					var qrDiv = document.createElement('tr');
					qrDiv.appendChild(qr.image);
					var labelDiv = document.createElement('tr');
					labelDiv.append(shelfID);
					var mainDiv = document.createElement('table');
					mainDiv.className = "col";
					mainDiv.appendChild(qrDiv);
					mainDiv.appendChild(labelDiv);
					$("#QRpdf").append(mainDiv);
				});
			}
		</script>
	</body>
</html>