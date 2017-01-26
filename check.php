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
			{
				echo "The sentence is safe.";
			}
			else
			{
				echo "Profanity detected in the sentence.";
			}
		}
		else if($check == "createcustom")
		{
			$list = preg_replace("/[^a-zA-Z 0-9]+/", " ", $list);
			$list_split =explode(" ", $list);
			print_r($list_split);
			foreach ($list_split as $key => $word)
			{
				$q1 = "SELECT * FROM `profane` WHERE `word`='$word'";
				if($query_run = mysqli_query($connection,$q1))
				{
					if(mysqli_num_rows($query_run) == 1 )
					{
						// Nothing to be done
					}
					else
					{
						$q2= "INSERT INTO `profane` (`word`) VALUES ('$word')";
						mysqli_query($connection,$q2);
					}

				}
			}
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
						$q2 = "INSERT INTO `profane` (`word`) VALUES ('$word')";
						mysqli_query($connection, $q2);
					}

				}
			}
			else if($check == "rmselect")
			{
				$list = $_POST['list'];
				$list_split =explode(" ", $list);
				print_r($list_split);
				$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
				$sent_split = explode(" ", $sentence);
				foreach($list_split as $key => $word)
				{
					if (in_array($word, $sent_split))
					{
					   echo "Profanity detected in sentence";
					}
					else
					{
					   echo "Sentence is safe";
					}
				}
			}
			if($check =="createcustom")
			{
				$sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
				$sent_split = explode(" ", $sentence);
				$flag = 0;
				foreach($sent_split as $key => $word)
				{
					$q3 = "SELECT * FROM `profane` WHERE `word`='$word'";
					if($query_run = mysqli_query($connection, $q3))
					{
						if(mysqli_num_rows($query_run) == 1 )
						{
							echo "Profanity detected in sentence";
							$flag = 1;
							break;
						}
						else
						{
							// Nothing
						}
					}
				}
				if ($flag == 0)
				{
					echo "Sentence is safe";
				}
			}
		}
	}
?>