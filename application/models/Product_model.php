<?php

class Product_model extends CI_Model
{
  public function show_product()
  {
    $query = "
    SELECT A.*, B.category_name 
    FROM  product A
    LEFT JOIN category B ON A.category_id = B.id
    
    ORDER BY A.id DESC
    LIMIT 1000;
    ";
    $result = $this->db->query($query);

    return $result;
  }

  public function show_product_id($id)
  {
    $query = "
    SELECT A.*, B.category_name 
    FROM  product A
    LEFT JOIN category B ON A.category_id = B.id
    WHERE A.id = $id
    
    ORDER BY A.id DESC
    LIMIT 1000;
    ";
    $result = $this->db->query($query);

    return $result;
  }
}
