<?php
   require('fpdf.php');
   $name = $_POST["pat"];
   $refer =  $_POST["refer"];
   $numberOfTest = $_POST["hiddens"] - 1;
   $gender = $_POST["gender"];
   $age = $_POST["age"];
   $user = $_POST["hiddens2"];
   $discount = $_POST["discount"];
   
   //echo $name ." ".$refer."  ".$age."  ". $numberOfTest . " ". $user ." ".$discount;
   $testNames = [$numberOfTest];
   $price = [$numberOfTest];
   $duration = [$numberOfTest];
   for ($i=0; $i < $numberOfTest; $i++) 
   {
       $a = $i+1; 
       $testNames[$i]=$_POST["testname".$a];
       $price[$i] = $_POST["price".$a];
       $duration[$i] = $_POST["duration".$a];

   }
   $disprice = array_sum($price) * $discount / 100 ;
   $GrandTotal  = array_sum($price) - $disprice;
    require ('databaseconnection.php');
    $sql ="insert into customer(name,gender,user,referby,testcount)values('$name','$gender','$user','$refer','$numberOfTest')";
    $result = $conn->query($sql);

    $sql = "select id from customer";
    $result = $conn->query($sql);
    $lastId;
    while($row=$result->fetch_assoc())
    {
      $lastId=$row["id"];
    }
    for( $b=0; $b<$numberOfTest; $b++ )
    {
      $sql ="insert into patienttest(pid,testName)values('$lastId','$testNames[$b]')";
      $result = $conn->query($sql);
    }
    $sumprice = array_sum($price);
    $date = date("Y-m-d");
    $sql ="insert into recepdetail(user,totalamount,Discount,Grandtotal,Date)values('$user',' $sumprice','$discount','$GrandTotal','$date')";
    $result = $conn->query($sql);

   class PDF extends FPDF
   {
// Page header
  function Header()
  {
    // Logo
    $this->Image('logo.jpeg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Ali Diagnostic Center',0,0,'C');
    $this->Ln(8);
    $this->Cell(88);
    $this->SetFont('Arial','B',6);
    $this->Cell(10,5,'Khawaja Plaza,Near King Abdullah Teaching Hospital,Mansehra',0,0,'C');
    // Line break
    $this->Ln(13);
  }

  // Colored table
function FancyTable($header, $names, $price , $duration)
{
    $this->cell(20);
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header

    $w = array(40, 35, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    $this->cell(20);
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    for ($i=0; $i < count($names); $i++) { 
        $this->Cell($w[0],6,$names[$i],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$price[$i],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$duration[$i],'LR',0,'L',$fill);
        //$this->Cell($w[2],6,,'LR',0,'R',$fill);
        
        $this->Ln();
        $this->cell(20);
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->addPage();
$pdf->AliasNbPages();

$pdf->SetFont('Times','B',10);
$pdf->cell(120);
$pdf->cell(10,5,"Patient Id: ".$lastId);
$pdf->Ln(6);

$pdf->SetFont('Times','B',10);
$pdf->cell(120);
$pdf->cell(10,5,"Patient Name: ".$name);

$pdf->Ln(6);
$pdf->cell(120);
$pdf->cell(10,5,"Age:                  ".$age);

$pdf->Ln(6);
$pdf->cell(120);
$pdf->cell(10,5,"Gender:                  ".$gender);

$pdf->Ln(6);
$pdf->cell(120);
$pdf->cell(10,5,"Refer By:         ".$refer);

$pdf->Ln(6);
$pdf->cell(120);
$pdf->cell(10,5,"Printed By:         ".$user);

$pdf->Ln(15);

$header = array('Test Name', 'Price (RS)', 'Duration');
$data= array();
$pdf->FancyTable($header,$testNames,$price,$duration);

$pdf->SetFont('Times','B',10);

$pdf->Ln(8);
$pdf->cell(120);
$pdf->cell(10,5,"Total Amount:".array_sum($price));



$pdf->Ln(8);
$pdf->cell(120);
$pdf->cell(10,5,"Discount:".$discount."%");

$pdf->Ln(8);
$pdf->cell(120);
$pdf->cell(10,5,"Grand Total:".$GrandTotal);


$pdf->Ln(8);
$pdf->cell(5);
$pdf->cell(10,5,"If you have any complaint regarding to service or any other fell free to contact us at complaint.ADS@gamil.com");

$pdf->Output();

?>