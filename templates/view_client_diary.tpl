<meta http-equiv="refresh" content="300">
<table width="932" border="1">
    <tr>
        <td width="65"  bgcolor="#999999" class="text"><div align="center">id</div></td>
        <td width="65"  bgcolor="#999999" class="text"><div align="center">datum</div></td>
        <td width="157" bgcolor="#999999" class="text"><div align="center">priimek in ime</div></td>
        <td width="80" bgcolor="#999999" class="text"><div align="center">za&#269;etek</div></td>
        <td width="71" bgcolor="#999999" class="text"><div align="center"><span class="style4">konec</span></div></td>
        <td width="249" bgcolor="#999999" class="text"><div align="center">aktivnost</div></td>
        <td width="170" bgcolor="#999999" class="text"><div align="center">komentar</div></td>
        ##IF_LEADER##<td width="249" bgcolor="#999999" class="text"><div align="left">vpisal</div></td>
        ##IF_LEADER##
    </tr>
    ##START_LOG##
    <tr>
        <td align="center"  class="text">##ID##</td>
        <td align="center"  class="text">##DAY##</td>
        <td align="left"    class="text">##USERS##</td>
        <td align="center"  class="text">##START##</td>
        <td align="center"  class="text">##STOP##</td>
        <td align="center"  class="text">##NAME##</td>
        <td align="center"  class="text">##DESCRIPTION##</td>
         ##IF_LEADER##
        <td align="right"  class="text">##ASSESSOR##</td>
         ##IF_LEADER##
    </tr>
    ##STOP_LOG##
</table>
