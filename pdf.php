<?php

require_once('Zend/Pdf.php');
//create new pdf
$pdf =new Zend_Pdf();


$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
$pdf->pages[] = $page;

//
//set font
$page->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA),20);

// Draw text
$page->drawText('Hello world!', 100, 510);

//get pdf document
$pdfData=$pdf->render();

header("Contenr-Dispostion: incline; filename=result.pdf");
header("Content-type: application/x-pdf");
//echo $pdfData;

$this->_helper->layout()->disableLayout();
$this->_helper->viewRenderer->setNoRender();
echo $pdf->render();
echo $pdfData;

?>
