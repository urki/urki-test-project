<!--<meta http-equiv="refresh" content="300"> -->


<form name="edit" id="edit" action="scan_inventory.php" onkeypress="return submitenter(this,event)" method="post" accept-charset="utf-8">
    <table  cellspacing="0" width="932" border="0" bgcolor="#9AFDA7" >
        <tr>
            <td colspan="7"  bgcolor="#9AFDA7" "><div align="center"><STRONG>Zadnjih 5 vnosov:</STRONG></div></td>
        </tr>
        <tr>
            <td></td>
            <td  bgcolor="#9AFDA7" class="text"><div  class="style6" >ID</div></td>
            <td  bgcolor="#9AFDA7" class="text"><div  class="style6" >EAN coda</div></td>
            <td  bgcolor="#9AFDA7" class="text"><div  class="style6">Naziv</div></td>
            <td bgcolor="#9AFDA7" class="text"><div  class="style6" >Enota</div></td>
            <td bgcolor="#9AFDA7" class="text"><div  class="style6" >Prostor</div></td>
            <td bgcolor="#9AFDA7" class="text"><div class="style6">Skrbnik</div></td>
            <td bgcolor="#9AFDA7" class="text"><div class="style6">Opombe</div></td>
        </tr>
        ##DSTART_LOG##
        <tr>
            <td></td>
            <td   bgcolor="#9AFDA7" class="text"> <input type=hidden size="3" type=text name="did[]" class="form_textbox" id="did" value=##DID## ></td>
            <td bgcolor="#9AFDA7" class="text"> <input readonly size="8" maxlength=11 type=text name="dean[]" id="dean" class="form_textbox" value=##DEAN## ></td>
            <td bgcolor="#9AFDA7" class="text"<INPUT readonly type="text" name="dname[]" id="dname" class="form_textbox" value=##DNAME## ></td>
            <td  bgcolor="#9AFDA7"class="text">##DUNIT##</td>
            <td  bgcolor="#9AFDA7"class="text">##DPLACE##</td>
            <td bgcolor="#FFFED2" class="text">##NAMEDROP##</td>
            <td  bgcolor="#9AFDA7"class="text"<INPUT type="text" name="ddescription[]" id="ddescription" class="form_textbox" value=##DDESCRIPTION##></td>
            <td bgcolor="#9AFDA7" class="text"><input name="edit" id="edit" value="spremeni" type="submit">##MESSAGE##</td>
    
        </tr>
        ##DSTOP_LOG##
    </table>
</form>
