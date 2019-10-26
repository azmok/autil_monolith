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