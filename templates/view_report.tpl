<meta http-equiv="refresh" content="300">

<form action="##SELF##" method="POST">
Izberi mesec: ##MDROP## 
Izberi leto: ##YDROP##
oseba: ##NAME_DROP##
<input type="checkbox" name="year_only" > Samo letni izpis
<input type="submit" name="prikazi" value="prikazi">
</form>
<br>
<br>


##START_LOG##  
<br>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="900" height="300" id="Pie3D" >
     <param name="movie" value="./swf/##PIE_TYPE##.swf" />
     <param name="FlashVars" value="&dataURL=Data.php##PARAMS##&chartWidth=900&chartHeight=300">
     <param name="quality" value="high" />
     <embed src="./swf/##PIE_TYPE##.swf" flashVars="&dataURL=Data.php##PARAMS##&chartWidth=900&chartHeight=300" quality="high" width="900" height="300" name="Column3D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
##STOP_LOG##

