<!DOCTYPE html>
<?php session_start();
$_SESSION['count']=time();?>
<html>
    <head>
        <title>Add Trainers</title>
        <link type="text/css" href="RaceStyle.css" rel="stylesheet">
        <script>
            function showLevel(domain) {
                if(domain="QA")
                {
	var level=document.forms["signup"]["domainQA"].checked
	if (level) 
            document.getElementById('LQA').style.display='';
	else 
	     document.getElementById('LQA').style.display='none';
		}
                if(domain="LA")
                {
	var level=document.forms["signup"]["domainLA"].checked
	if (level) 
		document.getElementById('LLA').style.display='';
	else 
		document.getElementById('LLA').style.display='none';
		}
                if(domain="VA")
                {
	var level=document.forms["signup"]["domainVA"].checked
	if (level) 
		document.getElementById('LVA').style.display='';
	else 
		document.getElementById('LVA').style.display='none';
		}
        }
            
            
            </script>
    </head>
    <body>
        <center><h1>RACE</h1></center>
        <?php
       include 'createImage.php';
       $flag = 5;
       if (isset($_POST["flag"])) //  check that POST variable is not empty
        {
          $input = $_POST["input"];
          $flag = $_POST["flag"];
          }
       if ($flag == 1) // submit has been clicked
        {
          if (isset($_SESSION['captcha_string']) && $input == $_SESSION['captcha_string']) // user input and captcha string are same
          {  
        $name=$_POST['name'];
        $DLA=$_POST['domainLA'];
        $LLA=$_POST['levelLA'];
       
        $DQA=$_POST['domainQA'];
        $LQA=$_POST['levelQA'];
        
        $DVA=$_POST['domainVA'];
        $LVA=$_POST['levelVA'];
        $link=  mysql_connect("127.0.0.1:3306", "root", "root") or die("Server connection failed");
        if(isset($link))
        {
            mysql_selectdb("race", $link) or die("Database Failed");
            if(isset($DLA))
           $indicator=mysql_query("insert into trainers(trainer,domain,level) values('$name','$DLA','$LLA')") or header("Location:TrainerReject.php");
            if(isset($DQA))
            $indicator=mysql_query("insert into trainers(trainer,domain,level) values('$name','$DQA','$LQA')") or header("Location:TrainerReject.php");
            if(isset($DVA))
           $indicator= mysql_query("insert into trainers(trainer,domain,level) values('$name','$DVA','$LVA')") or header("Location:TrainerReject.php");
            if($indicator>0)
            {
                header("Location:TrainerSuccess.php");
            }
            else
            {
                 header("Location:TrainerReject.php");
            }
        }
        mysql_close();
    } else // incorrect answer, captcha shown again
    {

        ?>
        <div style="text-align:center;">
            <h1>incorrect CAPTCHA <br>please try again </h1>
        </div>
        <?php
        create_image();
        display();
    }

} else // page has just been loaded
{
    create_image();
    display();
}
function display()
       {
        ?>
        <form name="signup"  method="post">
            Name<br>
            <input size="35" type ="text" name="name" required="required" /><br><br>
            Domain<br>
            <input  type ="checkbox" name="domainQA" value="QA" id="DQA" onclick="showLevel('QA');"/>Quantative Aptitude
            <select name="levelQA" id="LQA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="" selected>-select level-</option>
                </select><br>
            <input type ="checkbox" name="domainLA" value="LA" id="DLA" onclick="showLevel('LA');"/>Logical Aptitude
            <select name="levelLA" id="LLA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="" selected>-select level-</option>
            </select><br>
            <input type ="checkbox" name="domainVA" value="VA" id="DVA" onclick="showLevel('VA')";/>Verbal Aptitude
            <select name="levelVA" id="LVA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="" selected>-select level-</option>
            </select><br><br>
            <img src="image<?php echo $_SESSION['count'] ?>.png">
            <br><input type="hidden" name="flag" value="1"/>
            <input type="text" name="input" size="20" maxlength="6">
            <input type="submit" formaction=" <?php echo $_SERVER['PHP_SELF']; ?>" value="submit" name="submit">
            <input type="reset" value="Reset">
         </form>
        <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="submit" value="refresh the page">
        </form>
       <?php 
       }
       ?>
        <div style="width:100px;">
            <center><a href="index.php"><span style="font-size: 20px;">home page</span></a></center></div>
    </body>
   </html>
