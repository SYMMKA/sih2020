function autoFillDeleteCopy(copyID) {
    var html = '';
    html += `<input type="hidden" id="deleteCopyID"></label>`;
    document.getElementById('deleteCopyFormDiv').innerHTML = html;
    document.getElementById('deleteCopyID').textContent = copyID;
}