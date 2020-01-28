// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyDzMP7rnfFteMaw8xgUYTWgkmSfB-1l7a8",
    authDomain: "web-symmka.firebaseapp.com",
    databaseURL: "https://web-symmka.firebaseio.com",
    projectId: "web-symmka",
    storageBucket: "web-symmka.appspot.com",
    messagingSenderId: "884666647520",
    appId: "1:884666647520:web:633e06bcb53212a26e2185",
    measurementId: "G-GKB1XQRXSF"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);


// Listen for form submit
document.getElementById('searchBookForm').addEventListener('submit', issueBook);

// Submit form
function issueBook(e) {
    e.preventDefault();

    // Get values
    var title = getInputVal('issueTitle');
    var author = getInputVal('issueAuthor');
    var isbn = getInputVal('issueISBN');
    var stud_name = getInputVal('stud_name');
    var stud_email = getInputVal('stud_email');
    var stud_id = getInputVal('stud_id');
    var issue_date = getInputVal('issue_date');
    var issueID = getInputVal('issueID');



    var formData = new FormData();
    formData.append('title', title);
    formData.append('author', author);
    formData.append('bookID', issueID);
    formData.append('stud_name', stud_name);
    formData.append('stud_email', stud_email);
    formData.append('stud_id', stud_id);
    formData.append('isbn', isbn);
    formData.append('issue_date', issue_date);

    // Save message
    saveMessage(issueID, stud_id);

    $.ajax({
        type: "POST",
        url: "searchBook/issueQuery.php",
        data: formData,
        type: 'POST',
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        //Other options
    });

    // Clear form
    document.getElementById('searchBookForm').reset();

}


// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}

// Save message to firebase
function saveMessage(issueID, stud_id) {

    var encodedcatID = encodeURIComponent(issueID).replace(/\./g, '%2E');
    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(encodedcatID);
    categoryRef.once("value").then(function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            if (!childSnapshot.val().issued && !snapshot.val().reserved) {
                childSnapshot.ref.update({
                    "reserved": stud_id
                }).then(function () {
                    console.log("Success");
                });
                return true;
            }
        });
    });
}