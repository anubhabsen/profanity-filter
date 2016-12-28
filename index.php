<?php
	require_once 'inc/connect.inc.php';
	if(!isset($_POST['sentence']))
	{
		header("Location : index.php");
	}
	else
	{
		echo $_POST['sentence'];
	}
?>

<html>
    <form method="POST" >
        <strong><center>Enter sentence to check</cemter></strong>
        <br>
        Sentence:
        <input name="sentence" type="text" id="Sentence">
        <br>
        <input type="submit" name="Submit" value="GO">
    </form>
</html>