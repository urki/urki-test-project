
<form id="activity1" name="activity1" action="activity.php" onkeypress="return submitenter(this,event)" method="post" accept-charset="utf-8">


    <fieldset class="shadowcontainer">
        <div class="span-16">
            <h3>Vnos aktivnosti:</h3>
            <div class="span-6">
                <label>Izbor osebe:</label><br>
                ##MULTINAME##
            </div>
            <div class="span-9 last">
                <label>Aktivnost:</label><br>
                ##ACTIVITY##
            </div>
            <div class="push-13" id="activity1add">
                 <input name="add" id="add" value="    Vstavi    " type="submit">
            </div>
        </div>
    </fieldset>
</form>

<script type="text/javascript">
    document.activity1.multiname_drop.focus();
</script>






