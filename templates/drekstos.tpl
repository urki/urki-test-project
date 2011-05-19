<form action="NEWaktivnosti.php" method="post" accept-charset="utf-8">



    <fieldset class="shadowcontainer">
        <legend></legend>
        <div class="span-24 showgrid">
            <h3>Vnos aktivnosti:</h3>
            <div class="span-24 showgrid">
                <div class="span-16 showgrid">

                    <div class="span-5">
                        <label>Izbor osebe:</label><br>
                        ##NAMES##
                    </div>
                    <div class="span-5">
                        <label>Ocenjevalec:</label><br>
                        ##ASSNAMES##
                    </div>
                    <div class="span-1">
                        <label>Dan:</label><br>
                        ##ADAY##
                    </div>
                    <div class="span-2">
                        <label>Mesec:</label><br>
                        ##AMONTH##
                    </div>
                    <div class="span-3 last">
                        <label>Leto:</label><br>
                        ##AYEAR##
                    </div>
                    <div class="span-9 clear">
                        <label>Aktivnost:</label><br>
                        ##WORK##
                    </div>
                </div>
                <div class="span-8  showgrid last">
                    <label>Opomba:</label><br>
<textarea name="note" id="note" cols="49" rows="1"></textarea>
                </div>
                <div class="span-24 clear showgrid">
                    <div class="span-3 clear">
                        <label>Začetek:</label><br>
                        ##STARTTIMEHOUR##/##STARTTIMEMIN##
                    </div>
                    <div class="span-3">
                        <label>Konec:</label><br>
                        ##STOPTIMEHOUR##/##STOPTIMEMIN##
                    </div>
                    <div class="span-3">
                        <label>Neaktivno delo:</label><br>
                        ##PAUSEHOURTIME##/##PAUSEMINTIME##
                    </div>
                    <div class="push-7 last" id="activity1add">
                        <input name="add" id="add" value="    Vstavi    " type="submit">
                    </div>
                </div>

            </div>
        </div>

    </fieldset>
</form>


     <table bgcolor="#FFFED2"  BORDER="1" CELLPADDING="10" CELLSPACING="1">
         <td>


               <!--/////Prva vrsta -->
                  <TABLE TABINDEX=-1 bgcolor="#FFFED2" BORDER="1" CELLPADDING="0" CELLSPACING="0">
                    <tr>
                        <td ><iframe src="add_work_emplo.php" TABINDEX=-1 width="900" height="115" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">Nalaganje ...</iframe></td>
                    </tr>
                  </TABLE>
                <!--/////KONEC Prva vrsta -->
                   <TABLE bgcolor="#FFFED2" BORDER="1" CELLPADDING="0" CELLSPACING="0">
                     <tr>
                        <td height=14 bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                     </tr>
                  </TABLE>

                 <!--/////Prva vrsta -->
                     <TABLE bgcolor="#FFFED2" BORDER="1" CELLPADDING="0" CELLSPACING="0">
                      <tr>
                       <strong>Aktivnosti uporabnikov:</strong>
                         
                         <td bgcolor="#FFFED2"  colspan="1" <span class="style6">uporabnik:</span></td>
                         ##IF_ADMIN##
                           <td bgcolor="#FFFED2"   <span class="style6">ocenjevalec:</span></td>
                           <td bgcolor="#FFFED2"><span class="style6">dan</span></td>
                           <td bgcolor="#FFFED2"><span class="style6">mesec</span></td>
                          <td bgcolor="#FFFED2"><span class="style6">leto</span></td>
                         ##IF_ADMIN##
                        <td colspan="2" bgcolor="#FFFED2" ><span class="style6">Aktivnost</span></td>
                       
                      </tr>
                      <tr>
                        <td width="87" bgcolor="#FFFED2">##NAMES##</td>
                        ##IF_ADMIN##
                          <td bgcolor="#FFFED2">##ASSNAMES##</td>
                          <td bgcolor="#FFFED2">##ADAY##</td>
                          <td bgcolor="#FFFED2">##AMONTH##</td>
                          <td bgcolor="#FFFED2">##AYEAR##</td>
                        ##IF_ADMIN##
                        <td bgcolor="#FFFED2"><span class="text">##WORK##</span></td>
                       
                   </TABLE>
                <!--/////KONEC Prva vrsta -->
                <!--/////Druga vrsta -->
                   <TABLE bgcolor="#FFFED2" BORDER="1" CELLPADDING="0" CELLSPACING="0">
                         <tr>
                           <td height=10 bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                        </tr>
                        <tr>
                          <th colspan="2" bgcolor="#FFFED2"><span class="style6">Začetek akt.</span></th>
                          <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                          <th colspan="2" bgcolor="#FFFED2"><span class="style6">Konec akt.</span></th>
                          <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                          <th colspan="2" bgcolor="#FFFED2"><span class="style6">Neakt. čas</span></th>
                        </tr>
                       
                        <tr>
                          <th bgcolor="#FFFED2"><span class="style6">ur</span></th>
                          <th bgcolor="#FFFED2"><span class="style6">min</span></th>
                          <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                          <th bgcolor="#FFFED2"><span class="style6">ur</span></th>
                          <th bgcolor="#FFFED2"><span class="style6">min</span></th>
                          <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                          <th bgcolor="#FFFED2"><span class="style6">ur</span></th>
                          <th bgcolor="#FFFED2"><span class="style6">min</span></th>
                          <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
                          <td colspan="2" height="4" bgcolor="#FFFED2"><span class="style6">ocena</span></td>
                          <th height="4" bgcolor="#FFFED2"><span class="style6">opomba</span></th>
                        </tr>
                        <tr>
                         <td bgcolor="#FFFED2">##STARTTIMEHOUR##</td>
                         <td bgcolor="#FFFED2">##STARTTIMEMIN##</td>
                         <td bgcolor="#FFFED2"><span class="style7">ht</span></td> <!--vmesna kolona za boljši pregled  stop cas-->
                         <td bgcolor="#FFFED2">##STOPTIMEHOUR##</td>
                         <td bgcolor="#FFFED2">##STOPTIMEMIN##</td>
                         <td bgcolor="#FFFED2"><span class="style7">pt</span></td> <!--vmesna kolona za boljši pregled pauza-->
                         <td bgcolor="#FFFED2">##PAUSEHOURTIME##</td>
                         <td bgcolor="#FFFED2">##PAUSEMINTIME##</td>
                         <td bgcolor="#FFFED2"><span class="style7">oc</span></td> <!--vmesna kolona za boljši pregled ocena-->
                         <td bgcolor="#FFFED2">##RATING##</td>
                        <td bgcolor="#FFFED2"><span class="style7">di</span></td> <!--vmesna kolona za boljši pregled ocena-->
                                         
                        <td colspan="11" bgcolor="#FFFED2"><span class="text"> <textarea name="note" id="note" cols="49" rows="1"></textarea></span></td>
                        <td colspan="11" bgcolor="#FFFED2"><span class="text"><input type="submit" name="add" id="add" value="    Shrani    " />##MESSAGE## </span></td>
                     

                      </tr>
                   </TABLE>
                <!--/////KONEC Druga vrsta -->
                <!--/////TRETJA vrsta -->
                   
                <!--/////KONEC TRETJA vrsta -->
                <!--/////TRETJA vrsta -->
                   
                <!--/////KONEC vrsta -->
        </td>
 </table>


</form>