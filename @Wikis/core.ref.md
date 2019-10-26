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



<h1 id="types">Types</h1>

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
type( ["name" => "Goku"] ); // "[AssocArray]"
type( function(){} ); // "[Function]"
type( new MyClass() ); // "[Object]"
```


Below table summarize `gettype()`, `type()`

|      value     |   data types in PHP  |  `gettype()`<br>(built-in)  |  `type()`     |
| -------------- | --------- | ------------ | ----------  |
|   `true`, `false`   |  boolean  |  `"boolean"`   | `"[Boolean]"` |
|   `null`         |  null     |  `"NULL"`      | `"[Null]"`    |
|   `1`, `300`       |  integer  |  `"interger"`  | `"[Number]"`  |
|   `2.3`         |  double   |  `"double"`    | `"[Number]"`  |
|   `NAN`          |  NAN      |  `"double"`    | `"[Number]"`  |
|   `"hi"`        |  string   |  `"string"`    | `"[String]"`   |
|   `[1,2]`        |  array    |  `"array"`     | `"[Array]"`    |
|   `["name" => "goku"]` | array | `"array"` | `"[AssocArray]"` |
|   `new Person()`   |  object   |  `"object"`    | `"[Object]"`   |     
|   `function(){}` |  object   |  `"object"`    | `"[Function]"` | 



#### `isType( `*`typeStr`*`, `*`any`*` )`
`isType :: typeStr -> * -> Bool`
- Return true if *`typeStr`* match *`any`*'s data type

```php
isType("[String]", "a" ); // true
isType("[Number]", 3 ); // ture
```






