
<form action="user_add.php" method="post" accept-charset="utf-8">
 <table width="287" border="0">
      <tr>
        <td width="41" class="text">Uporabnisko ime:</td>
        <td width="236" class="text">
          <input type="text" name="username" id="jobtype" /></td>
      </tr>
      <tr>
        <td class="text">Geslo:</td>
        <td class="text"><input type="Geslo" name="password" /></td>
      </tr>
      <tr>
        <td class="text">Ime:</td>
        <td class="text"><input type="text" name="first" /></td>
      </tr>
      <tr>
        <td class="text">Priimek:</td>
        <td class="text"><input type="text" name="last" /></td>
      </tr>
      <tr>
        <td class="text">Skupina:</td>
        <td class="text"><label>##ROLE_DROPDOWN##</label></td>
      </tr>
      <tr>
        <td colspan="2"><label>
          <input name="add" type="submit" class="text" id="add" value="Dodaj" />
        </label></td>
      </tr>
    </table>
</form>
