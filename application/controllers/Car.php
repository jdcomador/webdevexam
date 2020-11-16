<?php

class Car extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('car_model');
    }

    public function index(){
        $result['car_queue'] = $this->car_model->select_queue();

        $this->load->view('includes/header');
        $this->load->view('index', $result);
        $this->load->view('includes/footer');
    }

    public function check_queue(){
        $plate_num = $this->input->post('plate_num');
        $curr_color = $this->input->post('curr_color');
        $target_color = $this->input->post('target_color');

        $result = $this->car_model->check_queue();
        if(count($result) <= 5){
            $queue = 1;
        } else {
            $queue = 0;
        }

        $result = $this->car_model->add_queue($plate_num, $curr_color, $target_color, $queue);
        
        echo json_encode($result);
    }

    public function car_completed(){
        $id = $this->input->post('id');

        $result = $this->car_model->car_completed($id);
    }

}