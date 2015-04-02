<?php

namespace mod\a1e56b1719819be07494b142bdac61ecc1b8685b;

/**
 * The Pages module
 */
class pages
{
/**
 * The main function controls which task we should execute
 */
	function start( $context )
	{
		// Set the module and task information
		
		$this->context = $context;
		unset( $context );

		// Check which task we are executing

		switch ( $this->context->task['task'] )
		{
			// Display the admin list

			case 'AdminList':
				$this->adminList( );
			break;

			// Add an item

			case 'add':
				$this->add( );
			break;

			// Edit an item

			case 'edit':
				$this->edit( );
			break;

			// Save an item

			case 'save':
				$this->save( );
			break;

			// Delete an item

			case 'delete':
				$this->delete( );
			break;

			// Display an item

			case 'display':
				$this->display( );
			break;
		}
	}

/**
 * Display the administrator list - allows an admin to add, edit, save and delete items
 */
	function adminList( )
	{
		$this->display( );
	}

/**
 * Display the add form
 */
	function add(){}

/**
 * Display the edit form
 */
	function edit(){}

/**
 * Save an item
 */
	function save(){}

/**
 * Delete an item
 */
	function delete(){}

/**
 * Display an item
 */
	function display()
	{
		//debug( $this->context, '$context' );
	
		//global $paths, $site, $module, $task, $url;
		
		//require_once('C:\wamp\www\dragonfly\libs\class.aggregator.php');
		
		/*
		// Do some stuff

		echo "<b>Displaying a page ...</b><br /><br />\n\n";
		echo '<b>Site:</b> '.$this->context->site['name']." ({$site->source})<br />\n";
		echo '<b>Module:</b> '.$this->context->module['name']." ({$module->source})<br />\n";
		echo '<b>Task:</b> '.$this->context->task['name']." ({$task->source})<br />\n";
		echo '<b>Request:</b> '.$this->context->request."<br />\n";
		
		// Getting the url paramters
		
		$params = $paths->getparams( $this->context->request );
		
		if ( !empty( $params ) )
		{
			echo '<b>Request params:</b> '.$params."<br />\n";
		}
		else echo "<b>No params here!</b><br />\n";
		
		// Generating a url with using the url
		
		$testurl = $url->getsiteurl( $this->context->module['namespace'], 'display', 'some/params', $paths->view );
		echo '<b>Test url by namespace:</b> '.$testurl."<br />\n";
		
		$testurl = $url->getsiteurl( $this->context->module['id'], 'display', 'other/some/params' );
		echo '<b>Test url by id:</b> '.$testurl."<br />\n";
		*/
		// xml example

		if ( $this->context->view == "url" )
		{
			//echo "full version of a page";
			
			/*
			$xml = new \lib\xml( );
			
			$configfile = dirname( __FILE__ ).'/xml/config.xml';
			$configxml = file_get_contents( $configfile );
			
			$configarray = $xml->getarray( $configxml );
			
			//echo '<br /><br />';
			debug( $configxml, "File contents" );
			debug( $configarray, "XML > Array" );
			debug( $xml->getxml( $configarray ), "Array > XML" );
			
			$xmldata = Array(
				'module' => Array(
					'name' => 'Pages',
					'folder' => 'pages',
					'table' =>
						Array(
							Array(
								'name' => 'page',
								'encoding' => 'utf8',
								'column' => Array(
									Array(
										'name' => 'id',
										'type' => 'integer',
										'length' => 11
									),
									Array(
										'name' => 'name',
										'type' => 'varchar',
										'length' => 255
									),
									Array(
										'name' => 'description',
										'type' => 'text',
									),
									'columncount' => 3
								)
							),
							Array(
								'name' => 'site__page',
								'encoding' => 'utf8',
								'column' => Array(
									Array(
										'name' => 'site_id',
										'type' => 'integer',
										'length' => 11
									),
									Array(
										'name' => 'page_id',
										'type' => 'integer',
										'length' => 11
									),
									'columncount' => 2
								)
							),
							'tablecount' => 2
						)
					)
				);
			*/
			//debug( $xmldata, 'Array' );
			//debug( $xml->getxml( $xmldata ), "Array > XML" );
			
			// Test entities
			
			$entityClient = new \lib\entity( );
			$entities = $entityClient->gettree( 1, 4 );
			//debug( $entities );

			echo process( dirname( __FILE__ ).'/tpl/entity.html', Array( 'entities' => $entities ) );
			
			
			
			
			
			
			
			/*
			
			$countries = Array('Afghanistan','Albania','Algeria','Andorra','Angola','Antigua & Deps',
			'Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh',
			'Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia Herzegovina',
			'Botswana','Brazil','Brunei','Bulgaria','Burkina','Burundi','Cambodia','Cameroon','Canada',
			'Cape Verde','Central African Rep','Chad','Chile','China','Colombia','Comoros','Congo',
			'Congo {Democratic Rep}','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark',
			'Djibouti','Dominica','Dominican Republic','East Timor','Ecuador','Egypt','El Salvador',
			'Equatorial Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon','Gambia',
			'Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana',
			'Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland {Republic}',
			'Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati',
			'Korea North','Korea South','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho',
			'Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macedonia','Madagascar','Malawi',
			'Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico',
			'Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar, {Burma}',
			'Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','Norway',
			'Oman','Pakistan','Palau','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland',
			'Portugal','Qatar','Romania','Russian Federation','Rwanda','St Kitts & Nevis','St Lucia',
			'Saint Vincent & the Grenadines','Samoa','San Marino','Sao Tome & Principe','Saudi Arabia',
			'Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands',
			'Somalia','South Africa','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Swaziland','Sweden',
			'Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tonga','Trinidad & Tobago',
			'Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom',
			'United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia',
			'Zimbabwe');
			
			
			foreach ($countries as $country)
			{
				$countryentity = Array(
					'name' => $country,
					'description' => "Country of {$country}",
					'created' => time()
					);
				$entityClient->set($countryentity);
			}
			
			
			*/
			
			
			
			
			
			
			
		}
		else if ( $this->context->view == "embed" )
		{
			echo "Embedded version of a page";
		}
		else if ( $this->context->view == "task" )
		{
			echo "task version of a page";
		}
		else if ($this->context->view == 'cli')
		{
			echo "\n\n----------------------------------\nHello Cli!\n----------------------------------\n\n\n";
		}
	}
}

?>
