<?php

class Complaints extends Controller
{
    protected function get()
    {
        $data = $this->complaints_model->getComplaints
        (
            $this->validateParameter($this->urlvalues['apikey'],"API Key",array('Validator::isNotNullAndNotEmpty')),
            $this->validateParameter($this->urlvalues['complaint-type'],"Complaint type",array()),         
            $this->validateParameter($this->urlvalues['agency'],"Agency",array()),    
       		$this->validateParameter($this->urlvalues['limit'],"Limit",array())         
        );

        $this->returnView(json_encode($data), "plain.php");
    }      
}

?>
