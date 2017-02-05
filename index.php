<?php
    require_once 'inc/connect.inc.php';
    require_once 'inc/curl.inc.php';
    include 'inc/header.inc.php';
    include 'inc/layout/navbar.inc.php';
    error_reporting(E_ERROR);

    if(!isset($_POST['sentence']) && !isset($_POST['checktype']))
    {
        header("Location : index.php");
    }
    else
    {
        $sentence = $_POST['sentence'];
        $check = $_POST['checktype'];
        if($check == "createcustom")
        {
            $list = $_POST['list'];
            $list = preg_replace("/[^a-zA-Z 0-9]+/", " ", $list);
            $list_split = explode(" ", $list);
            foreach($list_split as $key => $word)
            {
                $q1 = "SELECT * FROM `profane` WHERE `word` = '$word'";
                if($query_run = mysqli_query($connection, $q1))
                {
                    if(mysqli_num_rows($query_run) == 1 )
                    {
                        // Nothing to do
                    }
                    else
                    {
                        $q2 = "INSERT INTO `profane` (`word`) VALUES ('$word')";
                        mysqli_query($connection, $q2);
                    }
                }
            }
        }
        if($check == "standard")
        {
            $url = "http://www.wdylike.appspot.com/?q=".$sentence;
            $res = get_curl($url);
            if($res == "false")
                echo "The sentence is safe!";
            else
                echo "Sentence entered contains profanity.";
        }
        else if($check == "rmselect")
        {
            $list = $_POST['list'];
            $list = preg_replace("/[^a-zA-Z 0-9]+/", " ", $list);
            $list_split = explode(" ", $list);
            $sentence = preg_replace("/[^a-zA-Z 0-9]+/", " ", $sentence);
            $sent_split = explode(" ", $sentence);
            foreach($list_split as $key => $word)
            {
                if (in_array($word, $sent_split))
                {
                   echo "Sentence entered contains profanity.";
                }
                else
                {
                   echo "The sentence is safe!";
                }
            }
        }
    }
?>
<div class="container">
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
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
                            <td width="500" ><textarea name="sentence" cols="50" rows="5"></textarea></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="6"><label><input type="checkbox" name="checktype" value="standard">Standard check database</label><br></td>
                        </tr>
                        <tr>
                            <td colspan="6"><label><input type="checkbox" name="checktype" value="createcustom">Create Custom database</label><br></td>
                        </tr>
                        <tr>
                            <td colspan="6"><label><input type="checkbox" name="checktype" value="rmselect">Selective removal</label><br></td>
                        </tr>
                        <tr>
                            <td colspan="2">Custom list:</td>
                            <td colspan="6"><textarea name="list" cols="50" rows="2"></textarea></td>
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
<hr>
<?php include 'inc/layout/footer.inc.php';?>