<fieldset class="shadowcontainer">
    <h3>Končanje aktivnosti:</h3>

    ##NSTART_LOG##

    <form name="vdc_send_##FORM_NUM##" id="vdc_send_##FORM_NUM##" method="get">
        <div id="span_send_msg_##FORM_NUM##" class="warning">


            <fieldset>
                <div class="span-22">



                    <div class="span-19">

                        <h4><b class="red">##NAMEDROPSTOP##</b> | aktivnost: <b>##ACTIVITYSTOP##</b>; <!--  pričetek ob: <b>##NSTART## --></b></h4>
                    </div>

                    <div class="span-3 last">
                        <!-- @todo TU JE BUG z input dela - kako naj naredim da bo samo tekst-->
                        <h4> št. zapisa:<input type=text id="nid" name="nid" value="##NID##">
                        </h4>

                    </div>

                    <div class="span-3">
                        <label>Čas neaktvnosti:</label><br>
                        ##PAUSEHOUR## <b>:</b> ##PAUSEMINUTES##
                    </div>

                    <div class="span-2">
                        <label>Ocena:</label><br>
                        ##RATING##
                    </div>
                    <div class="span-7">
                        <label>Cilj:</label><br>
                    </div>
                    <div class="span-8 last">
                        <label>Opomba:</label><br>
                        <textarea class="htmltextarea" name="stopactivitytekst" id="stopactivitytekst">##DDESCRIPTION##</textarea>
                    </div>


                </div>
                <div class="push-20 last">
                    <input name="##EDITFORMNAME##" value="Končaj" onclick="send_req('span_send_msg_##FORM_NUM##','send_data.php',text_ok, text_error, ##FORM_NUM##); return false;" type="submit">
                </div>
            </fieldset>
        </div>
    </form>

    ##NSTOP_LOG##

</fieldset>



