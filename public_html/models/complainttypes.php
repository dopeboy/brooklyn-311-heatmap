<?php

class ComplaintTypesModel extends Model 
{
	public function getComplaintTypes($key, $limit)
	{
		// Check API key
		$this->checkAPIKey($key);

		$sqlParameters = array();

		if ($limit == null)
			$sqlParameters[":limit"] = 1000;
		else
			$sqlParameters[":limit"] = $limit;

        $preparedStatement = $this->dbh->prepare('SELECT DISTINCT TYPE FROM COMPLAINT ORDER BY TYPE LIMIT :limit');
        $preparedStatement->execute($sqlParameters);     
        
		// Update count
		$this->updateRequestCount($key);

        return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
	}    
}

?>
