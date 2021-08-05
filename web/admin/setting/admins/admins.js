$(document).ready(function () {
    orgAdminValues();

    $("#saveAdmins").on("click", function () {
        var values = {};
        for (var i = 0; i < totalAdmins; i++) {
            var adminID = $("#admin" + i).text();
            var clearance = $("#clearance" + i).val();
            if (!clearance) {
                alert("Please fill and submit");
                return;
            }
            values[adminID] = clearance;
        }
        values = JSON.stringify(values);

        $.ajax({
            url: "setting/admins/admins.php",
            method: "POST",
            dataType: "text",
            data: {
                adminIDs: values,
            },
            success: function (data) {
                
            },
            error: function (error) {
                alert(error);
            },
        });
    });
});

// gets org values
var totalAdmins;
function orgAdminValues() {
    $.ajax({
        url: "setting/admins/getAdmin.php",
        success: function (data) {
            $("#adminClearance").empty();
            var data = JSON.parse(data);
            totalAdmins = 0;
            for (var adminID in data) {
                var clearance = data[adminID];
                var html =
                    `
				<div class="form-group row">
				<label
					for="admin` +
                    totalAdmins +
                    `"
					class="col-sm-4 col-form-label"
					id="admin` +
                    totalAdmins +
                    `"
					>` +
                    adminID +
                    `</label
				>
				<div class="col-sm-8">
					<input
						class="form-control"
						type="number"
						min="1"
						id="clearance` +
                    totalAdmins +
                    `"
						value="` +
                    clearance +
                    `"
					/>
				</div>
				</div>`;
                $("#adminClearance").append(html);
                totalAdmins++;
            }
        },
    });
}
