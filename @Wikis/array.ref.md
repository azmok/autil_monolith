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


#### `push( `*`val`*`, `*`&arr`*` )`
`push :: ( * -> [] ) -> []`
- insert `val` to end of array `arr`. Return the reference of original array. Original `arr` is affected.

```php
$arr = [1, 2, 3];

push(4, $arr);
_( $arr ); // (1, 2, 3, 4)
```


#### pop
#### shit 
#### unshift




#### `pushTo( `*`val`*`, `*`index`*`, `*`&arr`*` )`
`pushTo :: ( * -> Number -> [] ) -> *`
- push `val` into specified position `index` on `arr`. pre-existed element and rest of element are pushed back. Return the reference of original array. Original array is affected.

```php
$arr = [1,2,3,4];

pushTo("+", 2, $arr);
_( $arr ); // (1, 2, +, 3, 4)
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
- Applying callback function `mappingFn` to each element of `arr` and return new mapped array.

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
- Return true if callback funcition `predicateFn` return true on one element at least

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
- Return true if callback funcition `predicateFn` return true on all elements

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