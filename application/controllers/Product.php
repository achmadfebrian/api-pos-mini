<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Product extends RestController
{

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->model('Key_model', 'Key');
    $this->load->model('Product_model', 'Product');
  }

  public function add_product_post()
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

        $result = $this->db->insert('product', $params);

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'New product added successfully'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Failed to add product'
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

  public function show_product_post()
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

        $result = $this->Product->show_product();

        if ($result->num_rows() > 0) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'row' => $result->num_rows(),
            'data' => $result->result_array(),
            'message' => 'Success'
          ], 404);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Data not found!'
          ], 404);
          # code...
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

  public function show_product_id_post()
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

        $id = $this->input->post('id');
        $result = $this->Product->show_product_id($id);

        if ($result->num_rows() > 0) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'row' => $result->num_rows(),
            'data' => $result->row_array(),
            'message' => 'Success'
          ], 404);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Data not found!'
          ], 404);
          # code...
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

  public function delete_product_post()
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

        $result = $this->db->delete('product', ['id' => $params['id']]);

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Product data has been successfully deleted'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Product data failed to delete'
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

  public function update_product_post()
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

        $this->db->set('category_id', $params['category_id']);
        $this->db->set('product_name', $params['product_name']);
        $this->db->set('price', $params['price']);
        $this->db->set('description', $params['description']);
        $this->db->where('id', $params['id']);
        $result = $this->db->update('product');

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Product data has been successfully updated'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Product data failed to update'
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
