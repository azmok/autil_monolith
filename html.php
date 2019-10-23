<?php

namespace V;






/****************  cas, js initializes, helper  *******/
define('PATH_CSS_BOOTSTR', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");



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

function insertIntoHeadTag ($str){
   $js = <<<JSCOMP
let head = document.querySelector("head");

head.innerHTML += "{$str}";
JSCOMP;

   injectJs($js);
}

function appendViewPort (){
   $str = "<meta name='viewport' content='width=device-width, initial-scale=1' />";
   insertIntoHeadTag($str);
}

function loadCss($url=PATH_CSS_BOOTSTR){
   $str = "<link rel='stylesheet' href='{$url}'>";
   
   insertIntoHeadTag($str);
}

function loadJs($url=""){
   $js = <<<DOC
let body = document.body;
let elm = document.createElement("SCRIPT");

elm.src = "{$url}";
body.appendChild(elm);

DOC;

   injectJs($js);

}

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



/*** initiliaze HTML meta vireport, css  **/
appendViewPort();
loadCss();
appendInlineStyle("body", "{padding: '2rem'}" );
/*********************************/