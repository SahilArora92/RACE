<!DOCTYPE html>
<?php session_start();
$_SESSION['count']=time();?>
<html>
    <head>
        <title>Add Colleges</title>
        <link type="text/css" href="RaceStyle.css" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
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
                
        var NewCount = 0;
          if (document.signup.domainQA.checked)
           {NewCount = NewCount + 1}

              if (document.signup.domainLA.checked)
              {NewCount = NewCount + 1}

              if (document.signup.domainVA.checked)
              {NewCount = NewCount + 1}

              if (NewCount == 3)
              {
                alert('Only 2 sessions are allowed...!!');
                document.signup; return false;
                 }
        }
        var rowNum=0;
        function addDates(frm)
        {
        rowNum ++;
        var row = '<p id="rowNum'+rowNum+'">days: <input type="date" name="qty[]" required value="'+frm.add_day.value+'"> <input type="button" value="Remove" onclick="removeRow('+rowNum+');"></p>';
           jQuery('#multipleDays').append(row);
          frm.add_day.value = '';
        }
        function removeRow(rnum)
        {
            jQuery('#rowNum'+rnum).remove();
        }
        $(function(){     
           $('.datetype').click(function(){
                  $('#start_end_date').show();
                  $('#multipleDays').hide();
                  if ($(this).attr("id") == "start_id")
                     {
                      $('#start_end_date').show();
                      $('#multipleDays').hide();
                      } 
                  else if ($(this).attr("id") == "days_id")
                     {
                      $('#start_end_date').hide();
                      $('#multipleDays').show();
                     }
                                              });
                   });
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
        $college=$_POST['college'];
        $radio=$_POST['datetype'];
        $link=  mysql_connect("127.0.0.1:3306", "root", "root") or die("Server connection failed");
        if(isset($link))
        {
            mysql_selectdb("race", $link) or die("Database Failed");
            if($radio=="multiple_days")
            {
                if(!empty($_POST['qty'])) 
                    {
                    foreach($_POST['qty'] as $qty1) 
                       {
                        mysql_query("INSERT INTO dates(college,days) VALUES ('$college','$qty1');" or die("query fail"));
                       }
                    }
            }
            else if($radio=="start_end")
            {  $start=$_POST['startdate'];
               $end=$_POST['enddate'];
                $start1=  date_create($start);
                $end1= date_create($end);
                $diff=  date_diff($start1, $end1);
                $diff= $diff->format("%R%a");
                while($diff>=0)
                {   
               $diff--;
               $start2 = $start1->format('Y-m-d');
                    mysql_query("INSERT INTO dates(college,days) VALUES ('$college','$start2');") or die("query fail");
                    $start1->add(new DateInterval('P1D'));
                }
            }
            
            if(isset($DLA) && !isset($DQA) && !isset($DVA))
           $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DLA','$LLA','2')") or header("Location:CollegeReject.php");
           else if(isset($DQA) && !isset($DLA) && !isset($DVA))
            $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DQA','$LQA','2')") or header("Location:CollegeReject.php");
            else if(isset($DVA) && !isset($DQA) && !isset($DLA))
           $indicator= mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DVA','$LVA','2')") or header("Location:CollegeReject.php");
            else if(isset($DLA) && isset($DQA) && !isset($DVA))
            {
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DLA','$LLA','1')") or header("Location:CollegeReject.php");
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DQA','$LQA','1')") or header("Location:CollegeReject.php");
            }
            else if(!isset($DLA) && isset($DQA) && isset($DVA))
            {
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DVA','$LVA','1')") or header("Location:CollegeReject.php");
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DQA','$LQA','1')") or header("Location:CollegeReject.php");
            }
            else if(isset($DLA) && !isset($DQA) && isset($DVA))
            {
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DLA','$LLA','1')") or header("Location:CollegeReject.php");
                $indicator=mysql_query("insert into colleges(college,domain,level,sessions) values('$college','$DVA','$LVA','1')") or header("Location:CollegeReject.php");
            }
            if($indicator>0)
            {
                
                header("Location:CollegeSuccess.php");
            }
            else
            {   
                 header("Location:CollegeReject.php");
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
            College Name<br>
            <input size="35" type ="text" name="college" required="required" /><br><br>
            Domain<br>
            <input  type ="checkbox" name="domainQA" value="QA" id="DQA" onclick="return showLevel('QA');"/>Quantative Aptitude
            <select name="levelQA" id="LQA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="any level">Any level</option>
                <option value="" selected>-select level-</option>
                </select><br>
            <input type ="checkbox" name="domainLA" value="LA" id="DLA" onclick="return showLevel('LA');"/>Logical Aptitude
            <select name="levelLA" id="LLA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="any level">Any level</option>
                <option value="" selected>-select level-</option>
            </select><br>
            <input type ="checkbox" name="domainVA" value="VA" id="DVA" onclick="return showLevel('VA')";/>Verbal Aptitude
            <select name="levelVA" id="LVA" style="display: none;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="any level">Any level</option>
                <option value="" selected>-select level-</option>
            </select><br><br>
            Start-End date<input type="radio" name="datetype" id="start_id" class="datetype" value="start_end">&nbsp;multiple days<input type="radio" id="days_id" name="datetype" class="datetype" value="multiple_days"><br>
            <div id="start_end_date" style="display:none;">
            Start date
            <input type="date" name="startdate" required><br>
            End date
            <input type="date" name="enddate" required>
            </div>
            
            <div id="multipleDays" style="display:none;">
            days:
            <input type="date" name="add_day">
            <input type="button" name="add_dates" onclick="addDates(this.form);" value="Add Date">
            </div>
            
            <br><br>
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
