$(document).ready(function () {
    $(".custom-file-input").on("change", uploadFile);

    // import Books
    $("#bookImport").on("click", function () {
        var bookCSV = $("#bookCSV")[0].files[0];

        var formData = new FormData();
        formData.append("bookCSV", bookCSV);
        $.ajax({
            url: "setting/import/importBooks.php",
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
    });

    // import Students
    $("#studentsImport").on("click", function () {
        var studentsCSV = $("#studentsCSV")[0].files[0];

        var formData = new FormData();
        formData.append("studentsCSV", studentsCSV);
        $.ajax({
            url: "setting/import/importStudents.php",
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
    });

    // import Teachers
    $("#teachersImport").on("click", function () {
        var teachersCSV = $("#teachersCSV")[0].files[0];

        var formData = new FormData();
        formData.append("teachersCSV", teachersCSV);
        $.ajax({
            url: "setting/import/importTeachers.php",
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
    });

    // import Admins
    $("#adminsImport").on("click", function () {
        var adminsCSV = $("#adminsCSV")[0].files[0];

        var formData = new FormData();
        formData.append("adminsCSV", adminsCSV);
        $.ajax({
            url: "setting/import/importAdmins.php",
            method: "POST",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function (data) {
                if (data) alert(data);
            },
            error: function (error) {
                alert(error);
            },
        });
    });
});

function uploadFile(e) {
    var id = $(this).attr("id");
    var fileName = document.getElementById(id).files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
}
