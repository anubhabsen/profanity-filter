<html>
    <form method="POST" action="check.php">
        <strong><center>Enter sentence to check</cemter></strong>
        <br>
        Sentence:
        <input name="sentence" type="text" id="Sentence">
        <br>
        <label><input type="radio" name="checktype" id="standard" value="standard">Standard check</label>
        <br>
        <label><input type="radio" name="checktype" id="createcustom" value="createcustom">Create Custom check</label>
        <br>
        <label><input type="radio" name="checktype" id="rmselect" value="rmselect">Remove Select</label>
        <br>
        Custom list:
        <input name="list" type="text" id="list">
        <br>
        <input type="submit" name="Submit" value="GO">
    </form>
</html>