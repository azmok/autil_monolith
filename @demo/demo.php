<?php



require_once dirname(__DIR__)  ."/__init__.php";
#  (1) By importing __init__.php file, all functions in Autil is imported to current file(this file).
# 
#     If you want to use Autil library in different file in different directory,
#     all you need to do is to import '__init__.php' file of Autil.
/***

   For example, suppose your Document Root is 'htdocs' and Autil folder is beside your project directory.



htdocs/
  |
  |- youProjectDir/
  |      |
  |      |- yourFile.php
  |
  |
  |- Autil/
       |
       |- __init__.php
       |
       |-...
       |
       
       


--- 'yourfile.php' ----
> <?php
>
>    require_once $_SERVER['DOCUMENT_ROOT']  . "/Autil/__init__.php";
>    
>    use function V\_, V\type, ...
>
>
>
>
>    ...your php script...
>
-----------------------*/









#  (2) How to use?
// Autil files(modules) is namespaced as 'V'. So, when you use function after you include(require) files, 
// you must follow two of which ways to use imported functions.




#-------------------------
#  (2-1) using 'fully qualified name' to use function.
#------------------------
#  ex  )
#

// {namespace}\{FnName}();
V\_(1); // 1





#-------------------------
#   + recommended +
#  (2-2 ) using 'use function {namespace}\{FnName}' clause to use imported function
#-------------------------
#  ex  )
#

use function V\_, V\type;


_(1); // 1
echo type(1); // "[Number]"











/**********************************************************
 *  To continue for demo,
 *
 *   - Add '/' to below '....******' line end 
 *                                             \        
 *       Let's try more Demos!!😙😋           |         
 *                                             ↓  
***********************************************/



use function
   # testing, debug
   V\isType, V\isArray, V\isAssoc, V\pretty,
    
   # array
   V\_forEach, V\map, V\filter, V\reduce,
   
   # string
   V\append, V\prepend, V\match, V\replace,
   # html
   V\render;

   






# output title
render('_( $arr )');

$arr = [1,2,3];

_( $arr );  // (1 , 2 , 3)







# output title
render('_( $assocArr )');

$assocArr = [
   "id" => "001",
   "name" => "Goku",
];

_( $assocArr );
//----  outputp  ----
// [id]: "001"
// [name]: "Goku"






render('pretty( $arr )');
pretty( $arr );
// [0]: 1
// [1]: 2
// [2]: 3

render('pretty( $assocArr )');
pretty( $assocArr );
// [id]: "001"
// [name]: "Goku"



/**/