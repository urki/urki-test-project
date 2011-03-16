<meta http-equiv="refresh" content="300">

<form action="##SELF##" method="POST">
Izberi mesec: ##MDROP##
znesek:<input type="text" name="amount" size=4 value="##AMOUNT##">
<input type="submit" name="prikazi" value="prikazi">
</form>

<table width="832" border="1">
  <tr>
    
    <td width="157" bordercolor="#CCCCCC" bgcolor="#999999" class="text"><div align="center">priimek in ime</div></td>
    <td width="249" bgcolor="#999999" class="text"><div align="center">znesek</div></td>
    
  </tr>
##START_LOG##  
<tr>
    <td align="center" bordercolor="#999999" class="text">##NAME##</td>
    <td align="center" bordercolor="#999999" class="text">##EUR##</td>

  </tr>
##STOP_LOG##
</table>
