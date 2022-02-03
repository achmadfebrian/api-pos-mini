<?php

class Key_model extends CI_Model
{
  public function beare()
  {
    $bearertoken = "Bearer kso349JK()#&*ok2781*(bskjfaajvbwue919as90fqj";
    return $bearertoken;
  }

  public function authorization()
  {
    $header = getallheaders();

    if (isset($header['Authorization'])) {

      $authorization = $header['Authorization'];

      return $authorization;
    } else {

      return false;
    }
  }
}
