<form action="##SELF##" method="POST">
oseba: ##NAME_DROP##
<input type="submit" name="prikazi" value="prikazi">
</form>
<br>
<br>


<form id="add" name="add" action="aim.php" onkeypress="return submitenter(this,event)" method="post" accept-charset="utf-8">


    <fieldset class="shadowcontainer">
        <div class="span-23">
            <h3>Vnos ciljev:</h3>
            <div class="span-6">
                <label>Izbor osebe:</label><br>
                ##ADDPERSONDROP##
            </div>
             <div class="span-8">
                <label>Cilj (kratko ime):</label><br>
                ##ADDACTIVITYNAME##
            </div>
             <div class="span-9 last">
                <label>Aktivnost: (na akterose navezuje)</label><br>
                ##ADDACTIVITY##
            </div>
              <div class="span-6">
                <label>Nosilec:</label><br>
                ##ADDRESPONSNAME##
            </div>
              <div class="span-6">
                <label>Trajanje: (ur)</label><br>
                ##ADDDURATION##
            </div>
            <div class="span-6">
                <label>Predviden datum:</label><br>
                ##ADDDATE##
            </div>
            

            <div class="span-16">
                <label id=htmltextarea>Opis:</label><br>
                   ##ADDDESCRIPTION##
            </div>

          
            <div class="push-3" id="aimadd">
                 <input name="add" id="add" value="    Vstavi    " type="submit">##MESSAGE##
            </div>
        </div>
    </fieldset>
</form>

    <script type="text/javascript">
            document.id.responsible_drop.focus();
        </script>

