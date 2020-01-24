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
    var title = getInputVal('title');
    var author = getInputVal('author');
    var mainCategory1 = test[mainCategorySelect1.value].description;
    var encodedcatID = getInputVal('encodedcatID');
    var publisher = getInputVal('publisher');
    var publishedDate = getInputVal('publishedDate');
    var isbn = getInputVal('isbn');
    var pageCount = getInputVal('pageCount');
    var money = getInputVal('money');
    var quantity = getInputVal('quantity');
    if (!test[mainCategorySelect1.value].subordinates) {
        var mainCategory2 = '';
        var mainCategory3 = '';
        var mainCategory4 = '';
    }
    else {
        var mainCategory2 = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].description;
        if (!test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates) {
            var mainCategory3 = '';
            var mainCategory4 = '';
        }
        else {
            var mainCategory3 = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].description;
            if (!test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates)
                var mainCategory4 = '';
            else
                var mainCategory4 = test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates[mainCategorySelect4.value].description;

        }
    }

    

    var formData = new FormData();
      formData.append('title1', title);
      formData.append('author1', author);
      formData.append('mainCategorySelect1', mainCategory1);
      formData.append('mainCategorySelect2', mainCategory2);
      formData.append('mainCategorySelect3', mainCategory3);
      formData.append('mainCategorySelect4', mainCategory4);
      formData.append('bookID', bookID);
      formData.append('publisher1', publisher);
      formData.append('publishedDate1', publishedDate);
      formData.append('isbn1', isbn);
      formData.append('pageCount1', pageCount);
      formData.append('money1', money);
      formData.append('imgValue1', document.getElementById('imgLink').src);
      formData.append('quantity1', quantity);

      

    // Save message
    saveMessage(encodedcatID, quantity);

    $.ajax({
        type: "POST",
        url: "addBook/addQuery.php",
        data: formData,
    type: 'POST',
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    //Other options
    });
    
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
function saveMessage(encodedcatID, quantity) {
    // Reference messages collection
    var rootRef = firebase.database().ref('Library');
    var categoryRef = rootRef.child(encodedcatID);
    for(var i=1; i<=quantity; i++){
        var newMessageRef = categoryRef.child(i);
        newMessageRef.set({
            issued: 0
        });
    }
}

