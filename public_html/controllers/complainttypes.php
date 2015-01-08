<?php

class ComplaintTypes extends Controller
{
    protected function get()
    {
        $data = $this->complainttypes_model->getComplaintTypes
        (
            $this->validateParameter($this->urlvalues['apikey'],"API Key",array('Validator::isNotNullAndNotEmpty')),  
       		$this->validateParameter($this->urlvalues['limit'],"Limit",array())         
        );

        $this->returnView(json_encode($data), "plain.php");
    }      
}

?>
