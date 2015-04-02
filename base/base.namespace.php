<?php

/**
 * The base namespace
 */
 
namespace base;

/**
 * Check if a class exists in the base namespace
 * @param string $className The name of the class to look for
 * @return boolean Return the result of the class_exists function
 */
function class_exists($className) { return \class_exists( $className ); } 

?>