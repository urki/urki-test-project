<script type="text/javascript">
    document.addlog.name_drop.focus();
</script>

<div class="span-24" >
    <div class="span-16">
        <form name=addlog id=addlog action="add_log_admin.php" method="post" accept-charset="utf-8">
            <fieldset class="shadowcontainer">

                <div id="accordion">
                    <h2>Obvestila</h2>
                    <div class="content">
                        <table>
                            <tr>
                                <td>
                                    Ob kliku na <b><i> Obvestila, V čakanju, Končana</i></b> se pogled na ta sklop razširi in se tako vidijo obstoječi zapisi.
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
        </form>
    </div>
    <div class="span-8 last" >
        <fieldset  class="shadowcontainer">
            <div>
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
                        <td>
                            <a href="view_user_log.php">več...</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            stanje ur:
                        </td>
                        <td colspan="2">
                            ##HOUR##
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        </td>
                    </tr>
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
</div>
