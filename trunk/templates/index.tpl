<form   action="index.php" method="get" accept-charset="utf-8">
    

    <div class="span-16" id="addlogadmin">


        <div class="push-1">

            <fieldset class="shadowcontainer">


                <table cellpadding="0" cellspacing="0">

                    <tr>
                        <td>
                            Čas začetka:
                        </td>
                        <td>
                            ##SHOUR## : ##SMIN##
                        </td>
                    </tr>
                    <tr>
                        <td class="barva">
                            Čas konca:
                        </td>
                        <td>
                            ##EHOUR## : ##EMIN##
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
                            <input type="submit" name="add" id="add" value="   Shrani    " />
                            
                        </td>
                        

                    </tr>



                </table>
            </fieldset>
        </div>


    </div>
</form>
<script type="text/javascript">
    document.addlog.shour_drop.focus();
</script>
