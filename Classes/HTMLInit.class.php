<?php

namespace V;



/** Initilizing HTML for PHP Dev 
 *
 */
class HTMLInit{
/*----------------------
      HTMLInit
------------------------
   
------------------------
   + _init
   + insertHTML
   + loadCss
   + loadJs
   + renderJs
   + appendInlineStyle
----------------------*/

   function __construct(){
      $this->_init();
      
      $this->viewport();
      $this->loadCss( PATH_CSS_BOOTSTR );
   }
   
   
   /*
    *
    */
   function _init(){
      $js = <<<DOC
;(function( window ){
   const _  = function(...args){
      console.log(...args);
   },
   doc = document,
   docRoot = doc.documentElement,
   body = doc.body;
   
   const initHTML = function(tagName){
      elm = doc.createElement( tagName );
   
      elm.innerHTML = "";
      
      if( tagName.toLowerCase() === "html" ){
         doc.documentElement = html;
      } else {
         doc[tagName] = elm;
      }
   },
   assertHTMLCore  = function(){
      if( !docRoot ){
         _(1);
         initHTML( "html" );
      }
      if( !doc.head ){
         _(2);
         initHTML( "head" );
      }
      if( !body ){
         _(3);
         initHTML( "body" );
      }
   }
})( window );

let _  = function(...args){
   console.log(...args);
},
docRoot = document.documentElement;
_( docRoot.outerHTML );
DOC;
   
      $this->renderJs($js);
   }
   
   
   /**
    *
    */
   function viewport(){
      $str = "<meta name='viewport' content='width=device-width, initial-scale=1' />";
      
      $this->insertHTML("head", $str);
   }
   
   
   /**
    *
    */
   function insertHTML($tagName, $txt){
      $js = <<<DOC
let elm = document.querySelector("$tagName");

elm.innerHTML += "$txt";
DOC;
   
      $this->renderJs($js);
   }
   

   /**
    *
    */
   function loadCss($url){
      $html = "<link rel='stylesheet' href='{$url}'>";
      
      $this->insertHTML("head", $html);
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
   
      $this->renderJs($js);
   
   }
   
   
   /**
    *
    */
   function renderJs($js){
      $jsTemplate = <<<DOC
<script>     
"use strict";

window.addEventListener("DOMContentLoaded", ()=>{
   {$js}
});
</script>
DOC;
   
      echo $jsTemplate ."\n";
   }
   
   
   /**
    *
    */
   function addStyle($tagName, $assoc){
      $json = json_encode($assoc);
      
      $js = <<<DOC
let el = document.querySelector("$tagName"),
props = $json;
      
for(let prop in props){
   el.style[prop] = props[prop];
}
DOC;
   
      $this->renderJs($js);
   }
}