<?php 
require_once("dboperations.class.php");

class UpdateRun {

    public function getQuery($q){
        $this->query = $q;
        $this->get = $this->getResult();
        return $this->get;
    }

    private function success(){
        $this->status = 'success';
        return $this->status;
    }

    private function error(){
        $this->status = 'error';
        return $this->status;
    }

    private function report(){
        if(!empty($this->query)){
            $updOb = new DBOperations;
            $this->obj = $updOb->setUpdate($this->query);
            $this->status = $this->success();
            return $this->status;   
        } else {
            $this->status = $this->error();
            return $this->status;
        }
    }
    
    private function getResult(){
        $this->response['status'] = $this->report();
        return $this->response;
    }


}


?>