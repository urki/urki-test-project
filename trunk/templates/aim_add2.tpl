<form action="##SELF##" method="POST">
oseba: ##NAME_DROP##
<input type="submit" name="prikazi" value="prikazi">
</form>
<br>
<br>


<form ##STYLEHIDDEN## id="add" name="add" action="aim2.php" onkeypress="return submitenter(this,event)" method="get" accept-charset="utf-8">


    <fieldset  class="shadowcontainer ">
        <div class="span-23">
            <h3>Vnos ciljev ##FIRST##   ##LAST##:</h3>
            <div class="span-6">                 
                <input type="hidden" name="ime" value="##IME##">
             </div>
             <div class="span-8">
                <label>Cilj (kratko ime cilja):</label><br>
                ##ADDACTIVITYNAME##
            </div>
             <div class="span-9 last">
                <label>Aktivnost: (na katero se navezuje)</label><br>
                ##ADDACTIVITY##
            </div>
              <div class="span-6">
                <label>Nosilec:</label><br>
                ##ADDRESPONSNAME##
            </div>
              <div class="span-2">
                <label>Trajanje: (ur)</label><br>
                ##ADDDURATION##
            </div>
            <div class="span-6">
                <label>Predviden datum:</label><br>
                ##ADDDATE## <hr>
            </div>           
            <div class="span-6 last">
                <label id=htmltextarea>Opis:</label><br>
                   ##ADDDESCRIPTION##
            </div>         
            <div class="" align=right id="aimadd">
                 <input name="add" id="add" value="    Vstavi    " type="submit">##MESSAGE##
            </div>
        </div>
    </fieldset>
</form>

    <script type="text/javascript">
            document.id.responsible_drop.focus();
        </script>

