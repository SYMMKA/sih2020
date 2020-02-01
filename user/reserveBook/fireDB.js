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
document.getElementById('searchBookForm').addEventListener('submit', reserveBook);

// Submit form
function reserveBook(e) {
    e.preventDefault();

    // Get values
    var stud_id = getInputVal('stud_id');
    var bookID = getInputVal('reserveID');

    // Save message
    saveMessage(bookID, stud_id);

    // Clear form
    document.getElementById('searchBookForm').reset();

}


// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}

// Save message to firebase
function saveMessage(bookID, stud_id) {

    var encodedcatID = encodeURIComponent(bookID).replace(/\./g, '%2E');
    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(encodedcatID);
    categoryRef.once("value").then(function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            if (!childSnapshot.val().issued && !childSnapshot.val().reserved) {
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