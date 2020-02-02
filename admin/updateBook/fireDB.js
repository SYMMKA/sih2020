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
document.getElementById('updateBookForm').addEventListener('submit', updateBook);

// Submit form
function updateBook(e) {
    e.preventDefault();

    // Get values
    var title = getInputVal('updateTitle');
    var author = getInputVal('updateAuthor');
    console.log(author);
    var addcopies = getInputVal('addcopies');
    var removecopyID = getInputVal('removecopyID');
    var orgupdateID = getInputVal('orgupdateID');
    var orgencodedcatID = encodeURIComponent(orgupdateID).replace(/\./g, '%2E');

    var formData = new FormData();
    formData.append('title', title);
    formData.append('author', author);
    formData.append('orgupdateID', orgupdateID);

    $.ajax({
        type: "POST",
        url: "updateBook/updateQuery.php",
        data: formData,
        type: 'POST',
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        //Other options
    });

    // Save message
    saveMessage(updateID, removecopyID, formData);

    // Clear form
    document.getElementById('updateBookForm').reset();

}


// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}

// Save message to firebase
function saveMessage(updateID, copyID, formData) {

    var encodedcatID = encodeURIComponent(updateID).replace(/\./g, '%2E');

    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(encodedcatID);
    var copyRef = categoryRef.child(copyID);
    copyRef.once("value").then(function (snapshot) {
        if (snapshot.val().reserved == stud_id || (!snapshot.val().updated && !snapshot.val().reserved)) {
            snapshot.ref.update({
                "updated": 1,
                "reserved": ""
            }).then(function () {
                console.log("Success");
            });
        }
    });
}