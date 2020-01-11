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
document.getElementById('addBook').addEventListener('submit', addBook);

// Submit form
function addBook(e) {
    e.preventDefault();

    // Get values
    var title = getInputVal('title');
    var author = getInputVal('author');
    var mainCategory = getInputVal('category');
    var publisher = getInputVal('publisher');
    var publishedDate = getInputVal('publishedDate');
    var isbn = getInputVal('isbn');
    var pageCount = getInputVal('pageCount');
    var money = getInputVal('money');
    var imgValue = getInputVal('imgValue');
    var quantity = getInputVal('quantity');
    var issued = 0;
    var subCategory = getInputVal('technology');


    // Save message
    saveMessage(title, author, mainCategory, subCategory, publisher, publishedDate, isbn, pageCount, money, imgValue, quantity, issued);

    // Show alert
    document.querySelector('.alert').style.display = 'block';

    // Hide alert after 1.5 seconds
    setTimeout(function () {
        document.querySelector('.alert').style.display = 'none';
    }, 1500);

    // Clear form
    document.getElementById('addBook').reset();
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
    switch (subCategory) {
        case "Artificial Intelligence": categoryRef = categoryRef.child('Artificial Intelligence');
            break;
        case "Database Design": categoryRef = categoryRef.child('Database Design');
            break;
        case "Electronics and Applications": categoryRef = categoryRef.child('Electronics and Applications');
            break;
        case "Network": categoryRef = categoryRef.child('Network');
            break;
        case "Programming": categoryRef = categoryRef.child('Programming');
            break;
        case "Software Engineering": categoryRef = categoryRef.child('Software Engineering');
            break;
        case "System Programming": categoryRef = categoryRef.child('System Programming');
            break;
        default:
            break;
    }
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