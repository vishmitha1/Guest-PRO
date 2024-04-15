<?php

    class M_Home{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getRoomDetails(){
            $this->db->query("SELECT * FROM roomtype");
            return $this->db->resultSet();
        }
    }