<form action="aktivnosti.php" method="post" accept-charset="utf-8">


    <fieldset class="shadowcontainer clear">
        <legend></legend>
        <div class="span-24">
            <h3>Vnos aktivnosti zaposlenih:</h3>
            <div class="span-24">
                <div class="span-16">

                  ##IF_ADMIN##
                    <div class="span-5">
                        <label>Izbor osebe:</label><br>
                        ##WNAME_DROP##
                    </div>
                    <div class="span-1">
                        <label>Dan:</label><br>
                        ##WADAY##
                    </div>
                    <div class="span-2">
                        <label>Mesec:</label><br>
                        ##WAMONTH##
                    </div>
                    <div class="span-3 last">
                        <label>Leto:</label><br>
                        ##WAYEAR##
                    </div>
                  ##IF_ADMIN##
                     <div class="span-8 clear">
                        <label>Aktivnost:</label><br>
                       ##WWORK_DROP##
                    </div>
                    <div class="span-5 last">
                        <label>Izbor lokacije:</label><br>
                        ##WLOCATION_DROP##
                    </div>
                     <div class="span-3 clear">
                        <label>Začetek:</label><br>
                        ##WSTARTTIMEHOUR##/##WSTARTTIMEMIN##
                    </div>
                    <div class="span-3 last">
                        <label>Konec:</label><br>
                        ##WSTOPTIMEHOUR##/##WSTOPTIMEMIN##
                    </div>
                </div>
                <div class="span-8 last">
                    <label>Opomba:</label><br>
                    <textarea name="noteemploy" id="noteemploy" cols="49" rows="1"></textarea>
                </div>
                <div class="span-24">
                    <div class="push-17 last" id="activityemploadd">
                        <input name="addemploy" id="addemploy" value="   Shrani   " type="submit">
                    </div>
                </div>

            </div>
        </div>

    </fieldset>
</form>