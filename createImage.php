<?php
 function  create_image()
    {
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);  
        imagefilledrectangle($image,0,0,200,50,$background_color);
        $line_color = imagecolorallocate($image, 64,64,64); 
      
        for($i=0;$i<5;$i++) 
        {
          imageline($image,0,rand()%50,200,rand()%50,$line_color);
         }
        $pixel_color = imagecolorallocate($image, 0,0,255);
        
        for($i=0;$i<500;$i++) 
        {
        imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
        }  
           $letters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
           $len = strlen($letters);
           $letter = $letters[rand(0, $len-1)];

           $text_color = imagecolorallocate($image, 0,0,0);
           $word=null;
           $font="C:/Windows/Fonts/Arial.ttf";
         for ($i = 0; $i< 6;$i++) 
         {
         $letter = $letters[rand(0, $len-1)];
         
        // imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
         
          $word=$word.$letter;
         }
         $captcha_text_colour=imagecolorallocate($image,58,94,47);
         imagettftext($image,18,rand(-5,5),rand(15,55),rand(35,40),$captcha_text_colour,$font,$word);
         $_SESSION['captcha_string'] = $word;
         $images = glob("*.png");
         foreach($images as $image_to_delete)
       {
        unlink($image_to_delete);      
       }
        imagepng($image, "image".$_SESSION['count'].".png");
        }



?>



