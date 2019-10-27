<?php

namespace V;



/*--------------------------
   <<trait>>
   ObjectT
----------------------------

-----------------------------
 + props() : <Assoc>
 + methods() : <Assoc>
 + getClassName() : <Str>
 + toString() : <Str>
 - __toString() : <Str>
---------------------------*/


trait ObjectT{
   
   /**
   * 
   * 
   */
   function getClassName(){
      return get_class($this);
   }
   
   /**
   * 
   * 
   */
   function props(){
      $varsAssoc = get_object_vars($this);
      //_( $vars );
      $varNames = array_keys($varsAssoc);

      return $varNames;
   }
   
   /**
   * 
   * 
   */
   function methods(){
      $methodNames = get_class_methods($this);
      $filtered = filter(function($curr){
         return $curr !== "__construct";
      }, $methodNames);
      
      $maped = map(function($curr, $indx){
         return $curr  ."\0";
      }, $filtered);
      return $maped;
   }
   
   /**
    */
   function toString(){
      return object2String($this);
   }
   
   function  __toString(){
      return object2String($this);
   }
}