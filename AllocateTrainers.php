<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Allocated</title>
        <style>
            th{
                background-color:#FFFFE0;
            }
        </style>
        <link type="text/css" href="RaceStyle.css" rel="stylesheet">
    </head>
    <body>
        <center><h1>RACE</h1></center>
        <?php
         $link=  mysql_connect("127.0.0.1:3306", "root", "root") or die("Server connection failed");
        if(isset($link))
        {
           mysql_selectdb("race", $link) or die("Database Failed");
           $college_check= mysql_query("select * from colleges where trainer_alloc='none';") or die("query1 fail");
           ?>
        
               <?php
           while($rowc=  mysql_fetch_array($college_check))
           {
               $college_domain=$rowc['domain'];
               $college_level=$rowc['level'];
               $college_name=$rowc['college'];
               if($college_level=="any level")
               {
                 $trainer_check=mysql_query("select * from trainers where allocated='no' and domain='$college_domain' and (level='1' or level='2');") or die("query2 fail");
                 $trainer_ava=mysql_num_rows($trainer_check);
                 if($trainer_ava>1)
                 {   ?>
                     <form method="post">
         <table name="info1" align="center" border="1" bgcolor="lavender" cellpadding="15"  width="50%" style="border-collapse: collapse">
        <caption>Select the people to be allocated</caption>    
        <tr><th>Trainer name</th><<th>Select</th></tr>
            <?php
                     $count=0;
                    while($rowtr=  mysql_fetch_array($trainer_check))
                     { $tra_n=$rowtr['trainer'];
                         print "<tr>";
                     ?>
        <td><?php print $tra_n;?></td>
      <td><input type="radio" name="add" value="<?php print $tra_n;?>"></td>
                  
                       
                  <?php
                    print "</tr>";
                     }?>
                     <center>
        <input type="submit" value="buy" name="submit">
        <input type="reset" value="reset" name="reset"></center></table></form><br><br>
                <?php
                }
               }
               else
               {
               $trainer_check=mysql_query("select * from trainers where allocated='no' and domain='$college_domain' and level='$college_level';") or die("query3 fail");
               }
               while($rowt=  mysql_fetch_array($trainer_check))
               {   $trainer_name=$rowt['trainer'];
                   $trainer_domain=$rowt['domain'];
                   $trainer_level=$rowt['level'];
                   mysql_query("update trainers set allocated='$college_name' where trainer='$trainer_name' and domain='$trainer_domain' and level='$trainer_level'") or die("query4 fail");
                   mysql_query("update colleges set trainer_alloc='$trainer_name' where domain='$college_domain' and level='$college_level'") or die("query5 fail");
                   if($college_level=="any level")
               {
                 $trainer_check=mysql_query("select * from trainers where allocated='no' and domain='$college_domain' and (level='1' or level='2');") or die("query2 fail");   
               }
               else
               {
               $trainer_check=mysql_query("select * from trainers where allocated='no' and domain='$college_domain' and level='$college_level';") or die("query3 fail");
               }
               }
           }
        }
        ?>
    <center><h3><p><b>Allocated</b></p></h3>
    </center>
        <table name="info" align="center" border="1" bgcolor="lavender" cellpadding="15"  width="50%" style="border-collapse: collapse">
        <caption>Allocated trainers</caption>    
        <tr><th>Trainer</th><th>domain</th><th>level</th><th>Allocated College</th></tr>
          <?php
        if(isset($link))
        {
            mysql_select_db("race",$link);
            $resultset=  mysql_query("select * from trainers") or die("Query failed");
            while($row=  mysql_fetch_row($resultset))
            {
       print "<tr>";
      foreach($row as $val)
          {   
              ?><td><?php print $val;?></td><?php
          }
          ?>  
              <?php
          print "</tr>";
      }
        }
        ?></table>
        <center><div style="width:100px; margin:100px;">
                <center><a href="index.php"><span style="font-size: 20px;">home page</span></a></center></div></center>
    </body>
</html>
