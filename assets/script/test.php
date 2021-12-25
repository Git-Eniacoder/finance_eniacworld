<?php
//thread class
class send_msg extends Thread{
  public $deliverd_to,$fields,$message,$title,$icon,$image,$click_link,$message_id,$result_string,$token_id;
  
  function __construct($message_id,$token,$token_id,$msg,$title,$icon,$image,$click_link) {
  $this->message_id=$message_id;  
  $this->fields= $token;
  $this->message=$msg;
  $this->title=$title;
  $this->icon=$icon;
  $this->image=$image;
  $this->click_link=$click_link;
  $this->result_string='';
  $this->token_id=$token_id;  
  }
  function run(){

$fields = array(
        'registration_ids' =>(array) $this->fields,
        'notification' => array('body' => $this->message,
        'message_id' => $this->message_id, 
        'title' => $this->title,
        "image"=>$this->image,
        "icon"=>$this->icon, 
        "click_action"=>$this->click_link, 'vibrate' => 1, 'sound' => 1)
    );

    $headers=array(
        'Authorization: key=AAAAjoG2mTQ:APA91bGEl8TqtqTr_mJBGG-tqXwRt3VZjz3zfH0TmFaWzmw4D5Od4AJi_jssYJsuhLzUYK2SZA0rxlIAsl9Qqu1uNsU_pA2evCTx48wa8o76U1tWnH1BajOdNrq_p8BQCL-o9lHvjByy',
        'Content-Type:application/json'
    );
  
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    $json_decoded=json_decode($result);

    // for($dead_count=0;$dead_count<count($json_decoded->results);$dead_count++){
    // if(isset($json_decoded->results[$dead_count]->error))
    //   {  
    //     $this->result_string=$this->result_string.(string)$this->token_id[$dead_count].',';//(1000*$this->chunck_count)+$dead_count;
    //   } 
    // }
    $this->deliverd_to=(int)$json_decoded->success;    

    curl_close($ch);
   }
}



//main programe
$test_mode=FALSE;

//connection to DB
if(!$test_mode)
{
$old = ini_set('memory_limit', '8000M');
$conn = new mysqli("127.0.0.1","root","password","admin_push");
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
mysqli_set_charset($conn ,'utf8');
}

//display settings
if(!$test_mode)
{
  echo 
  '<html>
    <h3 style="text-align:center">Please wait for a while we are sending nofification</h3>
  </html>';
  // <center><progress id="file" style="margin: auto; width:50%;  height:30px" value="0" max="100"> 32% </progress><center>
}


//init vars;
$send_to = 0;
$deliverd_to = 0;
$start = microtime(true);
$MIN = -1000000;
$MAX = 0;
$message_id=time().rand();
if (isset($argc) &&  !$test_mode) {
  $title=$argv[1];
  $message=$argv[2];
  $icon=$argv[3];
  $image=$argv[4];
  $click_link=$argv[5];
  $sql_main=$argv[6];
  
}
else {
  $title="Welcome Message";
  $message="Thanks for subscription";
  $icon="icon.png";
  $image="image.jpg";
  $click_link="https://google.com";
  $sql_main='select device_token , id from devices where ';
}


for($itr = 0 ; $itr < 100 ; $itr ++)
{
    $token = array();
    $token_id=array();
    //echo "********".$itr."**********\n";
    $MIN = $MIN + 1000000;
    $MAX = $MAX + 1000000;
  //Taking command line argument 
    $sql = $sql_main .' id > '.$MIN. ' AND id <= '.$MAX;
    echo $sql."<br/>";
if(!$test_mode){
    //fetching data from sql
    $result=$conn->query($sql);
    //$time_elapsed_secs = microtime(true) - $start;
    //echo "Data Fetch TIme:".$time_elapsed_secs."\n";
    $data = mysqli_fetch_all($result);
    $count = 0;
    // print_r($data);
    foreach($data as $value){
      $token[$count] = $value[0];
      $token_id[$count] = $value[1];
      $count++;
    }
  }
  else{
  $te='c0FoFw_5ss5x4NgHiswxoR:APA91bHeOrNqzTjEuhAVJKBXAsRI_ueRQ-9oA8awGf9gDvR5WQbF01fLeXX4Yu9MBsW21EJWmL8y-WkO50vfn0xruc2uD1r33oBMMNXtzrXGU14HvALzlaAT176e0Gko_S02VU_WbCrk';
  for($push_count=0;$push_count<2000000;$push_count++)
  {
    array_push($token,$te);
    array_push($token_id,$push_count);
  }
  }
  //if we reach nth itreation where we are end up with more tokens break condition
  if(count($token) == 0)
    break;
  $send_to =$send_to + count($token);


    //creating chuck of 1000
    $token_chunk = array_chunk($token,1000);
    $token_id_chunk = array_chunk($token_id,1000);
    // echo '<script>document.getElementById("file").max='.count($token_chunk).';</script>';


    for($i=0;$i<count($token_chunk);$i++)
    {
      $thread[$i]=new send_msg($message_id,$token_chunk[$i],$token_id_chunk[$i],$message,$title,$icon,$image,$click_link);
      $thread[$i]->start();
    }

    if(!$test_mode)
    {
      $progress=1;//var for calculate percentage of compleation
      $result_string='';
    } 

    for($i=0;$i<count($token_chunk);$i++)
    {
      $thread[$i]->join();
      if(!$test_mode)
        {
        $deliverd_to=$deliverd_to+$thread[$i]->deliverd_to;
        //$result_string=$result_string.$thread[$i]->result_string;
        // echo '<script>document.getElementById("file").value='.$progress.';</script>';
        $progress++;
      } 
    }

    if(!$test_mode)
    {
      //insert send report into mysql database
      $sql = "INSERT INTO send_report (`message_id`,`Title`, `message`,`icon_path`,`image_path`,`click_link`, `send_to`, `deliverd_to`) VALUES ('$message_id','$title', '$message','$icon','$image','$click_link',$send_to, $deliverd_to)";
      if ($conn->query($sql) != TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
      }
      //updating dead tokens staus into my sql database
      /*$result_string = substr($result_string, 0, -1);
      if(!empty($result_string)){
        $sql = "UPDATE `devices` SET token_status=0 WHERE id IN (".$result_string.")";
        if ($conn->query($sql) != TRUE) {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }*/

    }
  
}

  $time_elapsed_secs = microtime(true) - $start;
  echo '<h4 style="text-align:center">Statistics</h4>';
  echo '<p  style="text-align:center"> Total Time: '.number_format($time_elapsed_secs, 2).' Seconds</p>';
  echo '<p  style="text-align:center"> Total Send: '.$send_to.'</p>';
  echo '<p  style="text-align:center"> Total deliverd: '.$deliverd_to.'</p>';
  echo '<a href="../report"><p  style="text-align:center">Go To Full Report</p></a>';
?>