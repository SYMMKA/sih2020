// Listen for form submit
document.getElementById('addBookForm').addEventListener('submit', addBook);

// Submit form
function addBook(e) {
    e.preventDefault();

    // Get values
    var title = getInputVal('title');
    var author = getInputVal('author');
    var mainCategory1 = test[mainCategorySelect1.value].description;
    var publisher = getInputVal('publisher');
    var publishedDate = getInputVal('publishedDate');
    var isbn = getInputVal('isbn');
    var pageCount = getInputVal('pageCount');
    var money = getInputVal('money');
    var quantity = getInputVal('quantity');
    var oldID =getInputVal('oldID');
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
      formData.append('publisher1', publisher);
      formData.append('publishedDate1', publishedDate);
      formData.append('isbn1', isbn);
      formData.append('pageCount1', pageCount);
      formData.append('money1', money);
      formData.append('imgValue1', document.getElementById('imgLink').src);
      formData.append('quantity1', quantity);
      formData.append('oldID', oldID);

      var formData1 = new FormData();
      formData1.append('isbn', isbn);
      formData1.append('quantity1', quantity);
      formData1.append('oldID', oldID);

      

    /*$.ajax({
        type: "POST",
        url: "addBook/copiesDB.php",
        data: formData1,
    type: 'POST',
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    //Other options
    });*/

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

