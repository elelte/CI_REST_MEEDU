<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Berita extends REST_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->database();

        $this->load->model('MAuth');
        $this->load->model('MBerita');
    }
    
    public function index_get(){
        //AUTH
        $valid_token = $this->MAuth->validated_token();
        if ($valid_token[0]){
            $data = $this->MBerita->get_list();
            $this->response(ResponseTemplate($data, 200, "Berhasil"), 200);
        }
        else{
            $this->response(ResponseTemplate(null, 401, $valid_token[1]), 401);
        }
    }
}

?>