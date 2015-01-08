<?php

class AgenciesModel extends Model 
{
	public function getAgencies($key, $limit)
	{
		// Check API key
		$this->checkAPIKey($key);

		$sqlParameters = array();

		if ($limit == null)
			$sqlParameters[":limit"] = 100;
		else
			$sqlParameters[":limit"] = $limit;

        $preparedStatement = $this->dbh->prepare('SELECT DISTINCT AGENCY FROM COMPLAINT ORDER BY AGENCY LIMIT :limit');
        $preparedStatement->execute($sqlParameters);     
        
		// Update count
		$this->updateRequestCount($key);

        return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
	}    

}

?>
