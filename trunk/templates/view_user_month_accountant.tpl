<table width="668" border="1">
  <tr>
    <td width="140" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center"><span class="style4">Ime in Priimek</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Delovnih dni</span></div></td>
 <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Delovnih ur</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Bolni&scaron;kih dni</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Bolni&scaron;kih ur</span></div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Dopust dni</span></div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Dopust ur</span></div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Nega</div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Nega ur</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Izob.</div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Izob. ur</div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Porod.</div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Porod.ur</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Sluz. p.</td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Sluz. p. ur</td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Krv</td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Krv. ur</td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Stanje ur</div></td>
        <td width="40"  bgcolor="#999999" class="text"><div align="center">Ostane dopusta</td>
  </tr>
##START_LOG##  
<tr>
    <td  width="140" align="center" class="text"  ><div align="center"><strong>##FIRST## ##LAST##</strong></div></td>
    <td width="40" align="center" class="text" ><div align="center">##WORKING_DAYS##</div></td>
    <td width="40" align="center" class="text" ><div align="center">##WORKING_HOURS##</div></td>
    <td width="40" align="center" class="text" ><div align="center">##SICK_DAYS##</td>
    <td width="40" align="center" class="text" ><div align="center">##SICK_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##HOLIDAY_DAYS##</td>
    <td width="40" align="center" class="text" ><div align="center">##HOLIDAY_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##CARE##</td>
    <td width="40" align="center" class="text" ><div align="center">##CARE_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##EDUCATION##</td>
    <td width="40" align="center" class="text" ><div align="center">##EDUCATION_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##PREGNANCY##</td>
    <td width="40" align="center" class="text" ><div align="center">##PREGNANCY_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##MISSION_DAYS##</td>
    <td width="40" align="center" class="text" ><div align="center">##MISSION_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##BLOODAY##</td>
    <td width="40" align="center" class="text" ><div align="center">##BLOODAY_HOURS##</td>
    <td width="40" align="center" class="text" ><div align="center">##HOURS_LEFT##</td>
    <td width="40" align="center" class="text" ><div align="center">##HOLID_ALL_RES##</td>
</tr>
##STOP_LOG##
</table>

##IF_SAVE##
<form action="##SELF##" method="POST">
	<input type="hidden" name="unit" value="##UNIT##">
	<input type="hidden" name="save" value="true">
	<input type="submit" name="Poslji porocilo" value="Poslji porocilo">
</form>
##IF_SAVE##

