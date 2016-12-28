<?php
	require_once 'inc/connect.inc.php';
	require_once 'inc/curl.inc.php';

	if(!isset($_POST['sentence']))
	{
		header("Location : index.php");
	}
	else
	{
		$sentence = $_POST['sentence'];
		$check = $_POST['checktype'];
		if($check == "standard")
		{
			$url = "http://www.wdylike.appspot.com/?q=".$sentence;
			$res = getCurl($url);
			if($res == "false")
				echo "The sentence is safe.";
			else
				echo "Profanity detected in the sentence.";
		}
		else if($check == "custom")
		{
			$key = 'test';
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
	}
?>