<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

      $pdf = new Zend_Pdf();

      $page1 = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);

      $page2 = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);

      $page3 = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);

      // Page created, but not included into pages list



      $pdf->pages[] = $page1;

      $pdf->pages[] = $page2;



      $destination1 = Zend_Pdf_Destination_Fit::create($page2);

      $destination2 = Zend_Pdf_Destination_Fit::create($page3);



      // Returns $page2 object

      $page = $pdf->resolveDestination($destination1);



      // Returns null, page 3 is not included into document yet

      $page = $pdf->resolveDestination($destination2);



      $pdf->setNamedDestination('Page2', $destination1);

      $pdf->setNamedDestination('Page3', $destination2);


        // Returns $destination2

      $destination = $pdf->getNamedDestination('Page3');



      // Returns $destination1

      $pdf->resolveDestination(Zend_Pdf_Destination_Named::create('Page2'));



      // Returns null, page 3 is not included into document yet

      $pdf->resolveDestination(Zend_Pdf_Destination_Named::create('Page3'));
?>
