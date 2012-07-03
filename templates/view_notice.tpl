


<form name=addlog id=addlog action="add_log_admin.php" method="post" accept-charset="utf-8">



    <div class="span-24" id="addlogadmin">


        <div class="span-16">

            <fieldset class="shadowcontainer">

                <!--   <div class="span-1 last">
                -->

                <div id="accordion">

                    <h2>Obvestila</h2>

                    <div class="content">
                        <table>
                            <tr>
                                <td>

                                </td>
                            </tr>
                        </table>

                    </div>

                    <h2>V čakanju</h2>

                    <div class="content">
                        ##START_LOG##
                        <table>
                            <tr>
                                <td>
                                    ##FEEDBNOTE## <hr/>
                                </td>
                            </tr>
                        </table>
                        ##STOP_LOG##
                        <p></p>
                    </div>

                    <h2>Končana</h2>

                    <div class="content">
                        ##START END##
                        <table>
                            <tr>
                                <td>
                                    ##FEEDBNOTE DONE## <hr/>
                                </td>
                            </tr>
                        </table>
                        ##STOP_END##



                    </div>

                </div>

            </fieldset>
            <!--  </div> -->



        </div>
</form>
<script type="text/javascript">
    document.addlog.name_drop.focus();
</script>

<div class="span-6 last" >
    <fieldset  class="shadowcontainer">
        <div class="push-4 last"><a href="view_user_log.php">Več...</a>
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
