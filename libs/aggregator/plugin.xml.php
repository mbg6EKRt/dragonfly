<?php

namespace lib\aggregator;

class XMLDatasource
{
	var $source;
	var $data;
	
	function __construct($datasource)
	{
		$this->source = $datasource->source;
	}
	
	function next()
	{
		if (empty($this->data))
		{
			$this->getdata();
		}
	}
	
	function getdata()
	{
		$xmldocument = new \DOMDocument();
		$xmldocument->load($this->source);
		//echo $xmldocument->saveXML();
		
		$test = $xmldocument->getElementsByTagName('test');
		print_r($test);
		$k = 0;
		foreach($test as $item)
		{
			$someitem = $test->item($k);
			$i = 0;
			
			print_r($test->item($k));
		}
		
		/*
		$data = $xmldocument->getElementsByTagName('title');
		$descriptions = $xmldocument->getElementsByTagName('description');
		//var_dump($data);
		
		$rows = Array();
		
		$count = 0;
		
		foreach($data as $key => $value)
		{
			//var_dump($key,$value->nodeValue,$descriptions[$key]->nodeValue);
			$rows[$count]['title'] = $value->nodeValue;
			$count = $count + 1;
			
			print_r($key);
			print_r($value);
		}
		
		$count = 0;
		
		foreach ($descriptions as $key => $value)
		{
			$rows[$count]['description'] = $value->nodeValue;
			$count = $count + 1;
		}
		
		print_r($rows);
		
		//var_dump($xmldocument);
		*/
	}
}

?>