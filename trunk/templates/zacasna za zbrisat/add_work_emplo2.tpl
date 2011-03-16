<style type="text/css">
<!--
.style2 {font-size: x-small}
.style4 {font-size: x-small; font-weight: bold; }
.style6 {font-size: x-small; font-weight: bold; color: #999999; }
-->
</style>
<form action="add_work_emplo.php" method="post" accept-charset="utf-8">
  <table width="1348" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFF66">
    <tr>
      <td colspan="3" bgcolor="#FEFCAB"><strong>Aktivnosti zaposlenih:</strong></td>
      <td width="10" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="52" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="52" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="12" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="52" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="52" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="10" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="77" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="102" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="157" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="8" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="466" bgcolor="#FEFCAB">&nbsp;</td>
    </tr>
    <tr>
      <td width="131" height="4" bgcolor="#FEFCAB"><span class="style6">Aktivnost:</span></td>
      <td width="4" bgcolor="#FEFCAB">&nbsp;</td>
      <td width="163" height="4" bgcolor="#FEFCAB"><span class="style6">Lokacija:</span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td height="4" colspan="2" bgcolor="#FEFCAB"><span class="style6">&#269;as za&#269;etka:</span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td height="4" colspan="2" bgcolor="#FEFCAB"><span class="style6">&#269;as konca:</span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td height="4" bgcolor="#FEFCAB"><span class="style6">opomba:</span></td>
      <td height="4" bgcolor="#FEFCAB"><span class="style6"></span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td height="4" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="4" bgcolor="#FEFCAB">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FEFCAB"><!--##NAMES##
        -->
          <span class="text">##WORK_DROP##</span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB"><span class="text">##LOCATION_DROP##</span>
          <!--<select name="entry.4.single" tabindex=2>
          <option selected value="">...
          <option value="Blago">Blago
          <option value="Dekoracija">Dekoracija
          <option value="Glina">Glina
          <option value="Gospodinjstvo">Opravila
          <option value="Kooperacija">Kooperacija
          <option value="Lesarstvo">Lesarstvo
          <option value="Papir">Papir
          <option value="&Scaron;port">&Scaron;port
          <option value="Urejanje Okolice">Urejanje Okolice
        </select>--></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB"><span class="text">
        <select name="HOUR_START">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option selected="selected" value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
        </select>
        </span>
          <!--<select name="entry.5.single" tabindex=3>
          <option selected value="">...
          <option value="barvanje">Blago-barvanje
          <option value="barvanje">Dekoracija-barvanje
          <option value="barvanje">Glina-barvanje
          <option value="bru&scaron;enje">Lesarstvo-bru&scaron;enje
          <option value="dodelava">Papir-dodelava
          <option value="dru&#382;abne &scaron;potne igre">&Scaron;port-dru&#382;abne &scaron;potne igre
          <option value="glaziranje">Glina-glaziranje
          <option value="gnetenje in &#269;i&scaron;&#269;enje">Glina-gnetenje in &#269;i&scaron;&#269;enje
          <option value="gobeliranje">Blago-gobeliranje
          <option value="igre z &#382;ogo">&Scaron;port-igre z &#382;ogo
          <option value="izrezovanje">Dekoracija-izrezovanje
          <option value="jutranja telovadba">&Scaron;port-jutranja telovadba
          <option value="kontrola opravljenega dela">Kooperacija-kontrola opravljenega dela
          <option value="lakiranje">Lesarstvo-lakiranje
          <option value="lepljenje">Dekoracija-lepljenje
          <option value="lepljenje">Lesarstvo-lepljenje
          <option value="MATP">&Scaron;port-MATP
          <option value="modeliranje">Blago-modeliranje
          <option value="mozni&#269;enje">Lesarstvo-mozni&#269;enje
          <option value="oblikovanje">Glina-oblikovanje
          <option value="ozna&#269;evanje in risanje">Lesarstvo-ozna&#269;evanje in risanje
          <option value="pohodni&scaron;tvo">&Scaron;port-pohodni&scaron;tvo         
          <option value="priprava materiala za delo">Kooperacija-priprava materiala za delo
          <option value="rezanje">Papir-rezanje
          <option value="rezanje in trganje">Blago-rezanje in trganje
          <option value="risanje in lepljenje">Papir-risanje in lepljenje
          <option value="sajenje in presajanje">Urejanje Okolice-sajenje in presajanje
          <option value="SOS">&Scaron;port-SOS
          <option value="&scaron;ivanje">Blago-&scaron;ivanje
          <option value="&scaron;ivanje in oblikovanje">Papir-&scaron;ivanje in oblikovanje
          <option value="trganje, barvanje">Papir-trganje, barvanje
          <option value="uporaba enostavnih strojev">Urejanje Okolice-uporaba enostavnih strojev
          <option value="urejanje okolice">Urejanje Okolice-strojev-urejanje okolice
          <option value="vezenje">Blago-vezenje
          <option value="zlaganje in sortiranje">Glina-zlaganje in sortiranje
          <option value="zlaganje in sortiranje">Kooperacija-zlaganje in sortiranje
          <option value="pomivanje">Opravila-pomivanje
          <option value="likanje">Opravila-likanje
        </select>--></td>
      <td bgcolor="#FEFCAB"><span class="text">
        <select name="MIN_START">
          <option value="0">00</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
          <option value="32">32</option>
          <option value="33">33</option>
          <option value="34">34</option>
          <option value="35">35</option>
          <option value="36">36</option>
          <option value="37">37</option>
          <option value="38">38</option>
          <option value="39">39</option>
          <option value="40">40</option>
          <option value="41">41</option>
          <option value="42">42</option>
          <option value="43">43</option>
          <option value="44">44</option>
          <option value="45">45</option>
          <option value="46">46</option>
          <option value="47">47</option>
          <option value="48">48</option>
          <option value="49">49</option>
          <option value="50">50</option>
          <option value="51">51</option>
          <option value="52">52</option>
          <option value="53">53</option>
          <option value="54">54</option>
          <option value="55">55</option>
          <option value="56">56</option>
          <option value="57">57</option>
          <option value="58">58</option>
          <option value="59">59</option>
        </select>
      </span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB"><span class="text">
        <select name="HOUR_STOP">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option selected="selected" value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
        </select>
      </span></td>
      <td bgcolor="#FEFCAB"><span class="text">
        <select name="MIN_STOP">
          <option value="0">00</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
          <option value="32">32</option>
          <option value="33">33</option>
          <option value="34">34</option>
          <option value="35">35</option>
          <option value="36">36</option>
          <option value="37">37</option>
          <option value="38">38</option>
          <option value="39">39</option>
          <option value="40">40</option>
          <option value="41">41</option>
          <option value="42">42</option>
          <option value="43">43</option>
          <option value="44">44</option>
          <option value="45">45</option>
          <option value="46">46</option>
          <option value="47">47</option>
          <option value="48">48</option>
          <option value="49">49</option>
          <option value="50">50</option>
          <option value="51">51</option>
          <option value="52">52</option>
          <option value="53">53</option>
          <option value="54">54</option>
          <option value="55">55</option>
          <option value="56">56</option>
          <option value="57">57</option>
          <option value="58">58</option>
          <option value="59">59</option>
        </select>
      </span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB"><span class="text">
        <textarea name="note" id="note" cols="10" rows="1"></textarea>
      </span></td>
      <td bgcolor="#FEFCAB"><span class="text">
        <input type="submit" name="add" id="add" value="    Shrani    " />##MESSAGE##
      </span></td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
    </tr>
    <tr>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
      <td height="1" bgcolor="#FEFCAB">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
      <td bgcolor="#FEFCAB">&nbsp;</td>
    </tr>
  </table>
</form>
