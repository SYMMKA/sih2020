function autoFillDeleteCopy(copyID, i) {
    var html = '';
    html += `<input type="hidden" id="deleteCopyID"></label>`;
    document.getElementById('deleteCopyFormDiv').innerHTML = html;
    document.getElementById('deleteCopyID').textContent = copyID;
    document.getElementById('elementID').value = i;
}