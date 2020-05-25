// Listen for form submit
document.getElementById('issueBookForm').addEventListener('submit', issueBook);

// Submit form
function issueBook(e) {
    e.preventDefault();

    // Get values
    var reservedBy = document.getElementById('reservedBy').value;
    var isbn = document.getElementById('bookisbnIssue').textContent;
    var stud_ID = document.getElementById('stud_IDIssue').value;
    var copyID = document.getElementById('issueCopyID').textContent;
    var oldID = document.getElementById('issueOldID').textContent;

    var formData = new FormData();
    formData.append('isbn', isbn);
    formData.append('stud_ID', stud_ID);
    formData.append('copyID', copyID);
    formData.append('oldID', oldID);

    if ((reservedBy == '') || (reservedBy == stud_ID)) {
        $.ajax({
                type: "POST",
                url: "issueBook/issueQuery.php",
                data: formData,
                contentType: false, // Dont delete this (jQuery 1.6+)
                processData: false, // Dont delete this
                //Other options
            },

            window.location.reload(),
        );
    } else {
        alert("This book is reserved");
    }

    // Clear form
    //document.getElementById('issueBookForm').reload();

}