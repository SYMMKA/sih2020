function autoFillDeleteCopy(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById('issueBook').hidden = true; //hides issue book page
    document.getElementById('returnBook').hidden = true; //hides return book page
    document.getElementById('updateBook').hidden = true; //shows update book page
    document.getElementById('deleteCopy').hidden = false; //hides return book page
    var formData = new FormData();
    formData.append('isbn', isbn[i]);
    $.ajax({
        type: "POST",
        url: "deleteCopy/copies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function(data) {
                var data = JSON.parse(data);
                var html = '';
                data.forEach(function(item, index) {
                    html += `<div class="col-sm-3">
        <div class="card text-center" style="border:none;">
            <div class="card-body text-white" style="background-color: #393e46">
                <h5 class="card-title">` + item.copyno + `</h5>
                <h6 class="card-subtitle mb-2 text-muted">ISBN: ` + item.copyID + `</h6>
                <h6 class="card-subtitle mb-2 text-muted">` + item.oldID + `</h6>
            </div>
            <div class="card-footer" style="border:none; background-color: #393e46 ">
                <div class="col-auto">
                <button type="submit" class="button scrolly" name="deleteCopyCopy" onclick="autoFilldeleteCopyCopy('` + item.copyID + `')">
                        Delete Copy
                    </button>
                </div>
            </div>
        </div>
    </div>`;
                    document.getElementById("deleteCopyCopies").innerHTML = html;
                })
            }
            //Other options
    });
}

function autoFilldeleteCopyCopy(copyID) {
    document.getElementById('deleteCopyID').textContent = copyID;
}