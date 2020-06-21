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
      html +=
        `<div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">` +
        title[i] +
        `</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row row-cols-1 row-cols-md-3" id='displayBookCopies' style="height: 500px; overflow-y: scroll;">`;
      if (data) {
        console.log(data);
        var data = JSON.parse(data);
        data.forEach(function (item, index) {
          html +=
            `
            
              <div class="col mb-4">
                <div class="card h-100">
                  <div class="card-body" style="padding: 1rem;">
                    <h4 class="card-title text-center"><strong>Copy No: </strong>` +
            item.copyno +
            `</h4>
                    <p class="card-text">                   
                   <div class="row no-gutters">
                        <div Class="col-4">
                        <strong>Copy ID: </strong>
                        </div>
                        <div Class="col-8">
                        ` +
            item.copyID +
            `
                        </div></br>
                    </div>

                    <div class="row no-gutters">
                        <div Class="col-4">
                        <strong>ISBN: </strong>
                        </div>
                        <div Class="col-8">
                        ` +
            isbn[i] +
            `
                        </div></br>
                    </div>

                    <div class="row no-gutters">
                        <div Class="col-4">
                        <strong>Old ID: </strong>
                        </div>
                        <div Class="col-8">
                        ` +
            item.oldID +
            `
                        </div></br>
                    </div>

                    <div class="row no-gutters">
                        <div Class="col-4">
                        <strong>Shelf ID: </strong>
                        </div>
                        <div Class="col-8">
                        ` +
            item.shelfID +
            `
                        </div></br>
                    </div></p></div>
                         <div class="card-footer bg-white">
          <div class="row text-center">
                          <div class="col-12">`;
          if (item.shelfID == shelfID)
            html +=
              `
                            <button type="submit" class="btn btn-info" onclick="removeCopy('` +
              item.copyID +
              `','` +
              i +
              `')">
                              Remove`;
          else {
            html +=
              `             <button type="submit" class="btn btn-info" onclick="addCopy('` +
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
