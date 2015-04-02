<?php

namespace lib;

class Aggregator
{
	var $datasource;
	var $destination;
	
	function __construct($datasource, $destination)
	{
		$this->datasource = $datasource;
		$this->destination = $destination;
		
		require_once($this->datasource->plugin);
		
		$classname = $this->datasource->classname;
		$this->datasource = new $classname($this->datasource);
	}
	
	function aggregate()
	{
		global $db;
		
		while($row = $this->datasource->next())
		{
			//$db->save($this->destination->table,$row);
		}
	}
}

$datasource = new \stdClass;
$datasource->plugin = "aggregator/plugin.xml.php";
$datasource->classname = "\lib\aggregator\XMLDatasource";
$datasource->source = "libs/aggregator/sample.xml";
$destination = new \stdClass;
$destination->table = "sample";
$aggregator = new Aggregator($datasource,$destination);
$aggregator->aggregate();

?>