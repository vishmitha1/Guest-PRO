<?php

class M_Managers{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function insertroomdetails($data){
            $this->db->query('Insert into rooms(roomno ,floor ,price,category) VALUES(:roomno ,:floor ,:price,:category)');
            $this->db->bind(':roomno', $data['roomno']);
            $this->db->bind(':floor',$data['floor'] );
            $this->db->bind(':price',$data['price'] );
            
            $this->db->bind(':category',$data['category'] );
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
    }

    public function getroomdetails(){
        $this->db->query("SELECT * FROM rooms ");
            
            $row = $this->db->resultSet();
            // echo($row[0]->order_id);
            // echo("<br>".count($row));
            // echo("<br>");
            $row=array_reverse($row);

            return $row;
    }


    public function updatetroomdetails($data){
        $this->db->query('UPDATE rooms SET 
        floor=:floor ,
        category=:category ,
    
        price=:price WHERE roomno= :param');
        
        $this->db->bind(':param', $data['roomno']);
        $this->db->bind(':floor', $data['floor']);
        $this->db->bind(':category',$data['category'] );
        
        $this->db->bind(':price',$data['price'] );

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteroom($param) {
        $this->db->query("DELETE FROM rooms WHERE roomno= :id ");
        $this->db->bind(':id',$param);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}