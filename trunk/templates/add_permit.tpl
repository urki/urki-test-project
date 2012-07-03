<script type="text/javascript">
    document.addlog.name_drop.focus();
</script>

<div class="span-24" >
    <div class="span-12"">
         <form name=addlog id=addlog action="add_permit.php" method="post" accept-charset="utf-8">
            <div>
                <fieldset class="shadowcontainer">
                    <table>
                        ##IF_LEADER## 
                        <tr>     
                            <td>
                                Ime, priimek:
                            </td>
                            <td>
                                ##NAME_DROP##
                            </td>
                        </tr>
                        ##IF_LEADER##          
                        <tr>
                            <td>
                                Datum:
                            </td>
                            <td>
                                <div id="drophead">
                                    <h3>##DAYTO## / ##MONTHTO## / ##YEARTO##</h3>
                                    <div class="dropcontent">
                                    </div>
                                    <h3>Več...</h3>
                                    <div class="dropcontent">
                                        <table>
                                            <tr>
                                                <td>
                                                    Sem pa vpišeš nekaj skrivnega
                                                     ##DAYTO## / ##MONTHTO## / ##YEARTO##
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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
                                <textarea name="note"  id="note" cols="60" rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input name="add"  id="add" value="    Dodaj    " type="submit">
                            </td>
                            <td>
                                <input type=button onClick="location.href='add_permit.php'" value='Izbriši vse'>
                            </td>

                        </tr>
                    </table>
                </fieldset>
            </div>
        </form>
    </div>
    <div class="span-10 last" >
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
</div>
