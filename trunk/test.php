<?php
require('inc/fpdf.php');
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{
//Page header
function Header()
{
    /*
    //Logo
    $this->Image('../rootbg2.jpg',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(60,10,'to je vedno zgoraj.... ',1,0,'C');
    //Line break
    $this->Ln(20);
    */
}

//Page footer
function Footer()
{
    /*
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
*/
	}
}

/**
 * spacer function
 * 
 * adds spaces to the letters 
 *
 */
 
function spacer($text,$number = 5, $small=5 ) //$number=number of spaces,  $small=character after small space is inserted
  {
	
	if ($text) { 
		//set up spacer//
		for ($i = 0; $i < $number; $i++)
		{
			$spacer.=" ";
			
		}
		//spacer smaller//
		$len_space = strlen($spacer);
		$spacer_small =  substr ( $spacer , 0, $len_space - 1 );
		
		$len = strlen($text);
		//add spaces to the text//
		$x=0;
		for ($i = 0; $i < $len ; $i++)
			{
				$out .= $text[$i];
				if ($x == $small ) {
					$out .= $spacer_small;
					$x=0;
				} else 
					$out .= $spacer;
				$x++;
			}
		//return modified text//
		return $out;
			
	} else  return false;
}
 
$SUMNIKI ="ŠČĆŽĐščćžđ";
$text = iconv("UTF-8//TRANSLIT", "iso-8859-2", $SUMNIKI);
//
//
//$text = iconv("iso-8859-1", "iso-8859-2", $SUMNIKI);

//test Šumnikov


 
///koliko bomo pomaknili vse v desno//
$XOF = 26;
$LN_DEFAULT = 5;

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('img/obrazec.jpg', 0, 0, 197, 297);

//$pdf->AddFont('luxisb','','luxisb.php');

$pdf->AddFont('Arial','','Arial.php');

$pdf->SetFont('Arial','',8);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
//NAziv in sedez 
$pdf->SetXY($XOF+35, 15);
$pdf->Cell(0,0,"Root d.o.o., cesta v $text 10 3320 velenje",0,0,'L');
//$pdf->MultiCell(65, 4,'sss', '', 'TL',0);
$pdf->Ln($LN_DEFAULT);
$pdf->SetXY($XOF+13, $pdf->getY());
//napisemo davcno//

$pdf->Cell(0,0,spacer("123456789123",4,3),0,0,'L');
//nova vrsta
$pdf->Ln($LN_DEFAULT);
$pdf->SetXY($XOF+30, $pdf->getY());
//gospodarska dejavnost//
$pdf->Cell(0,0,'Struzenje in gledanje',0,0,'L');






//output of the PDF//
$pdf->Output("test.pdf","I");
?>