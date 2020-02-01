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