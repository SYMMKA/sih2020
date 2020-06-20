function autoFillIssueBook(copyID, oldID, reservedBy) {
    var html = '';
    html += `</br>
    </br>

    <div class="form-row align-items-center justify-content-center" style="font-size: 50px;">
        <label>Issue Book</label>
    </div>

    <div class="fields">

            <div name="studentDetailsIssue" id="studentDetailsIssue">
                <div class="field">
                    <label>Student ID</label>
                    <input type="text" name="stud_IDIssue" id="stud_IDIssue" placeholder="ID" required/>
                </div>
                <ul class="actions">
                    <li><input type="submit" form="issueBookForm" value="issue" name="issue" class="primary" /></li>
                    <li><input type="reset" value="Clear" /></li>
                </ul>
            </div>

            </br>
    </div>`;
    document.getElementById("issueBookFormDiv").innerHTML = html;
    document.getElementById('displayCopyTitleCopyID').textContent = copyID;
    document.getElementById('displayCopyTitleOldID').textContent = oldID;
    document.getElementById('reservedBy').value = reservedBy;
}