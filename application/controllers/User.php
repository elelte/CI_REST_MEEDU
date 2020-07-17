<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {
    // construct
    public function __construct(){
        parent::__construct();

        $this->load->database();

        $this->load->model('MAuth');
        $this->load->model('MUser');
    }
    
    public function register_post(){
        $email    = $this->input->post('email');
        $username = $this->input->post('username');
        $phone    = $this->input->post('phone');
        $password = $this->input->post('password');

        //Check Email 
        $data = $this->MUser->detail($email);
        if (count($data) == 0){
            //Insert User
            $param = [
                "email"     => $email,
                "username"  => $username,
                "phone"     => $phone,
                "password"  => $password
            ];
            $data = $this->MUser->insert_user($param);
            $this->response(ResponseTemplate(null, 200, "Register Berhasil"), 200);
        }
        else{
            $this->response(ResponseTemplate(null, 401, "Email sudah dipakai"), 401);
        }
    }

    public function login_post(){
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        
        $data = $this->MUser->login($email, $password);

        if (count($data) == 1){
            $user  = $data[0];
            $token = $this->MAuth->generate_token($user);
            $this->response(ResponseTemplate($token, 200, "Berhasil"), 200);
        }else{
            $this->response(ResponseTemplate(null, 401, "User tidak ditemukan"), 401);
        }
    }

    public function detail_get(){
        //AUTH
        $valid_token = $this->MAuth->validated_token();
        if ($valid_token[0]){
            $data = $this->MUser->detail($valid_token[1]);
            $this->response(ResponseTemplate($data[0], 200, "Access Granted"), 200);
        }
        else{
            $this->response(ResponseTemplate(null, 401, $valid_token[1]), 401);
        }
    }
}