<?php

namespace V;



/*-----------------------------------
|       RegExp
-------------------------------------
   - <String> _value
   - <String> _regex
   - <Array>  _flags
-------------------------------------
   + value() : <String>
   + regex() : <String>
   + flags() : <Array>
   + filterFlags() : <Object>
   + exec() : <String>
   + props() : <Array>
   + replace() : <Str>
   
   // 's' preceeding access modifier indicates 'static'.
  s+ getRegex() : <String>
  s+ getFlags() : <Array>
-----------------------------------*/


class RegExpO{
   use ObjectT;

   private $_value = "";
   private $_regex = "";
   private $_flags = [];
   
   /***
   * set instance's property
   * 
   * @param
   *    String $str : regex string
   */
   function __construct($str){
      $this->_value = $str;
      $this->_flags = self::getFlags($str);
      $this->_regex = self::getRegex($str);
   }
   
   /***
   * Return string of regex
   * 
   * @return 
   */
   function value(){
      return $this->_value;
   }
   
   /***
   * Return string of regex
   */
   function regex(){
      return $this->_regex;
   }
   
   /***
   * Return array of flags
   */
   function flags(){
      return $this->_flags;
   }
   
   /***
   * Return new regex object. supplied flag is dded to new regex object.
   * 
   * @param  String $flag : 
   * @return new object(RegExp)
   * 
   */
   function filterFlags($str){
      $arr = toArray($str);
      $flags = $this->flags();
      $filtered = array_diff($flags, $arr);
      //_( $arr, $flags);
      //_("diff:", $filtered);
      $regex = $this->regex();
      //_( $this->regex() );
      //_( $regex );
      $newRegex = concat($regex, joinWith("", $filtered));
      //_( $newRegex );
      return new RegExpO( $newRegex );
   }
   
   
   /*** exec($str)
   * summary
   * description
   @param
       String $str : param description
   ***/
   function exec($str){
      return match($this->value(), $str);
   }
   

   
   #####  Static Method  ####
   ## ::getFalgs
   static function getFlags($str){
      $regex = '#^(\W)([\w\W]*?)\1(\w*)$#';
      
      preg_match($regex, $str, $matches);
      
      $flagArr = split("", $matches[3]);
      
      return $flagArr;
   }
   
   ## ::getRegex
   static function getRegex($str){
      $regex = '#^(\W)([\w\W]*?)\1(\w*)$#';
      
      preg_match($regex, $str, $matches);
      
      return $matches[1] . $matches[2] . $matches[1];
   }
   
   function props(){
      return $this->keys();
   }
   
   function replace($fn, $str){
      return replace($this->value(), $fn, $str);
   }
   
   function __toString(){
      return $this->value();
   }
}
