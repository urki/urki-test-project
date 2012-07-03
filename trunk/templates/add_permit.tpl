
<form name=addlog id=addlog action="add_permit.php" method="post" accept-charset="utf-8">



    <div class="span-12" id="addlogadmin">


        <div class="push-1">

            <fieldset class="shadowcontainer">


                <table cellpadding="0" cellspacing="0">

                    <tr>
                        ##IF_LEADER##                        <td>
                            Ime, priimek:
                        </td>
                        <td>
                            ##NAME_DROP##
                        </td>

                    </tr>
                    ##IF_LEADER##                    <tr>
                        <td>
                            Datum:
                        </td>
                        <td>
                            ##DAYTO## / ##MONTHTO## / ##YEARTO##
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

                    
                    
                    

                    
                    
                    
                    
                  
                        <div class="content">
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
                            <input type=button onClick="location.href='add_permit.php'" value='Izbriši vse'>
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

<div class="span-6 last" >
    <fieldset  class="shadowcontainer">
        <a href="view_user_log.php"></a>

        <table>
            <tr>
                <td colspan="5">
                    Zadnje vloge
                </td>

            </tr>

            ##START_LOG##
            <tr>
                <td>
                    ##MESSAGERIGHT##   
                </td>
                <td>
                    ##RECORDID## 
                </td>
                ##IF_LEADER##
                <td>
                    ##NAME##
                </td>
                ##IF_LEADER##
                <td>
                    ##TYPENAME##
                </td>
                <td>
                    ##MINSTART##
                </td>

                <td>
                    ##MAXEND##
                </td>



            </tr>
            ##STOP_LOG##


        </table>
    </fieldset>
</div>
