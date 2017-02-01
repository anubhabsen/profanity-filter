<html>
    <div class="container">
        <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
            <tr>
                <form method="POST" action="check.php" >
                    <td>
                        <table width="100%" border="0">
                            <tr>
                                <td colspan="3"><strong><center>Enter the sentence to be checked</cemter></strong></td>
                            </tr>
                            <tr>
                                <td width="78">Sentence</td>
                                <td width="6">:</td>
                                <td width="3000"><input name="sentence" type="text" id="Sentence"></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="3"><label><input type="checkbox" name="checktype" value="standard">Standard check database</label><br></td>
                            </tr>
                            <tr>
                                <td colspan="3"><label><input type="checkbox" name="checktype" value="createcustom">Create Custom database</label><br></td>
                            </tr>
                            <tr>
                                <td colspan="3"><label><input type="checkbox" name="checktype" value="rmselect">Selective removal</label><br></td>
                            </tr>
                            <tr>
                                <td colspan="2">Custom list:</td>
                                <td colspan="3"><input name="list" type="text" id="list"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="Submit" value="GO"></td>
                             </tr>
                        </table>
                    </td>
                </form>
            </tr>
        </table>
    </div>
</html>