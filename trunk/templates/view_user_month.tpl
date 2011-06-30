<table width="964" border="1">
  <tr>
    <td bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center"><span class="style4">Ime in Priimek</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Delovnih dni</span></div></td>

  <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Službeno potovanje</span></div></td>

    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Dopust dni</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Izr. dopust</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">&#352;tud. dopust</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center">Izobra&#382;.</div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Bolniskih dni</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Nega</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Pošk.pri del</span></div></td>
    <td width="40"  bgcolor="#999999" class="text"><div align="center">Krvodaj.</td>

 <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Privat izhod.</span></div></td>
<td  bgcolor="#999999" class="text"><div align="center"><span class="style4">+ ur</span></div></td>

    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Stanje ur</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Ostane dopusta</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Ostane izr.dopu</span></div></td>
    <td  bgcolor="#999999" class="text"><div align="center"><span class="style4">Ostane Štud.dopusta</span></div></td>
  </tr>
##START_LOG##  
<tr>
    <td width="140" class="text" align="center"  >##FIRST## ##LAST##</td>
    <td class="text" align="center" >##WORKING_DAYS##</td>


  <td class="text" align="center" >##MISSION_DAYS##</td>


    <td class="text" align="center" >##HOLIDAY_DAYS##</td>
    <td class="text" align="center">##SPECIALEAVE##</td>
    <td class="text" align="center">##SABBATICAL##</td>
    <td width="40" align="center" class="text">##EDUCATION##</td>
    <td class="text" align="center" >##SICK_DAYS##</td>
    <td class="text" align="center" width="40"  >##CARE##</td>
    <td class="text" align="center">##WORKINJURY##</td>
    <td width="40" align="center" class="text">##BLOODAY##</td>
    <td width="40" align="center" class="text">##OFFTIME_HOURS##</td>
    <td width="40" align="center" class="text">##OVERTIME_HOURS##</td>
    <td width="40" align="center" class="text">##HOURS_LEFT##</td>
    <td class="text" align="center">##HOLID_ALL_RES##</td>
    <td class="text" align="center">##SPECIALLEAVE_LEFT##</td>
    <td class="text" align="center">##SABBATICAL_ALL_RES##</td>
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

  