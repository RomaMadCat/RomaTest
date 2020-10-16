<?php
if (isset($_COOKIE["NAHUI"])) {
	header('Location: http://google.com/');
	return;
	}
$API = [
  'key' => '1887',   
  'secret' => '6ebdd15d0f6226978d90fa0568c25abe'  
];

function send_the_order($post, $API) {
  $ip = $_SERVER['REMOTE_ADDR'];
  $sub1 = (isset($_GET['_clickid']) && !empty($_GET['_clickid'])) ? $_GET['_clickid'] : $_POST['clickid'];
  $sub2 = $_POST['bay'];
  $fbp = (isset($_GET['_fbp']) && !empty($_GET['_fbp'])) ? $_GET['_fbp'] : $_POST['fbp'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $address = $_POST['address'];
  $zipcode = $_POST['zipcode'];
  $params = [

      'flow_url' => 'https://leadrock.com/URL-04359-B6E87',  //ссылка на поток, подставлять свои значения
      'user_phone' => $post['phone'],
      'user_name' => $post['name'],
      'other' => $post['other'],
      'ip' => $_SERVER['REMOTE_ADDR'],
      'ua' => $_SERVER['HTTP_USER_AGENT'],
      'api_key' => $API['key'],
      'sub1' => $sub1,
      'sub2' => $sub2,
      'other[address]' => $post['address'],
      'other[city]' => $post['city'],
      'other[zipcode]' => $post['zipcode'],
      'other[quantity]' => '1'
  ];


  $url = 'https://leadrock.com/api/v2/lead/save';

  $trackUrl = $params['flow_url'] . (strpos($params['flow_url'], '?') === false ? '?' : '') . '&ajax=1' . '&ip=' . $params['ip'] . '&ua=' . $params['ua'];
  foreach ($params as $param => $value) {
      if (strpos($param, 'sub') === 0) {
          $trackUrl .= '&' . $param . '=' . $value;
          unset($params[$param]);

      }

  }

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $trackUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  $params['track_id'] = curl_exec($ch);

   $params['sign'] = sha1(http_build_query($params) . $API['secret']);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
  $return = curl_exec($ch);
  curl_close($ch);
  setcookie("NAHUI", "123", time() + (3600 * 24));
  
  date_default_timezone_set('Europe/Moscow');
  $time = date('Y-m-d H:i:s');
  $message = "$time;$sub2;$fbp;$address;$city;$zipcode;$sub1;$ip;$name;$phone;$return\n";
  file_put_contents('log.txt', $message, FILE_APPEND | LOCK_EX); 
  



header("Location: success.html");

$urls = 'http://keitaro.cc/56b2efe/postback?status=lead&subid=' . urlencode($sub1) . '&sub_id_12=' . $name . '&sub_id_13=' . $phone;

file_get_contents($urls);

exit;

}

if (!empty($_POST['phone'])) {

  send_the_order($_POST, $API);

}

?>
