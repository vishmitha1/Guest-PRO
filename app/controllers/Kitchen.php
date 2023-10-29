<?php
class Kitchen extends Controller
{


    public function dashboard()
    {
        $data = [];
        $this->view('kitchen/v_dashboard', $data);
    }

    public function foodorder()
    {
        $data = [];
        $this->view('kitchen/v_foodorder', $data);
    }

    public function foodmenu()
    {
        $data = [];
        $this->view('kitchen/v_foodmenu', $data);
    }
    public function foodstatus()
    {
        $data = [];
        $this->view('kitchen/v_orderstatus', $data);
    }
}
?>