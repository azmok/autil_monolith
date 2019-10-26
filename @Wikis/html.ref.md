<h2 id="html">HTML</h2>

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
- Return a string to which `assocArr` is coverted for HTML attributes.

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
// class='nav' style='color: #333; border: 1px solid blue;' alt='navigation_bar'
```
