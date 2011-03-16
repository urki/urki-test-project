
<form name="edit" id="edit" action="activity.php" onkeypress="return submitenter(this,event)" method="post" accept-charset="utf-8">
<form action="add_user.php" method="post" accept-charset="utf-8" onkeypress="return submitenter(this,event)">

    <div class="span-22">
          <h3>Osebni podatki:</h3>
    <div class="span-15 last">
          <fieldset class="shadowcontainer">
               <label>Ime in priimek:</label><br />
          </fieldset>  
      </div>
          <div class="span-6">
              <fieldset class="shadowcontainer">
                  ##PERSONS_START##
                  
                  <table>
                      ##NAMEDROP##
                  </table>
                  ##PERSONS_STOP##
                  <label>Ime in priimek:</label><br />
          </fieldset>
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







<form action="add_user.php" method="post" accept-charset="utf-8">
 <table width="287" border="0">
      <tr>
        <td width="41" class="text">Username:</td>
        <td width="236" class="text">
          <input type="text" name="username" id="jobtype" /></td>
      </tr>
      <tr>
        <td class="text">Password:</td>
        <td class="text"><input type="password" name="password" /></td>
      </tr>
      <tr>
        <td class="text">first name:</td>
        <td class="text"><input type="text" name="first" /></td>
      </tr>
      <tr>
        <td class="text">last name:</td>
        <td class="text"><input type="text" name="last" /></td>
      </tr>
      <tr>
        <td class="text">Jobtype:</td>
        <td class="text"><label>##ROLE_DROPDOWN##</label></td>
      </tr>
      <tr>
        <td colspan="2"><label>
          <input name="add" type="submit" class="text" id="add" value="Dodaj" />
        </label></td>
      </tr>
    </table>
</form>
