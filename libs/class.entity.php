<?php

namespace lib;

class entity
{
	// Constructor
	function __construct()
	{
		// Entity table
		$this->table = "ent";
		$this->columns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE, 'auto' => TRUE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'description' => Array( 'field' => 'description', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'content' => Array( 'field' => 'content_file_id', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )
			);
		
		// Entity relationship table
		$this->reltable = "ent_rel";
		$this->relcolumns = Array(
			'id' => Array( 'field' => 'id', 'type' => 'int', 'length' => '12', 'key' => 'primary', 'null' => FALSE, 'auto' => TRUE ),
			'id1' => Array( 'field' => 'id1', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'id2' => Array( 'field' => 'id2', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'name' => Array( 'field' => 'name', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'description' => Array( 'field' => 'description', 'type' => 'varchar', 'length' => '255', 'null' => TRUE ),
			'content' => Array( 'field' => 'content_file_id', 'type' => 'int', 'length' => '12', 'null' => TRUE ),
			'created' => Array( 'field' => 'created', 'type' => 'varchar', 'length' => '11', 'null' => TRUE ),
			'modified' => Array( 'field' => 'modified', 'type' => 'varchar', 'length' => '11', 'null' => TRUE )
			);
			
		// Create database tables
		$this->install( );
	}
	
	// Get an entity
	function get( $id = 0 )
	{
		global $db;
		
		if ( !empty( $id ) )
		{
			if ( is_array( $id ) ) return $db->exec( "SELECT * FROM ".$this->table." WHERE `".$this->columns['id']['field']."` IN ( ".implode( ',', $id )." )" );
			else return $db->exec( "SELECT * FROM ".$this->table." WHERE `".$this->columns['id']['field']."`=".$id );
		}
		else return $db->exec( "SELECT * FROM ".$this->table );
	}
	
	// Get a tree of entities
	function gettree( $id = 0, $levels = 0, $alreadyLoaded = Array( ) )
	{
		global $db;

		$entities = Array();

		if ( !empty( $id ) )
		{
			if ( is_array( $id ) )
			{
				$qry = "SELECT * FROM ".$this->table." WHERE `".$this->columns['id']['field']."` IN ( ".implode( ',', $id )." )";
				if (!empty($alreadyLoaded)) $qry = $qry." AND `".$this->columns['id']['field']."` NOT IN ( ".implode(',', $alreadyLoaded)." )";
			}
			else
			{
				$qry = "SELECT * FROM ".$this->table." WHERE `".$this->columns['id']['field']."`=".$id;
				if (!empty($alreadyLoaded)) $qry = $qry." AND `".$this->columns['id']['field']."` NOT IN ( ".implode(',', $alreadyLoaded)." )";
			}

			$tmpentities = $db->exec( $qry );

			$recurseLevel = $levels - 1;
			$getEntityIds = Array();

			foreach( $tmpentities as $key => $entity )
			{
				$entities['entities'][$entity['id']] = $entity;
				$alreadyLoaded[] = $entity['id'];
				$relationships = $this->getrel( $entity['id'] );
				
				if ( !empty( $relationships ) )
				{
					if ( !array_key_exists( 'relationships', $entities ) ) $entities['relationships'] = Array();
					$entities['relationships'] = array_merge( $entities['relationships'], $relationships );

					foreach ( $entities['relationships'] as $relkey => $relvalue )
					{
						if ( $relvalue['id1'] == $entity['id'] ) $getEntityIds[] = $relvalue['id2'];
						else $getEntityIds[] = $relvalue['id1'];
					}
				}
			}

			if ( array_key_exists( 'relationships', $entities ) )
			{
				foreach( $entities['relationships'] as $relationship ) $tmprelationships[$relationship['id']] = $relationship;
				$entities['relationships'] = $tmprelationships;
			}

            if ( $levels > 0 && !empty ( $tmpentities ) )
            {
				$children = $this->gettree( $getEntityIds, $recurseLevel, $alreadyLoaded );
				if ( !array_key_exists( 'children', $entities ) && !empty( $children ))
				{
					$entities['children'] = Array();
					$entities['children'] = array_merge( $entities['children'], $children );
				}
			}
		}
		
		return $entities;
	}
	
	// Create or update an entity or tree of entities
	function set( $entity = Array() )
	{
		global $db;
		
		return $db->save( $this->table, $entity );
	}
	
	
	// Delete an entity
	function del( $id )
	{
		if ( !empty( $id ) )
		{
			global $db;
			$db->delete( $this->reltable, $this->relcolumns['id1']['field'], $id );
			$db->delete( $this->reltable, $this->relcolumns['id2']['field'], $id );
			$db->delete( $this->table, $this->columns['id']['field'], $id );
		}
	}
	
	// Delete a tree of entities
	function deltree( $id = 0 )
	{
		
	}
	
	// Get a relationship
	function getrel( $id1 = 0, $id2 = 0 )
	{
		global $db;
		
		if ( !empty( $id1 ) && !empty( $id2 ) )
		{
			return $db->exec( "SELECT * FROM ".$this->reltable." 
					WHERE ((`".$this->relcolumns['id1']['field']."`=".$id1." 
						AND `".$this->relcolumns['id2']['field']."`=".$id2.")
						OR (`".$this->relcolumns['id1']['field']."`=".$id2." 
						AND `".$this->relcolumns['id2']['field']."`=".$id1."))" );
		}
		else if ( !empty( $id1 ) && empty( $id2 ) )
		{
			return $db->exec( "SELECT * FROM ".$this->reltable." WHERE `".$this->relcolumns['id1']['field']."`=".$id1." OR `".$this->relcolumns['id2']['field']."`=".$id1 );
		}
		else if ( empty( $id1 ) && !empty( $id2 ) )
		{
			return $db->exec( "SELECT * FROM ".$this->reltable." WHERE `".$this->relcolumns['id1']['field']."`=".$id2." OR `".$this->relcolumns['id2']['field']."`=".$id2 );
		}
	}
	
	// Create or update an entity or tree of entities
	function setrel( $rel = Array() )
	{
		global $db;
		return $db->save( $this->reltable, $rel );
	}
	
	// Create entity tables
	function install( )
	{
		global $db;
		$db->createTable( $this->table, $this->columns );
		$db->createTable( $this->reltable, $this->relcolumns );
	}
}

?>
