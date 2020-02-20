<?php
// echo "<h2> user record </h2>";
// print_r($id);
// echo "<br>";
// echo $fname. "  " .$lname;
// echo "<br>";
// echo $upicture;
// echo "<hr>";
// echo "<br>";
// echo "<h2> list of user groups </h2>";
// foreach($groups as $group){
//     echo $group -> title;
//     echo "<br>";
//     echo $group -> fullname;
//     echo "<br>";
//     //echo $group -> created_at;
//     $date=date_create_from_format("Y-n-j G:i:s",$group -> created_at);
//     echo date_format($date,"d/m/Y");
//     echo "<br>";
//     echo $group -> pic;
//     echo "<hr>";
// }
// echo "<br>";
// echo "<h2> list of user friends </h2>";
// foreach($ufriends as $friend){
//     echo $friend -> fullname;
//     echo "<br>";
// } 

// echo $id;
// echo '<br>';
// echo $title;
// echo '<br>';
// echo $pic;
// echo '<br>';
// echo '<br>';
// echo '<br>';
// foreach($group_member as $group){
//   echo $group -> fullname;
//   echo '<br>';
//   echo $group -> picture;
//   echo '<br>';
//   echo '<br>';
// }

foreach($friends as $friend){
  echo $friend -> fullname;
  echo "<br>";
  echo $friend -> picture;
  echo "<br>";
}


?>

<!-- <!DOCTYPE html>
<html lang="en">
 <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    </head>
    <body>
    <div class="container">
      <div class="row">
         <div class="col-md-6">
           <div class="row">
            <div class="col-md-12">
               </div>
             </div>
          </div>               
      </div>
  </div>        
    </body>
</html> -->