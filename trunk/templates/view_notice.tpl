


<form name=addlog id=addlog action="add_log_admin.php" method="post" accept-charset="utf-8">



    <div class="span-16" id="addlogadmin">


        <div class="span-16">

            <fieldset class="shadowcontainer">

                <div class="span-1 last">
                    <b>Obvestila:</b>  
                </div>

                <table>
                    <tr>
                        <td>

                        </td>
                    </tr>
                </table>


                <div class="push-0">
                    <b>V čakanju:</b> 
                </div>
                ##START_LOG##
                <table>
                    <tr>
                        <td>
                            ##FEEDBNOTE##
                        </td>
                    </tr>
                </table>
                ##STOP_LOG##
                <div class="push-0">
                    <b>Končano:</b> 
                </div>
##START END##
                <table>
                    <tr>
                        <td>
                            ##FEEDBNOTE DONE##
                        </td>
                    </tr>
                </table>
##STOP_END##


             


            </fieldset>
        </div>


    </div>
</form>
<script type="text/javascript">
    document.addlog.name_drop.focus();
</script>

<div class="span-7 last" >
    <fieldset  class="shadowcontainer">
        <div class="push-5 last"><a href="view_user_log.php">Več...</a>
        </div>

        <div>
            <table>
                <tr>
                    <td>
                        Danes:
                    </td>
                    <td>
                        ##TYPE## ##START##-##END##
                    </td>     
                </tr>
                <tr>
                    <td>
                        stanje ur:
                    </td>
                    <td>
                        ##HOUR##
                    </td>
                </tr>
                <tr><td></td><td></td><td></td></tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        ##DATELASTYEAR##                            
                    </td>  
                    <td>
                        ##DATEYEARNOW##
                    </td> 
                </tr>

                <tr>
                    <td>
                        dopust:
                    </td>
                    <td>
                        ##LASTYEAR##
                    </td> 
                    <td>
                        ##THISYEAR##
                    </td>
                </tr>

                <!--     <tr>
                         <td>
                             izredni dopust:
                         </td>
                         <td>
                             ##THISSPECIAL##
                         </td>
                         <td>
                         ##LASTSPECIAL##
                         </td>
                     </tr>
                     </tr>
                     <tr>
                         <td>
                             študijski dopust:
                         </td>
                         <td>
                             ##THISSABBA##
                         </td>
                         <td>
                             ##LASTSABBA##
                         </td>
                     </tr>
                
                -->

                <tr>
                </tr>
                <tr>

                </tr>

            </table>
        </div>







    </fieldset>
</div>
