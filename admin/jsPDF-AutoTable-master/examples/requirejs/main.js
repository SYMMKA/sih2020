define(['jspdf', 'jspdf-autotable'], function (jsPDF) {
  return {
    generatePdf: function () {
      var head = [['ID', 'Country', 'Rank', 'Capital']]
      var body = [
        [1, 'Denmark', 7.526, 'Copenhagen'],
        [2, 'Switzerland', 7.509, 'Bern'],
        [3, 'Iceland', 7.501, 'Reykjavík'],
        [4, 'Norway', 7.498, 'Oslo'],
        [5, 'Finland', 7.413, 'Helsinki'],
      ]

      var doc = new jsPDF()
      doc.autoTable({ head: head, body: body })
      doc.save('table.pdf')
    },
  }
})
