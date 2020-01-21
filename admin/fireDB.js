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
    var title = getInputVal('bookID');


    // Save message
    saveMessage(title, author, mainCategory, subCategory, publisher, publishedDate, isbn, pageCount, money, imgValue, quantity, issued);

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
function saveMessage(title, author, mainCategory, subCategory, publisher, publishedDate, isbn, pageCount, money, imgValue, quantity, issued) {
    // Reference messages collection
    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(mainCategory);
    var newMessageRef = categoryRef.child(title);
    newMessageRef.set({
        author: author,
        category: mainCategory,
        publisher: publisher,
        publishedDate: publishedDate,
        isbn: isbn,
        pageCount: pageCount,
        money: money,
        imgValue: imgValue,
        quantity: quantity,
        issued: issued
    });
}