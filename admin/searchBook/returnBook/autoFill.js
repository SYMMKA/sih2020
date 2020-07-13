function autoFillReturnBook(copyID, oldID, i) {
	var formData = new FormData();
	formData.append('copyID', copyID);
	$.ajax({
		type: "POST",
		url: "searchBook/returnBook/getfine.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			document.getElementById("bookFormDiv").innerHTML = "";
			var html =`
			<h1 class="text-center mb-4">Return Book</h1>
			<div class="text-center mb-4">
				<h4 class="d-inline">Copy ID: </h4>
				<h4 class="d-inline"` +
				copyID +
				`</h4></br>
				<h4 class="d-inline">Old ID: </h4>
				<h4 class="d-inline"` +
				oldID +
				`</h4></br>
				<h4 class="d-inline">Fine: </h4>
				<h4 class="d-inline" id="fine"><i class="fa fa-inr"></i>` +
				data.dueFine +
				`</h4></br>
				<h4 class="d-inline">Extra Fine: </h4>
				<h4 class="d-inline"><i class="fa fa-inr"></i><a id="extraFine">0</a></h4>
				</h4></br>
				<h4 class="d-inline">Total: </h4>
				<h4 class="d-inline"><i class="fa fa-inr"></i><a id="totalFine">` +
				data.dueFine +
				`</a></h4></br>
				<input type="hidden" id="point" value="` +
				data.point +
				`" />
				<input type="hidden" id="ratio" value="` +
				data.duePointFineRatio +
				`" />
		</div>      

		<div>
			<div class="form-group row justify-content-center" >
				<label class="col-sm-4 col-form-label  text-right">Add Fine</label>
				<div class="col-sm-4">
					<input class="form-control" type="number" min="1" step="any" name="addFine" id="addFine" placeholder="Fine" />
				</div>
				<div class="col-sm-4">
					<button type="reset" value="Clear" class="btn btn-secondary">
					clear
					</button>
					<button type="button" onclick="addFine()" class="btn btn-info">Add</button>
				</div>
			</div>
			<div class="form-group row justify-content-center" >
				<div class="col-sm-4">
					<button type="submit" onclick="due = 0" form="returnBookForm" class="btn btn-info">
						Pay & Return
					</button>
					<button type="submit" id="due1" onclick="due = 1" form="returnBookForm" class="btn btn-info">
						Return & Pay Later
					</button>
				</div>
			</div>
		</div>

		</br>
		`;
			document.getElementById('copyID').textContent = copyID;
			document.getElementById("bookFormDiv").innerHTML = html;
			document.getElementById("elementID").value = i;

			if((data.dueFine) == 0)
				document.getElementById('due1').hidden = true;
			else
				document.getElementById('due1').hidden = false;
		}
		//Other options
	});
}

function addFine(){
	var orgFine = parseFloat(document.getElementById('fine').textContent);
	var addFine = parseFloat(document.getElementById('addFine').value);
	if(document.getElementById('addFine').value == '')
		addFine = 0;
	var extraFine = document.getElementById('extraFine');
	var totalFine = document.getElementById('totalFine');
	extraFine.textContent = addFine;
	totalFine.textContent = orgFine+addFine;

	if((orgFine+addFine) == 0)
		document.getElementById('due1').hidden = true;
	else
		document.getElementById('due1').hidden = false;
}