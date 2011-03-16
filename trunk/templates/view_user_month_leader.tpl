<table width="668" border="1">
  <tr>
    <td width="140" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center"><span class="style4">Ime in Priimek</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Delovnih dni</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Bolni&scaron;kih dni</span></div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center"><span class="style4">Dopust dni</span></div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Nadur</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Izhodi</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Nega</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Izobra&#382;.</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Porod.</div></td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Sluzbeno potovanje</td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Krvodaj.</td>
	<td width="40"  bgcolor="#999999" class="text"><div align="center">Stanje ur</div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center">Ostane dopusta</td>
  </tr>
##START_LOG##  
<tr>
    <td  width="140" align="center" class="text"  ><div align="center"><strong>##FIRST## ##LAST##</strong></div></td>
    <td width="40" align="center" class="text" ><div align="center">##WORKING_DAYS##</div></td>
    <td width="40" align="center" class="text" >##SICK_DAYS##</td>
    <td width="40" align="center" class="text" >##HOLIDAY_DAYS##</td>
    <td width="40" align="center" class="text">##OVERTIME_HOURS##</td>
	<td width="40" align="center" class="text">##OFFTIME_HOURS##</td>  
	<td width="40" align="center" class="text">##CARE##</td>
	<td width="40" align="center" class="text">##EDUCATION##</td>
	<td width="40" align="center" class="text">##PREGNANCY##</td>
	<td width="40" align="center" class="text">##MISSION_DAYS##</td>
	<td width="40" align="center" class="text">##BLOODAY##</td>
	<td width="40" align="center" class="text">##HOURS_LEFT##</td>
    <td width="40" align="center" class="text">##HOLID_ALL_RES##</td>
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

