
<form name="edit" id="edit" action="activity.php" onkeypress="return submitenter(this,event)" method="post" accept-charset="utf-8">


    <fieldset class="shadowcontainer">
        <h3>Pripravljeni za začetek aktivnosti:</h3>
        <div class="span-23">


            <div class="span-2">
                <label>ID:</label><br>
            </div>
            <div class="span-5">
                <label>Ime in priimek:</label><br>
            </div>
            <div class="span-7 last">
                <label>Aktivnost
                </label>
            </div>


        </div>
          ##DSTART_LOG##
        <div class="span-22">
            <div class="span-2">
             <input readonly size="3" type=text name="did[]" class="textbox_green" id="did" value=##DID## >
            </div>
            <div class="span-5">
                ##NAMEDROP##
            </div>
            <div class="span-7 last">
                ##ACTIVITYSTART##
            </div>
        </div>
          ##DSTOP_LOG##
          <div class="push-20 last">
               ##BUTTON##
          </div>  
    </fieldset>
</form>
