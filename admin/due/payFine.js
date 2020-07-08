$.ajax({
  type: "POST",
  url: "due/getdata.php",
  type: "POST",
  contentType: false, // Dont delete this (jQuery 1.6+)
  processData: false, // Dont delete this
  success: function (data) {
    data = JSON.parse(data);
    console.log(data);
    var html = `<div class="table-responsive"><table id="issuedTable" class="table table-bordered table-hover">
    <caption>Click pay when payment is recieved</caption>
    <thead>
    <tr>
        <th scope="col">
            ID</th>
        <th scope="col">
            BookID</th>
        <th scope="col">
            OldID</th>
        <th scope="col">
            CopyID</th>
        <th scope="col">
            StudentID</th>
        <th scope="col">
            Time</th>
        <th scope="col">
            Return Time</th>
        <th scope="col">
            Star</th>
        <th scope="col">
            Fine</th>
        <th scope="col">
            Due</th>
        <th scope="col">
            Pay</th>
    </tr>
    </thead>
    <tbody>`;
    data.forEach(function (item, index) {
      html +=
        `<tr>
        <th scope="row">` +
        item.id +
        `</th>
        <td>` +
        item.bookID +
        `</td>
        <td>` +
        item.oldID +
        `</td>
        <td>` +
        item.copyID +
        `</td>
        <td>` +
        item.stud_ID +
        `</td>
        <td>` +
        item.time +
        `</td>
        <td>` +
        item.returnTime +
        `</td>
        <td>` +
        item.star +
        `</td>
        <td>` +
        item.fine +
        `</td>
        <td>` +
        item.due +
        `</td>
        <td><button type="button" class="btn btn-outline-dark">Pay</button></td>
        </tr>`;
    });
    html += `</tbody>
    </table></div>`;
    document.getElementById("tableData").innerHTML = html;
  },
  //Other options
});
//https://getbootstrap.com/docs/4.5/content/tables/
