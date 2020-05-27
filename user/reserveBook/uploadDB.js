// Listen for form submit
document.getElementById('searchBookForm').addEventListener('submit', reserveBook);

// Submit form
function reserveBook(e) {
    e.preventDefault();

    // Get values
    var stud_ID = document.getElementById('stud_ID').value;
    var copyID = document.getElementById('copyID').textContent;
    var oldID = document.getElementById('oldID').textContent;

    var formData = new FormData();
    formData.append('stud_ID', stud_ID);
    formData.append('copyID', copyID);
    formData.append('oldID', oldID);

    $.ajax({
            type: "POST",
            url: "reserveBook/reserveQuery.php",
            data: formData,
            type: 'POST',
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            //Other options
        },

        window.location.reload(),
    );

    // Clear form
    document.getElementById('searchBookForm').reset();
}