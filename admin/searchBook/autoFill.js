function autoFillBook(i) {
  document.getElementById("displayBookCopies").innerHTML = "";
  var formData = new FormData();
  formData.append("isbn", isbn[i]);
  $.ajax({
    type: "POST",
    url: "searchBook/copies.php",
    data: formData,
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      var html = "";
      html += `<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload()"aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-4" style="height:500px; overflow-y: scroll;">`;

      if (data) {
        var data = JSON.parse(data);
        data.forEach(function (item, index) {
          html += `
                <div class="col mb-4">
                        <div class="card h-100">`;
          if (imgLink[i]) {
            html +=
              `<img class="card-img-top" src="` +
              imgLink[i] +
              `"
                            alt="Card image cap" style="height:15vw;" />`;
          }
          html +=
            ` <div class="card-body" style="padding: 1rem;">
                            <h5 class="card-title text-center">` +
            title[i] +
            `</h4>
                            <p class="card-text">                   
                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Copy No:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
            item.copyno +
            `
                                </div>
                            </div>
                        <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Old ID:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
            item.oldID +
            `
                                </div>
                            </div>`;
          var reservedBy = "";
          if (item.status == "reserved" && item.returnTime > item.currentTime) {
            html +=
              `<div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Reserved by:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
              item.stud_ID +
              `
                                </div></br>
                            </div>
                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Reserved at:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
              item.time +
              `
                                </div></br>
                            </div>`;
            reservedBy = item.stud_ID;
          } else if (item.status == "issued") {
            html +=
              `<div class="row no-gutters">
                                <div Class="col-4">
                                    <strong>Issued by:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
              item.stud_ID +
              `
                                </div></br>
                            </div>
                            <div class="row no-gutters">
                                <div Class="col-4">
                                    <strong>Issued at:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
              item.time +
              `
                                </div></br>
                            </div>`;
          } else {
            html += `</br>
                            <div class="text-center">
                                <strong>Available</strong></br>
                            </div>`;
          }
          html += `   </p>
                            </div>
                            <div class="card-footer bg-white">
                            <div class="row text-center">
                            <div class="col-12">`;
          if (item.status == "issued") {
            html +=
              `<button type="submit" form="returnBookForm" class="btn btn-info btn-block btn-sm" name="issueReturnCopy" onclick="autoFillReturnBook('` +
              item.copyID +
              `','` +
              item.oldID +
              `')">Return Copy`;
          } else {
            html +=
              `<button type="button" class="btn btn-info btn-block btn-sm" name="issueBookCopy" id="issueBookCopy" onclick="autoFillIssueBook('` +
              item.copyID +
              `','` +
              item.oldID +
              `','` +
              reservedBy +
              `')">Issue Copy`;
          }
          html +=
            `</button>
                    <button type="submit" form="deleteCopyForm" class="btn btn-info btn-block btn-sm" name="deleteCopyCopy" onclick="autoFillDeleteCopy('` +
            item.copyID +
            `')">
                        Delete Copy
                    </button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>`;
        });
      }
      html += `
       </div>
        </div>
                </div>
            </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Understood</button>
				</div>
			</div>`;
      document.getElementById("displayBookCopies").innerHTML = html;
    },
    //Other options
  });
}
