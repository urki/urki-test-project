
	##MESSAGE##
<form name=log action="login.php" method="post" accept-charset="utf-8">

    <div class="span-6" id="login">
        <fieldset class="shadowcontainer">

            <p>
                <label>Vzdevek:</label><br>
                <input type="text" name="user" />
            </p>

            <p>
                <label>Geslo:</label><br>
                <input type="password" name="pass" />
            </p>
            <p>
                <button type="submit" class="button positive">
                    <img src="img/plugins/buttons/icons/tick.png" alt=""/>  Prijavi se
                </button>
            </p>
        </fieldset>
    </div>



</form>
<script type="text/javascript">
    document.log.user.focus();
</script>
