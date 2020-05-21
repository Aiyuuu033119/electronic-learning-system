<?php
require("fpdf/fpdf.php");

class myPDF extends FPDF{
    
    function header(){

        $this->Image('icon/icon.png',25,5,20,20);
        $this->SetFont('Arial','B',18);
        $this->Cell(0,10,'Learnmore',0,0,'C');
        $this->SetFont('Arial','B',12);
        $this->Ln(30);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function printInfo(){
        include('connection.php');
        $date=date('d/m/Y');
        $code=$_GET['code'];
        $retrive=mysqli_query($conn,"SELECT * FROM tbl_class INNER JOIN tbl_user_info ON tbl_class.teacherID=tbl_user_info.accID WHERE code='$code' ");
        $fetch=mysqli_fetch_array($retrive);
        $this->SetFont('Arial','B',17);
        $this->Cell(200,5,$fetch['subjects'],0,0,'L');
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,$date,0,0,'R');
        $this->Ln(7);        
        $this->SetFont('Arial','B',12);
        $this->Cell(0,5,'Sir/Maam: '.$fetch['ln'].','.$fetch['fn'],0,0,'L');
        $this->Ln(7);
        $this->Cell(0,5,$fetch['g_s'],0,0,'L');
        $this->Ln(10);       
        $this->Ln(10);       
    }

    function headerTable(){
        include('connection.php');
        $this->SetFont('Arial','B',12);
        $this->Cell(70,20,'Name',1,0,'C');
    
        $code=$_GET['code'];
        $date=date('d/m/Y');
        $x=0;
        $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
        $row=mysqli_num_rows($retrive);
        while($fetch=mysqli_fetch_array($retrive)):
        $x++;
            if($x==$row){
                $this->Cell((15*$row),10,'Date',1,0,'C');
                $this->Cell(20,10,'TOTAL',1,0,'C');
                $this->Cell(0,10,'',0,1,'C');
                $this->Cell(70,10,'',0,0,'C');
                $this->SetFont('Arial','B',8);
                for ($i=1; $i < $row+1; $i++) { 
                    $this->Cell(15,10,$fetch['dates'],1,0,'C');
                }
                $this->SetFont('Arial','B',7);
                $this->Cell(10,10,'Absent',1,0,'C');
                $this->Cell(10,10,'Present',1,0,'C');
            }
            
        endwhile;
        $this->Ln();
    }
    function viewTable(){
        include('connection.php');
        $this->SetFont('Arial','B',12);

        $code=$_GET['code'];
        $date=date('d/m/Y');
        $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
        while($fetch=mysqli_fetch_array($retrive)):

            $this->Cell(70,10,$fetch['ln'].','.$fetch['fn'],1,0,'C');
            
            $x=0;
            $y=0;
            $retrive2=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
            while($fetch2=mysqli_fetch_array($retrive2)):
            
            $retrive3=mysqli_query($conn,"SELECT tbl_attendance.dates,tbl_attendance.stdStatus,tbl_attendance.studentID FROM tbl_class INNER JOIN tbl_attendance ON tbl_class.classID=tbl_attendance.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_attendance.studentID WHERE tbl_class.code='$code' AND tbl_user_info.accID='".$fetch['accID']."' AND tbl_attendance.dates='".$fetch2['dates']."' GROUP BY tbl_attendance.dates ORDER BY tbl_user_info.ln DESC ");
            $row3=mysqli_num_rows($retrive3);
                if($row3==1){
                    $fetch3=mysqli_fetch_array($retrive3);
                    
                    if($fetch3['stdStatus']=='Present'){
                        $this->SetFont('Arial','B',8);
                        $this->Cell(15,10,$fetch3['stdStatus'],1,0,'C');
                        $x++;
                    }
                    else{
                        $this->SetFont('Arial','B',8);
                        $this->Cell(15,10,$fetch3['stdStatus'],1,0,'C');
                        $y++;
                    }
                } 
                else if($row3!=1){
                    $this->SetFont('Arial','B',8);
                    $this->Cell(15,10,'Absent',1,0,'C');
                    $y++;
                }    
            endwhile;
            $this->SetFont('Arial','B',12);
            $this->Cell(10,10,$y,1,0,'C');
            $this->Cell(10,10,$x,1,1,'C');
        endwhile;
    }
    
}


$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->addPage('L','A4',0);
$pdf->printInfo();
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();

?>