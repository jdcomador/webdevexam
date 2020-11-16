<?php

class Car_model extends CI_MODEL {

    public function check_queue(){
        $query = "SELECT * FROM car WHERE car_queue = 0 and car_status = 1";

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function add_queue($plate_num, $curr_color, $target_color, $queue){
        $query = "INSERT INTO car(plate_number, current_color, target_color, car_queue, car_status) VALUES ('$plate_num', '$curr_color', '$target_color', $queue, 1)";

        $result = $this->db->query($query);
        return $result;
    }

    public function select_queue(){
        $query = "SELECT * FROM car WHERE car_status = 1";

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function car_completed($id){
        $query = "UPDATE car SET car_status = 0 WHERE id = $id";
        $this->db->query($query);

        $query2 = "UPDATE car SET car_queue = 0 WHERE car_queue = 1 LIMIT 1";
        $this->db->query($query2);
    }
}