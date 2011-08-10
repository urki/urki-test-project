

<fieldset class="shadowcontainer">
    <h3>Cilji izbrane osebe:</h3>
    ##NSTART_LOG##
    <form name="##EDITFORMNAME##" id="##EDITFORMNAME##" action="activity.php" onkeypress="return submitenter(this,event)" method="get" accept-charset="utf-8">

        <fieldset>
            <div class="span-22">



                <div class="span-19">

                    <h4><b>##NLOGS##</b>; aktivnost: <b>##ACTIVITYSTOP##</b>; pričetek ob: <b>##NSTART##</b></h4>
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
                    <textarea name="stopactivitytekst" id="stopactivitytekst" value=##DDESCRIPTION##></textarea>
                </div>
                <div class="span-22"
                <div class="push-20 last">
                    <input name="##EDITFORMNAME##" value="Končaj" type="submit">
                </div>
            </div>
            </div>
        </fieldset>

    </form>

    ##NSTOP_LOG##


</fieldset>

