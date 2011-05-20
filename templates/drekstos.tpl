<form action="NEWaktivnosti.php" method="post" accept-charset="utf-8">


    <fieldset class="shadowcontainer">
        <legend></legend>
        <div class="span-24">
            <h3>Vnos aktivnosti:</h3>
            <div class="span-24">
                <div class="span-16">

                    <div class="span-5">
                        <label>Izbor osebe:</label><br>
                        ##NAMES##
                    </div>
                  ##IF_ADMIN##
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
                  ##IF_ADMIN##
                    <div class="span-9 clear">
                        <label>Aktivnost:</label><br>
                        ##WORK##
                    </div>
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
                    <div class="span-3">
                        <label>Ocena:</label><br>
                        ##RATING##
                    </div>
                </div>
                <div class="span-8 last">
                    <label>Opomba:</label><br>
                    <textarea name="note" id="note" cols="49" rows="1"></textarea>
                </div>
                <div class="span-24">
                    <div class="push-17 last" id="activity1add">
                        <input name="add" id="add" value="    Shrani    " type="submit">
                    </div>
                </div>

            </div>
        </div>

    </fieldset>
</form>
