<?php

namespace lib;

/**
 * An XML library to convert xml to and from arrays
 */
class xml
{
/**
 * Convert XML to an array in the XML structure. Based on: http://www.bin-co.com/php/scripts/xml2array/
 * @param string $contents The XML to convert
 * @param integer $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different array structure in the return value.
 * @param string $priority - Can be 'tag' or 'attribute'. This will change the way the resulting array sturcture. For 'tag', the tags are given more importance.
 * @return array The parsed XML in an array form.
 */ 
	function getarray( $contents, $get_attributes = 0, $priority = 'tag' )
	{ 
	    if( !$contents ) return array( );

	    if( !function_exists( 'xml_parser_create' ) )
		{ 
	        //print "'xml_parser_create()' function not found!";
	        return array( );
	    }
	
	    // Get the XML parser of PHP - PHP must have this module for the parser to work 
		
	    $parser = xml_parser_create( '' );
	    xml_parser_set_option( $parser, XML_OPTION_TARGET_ENCODING, "UTF-8" ); // http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
	    xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
	    xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
	    xml_parse_into_struct( $parser, trim( $contents ), $xml_values );
	    xml_parser_free( $parser );
	
	    if( !$xml_values ) return Array(); // Hmm...
	
	    // Initializations 
		
	    $xml_array = array( ); 
	    $parents = array( ); 
	    $opened_tags = array( ); 
	    $arr = array( ); 
	
	    $current = &$xml_array; //Reference 
	
	    // Go through the tags.
		
	    $repeated_tag_index = array( ); // Multiple tags with same name will be turned into an array 
	    foreach( $xml_values as $data ) 
		{ 
	        unset( $attributes,$value ); // Remove existing values, or there will be trouble 
	
	        // This command will extract these variables into the foreach scope 
	        // tag(string), type(string), level(int), attributes(array).
			
	        extract( $data ); // We could use the array by itself, but this cooler.
	
	        $result = array( ); 
	        $attributes_data = array( ); 
	         
	        if( isset( $value ) ) 
			{ 
	            if( $priority == 'tag' ) $result = $value; 
	            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode 
	        } 
	
	        //Set the attributes too.
			
	        if( isset( $attributes ) && $get_attributes )
			{ 
	            foreach( $attributes as $attr => $val )
				{ 
	                if( $priority == 'tag' ) $attributes_data[$attr] = $val; 
	                else $result['attr'][$attr] = $val; // Set all the attributes in a array called 'attr' 
	            } 
	        } 
	
	        // See tag status and do the needed.
			
	        if( $type == "open" ) 
			{
				// The starting of the tag '<tag>' 
				
	            $parent[$level-1] = &$current; 
				
				// Insert New tag 
				
	            if( !is_array( $current ) or !in_array( $tag, array_keys( $current ) ) )
				{ 
	                $current[$tag] = $result; 
	                if($attributes_data) $current[$tag. '_attr'] = $attributes_data; 
	                $repeated_tag_index[$tag.'_'.$level] = 1; 
	
	                $current = &$current[$tag];
	            } 
				
				// There was another element with the same tag name 
				
				else 
				{ 
					// If there is a 0th element it is already an array 

	                if( isset( $current[$tag][0] ) ) 
					{
	                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
	                    $repeated_tag_index[$tag.'_'.$level]++; 
	                }

					// This section will make the value an array if multiple tags with the same name appear together 

					else 
					{
	                    $current[$tag] = array($current[$tag],$result);// This will combine the existing item and the new item together to make an array 
	                    $repeated_tag_index[$tag.'_'.$level] = 2; 

						// The attribute of the last(0th) tag must be moved as well 

	                    if( isset( $current[$tag.'_attr'] ) ) 
						{ 
	                        $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
	                        unset($current[$tag.'_attr']); 
	                    } 
	                } 

	                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1; 
	                $current = &$current[$tag][$last_item_index]; 
	            } 
	        }

			// Tags that ends in 1 line '<tag />'

			else if( $type == "complete" ) 
			{ 
	            //See if the key is already taken.

	            if( !isset( $current[$tag] ) ) 
				{
					// New Key 

	                $current[$tag] = $result; 
	                $repeated_tag_index[$tag.'_'.$level] = 1; 
	                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data; 
	            }

				// If taken, put all things inside a list(array) 

				else 
				{
					// If it is already an array... 

	                if( isset( $current[$tag][0] ) and is_array( $current[$tag] ) )
					{
	                    // ...push the new element into that array. 

	                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 

	                    if( $priority == 'tag' and $get_attributes and $attributes_data )
						{ 
	                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
	                    }

	                    $repeated_tag_index[$tag.'_'.$level]++;
	                }

					// If it is not an array... 

					else 
					{
	                    $current[$tag] = array( $current[$tag],$result ); // ...Make it an array using using the existing value and the new value 
	                    $repeated_tag_index[$tag.'_'.$level] = 1; 
	                    if( $priority == 'tag' and $get_attributes ) 
						{
							// The attribute of the last(0th) tag must be moved as well 

	                        if( isset( $current[$tag.'_attr'] ) ) 
							{
	                            $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
	                            unset( $current[$tag.'_attr'] ); 
	                        } 

	                        if($attributes_data) 
							{ 
	                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
	                        } 
	                    } 

						// 0 and 1 index is already taken 

	                    $repeated_tag_index[$tag.'_'.$level]++; 
	                } 
	            } 
	        } 

			// End of tag '</tag>' 

			else if( $type == 'close' ) 
			{
	            $current = &$parent[$level-1]; 
	        } 
	    }

		// Return the final array

	    return $xml_array;
	}
	
/**
 * Convert the given array to XML. Reverses the process from $this->getarray().
 * @param array $data The array to convert to XML.
 * @param string $parenttag The parent tag of the current element.
 * @return string Return the XML generated from the array
 */ 
	function getxml( $data = Array(), $parenttag = '' )
	{
		$xml = "";
		
		foreach ( $data as $tag => $value )
		{
			if ( is_numeric( $tag ) )
			{
				if ( is_array( $value ) )
					$xml .= "\n<".$parenttag.">".$this->getxml( $value, $tag )."\n</".$parenttag.">";
				else
					$xml .= "\n<".$parenttag.">".$value."</".$parenttag.">";
			}
			else
			{
				if ( is_array( $value ) )
				{
					if ( !is_numeric( $parenttag ) && !array_key_exists( 0, $value ) )
						$xml .= "\n<".$tag.">".$this->getxml($value, $tag)."\n</".$tag.">";
					else
						$xml .= $this->getxml( $value, $tag );
				}
				else
				{
					$xml .= "\n<".$tag.">".$value."</".$tag.">";
				}
			}
		}
		
		return $xml;
	}
}

?>