<h2 id="function">Function</h2>

#### `length( `*`fn`*` )`
`length :: Fn -> Num`
- Return length of parameters of the function.

```php
$add = function ($x, $y){
   return $x + $y;
};
length( $add ); // 2
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