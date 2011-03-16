<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head><link rel="shortcut icon" href="https://spreadsheet.google.com/images/forms/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>Dnevna prisotnost zaposlenih</title>

<body  bgcolor="#eef6fc"> 

<table>
  <tbody valign="center">
    <TR>
      <TD><IMG SRC="http://www.vdcsasa.si/slike/glava_02.gif" ALIGN=TOP></TD>
      <TD><font  size="5"><b>Dnevnik prisotnosti</b></font></TD>
    </TR>
  </tbody>
</table>



<script type="text/javascript">var submitted=false;</script>
<iframe name="hidden_iframe" id="hidden_iframe"
style="display:none;" onload="if(submitted)
{window.location='novpis.htm';}"></iframe>
<form action="http://spreadsheets.google.com/formResponse?key=pzA5XNJGlbSpgI-21iwoJXQ&hl=sl&amp;embedded=true" method="post"
target="hidden_iframe" onsubmit="submitted=true;">

 

<TABLE BORDER CELLPADDING=3 CELLSPACING=5 BGCOLOR="#FFFFCC">
<TR>
     <TD><b>ime in priimek:</b> <select name="entry.0.single"> 
<?php 
  for($i = 0; $i < 3; $i++) { 
    echo "\n\t<option value=\"$i\">Item #$i</option>"; 
  } 
?> 
</select></TD>
     <TD ROWSPAN=3><b>opomba:</b><BR>
     <TEXTAREA name="entry.5.single" COLS=25 ROWS=5 TABINDEX=5></TEXTAREA></TD></TR>
<TR> <TD><b>čas začetka</b>: <INPUT NAME="entry.1.single" TABINDEX=2></TD></TR>
<TR> <TD><b>čas konca</b>: <INPUT NAME="entry.2.single" TABINDEX=3></TD></TR>
<TR> <TD><b>tip izhoda:</b> <SELECT NAME="entry.4.single" TABINDEX=4>
     <OPTION VALUE="Služba">Služba
     <OPTION VALUE="Dopust">Dopust
     <OPTION VALUE="Bolniški stalež">Bolniški stalež
     <OPTION VALUE="Nega">Nega
     <OPTION VALUE="Izobraževanje">Izobraževanje
     <OPTION VALUE="Nadomeščanje">Nadomeščanje
     <OPTION VALUE="Privatni izhod">Privatni izhod
     <OPTION VALUE="Služba brez malice">Služba brez malice
     <OPTION VALUE="Službeno potovanje">Službeno potovanje
     <OPTION VALUE="Sprememba dopusta v ure">Sprememba dopusta v ure
     <OPTION VALUE="+ ure">+ ure
     <OPTION VALUE="Drugo">Drugo
</SELECT></TD></TR>

<td><input type="submit" value="Pošlji" /> </td>



