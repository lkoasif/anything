<?php
error_reporting(0);
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
 $card = new HTMLDocument($html_codes);

$data_array=array();
/**
 * eruhg uo453tghy we4 y465y ihgt u5gh wu5h45ughy5
 */
$k=0;
foreach ($card->querySelectorAll('.img-fluid') as $a )
{
    $data_array[$k]['src']=trim($a->src);
 $k++;
}

$j=0;
foreach ($card->querySelectorAll('.card-title') as $h4)
 {
    $data_array[$j]['title']=trim($h4->innerText);
    $j++;
 }

  echo "<pre>";
  print_r($data_array);

// $img =$card->querySelectorAll('.img-fluid')->src;
 //print_r($img);
 
 //$title =$card->querySelectorAll(".card-title")->innerText;
    //echo "\n $img:<br>" . $card->src;

    foreach($data_array as $data_val){
        $title=$data_val['title'];
        $img=$data_val['src'];
        $url=$data_val['title'];

     $sql="select * from image_title where title='$title'";
     $result = mysqli_query($conn, $sql);
     //echo mysqli_num_rows($result);
     if (mysqli_num_rows($result)==0) {
           $date=date('Y-m-d h:i:s');
     $sql="INSERT INTO image_title(website_url,image_url,title,post_date) VALUES ('$url', '$img','$title','$date')";
     if (mysqli_query($conn, $sql)) {

     echo "inserted record";

      }
     }else{
    echo "already exsit";
    }
}


  


      ?>







