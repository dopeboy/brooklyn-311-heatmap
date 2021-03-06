<?php

class ComplaintsModel extends Model 
{
	public function getComplaints($key, $type,$agency, $descriptor, $limit)
	{
		// Check API key
		$this->checkAPIKey($key);

		$query = "";
		$limit_query = "";
		$sqlParameters = array();

		if ($type != null)
		{
			$sqlParameters[":type"] = $type;
			$query .= " AND TYPE = :type ";			
		}

		if ($agency != null)
		{
			$sqlParameters[":agency"] = $agency;
			$query .= " AND AGENCY = :agency ";			
		}

		if ($descriptor != null)
		{
			$sqlParameters[":descriptor"] = $descriptor;
			$query .= " AND LOWER(DESCRIPTION) LIKE %:descriptor% ";			
		}

		if ($limit != null)
		{
			$limit_query = " LIMIT :limit";	
			$sqlParameters[":limit"] = $limit;
		}

		// Hard code date constraint to ease client side
        $preparedStatement = $this->dbh->prepare('SELECT * FROM COMPLAINT WHERE 1=1 ' . $query . ' AND CREATE_DATE > "2014-12-01"' . $limit_query);
        $preparedStatement->execute($sqlParameters);     
        
		// Update count
		$this->updateRequestCount($key);

        return $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
	}    
}

?>
