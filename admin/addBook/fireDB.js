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
    /*var title = getInputVal('title');
    var author = getInputVal('author');
    var mainCategory = getInputVal('category');
    var publisher = getInputVal('publisher');
    var publishedDate = getInputVal('publishedDate');
    var isbn = getInputVal('isbn');
    var pageCount = getInputVal('pageCount');
    var money = getInputVal('money');
    var imgValue = getInputVal('imgValue');
    var issued = 0;
    var subCategory = getInputVal('technology');*/
    var quantity = getInputVal('quantity');
    

    var formData = new FormData();
      formData.append('title1', document.getElementById('title').value);
      formData.append('author1', document.getElementById('author').value);
      formData.append('mainCategorySelect1', document.getElementById('mainCategorySelect1').value);
      formData.append('mainCategorySelect2', document.getElementById('mainCategorySelect2').value);
      formData.append('mainCategorySelect3', document.getElementById('mainCategorySelect3').value);
      formData.append('mainCategorySelect4', document.getElementById('mainCategorySelect4').value);
      formData.append('publisher1', document.getElementById('publisher').value);
      formData.append('publishedDate1', document.getElementById('publishedDate').value);
      formData.append('isbn1', document.getElementById('isbn').value);
      formData.append('pageCount1', document.getElementById('pageCount').value);
      formData.append('money1', document.getElementById('money').value);
      formData.append('imgLink1', document.getElementById('imgLink').src);
      formData.append('quantity1', document.getElementById('quantity').value);

      

    // Save message
    saveMessage(bookID, quantity);

    $.ajax({
        type: "POST",
        url: "addQuery.php",
        data: formData,
    type: 'POST',
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    //Other options
    });
    console.log("hello");
    
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

