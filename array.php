<?php

  $arr = array(
    123, 
    'abskfdjf', 
    true, 
    array(7, 8, array(true, false, "IDK")), 
    12345=>"This is a sentence.", 
    'email'=>'johnsmith@yahoo', 
    'address'=>array(
      'line_1'=>'Somewhere', 
      'line_2'=>'', 
      'postcode'=>'50000', 
      'state'=>'WP KL', 
      'country'=>'MY'
    )
  );

  // ..... add more elements ....

  $arr[] = 'new data coming in....';
  $arr[123] = 'new data with lower index coming in....';
  $arr[0] = 34567;
  unset($arr['address']);

  echo '<pre>', print_r($arr, true);
  // echo '<pre>';
  // var_dump($arr);
  echo '<pre><h1>';
  echo 'Number of elements in array: ', count($arr), PHP_EOL;

  $values = array();
  foreach($arr as $key => $value) {
    if (is_array($value)) {
      echo "\$key['$key'] : Array with ", count($value), " element(s)", PHP_EOL;
      continue;  
    }
    echo "\$key['$key'] : $value", PHP_EOL;
    
    $values[] = $value;
  }
  
  print_r(array_keys($arr));