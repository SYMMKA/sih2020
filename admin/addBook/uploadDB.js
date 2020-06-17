// Listen for form submit
document.getElementById('addBookForm').addEventListener('submit', addBook);

// Submit form
function addBook(e) {
    e.preventDefault();

    // Get values
    var title = getInputVal('title');
    var author = getInputVal('author');
    var publisher = getInputVal('publisher');
    var publishedDate = getInputVal('publishedDate');
    var isbn = getInputVal('isbn');
    var pageCount = getInputVal('pageCount');
    var money = getInputVal('money');
    var quantity = getInputVal('quantity');
    var oldID = getInputVal('oldID');
    var imgValue = document.getElementById('imgValue').value;
    var files = $('#imgFile')[0].files[0];
    
    var mainCategory1 = '';
    var mainCategory2 = '';
    var mainCategory3 = '';
    var mainCategory4 = '';
    if(mainCategorySelect1.value)
        mainCategory1 = mainCategorySelect1.options[mainCategorySelect1.selectedIndex].text
    if(mainCategorySelect2.value)
        mainCategory2 = mainCategorySelect2.options[mainCategorySelect2.selectedIndex].text
    if(mainCategorySelect3.value) 
        mainCategory3 = mainCategorySelect3.options[mainCategorySelect3.selectedIndex].text
    if(mainCategorySelect4.value) 
        mainCategory4 = mainCategorySelect4.options[mainCategorySelect4.selectedIndex].text

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
    formData.append('imgValue1', imgValue);
    formData.append('imgFile', files);
    formData.append('quantity1', quantity);
    formData.append('oldID', oldID);

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
    //document.querySelector('.alert').style.display = 'block';

    // Hide alert after 1.5 seconds
    /* setTimeout(function() {
        document.querySelector('.alert').style.display = 'none';
    }, 1500); */

    // Clear form
    document.getElementById('addBookForm').reset();
}

// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}