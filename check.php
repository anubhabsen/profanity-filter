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
			$list = $_POST['list'];
			$list = preg_replace("/[^a-zA-Z 0-9]+/", " ", $list);
			$list_split =explode(" ", $list);
			foreach ($list_split as $key => $word)
			{
				$q1 = "SELECT * FROM `profane` WHERE `word`='$word'";
				if($query_run = mysqli_query($connection, $q1))
				{
					if(mysqli_num_rows($query_run) == 1 )
					{

					}
					else
					{
						$q2= "INSERT INTO `profane` (`word`) VALUES ('$word')";
						mysqli_query($connection, $q2);
					}

				}
			}
			$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
			$sent_split = explode(" ", $sentence);
		}
	}
?>