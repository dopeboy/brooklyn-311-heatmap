<?php

class Keys extends Controller
{
    protected function create()
    {
		if ($this->state == 0)
			$this->returnView(null,"naked.php");

		else if ($this->state == 1)
		{
            $key = $this->keys_model->createKey
            (
                $this->validateParameter($this->postvalues['name'],"Name",array('Validator::isNotNullAndNotEmpty'))         
            );

            $this->returnView(json_encode(array("URL" => "/keys/create/${key}/2")));
		}

		else if ($this->state == 2)
			$this->returnView(null,"naked.php");
    }       
}

?>
