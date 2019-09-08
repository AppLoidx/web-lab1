<?php
function array_to_json( $array ){

  if( !is_array( $array ) ){
    return false;
  }

  $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
  if( $associative ){

    $construct = array();
    foreach( $array as $key => $value ){

      if( is_numeric($key) ){
        $key = "key_$key";
      }
      $key = '"'.addslashes($key).'"';

      if( is_array( $value )){
        $value = array_to_json( $value );
      } else if( !is_numeric( $value ) || is_string( $value ) ){
        $value = '"'.addslashes($value).'"';
      }

      $construct[] = "$key: $value";
    }

    $result = "{ " . implode( ", ", $construct ) . " }";

  } else {

    $construct = array();
    foreach( $array as $value ){

      if( is_array( $value )){
        $value = array_to_json( $value );
      } else if( !is_numeric( $value ) || is_string( $value ) ){
        $value = '"'.addslashes($value).'"';
      }

      $construct[] = $value;
    }

    $result = "[ " . implode( ", ", $construct ) . " ]";
  }

  return $result;
}

$start = microtime(true);
$ajaxRequest = $_GET;
$x = $ajaxRequest["x"];
$y = $ajaxRequest["y"];
$z = $ajaxRequest["z"];

if (
  ( $x <= 0 && $y<= 0 && $x >= -$z && $y >= -$z) || // нижний квадрат
  ( $x >= 0 && $y<= 0 && $y >= $x - $z) || // нижний треугольник
  ( $x <= 0 && $y>=0 && ($x**2 + $y**2 <= $z ** 2) ) //верхний полукруг
){
  $res = "yes";
} else {
  $res = "no";
}
$output = array(
  "x" => $x,
  "y" => $y,
  "R" => $z,
  "res" => $res,
  "time" => date("d.m.Y H:i"),
  "benchmark" => round(microtime(true) - $start, 5),
);


  echo array_to_json($output);
