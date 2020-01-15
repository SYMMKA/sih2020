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

/*var categoryInfo = {
  "Technology": {
    "Artificial Intelligence": ["TECH-AI"],
    "Database Design": ["TECH-DD"],
    "Electronics and Applications": ["TECH-EA"],
    "Network": ["TECH-NT"],
    "Programming": ["TECH-PG"],
    "Software Engineering": ["TECH-SE"],
    "System Programming": ["TECH-SP"]
  },
  "General Science and Humanities": {
    "Physics": ["GSH-PHY"],
    "Chemistry": ["GSH-CHEM"],
    "Maths": ["GSH-MAT"]
  },
  "Fiction": []
}*/

function category() {

    var mainCategorySelect = document.getElementById("mainCategorySelect");
    var subCategorySelect = document.getElementById("subCategorySelect");

    //Load main categories
    firebase.database().ref().on('value', function (snapshot) {
        categoryInfo = snapshot.val();
        displayCat(categoryInfo, mainCategorySelect, subCategorySelect);
    });;

}

function displayCat(categoryInfo, mainCategorySelect, subCategorySelect) {
    for (var mainCategory in categoryInfo) {
        mainCategorySelect.options[mainCategorySelect.options.length] = new Option(mainCategory, mainCategory);
    }

    //Main Category Changed
    mainCategorySelect.onchange = function () {

        document.getElementById('bookId').value = ""; //resets bookID
        subCategorySelect.length = 1; // remove all options bar first

        console.log(this.selectedIndex);
        if (this.selectedIndex < 1)
        {
            document.getElementById('subCategorySelect').hidden = true;
            return; // done
        }

        var check = categoryInfo[this.value];
        if (check.length == 0) // hides sub category if not available
            document.getElementById('subCategorySelect').hidden = true;
        else
            document.getElementById('subCategorySelect').hidden = false;
        for (var subCategory in categoryInfo[this.value]) {
            subCategorySelect.options[subCategorySelect.options.length] = new Option(subCategory, subCategory);
        }
    }

    subCategorySelect.onchange = function () {

        document.getElementById('bookId').value = ""; //resets bookID
        if (this.selectedIndex < 1)
            return; // done
        var categoryID = categoryInfo[mainCategorySelect.value][this.value];
        document.getElementById('bookId').value = categoryID;

    }
}


function editCategory() {

    var category = docuement.getElementById('category').value;
    var rootRef = firebase.database().ref('web-symmka');
    var newMessageRef = rootRef.child(category);
    newMessageRef.set({
        author: category
    });

}