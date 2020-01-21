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
document.getElementById('addBookForm').addEventListener('submit', addBook);

// Submit form
function addBook(e) {
    e.preventDefault();

    // Get values
    var bookID = getInputVal('bookID');
    var quantity = getInputVal('quantity');


    // Save message
    saveMessage(bookID, quantity);

    // Show alert
    document.querySelector('.alert').style.display = 'block';

    // Hide alert after 1.5 seconds
    setTimeout(function () {
        document.querySelector('.alert').style.display = 'none';
    }, 1500);

    // Clear form
    document.getElementById('addBookForm').reset();
}


// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}

// Save message to firebase
function saveMessage(bookID, quantity) {
    // Reference messages collection
    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(bookID);
    for(var i=1; i<=quantity; i++){
        var newMessageRef = categoryRef.child(i);
        newMessageRef.set({
            issued: 0
        });
    }
}
