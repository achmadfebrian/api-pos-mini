<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Product_image extends RestController
{

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->model('Key_model', 'Key');
  }

  public function add_product_image_post()
  {
    $authorization = $this->Key->authorization();

    if ($authorization == false) {
      // Set the response and exit
      $this->response([
        'status' => false,
        'message' => 'Empty token'
      ], 404);
    } else {

      if ($authorization == $this->Key->beare()) {

        $params = $this->input->post();

        $result = $this->db->insert('product_image', $params);

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'New image added successfully'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Failed to add image'
          ], 404);
        }
      } else {
        // Set the response and exit
        $this->response([
          'status' => false,
          'message' => 'Invalid Token'
        ], 404);
      }
    }
  }

  public function update_product_image_post()
  {
    $authorization = $this->Key->authorization();

    if ($authorization == false) {
      // Set the response and exit
      $this->response([
        'status' => false,
        'message' => 'Empty token'
      ], 404);
    } else {

      if ($authorization == $this->Key->beare()) {

        $params = $this->input->post();

        $this->db->set('product_id', $params['product_id']);
        $this->db->set('image_name', $params['image_name']);
        $this->db->where('id', $params['id']);
        $result = $this->db->update('product_image');

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Image data has been successfully updated'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Image data failed to update'
          ], 404);
        }
      } else {
        // Set the response and exit
        $this->response([
          'status' => false,
          'message' => 'Invalid Token'
        ], 404);
      }
    }
  }
}
