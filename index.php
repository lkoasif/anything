<?php
//error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webscrawling";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if($conn){


}
use Gt\Dom\HTMLDocument;
require './vendor/autoload.php';
//include ('html.php');
$url = "https://dailynewshighlights.com/sports";
$html_codes = file_get_contents($url);
//echo $html_codes;
$document = new HTMLDocument($html_codes);

$news_cards = $document->querySelectorAll('.card');
echo"<pre>";
//print_r($news_cards);
foreach($news_cards as $card)
{
  $title = mysqli_real_escape_string($conn, $card->querySelector('.card-title')->innerText);
  $img =mysqli_real_escape_string($conn, $card->querySelector('.img-fluid')->src);
  $time = $card->querySelector('.time-stamp')->innerText;
  $date = date('Y-m-d H:i:s',strtotime($time));

   $sql="select * from image_title where title='$title' or image_url='$img'";
   $result = mysqli_query($conn,$sql);
   $row=mysqli_num_rows($result);
   if($row>0){
    echo "data already exist";

   }else{


    echo $sql="INSERT INTO image_title(website_url,image_url,title,post_date) VALUES ('$url', '$img','$title','$date')";
    $query=mysqli_query($conn, $sql);
    

   }   
}
exit;


?>





