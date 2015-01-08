<?php

class ComplaintTypesModel extends Model 
{
	public function getComplaintTypes($key, $limit)
	{
		$sqlParameters = array();

		if ($limit == null)
			$sqlParameters[":limit"] = 1000;
		else
			$sqlParameters[":limit"] = $limit;

        $preparedStatement = $this->dbh->prepare('SELECT DISTINCT TYPE FROM COMPLAINT ORDER BY TYPE LIMIT :limit');
        $preparedStatement->execute($sqlParameters);     
        
        return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
	}    
}

?>
