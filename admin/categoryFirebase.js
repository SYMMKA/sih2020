var categoryInfo = {
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
}

function category() {

    var mainCategorySelect = document.getElementById("mainCategorySelect");
    var subCategorySelect = document.getElementById("subCategorySelect");

    //Load main categories
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