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
