<?php

namespace V;




/* 
  This library use Bootstrup.css through CDN.
 
 
 * The MIT License (MIT)
 *
 * Copyright (c) 2011-2018 Twitter, Inc.
 * Copyright (c) 2011-2018 The Bootstrap Authors
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */
/****************  cas, js initializs, helper  *******/
define('PATH_CSS_BOOTSTR', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");









/**
 *
 */
function inject($val, $tagName="h1", $assocArr=[]){
   if( match('~h\d~', $tagName) ){
      if( empty($assocArr) ){
         $assocArr = [
            "class" => "bg-info text-white",
            "style" => [
               "padding" => "0 0.5rem",
            ],
         ];
      }
   }
   
   $str = toAttr($assocArr);
   echo "<{$tagName} {$str}>".  htmlspecialchars($val)  ."</{$tagName}>";
}


/**
 *
 */
function create($txt, $tagName="div", $assocArr=[]){
   if( empty($assocArr) ){
      $assocArr = [
         "class" => "bg-info text-white",
         "style" => [
            "padding" => "0 0.5rem",
         ],
      ];
   }
   $attr = toAttr($assocArr);
   
   return "<{$tagName} {$attr}>$txt</{$tagName}>";
}


function escape($str, ...$ops){
   $flags = $ops[0] ? $ops[0] : ENT_COMPAT;
   $encoding = $ops[1] ? $ops[1] : ini_get("default_charset");
   $double_encode = $ops[2] ? $ops[2] : TRUE;
   
   return htmlspecialchars($str, $flags, $encoding, $double_encode);
}


function unescape($str, ...$flags){
   $flags = $flags[0] ? $flags[0] : ENT_COMPAT | ENT_HTML401;
   return htmlspecialchars_decode($str, $flags);
}




/**
 *
 */
function injectJs($js){
   $jsTemplate = <<<JsTemp
<script>     
"use strict";
window.addEventListener("load", ()=>{
   {$js}
});
</script>
JsTemp;

   echo $jsTemplate ."\n";
}


/**
 *
 */
function insertIntoHeadTag ($str){
   $js = <<<JSCOMP
let head = document.querySelector("head");

head.innerHTML += "{$str}";
JSCOMP;

   injectJs($js);
}


/**
 *
 */
function appendViewPort (){
   $str = "<meta name='viewport' content='width=device-width, initial-scale=1' />";
   insertIntoHeadTag($str);
}



/**
 *
 */
function loadCss($url=PATH_CSS_BOOTSTR){
   $str = "<link rel='stylesheet' href='{$url}'>";
   
   insertIntoHeadTag($str);
}


/**
 *
 */
function loadJs($url=""){
   $js = <<<DOC
let body = document.body;
let elm = document.createElement("SCRIPT");

elm.src = "{$url}";
body.appendChild(elm);

DOC;

   injectJs($js);

}


/**
 *
 */
function appendInlineStyle($elm, $props){
   $js = <<<APPENDOC
let el = document.querySelector("$elm");
let props = $props;
      
for(let prop in props){
   el.style[prop] = props[prop];
}
APPENDOC;

   injectJs($js);
}


/**
 *
 */
function highlight($str){
   $str = "<?php\n".  $str;
   
   return highlight_string($str, true);
}






/*** initiliaze HTML meta vireport, css  **/
appendViewPort();
loadCss();
appendInlineStyle("body", "{padding: '2rem'}" );
/*********************************/