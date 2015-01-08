<?php

class Agencies extends Controller
{
    protected function get()
    {
        $data = $this->agencies_model->getAgencies
        (
            $this->validateParameter($this->urlvalues['apikey'],"API Key",array('Validator::isNotNullAndNotEmpty')),  
       		$this->validateParameter($this->urlvalues['limit'],"Limit",array())         
        );

        $this->returnView(json_encode($data), "plain.php");
    }      
}

?>
