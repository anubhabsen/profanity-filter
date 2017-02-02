<?php
	require_once 'inc/connect.inc.php';
	require_once 'inc/curl.inc.php';

	if(!isset($_POST['sentence']) && !isset($_POST['checktype']))
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
				echo "Sentence entered is safe!";
			else
				echo "Sentence entered contains a profanity.";
		}
		else if($check == "rmselect")
		{
			$list = $_POST['list'];
			$list_split = explode(" ", $list);
			$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
			$sent_split = explode(" ", $sentence);
			foreach($list_split as $key => $word)
			{
				if(in_array($word, $sent_split))
				{
				   echo "Sentence entered contains a profanity.";
				}
				else
				{
				   echo "Sentence entered is safe!";
				}
			}
		}
		else if($check == "createcustom")
		{
			$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
			$sent_split = explode(" ", $sentence);
			$flag=0;
			foreach($sent_split as $key => $word)
			{
				$q3 = "SELECT * FROM `profane` WHERE `word` = '$word'";
				if($query_run = mysqli_query($connection, $q3))
				{
					if(mysqli_num_rows($query_run) == 1)
					{
						echo "Sentence entered contains a profanity.";
						$flag = 1;
						break;
					}
					else
					{
						// Nothing to do
					}
				}
			}
			if($flag==0)
			{
				echo "Sentence entered is safe!";
			}
		}
	}
?>
