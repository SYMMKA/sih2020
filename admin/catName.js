function showCategory() {
    var html = `<div class="field half" id="mainCat1">
    <select size="1" name="mainCategorySelect1" id="mainCategorySelect1" class="mainCategorySelect1" required />
    <option value="">-- Select Category--</option>
    </select>
</div>
<div class="field half" id="mainCat2">
    <select size="1" name="mainCategorySelect2" id="mainCategorySelect2" class="mainCategorySelect2" required />
    <option value="">-- Select Category--</option>
    </select>
</div>
<div class="field half" id="mainCat3">
    <select size="1" name="mainCategorySelect3" id="mainCategorySelect3" class="mainCategorySelect3" required />
    <option value="">-- Select Category--</option>
    </select>
</div>
<div class="field half" id="mainCat4">
    <select size="1" name="mainCategorySelect4" id="mainCategorySelect4" class="mainCategorySelect4" required />
    <option value="">-- Select Sub-Category --</option>
    </select>
</div>
<div class="field">
    <button name="cancelCategory" id="cancelCategory" onclick="hideCategory()">Cancel</button>
</div>`;
    document.getElementById('category').innerHTML = html;
    document.getElementById('catDisplay').value = "true";
    loadCategory();
}

function loadCategory() {
    document.getElementById('category').hidden = false;
    var mainCategorySelect1 = document.getElementById("mainCategorySelect1");
    var mainCategorySelect2 = document.getElementById("mainCategorySelect2");
    var mainCategorySelect3 = document.getElementById("mainCategorySelect3");
    var mainCategorySelect4 = document.getElementById("mainCategorySelect4");
    //Load main categories
    for (var mainCategory = 0; mainCategory < test.length; mainCategory++) {
        mainCategorySelect1.options[mainCategorySelect1.options.length] = new Option(test[mainCategory].description, mainCategory);
    }

    //Main Category1 Changed
    mainCategorySelect1.onchange = function() {

            mainCategorySelect2.length = 1; // remove all options bar first
            mainCategorySelect3.length = 1; // remove all options bar first
            mainCategorySelect4.length = 1; // remove all options bar first
            if (this.selectedIndex < 1) {
                document.getElementById('mainCategorySelect2').hidden = true;
                document.getElementById('mainCategorySelect3').hidden = true;
                document.getElementById('mainCategorySelect4').hidden = true;

                return; // done
            }


            if (!test[this.value].subordinates) { // hides sub category if not available

                document.getElementById('mainCategorySelect2').disabled = true;
                document.getElementById('mainCategorySelect3').disabled = true;
                document.getElementById('mainCategorySelect4').disabled = true;
            } else {

                document.getElementById('mainCategorySelect2').disabled = false;
                document.getElementById('mainCategorySelect3').disabled = false;
                document.getElementById('mainCategorySelect4').disabled = false;

                c1();
            }
        }
        //Main Category2 Changed
    mainCategorySelect2.onchange = function() {
            mainCategorySelect3.length = 1; // remove all options bar first
            mainCategorySelect4.length = 1; // remove all options bar first
            if (this.selectedIndex < 1) {
                document.getElementById('mainCategorySelect3').hidden = true;
                document.getElementById('mainCategorySelect4').hidden = true;

                return; // done
            }


            if (!test[mainCategorySelect1.value].subordinates[this.value].subordinates) { // hides sub category if not available

                document.getElementById('mainCategorySelect3').disabled = true;
                document.getElementById('mainCategorySelect4').disabled = true;
            } else {

                document.getElementById('mainCategorySelect3').disabled = false;
                document.getElementById('mainCategorySelect4').disabled = false;

                c2();
            }
        }
        //Main Category3 Changed
    mainCategorySelect3.onchange = function() {


        mainCategorySelect4.length = 1; // remove all options bar first

        if (this.selectedIndex < 1) {
            document.getElementById('mainCategorySelect4').hidden = true;

            return; // done
        }


        if (!test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[this.value].subordinates) { // hides sub category if not available

            document.getElementById('mainCategorySelect4').disabled = true;
        } else {

            document.getElementById('mainCategorySelect4').disabled = false;

            c3();
        }
    }

    mainCategorySelect4.onchange = function() {

    }
}

function hideCategory() {
    document.getElementById('category').innerHTML = '';
    document.getElementById('catDisplay').value = "";
}



function c1() {
    for (var mainCategory = 0; mainCategory < test[mainCategorySelect1.value].subordinates.length; mainCategory++) {
        mainCategorySelect2.options[mainCategorySelect2.options.length] = new Option(test[mainCategorySelect1.value].subordinates[mainCategory].description, mainCategory);
    }
}

function c2() {
    for (var mainCategory = 0; mainCategory < test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates.length; mainCategory++) {
        //var index = parseFloat(test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategory].number);
        //index = Math.floor(index % 10);

        mainCategorySelect3.options[mainCategorySelect3.options.length] = new Option(test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategory].description, mainCategory);
    }
}

function c3() {
    for (var mainCategory = 0; mainCategory < test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates.length; mainCategory++) {
        //var index = parseFloat(test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates[mainCategory].number);
        //index = Math.floor((index % 1) / .1);


        mainCategorySelect4.options[mainCategorySelect4.options.length] = new Option(test[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates[mainCategory].description, mainCategory);
    }
}