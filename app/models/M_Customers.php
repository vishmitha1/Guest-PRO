<?php
    
    class M_Customers{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        //dashboard part'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

        //Retrive Last order
        public function retriveLastOrder($data){
            $this->db->query("SELECT * FROM foodorders WHERE user_id=:id ORDER BY order_id DESC LIMIT 1");
            $this->db->bind(':id',$data);
            $row = $this->db->single();

            return $row;
        }

        //Retrive customer food orders to active food orders table in dashboard
        public function retriveFoodOrders($data){
            $this->db->query("SELECT LENgth(quantity)- LENgth(REGEXP_REPLACE(quantity, ',',''))+1 as item_count,
                            order_id,date ,item_name , quantity,img,cost,total,status FROM foodorders WHERE user_id=:id  ORDER BY order_id DESC LIMIT 5");
            $this->db->bind(':id',$data['user_id']);
            $row = $this->db->resultSet();

            return $row;
        }

        //Retrive customer Bill to current bill table
        public function retriveBill($data){
            $this->db->query("SELECT *  FROM expenses WHERE user_id=:id ORDER BY date DESC ");
            $this->db->bind(':id',$data['user_id']);
            $row = $this->db->resultSet();

            return $row;
        }

        //Retrive customer Bill to total bill amount UI
        public function billTotal($data){
            $this->db->query("SELECT sum(amount) as cost  FROM expenses WHERE user_id=:id and status='Not Paid' ");
            $this->db->bind(':id',$data['user_id']);
            $row = $this->db->resultSet();

            return $row;
        }

        

        
        //Reservation part''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''



        //Check room availability for reservation.this one will trigger when customer click submit button in reservation UI
        public function checkroomavailability($data){
            // $this->db->query('SELECT roomtype.category,roomtype.price * :count as price, rooms.roomNo,roomtype.roomImg from rooms INNER JOIN roomtype ON roomtype.category=rooms.category and   availability=:avail GROUP BY roomtype.category ');
            $this->db->query("WITH RankedRooms AS (
                                                SELECT
                                                    category,
                                                    roomNo,
                                                    ROW_NUMBER() OVER (PARTITION BY category ORDER BY roomNo) AS row_num
                                                FROM
                                                    rooms
                                                WHERE
                                                    availability = :avail
                                            )
                                            SELECT
                                                RankedRooms.category,
                                                GROUP_CONCAT(RankedRooms.roomNo) AS roomNo,
                                                roomtype.price,
                                                roomtype.roomImg
                                            FROM
                                                RankedRooms
                                            INNER JOIN
                                                roomtype ON roomtype.category = RankedRooms.category
                                            WHERE
                                                row_num <= :count
                                            GROUP BY
                                                RankedRooms.category, roomtype.price, roomtype.roomImg");
            $this->db->bind('avail','yes');
            $this->db->bind('count',$data['roomcount']);
            $row=$this->db->resultSet();
            return $row;
        }


        //function for the place reservation
        public function placereservation($data){
            $this->db->query('INSERT INTO reservations (user_id,checkIn,checkOut,roomNo) VALUES(:id,:indate,:outdate,:roomNo)');
            $this->db->bind('id',$data["user_id"]);
            $this->db->bind('indate',$data["indate"]);
            $this->db->bind('outdate',$data["outdate"]);
            $this->db->bind('roomNo',$data["roomNo"]);

            //split roomNo one by one
            $roomNo = explode(",",$data["roomNo"]);
            
            if($this->db->execute()){
                //change room availability
                if($this->changeRoomAvailability($roomNo,'no')){

                    //add to bill this reservation
                    if($this->addExpenses($data,"Reservation Cost")){
                        return true;
                    }
                    else{
                        return false;
                    }
                   
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
        }


        //function to change room availability
        public function changeRoomAvailability($data,$avail){
            if(is_array($data)){
                for($i=0;$i<sizeof($data);$i++){
                    $this->db->query('UPDATE rooms SET availability = :avail WHERE roomNo=:roomNo');
                    $this->db->bind('roomNo',$data[$i]);
                    
                    $this->db->bind('avail',$avail);
                    if($this->db->execute()){
                        continue;
                    }
                    else{
                        return false;
                    }
                    
                }
                return true;
            }

            else{
                $this->db->query('UPDATE rooms SET availability = :avail WHERE roomNo=:roomNo');
                $this->db->bind('roomNo',$data);
                
                $this->db->bind('avail',$avail);
                if($this->db->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }
            
        }


        //This one use to retrive reservation details to reservation UI fill reservation hostory table
        public function retriveReservations($data){
            $this->db->query("SELECT  (LENGTH(roomNo) - LENGTH(REPLACE(roomNo, ',', '')) + 1)AS roomcount ,reservation_id,checkIn,checkOut,roomNo FROM reservations WHERE user_id=:id LIMIT 5");
            $this->db->bind(':id',$data['user_id']);
            
            $row = $this->db->resultSet();
           
            return $row;
        }


        //This one use to cancel reservation
        public function deleteReservation($data){
            $this->db->query("DELETE FROM reservations WHERE user_id = :u_id AND reservation_id = :res_id  ");
            $this->db->bind('u_id',$data['user_id']);
            $this->db->bind('res_id',$data['reservation_id']);


            //split roomNo one by one
            if( (substr_count($data["roomNo"],",")+1) >1 ){
                $roomNo = explode(",",$data["roomNo"]);
            }
            else{
                $roomNo = $data["roomNo"];
            }
            
            
            if($this->db->execute()){
                if($this->changeRoomAvailability($roomNo,'yes')){
                    return true;
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
        }

        
        //update reservation
        public function updateReservation($data){
            $this->db->query("UPDATE reservations SET checkIn=:indate,checkOut=:outdate,roomNo=:roomNo WHERE user_id=:id AND reservation_id=:res_id");
            $this->db->bind('id',$data["user_id"]);
            $this->db->bind('indate',$data["indate"]);
            $this->db->bind('outdate',$data["outdate"]);
            $this->db->bind('roomNo',$data["roomNo"]);
            $this->db->bind('res_id',$data["reservation_id"]);

            
            //split roomNo one by one
            if( (substr_count($data["roomNo"],",")+1) >1 ){
                $roomNo = explode(",",$data["roomNo"]);
            }
            else{
                $roomNo = $data["roomNo"];
            }

            //split old roomNo one by one
            if( (substr_count($data["oldroomNo"],",")+1) >1 ){
                $oldroomNo = explode(",",$data["oldroomNo"]);
            }
            else{
                $oldroomNo = $data["oldroomNo"];
            }
            
            if($this->db->execute()){
                if($this->changeRoomAvailability($roomNo,'no')){
                    
                    if($this->changeRoomAvailability($oldroomNo,'yes')){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
        }







        //Food order part'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


        //Load food menu to food order UI
        public function loadfoodmenu(){
            $this->db->query("SELECT * FROM fooditems ");
            
            $row = $this->db->resultSet();
            
            return $row;
        }


        //When customer place a order ,ordered items will store cart db 
        public function insertcart($data){
            $this->db->query('Insert into carts(item_no,user_id,quantity,item_name,price,image) VALUES(:item_no,:id ,:quantity ,:item_name,:price,:image)');
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind(':quantity',$data['quantity']);
            $this->db->bind(':item_name',$data['name']);
            $this->db->bind(':price',$data['price'] );
            $this->db->bind(':image',$data['image'] );
            $this->db->bind(':item_no',$data['item_id'] );

            
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        //Check cart item is already in the cart or not.this one use in when customer click add to cart button on items
        public function checkcartitem($data){
            $this->db->query('SELECT * FROM carts WHERE user_id=:id AND item_no=:itemNo ');
            $this->db->bind('id',$data['user_id']);
            $this->db->bind('itemNo',$data['item_id']);
            $row=$this->db->resultSet();
            if($this->db->rowCount() > 0){
                
                return false;
            }
            else{
               
                return true;
            }
            
        }


        //Retrive items to thecart. when clicked remove button on the cart
        public function removecartitems($data){
            $this->db->query("DELETE FROM carts WHERE user_id = :u_id AND item_no = :item_id");
            $this->db->bind('u_id',$data['user_id']);
            $this->db->bind('item_id',$data['item_no']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        
        
        //Retrive items to thecart. when clicked cart all the items retrive to the cart..
        public function retrivefoodcart($data){
            $this->db->query("SELECT * FROM carts WHERE user_id=:id ");
            $this->db->bind(':id',$data);
            
            if($this->db->execute()){
                $row = $this->db->resultSet();
                $row=array_reverse($row);
                return $row;
            }
            else{
                return false;
                
            }
           
        }

        

        // Itemo count on the cart Icon
        public function cartTotal($data){
            $this->db->query("SELECT COUNT(*) FROM carts WHERE user_id=:id ");
            $this->db->bind(':id',$data);
            $row = $this->db->single();

            return $row;
        }


        //Place order
        public function placeOrder($id,$var,$data){
            
            $qty=$name=$cost=$itemid=$img='';
            foreach($var as $item){
                
                $qty.=$item->quantity.',';
                $cost.=($item->price).',';
                $name.=$item->item_name.',';
                $itemid.=$item->item_no.',';
                $img.=$item->image.',';
            }
            $qty=trim($qty,',');
            $name=trim($name,',');
            $cost=trim($cost,',');
            $itemid=trim($itemid,',');
            $img=trim($img,',');
       
            $this->db->query("INSERT INTO foodorders (user_id,quantity,item_name,roomNo,cost,item_no,img,total) VALUES(:id,:quantity,:item_name,:roomNo,:cost,:item_id,:img,:tot)");
            // $this->db->query("INSERT INTO foodorders (user_id) VALUES(:id)");
            $this->db->bind(':id',$id);
            $this->db->bind(':quantity', $qty);
            $this->db->bind(':item_name',$name);
            $this->db->bind(':roomNo',$data['roomNo']);
            $this->db->bind(':cost',$cost);
            $this->db->bind(':item_id',$itemid);
            $this->db->bind(':img',$img);
            $this->db->bind(':tot',$data['price']);
            
            if($this->db->execute()){
                if($this->deleteallCartitems($id)){

                    //add to bill this order
                    if($this->addExpenses($data,"Food Order Placed")){
                        return true;
                    }
                    else{
                        return false;
                    }
                    
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }

           
              
            
        }

        

        //Dlete all the items in the cart.this one used after place order.. delete al the item belongs to that customer
        public function deleteallCartitems($data){
            $this->db->query("DELETE FROM carts WHERE user_id = :u_id ");
            $this->db->bind('u_id',$data);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        //Retrive Reservation Room number for food order and service request
        public function retriveRoomNo($id){
            $this->db->query("SELECT roomNo FROM reservations WHERE user_id=:id ");
            $this->db->bind(':id',$id);
            $row = $this->db->resultSet();

            return $row;
        }

        //Update order
        public function updateOrder($data,$id){
          
            
                $item=$data;
                $itemNames = explode(",",$item ->item_name);
				$itemCosts = explode(",", $item->cost);
				$quantities = explode(",", $item->quantity);
                $itemImgs = explode(",", $item->img);
                $itemIds = explode(",", $item->item_no);
                
                
            for($i=0;$i<count($itemNames);$i++){
                $param = [
                    'name' => $itemNames[$i],
                    'price' => $itemCosts[$i],
                    'quantity' => $quantities[$i],
                    'image' => $itemImgs[$i],
                    'item_id' => $itemIds[$i],
                    'user_id' => $id
                ];
                // echo $param['name'];
                if($this->checkcartitem($param)){
                    if($this->insertcart($param)){
                    continue;
                    }
                    else{
                        return false;
                    }
                
                
                }
            }
            return true;
				
				
        }

        public function test(){
            $this->db->query("SELECT * FROM carts  ");
            $row = $this->db->resultSet();
            $row=array_reverse($row);
            return $row;

        }

      
        

        //function for the add expenses

        public function addExpenses($data , $category=''){
            $this->db->query('INSERT INTO expenses (user_id,amount,description,status) VALUES(:id,:amount,:description,:status)');
            $this->db->bind('id',$data["user_id"]);
            $this->db->bind('description',$category);
            $this->db->bind('amount',$data["price"]);
       
            $this->db->bind('status','Not Paid');
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        
        

       

        //ServiceRequest
        public function placeserviceRequest($data){
            $this->db->query('INSERT INTO servicerequests (roomNo,user_id,category,AddDetails,SpecDetails) VALUES(:roomNo,:id,:category,:AddDetails,:SpecDetails)');
            $this->db->bind('id',$data["user_id"]);
            $this->db->bind('category',$data["category"]);
            $this->db->bind('AddDetails',$data["AddDetails"]);
            $this->db->bind('SpecDetails',$data["SpecDetails"]);
            $this->db->bind('roomNo',$data["roomNo"]);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }



        //Review waiter''''''''''''''''''''''''''''''''''''''''
        public function getwaiterdetails(){
            $this->db->query("SELECT * FROM waiters ");
            $row = $this->db->resultSet();
            return $row;
        }
    
    }