<?php

$master_data_folder = __DIR__."/../../data/master-data";

require_once __DIR__."/../../_www/_common/database_access.php";
global $database;

// Loop through all the files in master-data folder
foreach(scandir($master_data_folder) as $filename)
{

	// Filter the CSV files
	if (substr(strtolower($filename),-4) == ".csv")
	{

		
		// 0.1 Get CSV ids
		try{
			$csv_data = load_csv ($master_data_folder."/".$filename);
		}catch(Exception $e){ echo "WARNING: Malformed CSV file $filename SKIPPED\n"; continue;}
		$csv_ids = array_column($csv_data, "id");

		// 0.2 Get SQL ids
		$sql_table_name = str_replace(".csv", "", $filename);
		try{
			$res = $database->query("SELECT id FROM $sql_table_name")->fetchAll(PDO::FETCH_ASSOC);
			$db_ids = array_column($res,"id");
		}catch(Exception $e)
		{
			echo "WARNING: $sql_table_name sql table not found.\n"; continue;
		}

		// 1. UPDATE based on $filename and id in the first column
		foreach(array_intersect($db_ids, $csv_ids) as $id)
		{
			
			unset ($csv_data[$id]['id']);
			
			$query = "UPDATE $sql_table_name SET ";
			$query .= implode(', ', array_map(function ($v, $k) { return sprintf("%s=?", $k, $v); },$csv_data[$id],array_keys($csv_data[$id])));
			$query .= " WHERE id = ".$id;


				if( $database->prepare($query)->execute(array_values($csv_data[$id])) === false && $database->errorInfo()[0] != "00000")
					echo "WARNING: Could not UPDATE table $sql_table_name ".print_r($database->errorInfo(), true)."\n\nQUERY: $query \n".print_r($csv_data[$id],true)."\n";
				


		}
			
		// 2. DELETE ids that only exist in the database
		$query = "DELETE FROM $sql_table_name WHERE id IN ( ".implode(", ",array_diff($db_ids, $csv_ids)).");";

		if (!empty(array_diff($db_ids, $csv_ids)) && $database->exec($query) === false)
		{
			echo "WARNING: Could not DELETE FROM table $sql_table_name ".print_r($database->errorInfo(), true)."\n\nQUERY: $query \n";
		}


		
		// 3. INSERT ids that only exist in CSV
		foreach(array_diff($csv_ids, $db_ids) as $id)
		{
			
			$query = "INSERT INTO $sql_table_name ";
			$query .= "( ".implode(", ",array_keys($csv_data[$id])).") ";
			$query .= "VALUES (".implode(", ",array_fill(0, count(array_keys($csv_data[$id])), "?")).") ";


			
				if ($database->prepare($query)->execute(array_values($csv_data[$id])) === false && $database->errorInfo()[0] != "00000")
					echo "WARNING: Could not INSERT INTO table $sql_table_name ".print_r($database->errorInfo(), true)."\n\nQUERY: $query \n".print_r($csv_data[$id],true)."\n";
			
		
		}

	}
}

function load_csv($filename)
{
		// Capture CSV file with header
		$file = file($filename,FILE_SKIP_EMPTY_LINES);
		$array = array_map("str_getcsv",$file ,array_fill(0,count($file),";"));
		// Remove the first line
		$keys = array_shift($array);
		$parsed_array = array();

	//	To turn all the rows into a nice associative array you could then apply:
		foreach ($array as $i=>$row) {
		    if (count($keys) != count( $row)) throw new Exception("CSV lines doesn't have the same number of columns as header");
			
			$parsed_array[$row[0]] = array_combine($keys, $row);
		}
		return $parsed_array;
	
}
