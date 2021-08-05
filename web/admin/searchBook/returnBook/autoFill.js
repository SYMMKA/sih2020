var price = "";
var lightDamage = "";
var mediumDamage = "";
var heavyDamage = "";
var lostBook = "";
function autoFillReturnBook(copyID, oldID, i) {
    var formData = new FormData();
    formData.append("copyID", copyID);
    $.ajax({
        type: "POST",
        url: "searchBook/returnBook/getfine.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var data = JSON.parse(data);
            var priceString = data.price;
            price = priceString.match(/\d+/)[0];
            lightDamage = parseInt(data.lightDamage);
            mediumDamage = parseInt(data.mediumDamage);
            heavyDamage = parseInt(data.heavyDamage);
            lostBook = parseInt(data.lostBook);
            document.getElementById("bookFormDiv").innerHTML = "";
            var html =
                `

      <div class="container pt-5 mb-5">
            <div class="mb-5 pb-3">
                                <h3 class="text-white float-left">Return Form</h3>
                <h3 class="text-white float-right" id="displayCopyTitleOldID">Old ID: ` +
                oldID +
                `</h3>
                <h3 class="text-white float-right mr-5" id="displayCopyTitleCopyID">Copy ID: ` +
                copyID +
                `</h3>
            </div>
            <div class="form-group row pt-4 mb-4">
                <label for="" class="col-sm-3 col-form-label text-white"
                    >Damage/Lost</label
                >
                <div class="col-sm-5">
                    <select onchange="changeFineType();" class="custom-select" name="addFine" id="addFine" placeholder="Fine">
                    <option selected value="none">None</option>
                      <option value="damage">Damage</option>
                      <option value="lost">Lost</option>
                    </select>
                </div>
                <div class="col-sm-4" id="fineType"></div>
            </div>

            <div class="pb-5">
                <button type="button" onclick="addFine()" class="btn btn-orange float-right">
                    Add Extra Fine
                </button>
            </div>

            <div class="table-responsive pt-4 mb-4">
                <table class="table table-hover table-bordered">
                    <thead class="btn-orange">
                        <tr>
                            <th scope="col">Fine Type</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white; color: black;">
						<tr>
							<td scope="col">
								Days after Due Date
								<i
									class="fa fa-info-circle ml-2"
									data-toggle="tooltip"
									data-placement="right"
									title="Number of days after due date"
								></i>
							</td>
							<td id="fine">` +
				data.days +
				` days</td>
						</tr>
                        <tr>
                            <td scope="col">
                                Due Fine
                                <i
                                    class="fa fa-info-circle ml-2"
                                    data-toggle="tooltip"
                                    data-placement="right"
                                    title="This is fine is calculated when book is received after due date"
                                ></i>
                            </td>
                            <td id="fine"><i class="fa fa-inr mr-2" >` +
                data.dueFine +
                `</td>
                        </tr>
                        <tr>
                            <td scope="col">
                                Damage/Lost Fine
                                <i
                                    class="fa fa-info-circle ml-2"
                                    data-toggle="tooltip"
                                    data-placement="right"
                                    title="This is fine is calculated when book is lost or damaged"
                                ></i>
                            </td>
                            <td><i class="fa fa-inr mr-2"></i><a id="extraFine">0</a></td>
                        </tr>
                        <th scope="col">
                            Total Fine
                            <i
                                class="fa fa-info-circle ml-2"
                                data-toggle="tooltip"
                                data-placement="right"
                                title="This is fine is calculated by adding Normal and Extra Fine"
                            ></i>
                        </th>
                        <th><i class="fa fa-inr"></i><a id="totalFine">` +
                data.dueFine +
                `</a></th>
                    </tbody>
                </table>
            </div>
          <input type="hidden" id="point" value="` +
                data.point +
                `" />
				<input type="hidden" id="ratio" value="` +
                data.duePointFineRatio +
                `" />
            <div class="pb-5">
                <button type="submit" onclick="due = 0" form="returnBookForm"  class="btn btn-orange float-right">
                    Pay & Return
                </button>
                <button type="submit" id="due1" onclick="due = 1" form="returnBookForm" class="btn btn-orange mr-3 float-right">
						Return & Pay Later
					</button>
            </div>
        </div>




			
		`;
            document.getElementById("copyID").textContent = copyID;
            document.getElementById("bookFormDiv").innerHTML = html;
            document.getElementById("elementID").value = i;

            if (data.dueFine == 0)
                document.getElementById("due1").hidden = true;
            else document.getElementById("due1").hidden = false;
        },
        //Other options
    });
}

function changeFineType() {
    xyz = "";
    document.getElementById("extraFine").textContent = 0;
    document.getElementById("totalFine").textContent = 0;
    if (document.getElementById("addFine").value == "damage") {
        document.getElementById("extraFine").textContent = 0;
        xyz += `<select onchange="percentFineCalc();" class="custom-select" name="fineLevel" id="fineLevel" placeholder="Fine">
				<option selected value="noDamageType">Select Damage Type</option>
				<option value="light">Light</option>
				<option value="medium">Medium</option>
				<option value="heavy">Heavy</option>
	  		</select>`;
        /* xyz += `<input class="form-control" type="number" onchange="percentFineCalc()" min="1" step="any" name="damageFine" id="damageFine" placeholder="Percentage damage" />`; */
    }
    if (document.getElementById("addFine").value == "lost") {
        xyz = "";
        var lost = parseFloat(lostBook) * parseFloat(price) * 0.01;
        document.getElementById("extraFine").textContent = parseFloat(lost);
    }
    document.getElementById("fineType").innerHTML = xyz;
    //
}

function percentFineCalc() {
    if ($("#fineLevel").val() == "noDamageType") {
        var percentNumber = 0;
        document.getElementById("extraFine").textContent = 0;
    }
    if ($("#fineLevel").val() == "light") {
        var percentNumber = lightDamage;
    }
    if ($("#fineLevel").val() == "medium") {
        var percentNumber = mediumDamage;
    }
    if ($("#fineLevel").val() == "heavy") {
        var percentNumber = heavyDamage;
    }
    /* var percentNumber = parseInt(
    document.getElementById("damageFine").value.match(/\d+/)[0]
  ); */
    var intt = parseInt(price);
    var fine = intt * percentNumber * 0.01;
    
    document.getElementById("extraFine").textContent = fine;
    /* var abcc = document.getElementById("extraFine").textContent;
  
   */
}

function addFine() {
    var orgFine = parseFloat(document.getElementById("fine").textContent);
    var addFine = parseFloat(document.getElementById("addFine").value);
    var extraFine = document.getElementById("extraFine").textContent;
    var totalFine = document.getElementById("totalFine").textContent;
    if ($("#addFine").val() == "none") {
        extraFine = 0;
        document.getElementById("extraFine").textContent = 0;
        //document.getElementById("totalFine").textContent = 0;
    }

    document.getElementById("totalFine").textContent =
        parseInt(orgFine) + parseInt(extraFine);

    if (orgFine + extraFine == 0) document.getElementById("due1").hidden = true;
    else document.getElementById("due1").hidden = false;
}
