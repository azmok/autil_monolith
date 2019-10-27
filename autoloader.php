<?php

namespace V;

require_once $PACKAGE_BASE  ."/base.php";



function getNamespaces($str){
   $regex = '/^([\w\d_]+)\\\\(.+)/'; # three-backslashes is used as escape-sequence in regex
   preg_match($regex, $str, $matches);
   
   $namespace = $matches[1];
   $className = $matches[2];
   $arr = [
      $namespace,
      $className,
   ];
   return $arr;
}



### class autoloader
spl_autoload_register(function ($name){
   global $PACKAGE_BASE;
   
   if( strpos($name, '\\') ){
      list($namespace, $className) = getNamespaces($name);
   }
   $filePath = $PACKAGE_BASE  ."/Classes/{$className}.class.php";
   
   if( is_readable( $filePath ) ){
      require_once $filePath;
   }
});



###  trait autoloader
spl_autoload_register(function ($name){
   global $PACKAGE_BASE;

   if( strpos($name, '\\') ){
      list($namespace, $traitName) = getNamespaces($name);
   }
   $filePath = $PACKAGE_BASE  ."/Traits/{$traitName}.trait.php";
   
   if( is_readable( $filePath ) ){
      require_once $filePath;
   }
});











