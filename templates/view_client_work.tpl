
<form action="##SELF##" method="POST">
##IF_ROLE_LIST##Izberi mesec: ##MDROP##
Izberi leto: ##YDROP##
oseba: ##NAME_DROP##
<input type="submit" name="prikazi" value="prikazi">
##IF_ROLE_LIST##
</form>
<br>
<br>

<table width="232" border="1">
  <tr>
    <td width="10" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center">ID</div></td>
    <td width="10" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center">dan</div></td>
    <td width="60" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center">program</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">delo</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">delal</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">odmori</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">aktivno</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">ocena</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">ocenjevalec</div></td>
    <td width="20" bgcolor="#999999" class="text"><div align="center">pisna ocena</div></td>
    
  </tr>
##START_LOG##

<tr>
    <td align="center" bordercolor="#999999" class="text">##ID##</td>
    <td align="center" bordercolor="#999999" class="text">##DATUM##</td>
    <td align="center" bordercolor="#999999" class="text">##PROGRAM##</td>
    <td align="center" bordercolor="#999999" class="text">##DELO##</td>
    <td align="center" bordercolor="#999999" class="text">##DELAL##</td>
    <td align="center" bordercolor="#999999" class="text">##ODMOR##</td>
    <td align="center" bordercolor="#999999" class="text">##ADELAL##</td>
    <td align="center" bordercolor="#999999" class="text">##OCENA##</td>
    <td align="center" bordercolor="#999999" class="text">##OCENJEV##</td>
    <td align="center" bordercolor="#999999" class="text">##COMM##</td>

  </tr>
##STOP_LOG##
</table>

