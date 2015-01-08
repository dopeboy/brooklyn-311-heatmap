<?php

class KeysModel extends Model 
{    
    public function createKey($name)
    {   
		$sqlParameters[":name"] = $name;
		$sqlParameters[":key"] = uniqid();;
		$sqlParameters[":date_created"] = date("Y-m-d H:i:s");
        $preparedStatement = $this->dbh->prepare('INSERT INTO API_KEY (NAME, KEY_VALUE, CREATE_DATE) VALUES (:name, :key, :date_created)');
        $preparedStatement->execute($sqlParameters);

		return $sqlParameters[":key"];
    }  	
}

?>
