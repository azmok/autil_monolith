<?php

namespace V;



#---------------------------------------------------------#
#------------------   self-independent   -----------------#
#---------------------------------------------------------#
/**
 *
 */
function toArray($str){
   return str_split($str);
}


/**
 *
 */
function br($num=2){
   for($i = 0; $i < $num; $i++){
      echo "<br>";
   }
}


/**
 *
 */
function exho($val){
   echo "$val<br/>";
}


/**
 *
 */
function isAssoc($val){
   if( gettype($val) === "array" ){
      $keys = array_keys($val);
      $StringKeyArray = array_filter($keys, function($val){
         return gettype($val) === "string";
      });
      return !empty($StringKeyArray) ? true : false;
   } else {
      return false;
   }
}


/**
 *
 */
function split($separator="", $str){

   if( $separator === ""){
      return str_split($str);
   } else {
      return explode($separator, $str);
   }
}


/**
 *
 */
function isNill($v){
   if( $v === null ||
       $v === "" ||
       $v === [] ){
      
      return true;
   } else {
      return false;
   }
}


/**
 *
 */
function prependTab($str, $count=1, $tabChar="&emsp;"){
   $tab = "";
   
   for($i = 0; $i < $count; $i++){
      $tab .= $tabChar;
   }
   $tabbed = $tab  .  $str;
   
   return $tabbed;
}


/**
 *
 */
function appendTab($str, $count=1, $tabChar="&emsp;"){
   $tab = "";
   
   for($i = 0; $i < $count; $i++){
      $tab .= $tabChar;
   }
   $tabbed = $str  .  $tab;
   
   return $tabbed;
}


/**
 *
 */
function formatR($val, $tabNum=15){
   # "r"(right): $alignType
   $str = "$val";
   if( $tabNum - length($str) <= 0 ){
      $formatted = $str;
   } else {
      $formatted = prependTab($str, $tabNum - length($str));
   }
   //_( $formatted );
   return $formatted;
}


/**
 *
 */
function toUpperCase($str){
   return strtoupper($str);
}


/**
 *
 */
function toLowerCase($str){
   return strtolower($str);
}


/**
 *
 *
function trim($str){
   $regex = '/^([\s\t　])*([\w\W]+?)[\s\t　]*$/';
   $replacer = function($matches){
         //pretty( $matches );
      $match = $matches[0];
      $chars =  $matches[2];
      return $chars;
   };
      
   $trimmed = replace($regex, $replacer, $str);
      
   return $trimmed;
}


/**
 *
 */
function head($arr){
   return $arr[0];
}


/**
 *
 */
function last($arr){
   return $arr[ length($arr) -1 ];
}


/**
 *
 */
function initial($arr){
   $lastIndex = count($arr) - 1;
   $newArr = [];
   
   foreach($arr as $index=>$val){
      if( $index !== $lastIndex ){
         $newArr[] = $val;
      }
   }
   return $newArr;
}


/**
 *
 */
function rest($arr){
   $filterFn = function($curr, $indx){
      return $indx !== 0;
   };
   $newArr = array_filter( $filterFn, $arr);
   
   return $newArr;
}


/**
 *
 */
function indexOf($val, $arr){
   $res = array_search($val, $arr);
   
   return $res;
}






#-------------------------------------------------------#
#------------------   self dependant   -----------------#
#-------------------------------------------------------#
/**
 *
 */
function isArray($val) {
   return (
      gettype($val) === "array"  &&
      !isAssoc($val)
   );
}


/**
 *
 */
function type($val){
   if ( is_callable($val) ){
      return "[Function]";
   
   } elseif( gettype($val) === "integer" ||
       gettype($val) === "double" ){
      return "[Number]";
   
   } elseif ( gettype($val) === "NULL" ){
      return "[Null]";
   
   } elseif ( gettype($val) === "array" &&  
               isAssoc($val) ){
      return "[AssocArray]";
   
   } elseif ( gettype($val) === "string"  && 
              preg_match('~^([^\w\d\s]).*(\1)[gimsxeADSUXJu]*$~', $val) ){
      return "[Regex]";
   
   } else {
      return "[".  ucfirst( gettype($val) )  ."]";
   }
}


/**
 *
 */
function isType($type, $val){
   if( type($val) === $type ){
      return true;
   } else {
      return false;
   }
}


/**
 *
 */
function includes($searchVal, $str){
   $pos = strpos($str, $searchVal);
   
   return isType('[Number]', $pos) ? true : false;
}


/**
 *
 */
function length($arg){
   
   ##  $arg :: [Function]
   if( type($arg) === "[Function]" ){
      
      $ref = new \ReflectionFunction($arg);
      
      return $ref->getNumberOfParameters();
         
   ##  $arg :: [Object]
   } elseif ( type($arg) === "[Object]" ){
      return null;
      
   ##  $arg :: [Array]
   } elseif ( type($arg) === "[Array]" || 
              type($arg) === "[AssocArray]" ){
      return count( $arg );
   
   ##  $arg :: [String]
   } elseif ( type($arg) === "[String]" ){
      return mb_strlen( $arg );
   
   ##  arg :: [Number], [Null]
   } else {
      throw new \Exception("invalid type of Arguments");
   }
}


/**
 *
 */
function _forEach($fn, $arr, $argType=3){
   ## assocArr
   if( isAssoc($arr)  ||  $argType === 4 ){
      $indx = 0;
      
      foreach($arr as $key=>$val){
         $fn($key, $val, $indx, $arr);
         $indx++;
      }
   
   ## arr
   } else {
      foreach($arr as $indx=>$val){
         $fn($val, $indx, $arr);
      }
   }
}


/**
 *
 */
function object2String($obj, $depth=1){
   if( $obj === NULL ){
      $obj = $this;
   }
   $str = "";
      
   $depth === 1 ? ($str .= "{<br>") : false;
   
   $props = get_object_vars( $obj );
   
   _forEach(function($prop, $val, $i, $props) use($depth, &$str) {
      $lastIndex = length($props) - 1;
      
      //_( "VALLLL::", type($val), $val );
      
      if( is_object($val) ){
         // echo '$val is Object';
         $str .= prependTab( "{$prop}: {<br>". object2String($val, $depth+1), $depth );
      } else {
         $str .= prependTab(
            "{$prop}: ". toTypeFriend($val),
            $depth
         );
      }
      ### add break, but last index of loop
      $i === $lastIndex ? false : $str .= "<br>";
      
      ### add "}"
      $i === $lastIndex ? $str .= "<br>".  prependTab("}", $depth-1) : false ;
      
   }, $props);
   
   return $str;
}


/**
 *
 */
function toString($arg){

   ## String
   if( isType("[String]", $arg) ){
      return $arg;
      
   ## Number
   } elseif( isType("[Number]", $arg) ){
      return "$arg";
   
   ## Boolean
   } elseif ( isType("[Boolean]", $arg) ){
      return $arg === true ? "true" : "false";
   
   ## Array, AssocArray
   } elseif ( isAssoc($arg)  ||
              isArray($arg) ){
      return prettify($arg);
   
   ## Regex
   } elseif ( isType("[Regex]", $arg) ){
      return "{$arg}";
   
   
   ## Object
   } elseif ( match("Object", type($arg)) ){

      ### Closure class
      if( $arg instanceof \Closure ){
         return "[Closure Object]";
         
      ### exist '__toString()' method
      } elseif( method_exists($arg, '__toString') ){
         return $arg->__toString();
      
      } else {
         return type($arg);
      }
   
   ## Function
   } elseif ( isType("[Function]", $arg) ){
      $ref = new \ReflectionFunction($arg);
      $fnName = $ref->getName();
      
      return "'$fnName'";
   ## Null,
   } else {
      return type($arg);
   }
}





function prettify($arr, $format_assoc=False, $depth=0){

   define('BASE', 2);
   
   if( isAssoc($arr) ||
       isArray($arr)  &&  $format_assoc === true ){
      
      $str = "";
      $indx = 0;
      
      foreach($arr as $key=>$val){
         $lastIndex = length($arr) - 1;
         
         ######  add <br>, but not in last element  ######
         if( $indx !== 0 ){
            $str .= "<br>";
         }
         #######  add tab  ######
         $str .= appendTab( "", $depth*BASE);
         
         ######  add "[$key]: $val"  ######
         # $curr :: [Array], [AssocArray]
         if( isType("[AssocArray]", $val) ){
            $str .= "[{$key}]: ".  prettify($val, $format_assoc, $depth+1);
         
         # $curr :: [Array]
         } elseif( isType("[Array]", $val) ){
            $str .= "[{$key}]:".  prettify($val, $format_assoc, $depth+1);
         
         # $curr :: ![Array], ![AssocArray]
         } else {
            # inject $curr
            if( isType("[AssocArray]", $arr) ){
               if( isType("[String]", $val)  ){
                  $str .= "[{$key}]: \"{$val}\"";
               } else {
                  $str .= "[{$key}]: ".  toString($val);
               }
            } else {
               $str .= "[{$key}]: ".  toString($val);
            }
         }
         $indx++;
      }
      
      return $str;

   ## Array, $format_assoc: false 
   } elseif( isArray($arr)  &&  $format_assoc === false ){
      
      $str = "";
         
      if( empty($arr) ){
         $str .= "". prependTab("()", $depth*BASE);
      } else {
         _forEach(function($curr, $indx, $arr) use (&$str, $depth, $format_assoc){
            $lastIndex = length($arr) - 1;
            
            //$str.= "<br>";
            
            ######  add `(`  ######
            if ( $indx === 0  ){
               $str .= "".  prependTab("(", $depth*BASE);
            }
            
            ######  add $curr  ######
            # $curr :: [Array]
            if( isType("[Array]", $curr) ){
               $str .= prettify($curr, $format_assoc, $depth+1);
            
            # $curr :: [AssocArray]
            } elseif( isType("[AssocArray]", $curr) ){
               $str .= prettify($curr, $format_assoc, $depth+1);
            
            # $curr :: ![Array],
            } else {
               # inject $curr
               $str .= toString($curr);
            }
         
            ######  add `,` | `)`  ######
            if ( $indx === $lastIndex ){
               if( isArray($curr)  ||  isAssoc($curr) ){
                  $str .= "<br>".  prependTab(")", $depth*BASE);
               
               } else {
                  $str .= ")";
               }
            # not lastIndex
            } else {
               $str .= ", ";
               if( isType("[AssocArray]", $curr) ){
                  $str .= "<br>";
               }
            }
         }, $arr);
      }
      
      return $str;
   }
}


/**
 *
 */
function toAttr($assocArr){
   if( isAssoc($assocArr) ){
      $str = "";
      $flatArr = joinWith(function($key, $val, $indx){
         
         ### style attribute
         if( isAssoc($val) ){
            $val_arr = joinWith(": ", $val);
            $val_str = joinWith( "; ", $val_arr )  .";";
            
            return "{$key}='{$val_str}'";
         } else {
            return "{$key}='{$val}'";
         }
      }, $assocArr);
   
      foreach($flatArr as $indx => $val){
         $str .= ($indx === 0 ? $val : " $val");
      }
      //exho( $str );
      return $str;
      
   }
}


/** echo for debugging
 * @sig _ :: (* -> * -> ...) -> null
 */
function inject($val, $tagName="h1", $assocArr=[]){
   preg_match('~h\d~', $tagName, $matches);
   
   $match = $matches[0][0];
   
   if( !empty($match) ){
      if( empty($assocArr) ){
         $assocArr = [
            "class" => "",
            "style" => [
               "padding" => "0 0.5rem",
            ],
         ];
      }
   }
   
   $str = toAttr($assocArr);
   echo "<{$tagName} {$str}>".  $val  ."</{$tagName}>";
}


function _ (...$args){
   $style = [
      "style" => [
         "background" => "#faf8f6",
         "padding" => "1rem",
         "font" => "400 1rem/1.2 Inconsolata, Courier, monospace",
         "letter-spacing" => "-0.3px",
         "border-bottom" => "1px solid #eaeaea",
      ],
   ];
   #### args.length <= 1
   if( count($args) <= 1 ){
      inject( toString($args[0]), "div", $style);
      
   } else {
   #### args.length >= 2
      $str = "";
      foreach($args as $arg){
         
         if( type($arg) === "[Array]" ){
            $str .= toString($arg);
         } else {
            $str .= toString($arg)  ." ";
         }
      }
      inject( $str, "div", $style );
   }
}


/**
 *
 */
function pretty($arr, $format_assoc=true){   
   _( prettify($arr, $format_assoc) );
}


/**
 *
 */
function append($val, &$data){
   # Array(mutable)
   if( isType('[Array]', $data) ){
      $data[] = $val;
   
      return $data;
   }
}


/**
 *
 */
function prepend($val, &$data){
   if( isType('[Array]', $data) ){
      $newArr = [];
      for($i=0; $i < count($data)+1; $i++){
         if( $i === 0 ){
            $newArr[0] = $val;
         } else {
            $newArr[$i] = $data[$i-1];
         }
      }
      $data = $newArr;
      
      return $newArr;
   }
}


/**
 *
 */
function find($item, $arr){
   $flag = false;
   
   if( isArray($arr) ){
      foreach( $arr as $index=>$val){
         ## $val :: Array
         if( type($val) === "[Array]" ){
            find($item, $val) ? $flag = find($item, $val) : false;
            
         ## 
         } else {
            if( $item === $val ){
               $flag = true;
            }
         }
      }
   } elseif ( isAssoc($arr) ){
   
   }
   return $flag;
}


/**
 *
 */
function some($fn, $arr){
   $flag = false;
   
   #### $arr :: AssocArray
   if( isAssoc($arr) ){
      _forEach(function($key, $val, $indx, $arr) use ($fn, &$flag){
         if ( $fn($key, $val, $indx, $arr) === true ){
            $flag = true;
         }
      }, $arr);
   
   #### $arr :: Array
   } else {
      _forEach(function($curr, $indx, $arr) use ($fn, &$flag){
         if ( $fn($curr, $indx, $arr) === true  ){
            $flag = true;
         }
      }, $arr);
   }
   return $flag;
}


/**
 *
 */
function every($fn, $arr){
   $flag = true;
   
   #### $arr :: AssocArray
   if( isAssoc($arr) ){
      _forEach(function($key, $val, $indx, $arr) use ($fn, &$flag){
         if ( $fn($key, $val, $indx, $arr) === false ){
            $flag = false;
         }
      }, $arr);
   
   #### $arr :: Array
   } else {
      _forEach(function($curr, $indx, $arr) use ($fn, &$flag){
         if ( $fn($curr, $indx, $arr) === false ){
            $flag = false;
         }
      }, $arr);
   }
   return $flag;
}


/**
 *
 */
function isInRange($num, $ranges){
   return find($num, $ranges);
}


/**
 *
 */
function takeAt($startIndex, $num, $arr){
   $endIndex = $startIndex + $num - 1;
      
   return filter(function($curr, $indx) use($startIndex, $endIndex){
      return ($startIndex <= $indx  &&  $indx <= $endIndex);
   }, $arr);
}


/**
 *
 */
function joinWith($jointer, ...$rest){
   ### jointer :: [String]
   if( isType("[String]", $jointer) ){
   
      ### length( rest ) : 1
      if( length($rest) === 1 ){
      
         ## (1-1) rest[0] :: AssocArray
         if( isAssoc($rest[0]) ){
            $assocArr = $rest[0];
            $newArr = [];
            
            foreach($assocArr as $key=>$val){
               $str = "";
               $str = "{$key}{$jointer}{$val}";
         
               $newArr = append($str, $newArr);
            }
            return $newArr;
            
         ## (1-2) rest[0] :: Array
         } elseif ( isArray($rest[0]) ){
            
            $arr = $rest[0];
            $str = "";
            
            _forEach(function($curr, $indx) use (&$str, $jointer){
               if( $indx === 0 ){
                  $str .= $curr;
               } else {
                  $str .= "{$jointer}{$curr}";
               }
            }, $arr);
            return $str;
         }
      

      ### length( rest) >= 2
      ##
      ##      ...$rest :: ...String
      ##      joinWith( jointer, ...str )
      ##      joinWith( jointer, "a", "b", "c", ... )
      } elseif ( length($rest) >= 2 ){
         $str = "";
         $filtered = filter(function($curr){
            return (
               isType("[String]", $curr) ||
               isType("[Number]", $curr)
            );
         }, $rest);
         
         foreach($filtered as $indx=>$curr){
            if( $indx === 0 ){
               $str .= "{$curr}";
            } else {
               $str .= "{$jointer}{$curr}";
            }
         }
         return $str;
      }
   
   ### jointer :: fn
   } else {
      $jointFn = $jointer;
      
      ### length( rest ) : 1
      if( length($rest) === 1 ){
      
         ## (1) rest[0] :: AssocArray
         if( isAssoc($rest[0]) ){
            $assocArr = $rest[0];
            $newArr = [];
            
            _forEach(function($key, $val, $indx, $arr) use (&$newArr, $jointFn){
               $newArr[] = $jointFn($key, $val, $indx, $arr);
            }, $assocArr);
            
            return $newArr;
            
          ## (1) rest[0] :: Array
         } elseif ( isArray($rest[0]) ){
            $arr = $rest[0];
            $str = "";
            
            _forEach(function($curr, $indx, $arr) use (&$str, $jointFn){
               $str .= $jointFn($curr, $indx, $arr);
            }, $arr);
            
            return $str;
         }
      
      ### ...$rest :: ...String
      ## (2) joinWith( jointer, str1, str2 )
      ##     joinWith( jointer, ...str )
      } elseif ( length($rest) >= 2 ){
         ## filter $rest that is type [String]
         $filtered = filter(function($curr){
            return isType("[String]", $curr);
         }, $rest);
         
         $str = "";
            
         _forEach(function($curr, $indx, $arr) use (&$str, $jointFn){
            $str .= $jointFn($curr, $indx, $arr);
         }, $filtered);
         
         return $str;
      }
      
   }
}


/**
 *
 */
function map($fn, $arr){
   $newArr = [];
   
   #### $arr :: AssocArray
   if( isAssoc($arr) ){
      _forEach(function($key, $val, $indx, $arr) use ($fn, &$newArr){
         $newArr[] = $fn($key, $val, $indx, $arr);
      }, $arr);
   
   #### $arr :: Array
   } else {
      _forEach(function($curr, $indx, $arr) use ($fn, &$newArr){
         $newArr[] = $fn($curr, $indx, $arr);
      }, $arr);
   }
   
   return $newArr;
}


/**
 *
 */
function toCamelCase($str){
   $str = strtolower($str);
   ## detect 'snake_case', 'space'
   $regex = "/\s+(.)|_(.)/";
   $replaced = replace( $regex, function($matches){
      $match = $matches[0];
      $p1 = $matches[1];
      $p2 = $matches[2]; 
      /*//////////////////
      _( "match: ", $match );
      _( "match: ", rawurlencode($p1) );
      _( "p2: ", $p2 );
      /////////////////*/
      
      return toUpperCase( $p1  .  $p2);
      
   }, $str);
   
   return $replaced;
}


/**
 *
 */
function toSnakeCase($str){
   return "snaked!";
}


/**
 *
 */
function filter($fn, $arr){
   $newArr = [];
   
   #### $arr :: AssocArry
   if( isAssoc($arr) ){
      _forEach(function($key, $val, $indx, $arr) use ($fn, &$newArr){
         $fn($key, $val, $indx, $arr) ? $newArr[$key] = $val : false;
      }, $arr);
   
   #### $arr :: Array
   } else {
      _forEach(function($curr, $indx, $arr) use ($fn, &$newArr){
         $fn($curr, $indx, $arr) ? $newArr[] = $curr : false;
      }, $arr);
   }
   
   return $newArr;
}


/**
 *
 */
function take($num, $arr){
   return filter(function($curr, $indx) use($num){
      return $indx < $num;
   }, $arr);
}


/**
 *
 */
function concat(...$args){
   $length = length($args);
   
   if( $length <= 1 ){
      //$arg = $args[0];
      return $args;
   }
   ////////
   $isArray = function($curr){
      return isType("[Array]", $curr);
   };
   $isString = function($curr){
      return isType("[String]", $curr);
   };
   ///////
   
   ## at least one arg is [Array]
    # (array concat)
   if( some($isArray, $args) ){
      $newArr = [];
      
      foreach($args as $arg){
         if( isType("[Array]", $arg) ){
            foreach($arg as $ar){
               $newArr[] = $ar;
            }
         } else {
            $newArr[] = $arg;
         }
      }
      return $newArr;

   ## no Array at all
   } else {
      # (string concat)
      ## at least one elements is [String]
      $str = "";
         
      foreach($args as $arg){
         $str .= $arg;
      }
      return $str;
   }
}


/**
 *
 */
function reduce($fn, $initVal, $arr){
   $acc = $initVal;
   
   #### $arr :: AssocArry
   if( isAssoc($arr) ){
      _forEach(function($key, $val, $indx, $arr) use ($fn, &$acc){
         $acc = $fn($acc, $key, $val, $indx, $arr);
      }, $arr);
   
   #### $arr :: Array
   } else {
      _forEach(function($curr, $indx, $arr) use ($fn, &$acc){
         $acc = $fn($acc, $curr, $indx, $arr);
      }, $arr);
   }
   
   return $acc;
};


/**
 *
 */
function flatten($arr, $recursive=false, $depth=0){
   ### Array
   if( isArray($arr) ){
       ### Array of AssocArray
      if( isAssoc($arr[0]) ){
         return flatten($arr[0], $recursive, $depth+1);
      
      ### Array of primitive Value
      } else {
         $acc = reduce(function($acc, $curr){
         //_( $curr );
            return concat($acc, $curr);
         }, [], $arr);
         $noArrayExists = some(function($curr){
         return type($curr) !== "[Array]";
         }, $acc);
   
         if( $recursive ){
            if( $noArrayExists ){
               return $acc;
            } else {
               return flatten($acc, true, $depth+1);
            }
         } else {
            return $acc;
         }
      }
   ### AssocArray
   } else {
      return $arr;
   }
}


/**
 *
 */
function flattenDeep($arr, $depth=0){
   ### Array
   if( isArray($arr) ){
      ### Array of AssocArray
      if( isAssoc($arr[0]) ){
         return flattenDeep($arr[0], $depth+1);
      
      ### Array of Primitive Value
      } else {
         ###  1-level latten 
         $acc = reduce(function($acc, $curr){
            return concat($acc, $curr);
         }, [], $arr);
         
         $arrayExists = some(function($curr){

         
            return type($curr) === "[Array]";
         }, $acc);
   
         if( $arrayExists ){
            return flattenDeep($acc, $depth+1);
         } else {
            return $acc;
         }
      }
   ### AssocArr
   } else {
      return $arr;
   }
}


/**
 *
 */
function filterFlags($regexStr, $flag){
   $regObj = new RegExpO( $regexStr );
   $newRegObj = $regObj->filterFlags($flag);
  // _( $newRegObj->value() );
   return $newRegObj->value();
}


/**
 *
 */
function pushTo($val, $index, $arr){
   $lastIndex = length($arr) - 1;
   $before = take($index, $arr);
   $after = takeAt($index, $lastIndex, $arr);
   //_($before, $after);
   $newBefore = concat($before, $val);
   $newArr = concat($newBefore, $after);
   
   return $newArr;
}


/**
 *
 */
function match($searchPat, $str, $offset=false){
   ## $searchPat :: [Regex]
   if( isType("[Regex]", $searchPat) ){
      $flags = \OOPe\RegExpO::getFlags($searchPat);
      $pattern = \OOPe\RegExpO::getRegex($searchPat);
      
      ## global match
      if( $flags  &&  in_array("g", $flags) ){
         $notGFlags = filter(function($curr, $indx){
            return $curr !== "g";
         }, $flags);
         $pattern .= join($notGFlags);
         
         if( $offset ){
            preg_match_all($pattern, $str, $matches);
            
            return $matches;
         } else {
            preg_match_all($pattern, $str, $matches);
            
            return $matches[0];
         }
         
      ## single match
      } else {
         if( $offset ){
            preg_match($searchPat, $str, $matches);
            
            return $matches;
         } else {
            preg_match($searchPat, $str, $matches);
            
            return $matches[0];
         }
      }
   
   ## $searchPat :: [String]
   } elseif ( isType("[String]", $searchPat) ){
      
      $res = strpos($str, $searchPat);
      
      # no match #
      #   @return: <null>
      if( $res === false ){
         return null;
      # match #
      #   @return: <Num> position index
      } else {
         return $res;
      }
   } else {
      throw new \Exception("Invalid type of arguments in 'match()'");
   }
}


/**
 *
 */
function replace($searchPattern, $replacePattern, $str){
   ## $searchPattern === [Regex]
   
   if( isType("[Regex]", $searchPattern) ){
      $regex = $searchPattern;
      
      ## $replacePattern === [Function]
      if( isType("[Function]", $replacePattern) ){
         $replacer = $replacePattern;
         $regex = filterFlags($regex, "g");
         
         return preg_replace_callback($regex, $replacer, $str);
      ## $replacePattern === [String]
      } else {
         $newVal = $replacePattern;
         $regex = filterFlags($regex, "g");
         
         return preg_replace($regex, $newVal, $str);
      }
      
   #### $searchPattern === [String]
   } else {
      $searchVal = $searchPattern;
      $newVal = $replacePattern;
      
      return str_replace($searchVal, $newVal, $str);
   }
}


/**
 *
 */
function curry($fn){
   $inner = function($arguments) use ($fn, &$inner){
   
      return function(...$args) use ($fn, &$inner, $arguments){
         $paramLength = ( new \ReflectionFunction($fn) )->getNumberOfParameters();
         $passedArgs = concat($arguments, $args);
         $passedArgsLength = length($passedArgs);
         
         ## passedArgsNum >= paramNum :: ok
         if( $passedArgsLength >= $paramLength ){
            return $fn( ...$passedArgs );
         
         ## passedArgsNum <= paramNum :: not yet
         } else {
            return $inner( $passedArgs );
         }
      };
      
   };
   return $inner( [] );
}


/**
 *
 */
function toClosure($fn){
   $refFn = new \ReflectionFunction($fn);
   
   ##### chaeck if fn is closure or not.
   ## fn :: closure
   if( $refFn->isClosure() ){
      $closure = $fn;
   
   ## fn :: not closure
   } else {
      $closure = \Closure::fromCallable($fn);
   }
   return $closure;
}


/**
 *
 */
function apply($fn, $obj, $arrArgs=[]){
   $closure = toClosure($fn);
   
   ## null check for $obj
   if( $obj ){
      return $closure->call($obj, $arrArgs);
   } else {
      return $closure($arrArgs);
   }
}


/**
 *
 */
function call($fn, $obj, ...$args){
   $closure = toClosure($fn);
   
   ## null check for $obj
   if( $obj ){
      return $closure->call($obj, ...$args);
   } else {
      return call_user_func($fn, ...$args);
   }
}


/**
 *
 */
function bind($fn, $obj, ...$bArgs){
   $refFn = new \ReflectionFunction($fn);
   
   ##### chaeck if fn is closure or not.
   ## fn :: closure
   if( $refFn->isClosure() ){
      $closure = $fn;
   
   ## fn :: not closure
   } else {
      $closure = \Closure::fromCallable($fn);
   }
   
   ## bind $obj to $closure
   $func = $closure->bindTo($obj);
   
   return function(...$args) use ($func, $bArgs){
      if( length($func) <= length($bArgs) + length($args) ){
         return $func(...$bArgs, ...$args);
      } else {
         return bind($func, null, ...$bArgs, ...$args);
      }
   };
}

/** Merge two arrays. deep-merging is done.
 *
 */
function merge($arr1, $arr2, $depth=0){
   if( isAssoc($arr1) ){
      foreach( $arr1 as $key1=>$val1){
         foreach( $arr2 as $key2=>$val2){
            # keyMatch
            if( $key1 === $key2 ){
         
               ###$val1 IsAssoc
               if( isAssoc($val1) ){
                  $arr1[$key1] = merge($val1, $val2, $depth+1);
                 
               ## overwrite
               } else {
                  $arr1[$key1] = $val2;
               }
            # no keyMatch
            ## add new key-val
            } else {
               $arr1[$key2] = $val2;
            }
         }
      }
   
   ### isArray($arr1)
   } else {
      $arr1 = concat($arr1, $arr2);
   }
   return $arr1;
}


/**
 *
 */
function repeat($v, $num, ...$args){
   # Function
   if( is_callable($v) ){
      $res = "";
      
      for($i=0; $i < $num; $i++){
         $res .= $v(...$args);
      }
      return $res;
   
   # String
   } else {
      $str = "";
      
      for($i=0; $i < $num; $i++){
         $str .= $v;
      }
      
      return $str;
   }
}