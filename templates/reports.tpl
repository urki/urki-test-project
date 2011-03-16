	<h4>POROČILA ZAPOSLENIH</h4>
	<ul>
	##IF_EMPLOYED##
		<li><a href="view_user_log.php" class="text"><b>Lastna evidenca prisotnosti</b></a><br></li>
	##IF_EMPLOYED##	
        ##IF_LEADER##
		<li><a href="view_user_month.php" class="text"><B>Mese&#269;na evidenca prisotnost OE</B></a></li>
        ##IF_LEADER##
        ##IF_LEADER##
        ##IF_LEADER##
        ##IF_LEADER##  
                <li><a href="view_user_diary.php" class="text"><B>Mesečni pregled vnosov v evidenco prisotnosti</B></a></li>
                <li><a href="view_user_log_hours_dkd.php" class="text" > <b>Pregled delovnih ur DKD</b></a><br></li>
        ##IF_LEADER##
        ##IF_ADMIN##
                 <li><a href="view_report_assessor.php" class="text" > <b>Pregled aktivnosti zaposlenih</b></a><br></li>
                
        ##IF_ADMIN##
	</ul>


        <h4>POROČILA UPORABNIKOV</h4>
	<ul>
	   ##IF_EMPLOYED##
                <li><a href="view_client_diary.php"  class="text"> <b>Mesečni pregled trenutnih aktivnosti uporabnikov</b></a><br></li>
           ##IF_EMPLOYED##
           ##IF_LEADER##
                <li><a href="view_report.php"  class="text"><b> Grafični poročilo uporabnikov</b></a><br></li>
		<li><a href="casetry.php"  class="text"><b> Tabela mesečne prisotnosti uporabnikov</b></a><br></li>
                <li><a href="view_client_work.php"  class="text"> <b>Pregled aktivnosti po uporabniku</b></a><br></li>
           ##IF_LEADER##
		
	</ul>


 <!--##IF_LEADER## <h4>POROČILA ENOTE</h4>
	       <ul>
            	    <li>##IF_EMPLOYED##</li>
		    <li>To show off</li>
		    <li>Because I've fallen in love with my computer and want to give her some HTML loving.</li>
	       </ul> 
 ##IF_LEADER##
--!>



