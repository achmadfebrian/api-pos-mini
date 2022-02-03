<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Category extends RestController
{

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->model('Key_model', 'Key');
  }

  public function add_category_post()
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

        $result = $this->db->insert('category', $params);

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'New category added successfully'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Failed to add category'
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

  public function show_category_post()
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

        $result = $this->db->get('category');

        if ($result->num_rows() > 0) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'row' => $result->num_rows(),
            'data' => $result->result_array(),
            'message' => 'Success'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Data not found!'
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

  public function show_category_id_post()
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

        $result = $this->db->get_where('category', ['id' => $this->input->post('id')]);

        if ($result->num_rows() > 0) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'row' => $result->num_rows(),
            'data' => $result->row_array(),
            'message' => 'Success'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Data not found!'
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

  public function delete_category_post()
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

        $result = $this->db->delete('category', ['id' => $params['id']]);

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Category data has been successfully deleted'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Category data failed to delete'
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

  public function update_category_post()
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

        $this->db->set('category_name', $params['category_name']);
        $this->db->where('id', $params['id']);
        $result = $this->db->update('category');

        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Category data has been successfully updated'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Category data failed to update'
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
