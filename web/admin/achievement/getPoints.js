$.ajax({
  type: "POST",
  url: "achievement/points.php",
  type: "POST",
  contentType: false, // Dont delete this (jQuery 1.6+)
  processData: false, // Dont delete this
  success: function (data) {
    if (data) {
      data = JSON.parse(data);
      
      var html = `<div class="table-responsive"><table data-sortable id="leaderboard" class="table table-bordered table-hover">
      <caption>Leaderboard</caption>
      <thead>
      <tr>
          <th scope="col">
              Student ID</th>
          <th scope="col">
              Name</th>
          <th scope="col">
              Email</th>
          <th scope="col">
              Mobile</th>
          <th scope="col">
              Points</th>
      </tr>
      </thead>
      <tbody>`;
      data.forEach(function (item, index) {
        html +=
          `<tr>
          <td>` +
          item.stud_ID +
          `</td>
          <td>` +
          item.name +
          `</td>
          <td>` +
          item.email +
          `</td>
          <td>` +
          item.mobile +
          `</td>
          <td>` +
          item.points +
          `</td>
          </tr>`;
      });
      html += `</tbody>
      </table></div>`;
    } else {
      var html = "No students";
    }
    document.getElementById("achievementData").innerHTML = html;
    Sortable.init();
  },
  //Other options
});
