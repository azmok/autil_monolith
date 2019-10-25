# Autil
Vital, versatile, core utility function libray for PHP7 development.


# How to use
- Go to **'@Test/Autil.test.php'** file
- Read and follow instructions in that file.

# Who this is for
**For novice or intermediate.**

I wrote this functions for my personal use. However, I think taht this is also useful for novice developers.
  
Short tutorial in '@Test/autil.test.php' makes it easier to use this library for novice, written for programming novice into consideration.

This library makes many duplicated, verbose built-in functions, that is outdated, procedural-style, bind up to relatively simple, versatile functions for daily use.

I've convinced that PHP is very norvice-friendly and interesting scripting language. As you learn more and then using many features of OOP or FP, that has been gradually added to PHP as time passing, makes learning PHP more interesting!

I curretly has been implementing JavaScript-like OOP features in PHP. This is very exciting!



# Credit
This library uses css of [Bootstrup](https://getbootstrap.com) thorugh CDN.








# Function Reference
- [Debugging](#debugging)
- [Types](#types)
- [Each Data Types](#each_data_types)
- - [String](#string)
- - [Array](#array)
- - [Assoc Array](#assoc_array)
- - [Function](#function)

- [HTML](#html)




<h1 id="debugging">Debugging</h1>

#### `_( `*`...any`*` )`
`_ :: ...* -> null`
- inject arguments into HTML for debugging

```php
_( [1,2,3] ); // (1, 2, 3)



_( 1, 2, 3 );
// 1 2 3 



_( function(){} );
// [Function]



class Foo{}
_( new Foo() );
// [Object]




$assoc1 = ["name"=> "joe"];
_( $assoc1 );
// [name]: joe
```


#### `pretty( `*`arr`*` )`
`pretty :: ( [] | Assoc ) -> Null`
- Inject array/assocArray to HTML that is more easy-to-recognaize format than built-in `print_r()`/`var_dump()`

```php
$arr = ["a", "b", "c"];

pretty( $arr );
// [0]: a
// [1]: b
// [2]: c


$assocArr = [
   "id" => "001",
   "name" => "Buruma",
];

pretty( $assocArr );
// [id]: 001
// [name]: buruma
```



<h1 id="types">Type</h1>

#### `type( `*`any`*` )`
`type :: * -> Str`

- more js-like, easy-to-handle type representation than built-in `gettype()`.

```php
# gettype() (built-in)
gettype( 1 ); // "number"
gettype( "a" ); // "string"
...


# type() 
type( 1 ); // "[Number]"
type( "a" ); // "[String]"
type( [1,2,3] ); // "[Array]"
type( [] ); // "[AssocArray]"
type( function(){} ); // "[Function]"
type( new MyClass() ); // "[Object]"
```


Below table summarize gettype(), type()

|      value     |   type    |  gettype()   |  type()     |
| -------------- | --------- | ------------ | ----------  |
|   `true`, `false`   |  boolean  |  "boolean"   | "[Boolean]" |
|   `null`         |  null     |  "NULL"      | "[Null]"    |
|   `1`, `300`       |  integer  |  "interger"  | "[Number]"  |
|   `2.3`         |  double   |  "double"    |     〃      |
|   `NAN`          |  NAN      |  "double"    |     〃      |
|   `"hi"`        |  string   |  "string"    | "[String]"   |
|   `[1,2]`        |  array    |  "array"     | "[Array]"    |
|   `["name" => "goku"]` | array | "array" | "[AssocArray]" |
|   `new Person()`   |  object   |  "object"    | "[Object"]   |     
|   `function(){}` |  object   |  "object"    | "[Function]" | 



#### `isType( `*`typeStr`*`, `*`any`*` )`
`isType :: typeStr -> * -> Bool`
- Return true if *`typeStr`* match *`any`*'s data type

```php
isType("[String]", "a" ); // true
isType("[Number]", 3 ); // ture
```









<br>
<br>
<h1 id="each_data_types">Each Data Types</h1>
<br>
<h2 id="string">String</h2>

#### `length( `*`str`*` )`
`length :: Str -> Num`
- Return length of String. Equivalent to built-in `strlen()`.

\*`length()` function also accept different data types, Array, Function, Object. About more detail, see corresponding section of `length()`.


```php
length( "a" ); // 1
length( "abcd" ); // 4
```


#### `concat( `*`str`*`, `*`...str`*` )`
`concat :: Str -> ...Str -> Str`
- Return concatnated string

```php
$str = "This is demo";

echo concat($str, " sentence."); // This is demo sentence.
echo concat($str, " Apple", " and Banana."); // This is Apple and Banana.
```


#### `split( `*`separator`*`, `*`str`*` )`
`split :: Str -> []`
- split the string by separator and store each string to array, and return the array. This function can acccept `""`(empty string) as *`separator`*.

```php
$str = "this is demo";
_( split("", $str) ); // (t, h, i, s, , i, s, , d, e, m, o)

// `split()` can accept empty string as `separatir`. (It is illegal in built-in `explode()` function
// of which the separator is empty string. If you want to do like those, instead you need to use 
// `str_split()` function.)
// 
// `split()` is the merged version of `str_split()` and `explode()`.


_( split(" ",$str) ); // (this, is, demo)
```



#### `toUpperCase( `*`str`*` )`
`toUpperCase :: Str -> Str`
- Return the upper-cased string.

```php
$str = "lower-case letter";

_( toUpperCase($str) );  // LOWER-CASE LETTER
```


#### `toLowerCase( `*`str`*` )`
`toLowerCase :: Str -> Str`
- Return the lower-cased string.

```php
$str = "UPPER-CASE LETTER";

_( toLowerCase($str) );  // upper-case letter";
```


#### `toCamelCase( `*`str`*` )`
`toCamelCase: Str -> Str`
- Return the camel-cased string.

```php
$str = "lower case letter";

_( toCamelCase($str) ); // lowerCaseLetter
```










<br>
<h2 id="array">Array</h2>

#### `length( `*`arr`*` )`
`length :: ( [] | Assoc ) -> Num`
- Return length of the array. Equivalent to built-in `sizeof()`, `count()`.

```php
length( [1,2,3] ); // 3
```


#### `head( `*`arr`*` )`
`head :: [] -> *`
- Return first element of `arr`

```php
$arr = ["a", "b", "c"];

head( $arr ); // "a"
```



#### `last( `*`arr`*` )`
`last :: [] -> *`
- Return last element of `arr`

```php
$arr = ["a", "b", "c"];

last( $arr ); // "c"
```



#### `rest( `*`arr`*` )`
`rest :: [] -> []`
- Return copied array of `arr` except first elements

```php
$arr = ["a", "b", "c"];

rest( $arr ); // ("b", "c")
```

#### `initial( `*`arr`*` )`
`initial :: [] -> []`
- Return copied array of `arr` except last elements

```php
$arr = ["a", "b", "c"];

rest( $arr ); // ("a", "b")
```


#### `push( `*`val`*`, `*`arr`*` )`
`push :: ( * -> [] ) -> []`
- insert `val` to end of array `arr`. return item-inserted new array. Original `arr` is not affected.

```php
$arr = [1, 2, 3];

_( push(4, $arr) ); // (1, 2, 3, 4)
_( $arr ); // (1, 2, 3)
```


#### pop
#### shit 
#### unshift




#### `pushTo( `*`val`*`, `*`index`*`, `*`arr`*` )`
`pushTo :: ( * -> Number -> [] ) -> *`
- push `val` into specified position `index` on `arr`. pre-existed element and rest of element are pushed back. Return new merged array. Original array is not affected.

```php
$arr = [1,2,3,4];
$pushedArr = pushTo("+", 2, $arr);

_( $pushedArr ); // (1, 2, +, 3, 4)
_( $arr ); // (1, 2, 3, 4)
```



#### `take( `*`num`*`, `*`arr`*`)`
`take :: ( Number -> [] ) -> []’
- take specified number `num` of elements from start in array and return new taked array.

```php
$arr = [1,2,3,4];
 
take(1, $arr); // (1)
take(2, $arr); // (1, 2)
take(3, $arr); // (1, 2, 3)
```



#### `takeAt( `*`startIndex`*`, `*`num`*`, `*`arr`*`)`
`takeAt :: ( Number -> Number -> [] ) -> []`
- take specified number `num` of elements from `startIndex` in array and return new taked array.

```php
$arr = [1,2,3,4];

takeAt(1, 2, $arr); // (2, 3)
takeAt(2, 2, $arr); // (3, 4)
takeAt(1, 3, $arr); // (2, 3, 4)
```



#### `concat( `*`arr1`*`, `*`arr2`*` )`
`concat :: ( [] -> [] ) -> []`
- Return concatenated array.

```php

concat([1], [2]); // (1, 2)
concat([3], ["a", "b"]); // (3, "a", "b")
```



#### `indexOf( `*`ArrItem`*`, `*`arr`*` )`
`indexOf :: ( * -> [] ) -> Num`
- Return index of element in array/assocArray. If isn't, return `false`.

```php
$normalArr = ["a", "b", "c"];

indexOf("c", $flatArr); // 2


$assocArr = [
   "id" => "001",
   "name" => "goku",
];

indexOf("name", $AssocArr); // 1
```


##### `joinWith( `*`jointer`*`, `*`arr`*` )`


```php

```



#### `_forEach( `*`fn`*`, `*`arr`*` )`
`_forEach :: ( fn -> [] ) -> null`
- Iterate over the `arr` with callback function `fn`. Callback function `fn` is applied to each element of the array. No return value.

The callback function `fn` takes three prameter, and in invocation each parameter is evaluated to the value as specified below.

   `fn($val, $index, $arr)`:  
      $val: current element value of array on iteration.  
      $index: current element index number in array.  
      $arr: the array iterated over.  
      
      
```php
$arr = [1,2];

_forEach( function($val, $indx, $arr){
   _( "val: ", $val );
   _( "indx: ", $indx );
   _( "arr: ",  $arr );
   _("");
}, $arr );


/***  output  ***
val: 1 
indx: 0 
arr: 
(1 , 2)

val: 2 
indx: 1 
arr: 
(1 , 2)
/*****************/



/*--- callback function can be passed by variable name --------*/
$logArrElms = function($val, $indx, $arr){
   _( "val: {$val}" );
   _( "index: {$indx}" );
   _( "arr: {$arr}" );
};
_forEach( $logArrElms, $flatArr ); // same output
/*--------------------------------------------------*/





// If you want to use nearest outer scope variable, 
//  must use 'use' keyword in callback function definition.


function LogArrElms($arr){
   $local = "local Var!";
   $callback = function($curr, $indx) use($local){
      _( $local );
      _( $indx );
   };
   _forEach($callback, $arr);
}
LogArrElms( [1,2] );
/***  output  ***
local Var!
0
local Var!
1
/****************/

// If 'use' keyword is absent...

function LogArrElms($arr){
   $local = "local Var!";
   $callback = function($curr, $indx){
      _( $local );
      _( $indx );
   };
   _forEach($callback, $arr);
}
LogArrElms( [1,2] );
/***  output  ***
[Null]
0
[Null]
1
/****************/
```



#### `map( `*`mappingFn`*`, `*`arr`*` )`
`map :: ( (* -> *) -> [] ) -> []`
- Applying callback function `mappingFn` to each element of array `arr` and return new mapped array.

```php
$arr = [1,2,3];
$add1 = function($x){
   return $x + 1;
};

_( map($add1, $arr) ); // (2,3,4)
```



#### `filter( `*`predicateFn`*`, `*`arr`*` )`
`filter :: ( (* -> bool) -> [] ) -> []`
- Filtering elements of array with callback function `predicateFn` and return new filtered array.

```php
#-----  arr  ----------------------
$arr = [1, 2, 3, 4];
$isEven = function($x){
   return $x % 2 === 0;
};

_( filter($isEven, $arr) ); // [2, 4]
```



#### `reduce( `*`reducerFn`*`, `*`initVal`*`, `*`arr`*` )`
`reduce :: ((* -> * -> *) -> * -> []) -> *`

```php

```



#### `some( `*`predicateFn`*`, `*`arr`*` )`
`some :: ( (* -> bool) -> [] ) -> bool`
- Return true if callback funcition `predicateFn` return true in ,at least, one element

```php
$arr = [1,2,3];

some(function($curr){
   return $curr === 3;
}, $arr); // true

some(function($curr){
   return $curr < 2;
}, $arr); // true



// function can be passed by variable name
$isThree = function($curr){
   return $curr === 3;
};
some( $isThree, $arr ); // true


$lessThan2 = function($curr){
   return $curr < 2;
};
some( $lessThan2, $arr) ); // true
```


#### `every( `*`predicateFn`*`, `*`arr`*` )`
`every :: ( (* -> bool) -> [] ) -> bool`
- Return true if callback funcition `predicateFn` return true in all elements

```php
$arr = [1,2,3];
$lessThan5 = function($curr){
    return $curr < 5;
};

every($lessThan5, $arr); // true

$lessThan2 = function($curr){
    return $curr < 2;
};

every($lessThan2, $arr); // false
```
















<br>
<h2 id="assoc_array">Assoc Array</h2>

#### `length( `*`assoc`*` )`
`length :: ( Assoc ) -> Num`
- Return length of the array. Equivalent to built-in `sizeof()`, `count()`.

```php
$assoc = [
   "id" => "001",
   "name" => "Goku",
];

length( $assoc ); // 2
```



#### `isAssoc( `*`any`*` )`
`isAssoc :: * -> Bool`
- Return true if passed argument is Associative array.

```php
$assoc = [
   "id" => "001",
   "name" => "Goku",
];

isAssoc( $assocArr ); // true
isAssoc( [1,2,3] ); // false
```



##### `joinWith( `*`jointer`*`, `*`assoc`*` )`
`joinWith :: (( Str|Fn ) -> Assoc ) -> []`
- Return array of which each element is joined string with jointer

```php
$PersonHP = [
   "Goku" => 999,
   "Chichi" => 10,
   "Bejita" => 990,
];

_( joinWith("-", $PersonHP) ) ;
// (Goku-999 , Chichi-10 , Bejita-990)
```


#### `_forEach( `*`fn`*`, `*`assoc`*` )`
`_forEach :: ( fn -> assoc ) -> null`
- Iterate over the `arr` with callback function `fn`. Callback function `fn` is applied to each element of the assocArray. No return value.

The callback function `fn` takes four prameter, and in invocation, each parameter is evaluated to the value as specified below.

   `fn($val, $index, $arr)`:  
      $key: current element key of assocArray on iteration.  
      $val: current element value of assocArray on iteration.  
      $index: current element index number in assocArray.  
      $assocArr: the assocArray iterated over.  
      
      
```php
$assoc = [
   "id" => "001",
   "name" => "Goku",
];

_forEach( function($key, $val, $indx, $assoc){
   _( "key: ", $key );
   _( "val: ", $val );
   _( "indx: ", $indx );
   _( "arr: ",  $assoc );
   _("");
}, $assoc );


/****  output  ****
key: id 
val: 001 
indx: 0 
arr: 
[id]: "001"
[name]: "Goku" 

key: name 
val: Goku 
indx: 1 
arr: 
[id]: "001"
[name]: "Goku" 
/*****************/
```



#### `map( `*`mappingFn`*`, `*`assocArr`*` )`
`map :: ( (* -> *) -> [] ) -> []`
- Applying callback function `mappingFn` to each element of assocArray `assocArr` and return new mapped array.

```php
$PersonHP = [
   "Goku" => 999,
   "Chichi" => 10,
   "Bejita" => 990,
];
$mappedArr = map(function($key, $val, $indx){
   return "{$val}'s HPis {$val}:: {$indx}";
}, $PersonHP);

pretty( $mappedArr );
/****  output  **********
[0]: 999's HPis 999:: 0
[1]: 10's HPis 10:: 1
[2]: 990's HPis 990:: 2
/***********************/
```



#### `filter( `*`predicateFn`*`, `*`arr`*` )`
`filter :: ( (* -> bool) -> [] ) -> []`
- Filtering elements of array with callback function `predicateFn` and return new filtered array.

```php
$PersonHP = [
   "Goku" => 999,
   "Chichi" => 10,
   "Bejita" => 990,
];

$filtered = filter(function($key, $val, $indx){
   return $val > 900;
}, $PersonHP);

_( $filtered );

/****  output  ****
[Goku]: 999
[Bejita]: 990
/*****************/
```



#### `reduce( `*`reducerFn`*`, `*`initVal`*`, `*`arr`*` )`
`reduce :: ((* -> * -> *) -> * -> []) -> *`

```php

```



#### `some( `*`predicateFn`*`, `*`arr`*` )`
`some :: ( (* -> bool) -> [] ) -> bool`
- Return true if callback funcition `predicateFn` return true in ,at least, one element

```php

```


#### `every( `*`predicateFn`*`, `*`arr`*` )`
`every :: ( (* -> bool) -> [] ) -> bool`
- Return true if callback funcition `predicateFn` return true in all elements

```php

```














<br>
<h2 id="function">Function</h2>

#### `length( `*`fn`*` )`
`length :: Fn -> Num`
- Return length of parameters of the function.

```php
$add = function ($x, $y){
   return $x + $y;
};
length( add ); // 2
```


#### `call( `*`fn`*`, `*`...args`*` )`
`call :: ( Fn -> ...* ) -> *`
- call `fn` with arbitrary-length list of arguments.

```php

```


#### `apply( `*`fn`*`, `*`arr`*` )`
`apply :: ( fn -> [] ) -> *`
- call `fn` with arguments of array `arr`.

```php

```

#### bind

#### curry

#### toClosure










<br>
<h2 id="html">HTML</h2>

#### `pretty( `*`arr`*` | `*`assocArr`*` )`
`pretty :: ( [] | Assoc ) -> null`
- Output more human-readable format of array or associative array than built-in `print_r`/`var_dump`

```php
$arr = [1,2,3];
pretty( $arr );
/****  output  ****
[0]: 1
[1]: 2
[2]: 3
/*****************/



$assoc = [
   "id" => "001",
   "name" => "Goku",
];
pretty( $assoc );
/****  output  ****
[id]: "001"
[name]: "Goku"
/*****************/
```


#### `inject( `*`str`*`, `*`tagName="h1"`*`, `*`attrs=[]`*` )`
`inject :: ( Str -> Str -> [] ) -> null`
- Inject string to HTML. Embracing `tagName`(for HTML tgaName), `attrs`(for HTML attributes)

```php
inject( "hi" );
//*** output(HTML source code) ***
// <h1>hi</h1>

inject( "hey!", "h2" );
// <h2>hey!</h2>

$attrArray = [
   "class" => "item",
   "style" => [
      "color" => "red",
   ],
];
inject( "meow!", "h3", $attrArray );
// <h3 class="item" style="color: red;">meow!</h3>

```


#### `toAttr( `*`assocArr`*` )`
`toAttr :: [] -> Str`
- Return a string to which `assocArr` is coverted to for HTML attribute.

```php
$assoc = [
   "class" => "nav",
   "id" => "main-nav",
];
_( toAttr($assoc) ); // class='nav' id='main-nav'

// case of 'style' attribute
$assoc2 = [
   "class" => "nav",
   "style" => [
      "color" => "#333",
      "border" => "1px solid blue",
   ],
   "alt" => "navigation_bar",
];
_( toAttr($assoc2) );
// class='nav' style='color: #333; border: 1px solid blue' alt='navigation_bar'
```
