<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>ocenjevanje</title>

<style type="text/css">
<!--
.style2 {font-size: x-small}
.style4 {font-size: x-small; font-weight: bold; }
.style6 {font-size: x-small; font-weight: bold; color: #999999; }
.style7 {font-size: x-small; font-weight: bold; color: #FFFED2; }

-->
</style>
<body  bgcolor="#FFFED2"> 


<form action="aktivnosti.php" method="post" accept-charset="utf-8">
  <strong>Aktivnosti uporabnikov:</strong>
  <table  border="0" cellpadding="0" cellspacing="0">
   

<tr>
        <td bgcolor="#FFFED2"  colspan="3" <span class="style6"></span></td>
        ##IF_ADMIN##
          <td bgcolor="#FFFED2"  colspan="4" <span class="style6"></span></td>
        ##IF_ADMIN##
        <td bgcolor="#FFFED2"  colspan="2" <span class="style6">čas začetka:</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
        <td bgcolor="#FFFED2"  colspan="2" <span class="style6">čas konca</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
        <td bgcolor="#FFFED2"  colspan="2" <span class="style6">čas neak. dela:</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
    </tr>

   <tr>
     <td bgcolor="#FFFED2"  colspan="1" <span class="style6">uporabnik:</span></td>
       ##IF_ADMIN##
          <td bgcolor="#FFFED"   <span class="style6">ocenjevalec:</span></td>
          <td bgcolor="#FFFED2"><span class="style6">dan</span></td>
          <td bgcolor="#FFFED2"><span class="style6">mesec</span></td>
          <td bgcolor="#FFFED2"><span class="style6">leto</span></td>
       ##IF_ADMIN##
        <td colspan="2" bgcolor="#FFFED2" ><span class="style6">delo</span></td>
        <td bgcolor="#FFFED2"><span class="style6">ur</span></td>
        <td bgcolor="#FFFED2"><span class="style6">min</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
        <td bgcolor="#FFFED2"><span class="style6">ur</span></td>
        <td bgcolor="#FFFED2"><span class="style6">min</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
        <td bgcolor="#FFFED2"><span class="style6">ur</span></td>
        <td bgcolor="#FFFED2"><span class="style6">min</span></td>
        <td bgcolor="#FFFED2"><span class="style6">  </span></td>  <!--vmesna kolona za boljši pregled -->
        <td colspan="2" height="4" bgcolor="#FFFED2"><span class="style6">ocena</span></td>
        <td height="4" bgcolor="#FFFED2"><span class="style6">opomba</span></td>
    </tr>

 <tr>
        <td bgcolor="#FFFED2" height=180 colspan="12" <span class="style6"></span></td>
        ##IF_ADMIN##
          <td bgcolor="#FFFED2"  colspan="4" <span class="style6"></span></td>
        ##IF_ADMIN##
    </tr>


    <tr>
      <td width="87" bgcolor="#FFFED2">##NAMES##</td>
      ##IF_ADMIN##
        <td bgcolor="#FFFED2">##ASSNAMES##</td>
        <td bgcolor="#FFFED2">##DAY##</td>
        <td bgcolor="#FFFED2">##MONTH##</td>
        <td bgcolor="#FFFED2">##YEAR##</td>
      ##IF_ADMIN##
      <td bgcolor="#FFFED2"><span class="text">##WORK##</span></td>
      <td bgcolor="#FFFED2"><span class="style7">ht</span>&nbsp;</td> <!--vmesna kolona za boljši pregled  stop cas-->
      <td bgcolor="#FFFED2">##STARTTIMEHOUR##</td>
      <td bgcolor="#FFFED2">##STARTTIMEMIN##</td>
      <td bgcolor="#FFFED2"><span class="style7">ht</span></td> <!--vmesna kolona za boljši pregled  stop cas-->
      <td bgcolor="#FFFED2">##STOPTIMEHOUR##</td>
      <td bgcolor="#FFFED2">##STOPTIMEMIN##</td>
      <td bgcolor="#FFFED2"><span class="style7">pt</span></td> <!--vmesna kolona za boljši pregled pauza-->
      <td bgcolor="#FFFED2">##PAUSEHOURTIME##</td>
      <td bgcolor="#FFFED2">##PAUSEMINTIME##</td>
      <td bgcolor="#FFFED2"><span class="style7">oc</span></td> <!--vmesna kolona za boljši pregled ocena-->
      <td bgcolor="#FFFED2">##RATING##</td>
      <td bgcolor="#FFFED2"><span class="style7">di</span></td> <!--vmesna kolona za boljši pregled ocena-->
      <td bgcolor="#FFFED2"><span class="text"> <textarea name="note" id="note" cols="10" rows="1"></textarea></span></td>
      <td bgcolor="#FFFED2"><span class="text"><input type="submit" name="add" id="add" value="    Shrani    " />##MESSAGE## </span> </td>
   </tr>

    
  </table>
</form>