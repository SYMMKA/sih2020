<!-- https://www.phpflow.com/php/generate-pdf-file-mysql-database-using-php/ (refer this) -->
<?php
//include connection file 
include("../session.php");
include("../db.php");

if ($_POST['query'])
    $query = $_POST['query'];
else
    $query = '';

$stmt = $conn->prepare($query);
$stmt->execute();
$i = 0;
while ($row = $stmt->fetchObject()) {
    $data["id"] = $row->id;
    $data["copyID"] = $row->copyID;
    $data["adminID"] = $row->adminID;
    $data["studentID"] = $row->studentID;
    $data["action"] = $row->action;
    $data["time"] = date('d/m/Y H:i', $row->time);
    $data["bookID"] = $row->bookID;
    $data["oldID"] = $row->oldID;
    $result[] = $data;
}

/* class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        //$this->Image('logo.png',10,-1,70);
        $this->SetFont('Arial', 'B', 10);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80, 10, 'Report', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$display_heading = array('id' => 'ID', 'copyID' => 'CopyID', 'adminID' => 'AdminID', 'studentID' => 'StudentID', 'action' => 'Action', 'time' => 'Time', 'bookID' => 'BookID', 'oldID' => 'OldID',);

$result1 = $conn->query('select * from history limit 1');
$header = array_keys($result1->fetch(PDO::FETCH_ASSOC));

$pdf = new PDF('P', 'mm', 'A4');
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);
foreach ($header as $heading) {
    $pdf->Cell(20, 12, $display_heading[$heading], 1);
}
foreach ($result as $row) {
    $pdf->Ln();
    foreach ($row as $column)
        $pdf->Cell(20, 12, $column, 1);
}
$pdf->Output('F', 'report.pdf', true); */
?>
<!-- <!DOCTYPE html>
<html lang="en">

</html> -->