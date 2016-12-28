<?php
	require_once 'inc/connect.inc.php';
	if(!isset($_POST['sentence']))
	{
		header("Location : index.php");
	}
	else
	{
		$sentence= $_POST['sentence'];
		$key  = 'test';
		$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
		$sent_split = explode(" ", $sentence);
		if (in_array($key, $sent_split))
		{
		    echo "Word found";
		}
		else
		{
		    echo "Word not found";
		}
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