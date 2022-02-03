<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin extends RestController
{

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->model('Key_model', 'Key');
  }

  public function add_admin_post()
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

        $name = $params['name'];
        $email = $params['email'];
        $password = $params['password'];
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $data = [
          'name' => $name,
          'email' => $email,
          'password' => $passwordhash
        ];

        $result = $this->db->insert('admin', $data);

        // Check if the users data store contains users
        if ($result) {
          // Set the response and exit
          $this->response([
            'status' => true,
            'message' => 'Data added successfully'
          ], 200);
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'No users were found'
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

  public function login_post()
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

        $email = $params['email'];
        $password = $params['password'];

        $usercheck = $this->db->get_where('admin', ['email' => $email]);

        if ($usercheck->num_rows() > 0) {

          $data = $usercheck->row();

          if (password_verify($password, $data->password)) {
            # code...
            $this->response([
              'status' => true,
              'data' => ['name' => $data->name, 'email' => $data->email],
              'message' => 'Login successfully'
            ], 200);
          } else {
            // Set the response and exit
            $this->response([
              'status' => false,
              'message' => 'Wrong password'
            ], 404);
          }
        } else {
          // Set the response and exit
          $this->response([
            'status' => false,
            'message' => 'Email not registered'
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
