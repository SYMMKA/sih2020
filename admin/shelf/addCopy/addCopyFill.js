function addCopyFill(i) {
  var formData = new FormData();
  formData.append("isbn", isbn[i]);
  $.ajax({
    type: "POST",
    url: "addCopy/showAddCopies.php",
    data: formData,
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      var html = "";
      html += `<div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row" id='displayBookCopies'>`;
      if (data) {
        var data = JSON.parse(data);
        data.forEach(function (item, index) {
          html +=
            `
                    <div class="col-sm-3">
                      <div class="card text-center" style="border:none;">
                        <div class="card-body text-white" style="background-color: #393e46">
                          <h5 class="card-title">` +
            item.copyno +
            `</h5>
                          <h6 class="card-subtitle mb-2 text-muted">Copy ID: ` +
            item.copyID +
            `</h6>
                          <h6 class="card-subtitle mb-2 text-muted">` +
            item.oldID +
            `</h6>
                          <h6 class="card-subtitle mb-2 text-muted">Shelf ID: ` +
            item.shelfID +
            `</h6>
                        </div>
                        <div class="card-footer" style="border:none; background-color: #393e46 ">
                          <div class="col-auto">`;
          if (item.shelfID == shelfID)
            html +=
              `
                            <button type="submit" onclick="removeCopy('` +
              item.copyID +
              `','` +
              i +
              `')">
                              Remove`;
          else {
            html +=
              `             <button type="submit" onclick="addCopy('` +
              item.copyID +
              `','` +
              i +
              `')">`;
            if (item.shelfID == null) html += `Add to Shelf`;
            else html += `Change Shelf`;
          }
          html += `</button>
                          </div>
                        </div>
                      </div>
                    </div>`;
        });

        html += `
                          

                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>`;
        document.getElementById("displayBookCopies").innerHTML = html;
      }
    },
    //Other options
  });
}

function addCopy(copyID, i) {
  var formData = new FormData();
  formData.append("copyID", copyID);
  formData.append("shelfID", shelfID);
  $.ajax({
    type: "POST",
    url: "addCopy/addCopyShelf.php",
    data: formData,
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      addCopyFill(i);
    },
  });
}

function removeCopy(copyID, i) {
  var formData = new FormData();
  formData.append("copyID", copyID);
  $.ajax({
    type: "POST",
    url: "removeCopy.php",
    data: formData,
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      addCopyFill(i);
    },
    //Other options
  });
}
