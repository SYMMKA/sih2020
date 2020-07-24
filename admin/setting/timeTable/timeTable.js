$(document).ready(function(){
    orgTimeTableValues()
    $("#saveTimeTable").on("click", function(){
        var mondayStartTime = $("#mondayStartTime").val()
        var tuesdayStartTime = $("#tuesdayStartTime").val()
        var wednesdayStartTime = $("#wednesdayStartTime").val()
        var thursdayStartTime = $("#thursdayStartTime").val()
        var fridayStartTime = $("#fridayStartTime").val()
        var saturdayStartTime = $("#saturdayStartTime").val()
        var sundayStartTime = $("#sundayStartTime").val()

        var mondayEndTime = $("#mondayEndTime").val()
        var tuesdayEndTime = $("#tuesdayEndTime").val()
        var wednesdayEndTime = $("#wednesdayEndTime").val()
        var thursdayEndTime = $("#thursdayEndTime").val()
        var fridayEndTime = $("#fridayEndTime").val()
        var saturdayEndTime = $("#saturdayEndTime").val()
        var sundayEndTime = $("#sundayEndTime").val()

        var mondayComment = $("#mondayComment").val()
        var tuesdayComment = $("#tuesdayComment").val()
        var wednesdayComment = $("#wednesdayComment").val()
        var thursdayComment = $("#thursdayComment").val()
        var fridayComment = $("#fridayComment").val()
        var saturdayComment = $("#saturdayComment").val()
        var sundayComment = $("#sundayComment").val()

        var formData = new FormData();
        formData.append('mondayStartTime',mondayStartTime );
        formData.append('tuesdayStartTime',tuesdayStartTime);
        formData.append('wednesdayStartTime',wednesdayStartTime);
        formData.append('thursdayStartTime',thursdayStartTime);
        formData.append('fridayStartTime',fridayStartTime);
        formData.append('saturdayStartTime',saturdayStartTime);
        formData.append('sundayStartTime',sundayStartTime);
        formData.append('mondayEndTime',mondayEndTime);
        formData.append('tuesdayEndTime',tuesdayEndTime );
        formData.append('wednesdayEndTime',wednesdayEndTime);
        formData.append('thursdayEndTime',thursdayEndTime);
        formData.append('fridayEndTime',fridayEndTime);
        formData.append('saturdayEndTime',saturdayEndTime);
        formData.append('sundayEndTime',sundayEndTime );
        formData.append('mondayComment',mondayComment );
        formData.append('tuesdayComment',tuesdayComment );
        formData.append('wednesdayComment',wednesdayComment );
        formData.append('thursdayComment',thursdayComment );
        formData.append('fridayComment',fridayComment);
        formData.append('saturdayComment',saturdayComment);
        formData.append('sundayComment',sundayComment);

        $.ajax({
            type: "POST",
            url: "setting/timeTable/updateTimeTable.php",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function(data){
                console.log(data);
            },
            error: function (error) {
                alert(error);
            },

        })
    })
})

function orgTimeTableValues() {
$.ajax({
            type: "POST",
            url: "setting/timeTable/orgTimeTable.php",
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function(data){
                console.log(data);
				var data = JSON.parse(data);
				var weekDays = [];
				for(var days in data) {
					var day = [];
					day['start'] = data[days]['start'];
					day['end'] = data[days]['end'];
					day['comment'] = data[days]['comment'];
					weekDays[days] = day;
				}
				console.log(weekDays);

                $("#mondayStartTime").val(weekDays['Monday']['start']);
                $("#tuesdayStartTime").val(weekDays['Tuesday']['start']);
                $("#wednesdayStartTime").val(weekDays['Wednesday']['start']);
                $("#thursdayStartTime").val(weekDays['Thursday']['start']);
                $("#fridayStartTime").val(weekDays['Friday']['start']);
                $("#saturdayStartTime").val(weekDays['Saturday']['start']);
				$("#sundayStartTime").val(weekDays['Sunday']['start']);
				
                $("#mondayEndTime").val(weekDays['Monday']['end']);
                $("#tuesdayEndTime").val(weekDays['Tuesday']['end']);
                $("#wednesdayEndTime").val(weekDays['Wednesday']['end']);
                $("#thursdayEndTime").val(weekDays['Thursday']['end']);
                $("#fridayEndTime").val(weekDays['Friday']['end']);
                $("#saturdayEndTime").val(weekDays['Saturday']['end']);
				$("#sundayEndTime").val(weekDays['Sunday']['end']);
				
                $("#mondayComment").val(weekDays['Monday']['comment']);
                $("#tuesdayComment").val(weekDays['Tuesday']['comment']);
                $("#wednesdayComment").val(weekDays['Wednesday']['comment']);
                $("#thursdayComment").val(weekDays['Thursday']['comment']);
                $("#fridayComment").val(weekDays['Friday']['comment']);
                $("#saturdayComment").val(weekDays['Saturday']['comment']);
                $("#sundayComment").val(weekDays['Sunday']['comment']);

            },
            error: function (error) {
                alert(error);
            },

        })
}