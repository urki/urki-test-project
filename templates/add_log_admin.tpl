


<form name=addlog id=addlog action="add_log_admin.php" method="post" accept-charset="utf-8">



    <div class="span-16" id="addlogadmin">


        <div class="push-1">

            <fieldset class="shadowcontainer">
               

                <table cellpadding="0" cellspacing="0">

                    <tr>
                        <td>
                            Ime, priimek:
                        </td>
                        <td>
                            ##NAME_DROP##
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Datum:
                        </td>
                        <td>
                            ##ADAY## / ##AMONTH## / ##AYEAR##
                        </td>
                    </tr>
                    <tr>
                        <td class="barva">
                            Čas začetka:
                        </td>
                        <td>
                            ##SHOUR## : ##SMIN##
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Čas konca:
                        </td>
                        <td>
                            ##EHOUR## : ##EMIN##
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tip:
                        </td>
                        <td>
                            ##JOB_DROP##
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Opomba:
                        </td>
                        <td>
                            <textarea name="note" id="note" cols="60" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="add" id="add" value="    Dodaj    " type="submit">
                        </td>
                        <td>
                            <input type=button onClick="location.href='add_log_admin.php'" value='Izbriši vse'>
                        </td>

                    </tr>



                </table>
            </fieldset>
        </div>


    </div>
</form>
<script type="text/javascript">
    document.addlog.name_drop.focus();
</script>

<div class="pull-1 last" id="addlogadmininsert">
    <fieldset  class="shadowcontainer">
     </fieldset>
</div>
