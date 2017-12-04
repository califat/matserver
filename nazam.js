'use strict';function createTag(tag){return document.createElement(tag);}function _(elem){return document.getElementById(elem);}function textNode(string){return document.createTextNode(string);}let debug=function(bugMsg){return console.log(bugMsg);}
let isEventReady  =false;
let d             =document;
let LOCATION_API  =_("home-nav");
let overLayHighest =createTag("div");overLayHighest.id ="_ov_1inH";overLayHighest.className ="_ov_1inH";
function attr(elem,attr,value){return elem.setAttribute(attr,value);}let overLay=createTag("div"),overLayPanelmessage=createTag('div'),overLayPanelconfirm=createTag('BUTTON'),overLayPanelbody=createTag('div'),overLayPanelbodyTip=createTag('div'),overLayCloseHtml=createTag("div");;attr(overLay,"class","_o_hiden");attr(overLay,"id","_o_hiden");let overLayClose="<div class=\"o_c_14\" id=\"o_c_14\" title=\"close modal\">&times;</div>";let img=createTag("IMG");attr(img,"class","_im");attr(img,"id","_im");attr(overLayPanelmessage,"class","_p_ms");attr(overLayPanelmessage,"id","_p_ms");attr(overLayPanelconfirm,"class","panelconfirm");attr(overLayPanelconfirm,"id","panelconfirm");attr(overLayPanelbody,"class","_o_p_bo");attr(overLayPanelbody,"id","_o_p_bo");attr(overLayPanelbodyTip,"class","overLayPanelbodytip");attr(overLayPanelbodyTip,"id","overLayPanelbodytip");function modal(action,action_content,btn,btnSelector,animation,overlayOpt,bodyOption,html_,autodismiss){this.messageType=action;this.messageContent=action_content;this.buttonUsed=btn;this.buttonSelector=btnSelector;this.animationUsed=animation;this.overlayOption=overlayOpt;this.bodyOptionScrollOrNot=bodyOption;this.htmlContent=html_;this.eautoDismissValue=autodismiss;const ARG_NUM=9;let overLayPanelbodyTips=["This is an information","This is a warning","This is a success","This is a danger"];let classColor=null;let defaultParam_action=["info","warning","success","danger"];let defaultParam_btnSelector=["#","."];let defaultParam_anim=["_","shw","fadein","lime","bounce"];let defaultParam_overlay=["overlayDefault","overlayColored"];let defaultBody_bodyOption=["noScroll","scroll"];let defaultParam_btn=["btn"];let defaultParam_html=["success","warning","info","message"];let defaultParam_action_content=[null];let autoDismiss=[true,false];let options_array=[defaultParam_action,defaultParam_action_content,defaultParam_btn,defaultParam_btnSelector,defaultParam_anim,defaultParam_overlay,defaultBody_bodyOption,defaultParam_html,autoDismiss];let errMsg=["_nazModal require at least "+ARG_NUM+" params","is not an option","use # as element selector","is not defined","can not provide both html and modal text","can not miss both html and modal text"];let imgPath=["img/info.png","img/warning.png","img/success.png","img/danger.png"];let args=arguments.length;let argsList=arguments;switch(this.messageType){case"info":classColor="info";break;case"warning":classColor="warning";break;case"success":classColor="success";break;case"danger":classColor="danger";break;default:classColor="info";}
function _selector(elem,selector){try{if(arguments.length>2||arguments.length<2)throw errMsg[0];}catch(err){debug(err);return false;}
try{if(selector!=="#"&&selector!==".")throw errMsg[1];if(selector=="#"){let button=document.getElementById(elem);try{if(button){button.addEventListener("click",openModal);}else{throw elem+" "+errMsg[3];}}catch(err){debug(err);}}else if(selector=="."){let buttons=document.getElementsByClassName(elem);for(var i=0;i<buttons.length;i++){let button=buttons[i];try{if(button){button.addEventListener("click",openModal);}else{throw elem+" "+errMsg[3];}}catch(err){debug(err);}}}}catch(err){debug(err);return 0;}}
function scrol_y_or_not(){overLay.classList.remove("_o_hiden");if(argsList[6]==defaultBody_bodyOption[0]){document.body.classList.add("_f_this");overLay.setAttribute("class","_ov_1");}else{overLay.classList.add("_o_view_s");}}
function openModal(enent){event.preventDefault();if(argsList[1]!==null&&argsList[7]!==null){debug(errMsg[4]);return 0;}else if(argsList[1]===null&&argsList[7]===null){debug(errMsg[5]);return 0;}else if(argsList[7]===null&&argsList[1]!==null){for(var i=0;i<defaultParam_anim.length;i++){if(argsList[4]==defaultParam_anim[i]){overLayPanelmessage.classList.add(defaultParam_anim[i]);}else if(argsList[4]!=defaultParam_anim[i]){overLayPanelmessage.classList.remove(defaultParam_anim[i]);}}
for(var i=0;i<defaultParam_action.length;i++){try{if(argsList[0]===defaultParam_action[i]){attr(img,"src",imgPath[i]);}else{}}catch(err){debug(err);}}
scrol_y_or_not();for(var i=0;i<defaultParam_action.length;i++){if(argsList[0]==defaultParam_action[i]){overLayPanelmessage.innerHTML=overLayClose;overLayPanelbody.innerHTML=argsList[1]+"<br>";overLayPanelbody.appendChild(img);overLayPanelmessage.appendChild(overLayPanelbody);overLayPanelbodyTip.innerHTML=overLayPanelbodyTips[i];overLayPanelbody.appendChild(overLayPanelbodyTip);overLay.appendChild(overLayPanelmessage);}}
document.body.appendChild(overLay);closeModal();}else if(argsList[7]!==null&&argsList[1]==null){if(bodyOption==defaultBody_bodyOption[0])document.body.classList.add("_f_this");for(var i=0;i<defaultParam_anim.length;i++){if(argsList[4]==defaultParam_anim[i]){overLayPanelmessage.classList.add(defaultParam_anim[i]);}else{overLayPanelmessage.classList.remove(defaultParam_anim[i]);}}
scrol_y_or_not();overLayCloseHtml.innerHTML="&times";attr(overLayCloseHtml,"class","o_c_html");attr(overLayCloseHtml,"id","o_c_html");overLay.appendChild(overLayCloseHtml);overLay.innerHTML+=argsList[7];document.body.appendChild(overLay);closeModalHtml();}}
if(args<ARG_NUM||args>ARG_NUM)debug(errMsg[0]);for(var i=0;i<args;i++){try{if(argsList[i]!==null&&argsList[i]!==argsList[1]&&argsList[i]!==argsList[2]&&argsList[i]!==argsList[7]&&options_array[i].indexOf(argsList[i])===-1)
{throw argsList[i]+" "+errMsg[1];}else{_selector(argsList[2],argsList[3]);}}
catch(err){debug(err);return 0;}}}
function closeModal(){let closer=_("o_c_14");try{window.onclick=function(event){if(event.target==overLay){overLay.setAttribute("class","_o_hiden");document.body.classList.remove("_f_this");document.body.removeAttribute("class");overLay.removeChild(overLayPanelmessage);document.body.removeChild(overLay);}}
if(closer){closer.addEventListener("click",function(){overLay.setAttribute("class","_o_hiden");document.body.classList.remove("_f_this");document.body.removeAttribute("class");overLay.removeChild(overLayPanelmessage);document.body.removeChild(overLay);});}else{throw"undifined element";}}catch(err){debug(err)}}
function closeModalHtml(){let closer=document.getElementById("o_c_html");try{window.onclick=function(event){if(event.target ==overLay){document.body.removeChild(overLay);overLay.innerHTML=null;document.body.classList.remove("_f_this");}}
if(closer){closer.addEventListener("click",function(){document.body.removeChild(overLay);overLay.innerHTML=null;document.body.remove("class");})}else{throw"undifined element";}}catch(err){debug(err);}}

function clearOverLay(){/*CLOSE THE OVERLAY IN FADEOUT*/

  /*#######################*/
  /*  CALLABLE FUNCTION   */

  try{
    if(globalFunc.preventLostEvent() != undefined)
    globalFunc.preventLostEvent();
  }catch(e){

  }

  /*END CALLABLE FUNCTION */
  /*######################*/



  if(isEventReady ==true){return false;}
  let diminution  =0.02;
  let speed       =100;
  let elem        =overLay;
  if(!elem.style.opacity)
  {
    elem.style.opacity = 1;
  }
  let fadeEffect =setInterval(function(){

    elem.style.opacity -= diminution;

    if(elem.style.opacity ==0){

      clearInterval(fadeEffect);

      if(_("_ov_1inH")){

        _("_ov_1inH").innerHTML =null;
        document.body.removeChild(_("_ov_1inH"));

      };
      overLay.setAttribute("class","_ov_1in");
      overLay.innerHTML=null;document.body.removeChild(overLay);
      document.body.removeAttribute("class");
      let home_nav =_("home-nav");
      if(home_nav){
          home_nav.classList.remove("hnsy")
      }
      elem.style.opacity = 1;
    }

  }, speed /Math.round(50));

}/*END CLOSE THE OVERLAY IN FADEOUT*/

function clearOverLayWithTrigger(){/*CLOSE THE OVERLAY IN FADEOUT WITH TRIGER*/

  let diminution  =0.02;
  let speed       =100;
  let elem        =overLay;
  if(!elem.style.opacity)
  {
    elem.style.opacity = 1;
  }
  let fadeEffect =setInterval(function(){

    elem.style.opacity -= diminution;
    if(elem.style.opacity ==0){

      clearInterval(fadeEffect);

      if(_("_ov_1inH")){

        _("_ov_1inH").innerHTML =null;
        document.body.removeChild(_("_ov_1inH"));
        
      }
      overLay.setAttribute("class","_ov_1in");
      overLay.innerHTML=null;document.body.removeChild(overLay);
      document.body.removeAttribute("class");
      let home_nav =_("home-nav");
      if(home_nav){
          home_nav.classList.remove("hnsy")
      }
      elem.style.opacity = 1;
    }
  }, speed /Math.round(50));

}/*END CLOSE THE OVERLAY IN FADEOUT WITH TRIGER*/

function modali(content){let modalContent=content;try{if(modalContent){let modaliCloseClickSumilator =createTag("div");modaliCloseClickSumilator.id="modali_cls_clicksumilator";let modaliClose=createTag("div");modaliClose.innerHTML="&times";attr(modaliClose,"class","_x0");attr(modaliClose,"id","_x0");attr(overLay,"role","popup");overLay.appendChild(modaliCloseClickSumilator);overLay.appendChild(modaliClose);overLay.appendChild(modalContent);overLay.classList.remove("_o_hiden");overLay.setAttribute("class","_ov_1in");overLay.setAttribute("id","_ov_1in");document.body.appendChild(overLay);document.body.classList.add("_f_ajx");_("home-nav").classList.add("hnsy");try{let closer=_("_x0");window.onclick=function(event){if(event.target==overLay){clearOverLay()}}
if(closer){closer.addEventListener("click",function(){clearOverLay()})}else{throw"undifined element";}if(modaliCloseClickSumilator){modaliCloseClickSumilator.addEventListener("click",function(){clearOverLayWithTrigger()})}else{throw"undifined element";}}catch(err){debug(err);}}else{ throw"_nazModal"}}catch(e){debug(e)}}
let _t_0xt=function modali(){let X1="<span id=\"_sad\"><img src=\"_node.png\"/></span>",X2=createTag('span'),X3=createTag('BUTTON'),X4=createTag('div'),cont=createTag('div'),secure_txt="Redirecting to login page";X3.innerHTML="Login";attr(X2,"class","x2");attr(cont,"class","cnt");X2.innerHTML=secure_txt;X3.id="_btn";X4.appendChild(X3);cont.innerHTML=X1;cont.appendChild(X2);cont.appendChild(X4);let _t_0xt=createTag('div')
_t_0xt.appendChild(cont);_t_0xt.setAttribute("class","_t_1xt");_t_0xt.setAttribute("id","_t_1xt");document.body.appendChild(_t_0xt);document.body.classList.add("_f_ajx");}
let GethttpRequest=function(){var httpRequest=false;if(window.XMLHttpRequest){httpRequest=new XMLHttpRequest();if(httpRequest.overrideMimeType){httpRequest.overrideMimeType('text/xml');}}//innerHTML+=
else if(window.ActiveXObject){try{httpRequest=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e){try{httpRequest=new ActiveXObject("Microsoft.XMLHTTP");}
catch(e){}}}
if(!httpRequest){return 0;}
return httpRequest;}

var getJSON = function(url, callback) {/*FETCH JSON FROM A SERVER*/

  function request(){

    var xhr = GethttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
      var status = xhr.status;
      if (status == 200) {
        callback(status, xhr.response);
      } else {
        callback(status);
      }
    };
    xhr.send();
  }
  networkOrFail(request,5000);
};

// document.getElementById("nazi").onclick = function () {
//     scrollTo(document.body, 0, 100);
// }

    function scrollTo(element, to, duration) {

        if (duration < 0) return;
        var difference = to - element.scrollTop;
        var perTick = difference / duration * 2;

    setTimeout(function() {
        element.scrollTop = element.scrollTop + perTick;
        scrollTo(element, to, duration - 2);
    }, 10);
}
/* ce script synchrone va retarder l'analyse du DOM. 
    Donc l'événement DOMContentLoaded va se lancer plus tard.

document.addEventListener("DOMContentLoaded", function(event) {
  console.log("DOM fully loaded and parsed");
});

for(var i=0; i<1000000000; i++)
{} 


document.onreadystatechange = function () { This event has long been supported by Internet Explorer and can be used as an alternative to the DOMContentLoaded event
    if (document.readyState == "interactive") {
        initApplication();
    }
}


*/


HTMLElement.prototype.fadeOut =function() {/*FADEOUT EFFECT*/

  let diminution  =0.02;
  let speed       =200;
  let elem =this;
  if(!elem.style.opacity)
  {
    elem.style.opacity = 1;
  }
  let fadeEffect =setInterval(function(){

    elem.style.opacity -= diminution;

    if(elem.style.opacity ==0){

      clearInterval(fadeEffect);
      elem.style.opacity = 1;
    }

  }, speed /Math.round(50));
}


function Interval(callback,interval){/*EXECUTE A FUNCTION AFTER A GIVEN TIME*/

  let tours =1;
  let intervalId          = setInterval( function() { 

    callback();/*CALL THE FUNCTION PASSED IN PARAMETER*/

    tours =0;/*CLEAR NUMBER OF TOUR*/

    if(tours ==0 ){/*IF THE TOUR ==0 CLEAR INTERVAL*/

      clear();
    }

  }, interval ? interval : 2000);

  let clear             = function() {

    clearInterval(intervalId);
  };

}


String.prototype.newLines =function(){
  let lines = this.split(/\r|\r\n|\n/);
  let count = lines.length;
  return count;
}

/*DETECT WHEN A USER IS CONNECTED OR NOT */
function getNavigatorConection(){
  return navigator.onLine;
}

/*FUNCTION TO RECALL A ANOTHER FUNCTION AFTER A AMOUNT OF MUNITE*/
function networkOrFail(callFunc,callTime){

  let connected     =getNavigatorConection();
  let callableTimes =callTime < 2000 ? 2000 : callTime;
  let toursBegin    =3;
  let tours         =toursBegin;
  let intervalId;

  let request       = function(){

    intervalId      = setInterval( function() { 

      let connected =getNavigatorConection();

      if(tours > 0){

        if(connected){

          callFunc();
          tours =0;
          return false;
        }
        tours--;
        
      }else{

        clearRequest();
        tours =toursBegin;
      }
        
    }, callableTimes >5000 ? 5000 : callableTimes);

  };

  let clearRequest  = function() {
      clearInterval(intervalId);
      intervalId    = null;
  };

  if(connected){

    callFunc();

  }else{

    request();

  }

}

class dater{

  constructor() {

    this.currentTime  = new Date();

    this.month        = this.currentTime.getMonth() + 1;

    this.day          = this.currentTime.getDate();

    this.year         = this.currentTime.getFullYear();

    this.numDay       = this.currentTime.getDay() 

    this.hour         = this.currentTime.getHours()

    this.millisecond  = this.currentTime.getMilliseconds()

    this.minute       = this.currentTime.getMinutes()       
  
    this.second       = this.currentTime.getSeconds()
    
    this.timestamp    = this.currentTime.getTime() 
  }

}
let date =new dater();

//console.log(date.hour + " " +date.minute);

// Return today's date and time
let $currentTime  = new Date();

// returns the month (from 0 to 11)
let $month        = $currentTime.getMonth() + 1;

// returns the day of the month (from 1 to 31)
let $day          = $currentTime.getDate();

// returns the year (four digits)
let $year         = $currentTime.getFullYear();

// Get the weekday as a number (0-6)
let $numDay       = $currentTime.getDay()+1 

// Get the hour (0-23)          
let $hour         = $currentTime.getHours()+1

// Get the milliseconds (0-999)         
let $millisecond  = $currentTime.getMilliseconds()

// Get the minutes (0-59)  
let $minute       = $currentTime.getMinutes()       
 
// Get the seconds (0-59)      
let $second       = $currentTime.getSeconds()

// Get the time (milliseconds since January 1, 1970)       
let $timestamp    = $currentTime.getTime()          



function Trim(str) {/*Trim*/
    return str.replace(/^\s+|\s+$/gm,'');
}
String.prototype.ucFirst = function() {/*Capitalize first letter of a word*/
  return this.charAt(0).toUpperCase() + this.slice(1);
}
function ucFirst(string){/*Capitalize first letter of a word but faster than the above one*/
    return string && string[0].toUpperCase() + string.slice(1);
}
String.prototype.noSpace =function(haystack){/*REPLACE ALL SPACE CHARACTER*/

  return this.replace(/\s+/g, " ") ?  this.replace(/\s+/g, " ") : this.replace(/ /g, " ");
  //return this.split(needle).join(haystack);
}



/*RANDOM LIBS*/

class AppDefender{

  constructor(){

  }

  Token(srt1,str2,str3,str4){

    let Token =
              String(str4).substring(0,2) 
              +String(srt1).substring(0,1)
              +String(str2).toUpperCase()
              +String(srt1).substring(1,3)
              +String(str3).substring(0,4)
              +String(str3).substring(2,6); 
    return Token.toUpperCase();
  
  }/*END METHOD*/

  TokenShuffle(srt1,str2,str3){

    let Token =String(srt1).substring(0,1)
              +String(str2).toUpperCase()
              +String(srt1).substring(1,3)
              +String(str3).substring(0,4)
              +String(str3).substring(2,6);  
    return Token.toUpperCase().shuffle();
  
  }/*END METHOD*/

}

String.prototype.shuffle = function () {
    var a = this.split(""),
        n = a.length;

    for(var i = n - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var tmp = a[i];
        a[i] = a[j];
        a[j] = tmp;
    }
    return a.join("");
}

function $randomString(length, chars) {
    var mask = "";
    if (chars.indexOf("a") > -1) mask += "abcdefghijklmnopqrstuvwxyz";
    if (chars.indexOf("A") > -1) mask += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if (chars.indexOf("#") > -1) mask += "0123456789";
    if (chars.indexOf("!") > -1) mask += "~`!@#$%^&*()_+-={}[]:\";\"<>?,./|\\";
    var result = "";
    for (var i = length; i > 0; --i) result += mask[Math.floor(Math.random() * mask.length)];
    return result;
}

function $$randomString(length, chars) {

    chars = chars ? chars : "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
    var result = "";
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}

/***/
function randomChar(){
    return String.fromCharCode(randomNum(100));
}
function $$$$randomString(length){
   var str = "";
   for(var i = 0; i < length; ++i){
        str += randomChar();
   }
   return str;
}

/*****/

function randomNum(hi){

    //let hi = hi ? hi : 100000;
    return hi ? Math.floor(Math.random()*hi) : Math.floor(Math.random()*10000);
} 


var RandomString = $$$$randomString(32); //32 length string

//alert(RandomString);
/*END RANDOM LIBS */




/*TAGS INPUT*/
(function() {

  "use strict";

  // Helpers
  function $$taglib(selectors, context) {
    return (typeof selectors === "string") ? (context || document).querySelectorAll(selectors) : [selectors];
  }
  function $taglib(selector, context) {
    return (typeof selector === "string") ? (context || document).querySelector(selector) : selector;
  }
  function create(tag, attr) {
    var element = document.createElement(tag);
    if(attr) {
      for(var name in attr) {
        if(element[name] !== undefined) {
          element[name] = attr[name];
        }
      }
    }
    return element;
  }
  function whichTransitionEnd() {
    var root = document.documentElement;
    var transitions = {
      "transition"       : "transitionend",
      "WebkitTransition" : "webkitTransitionEnd",
      "MozTransition"    : "mozTransitionEnd",
      "OTransition"      : "oTransitionEnd otransitionend"
    };

    for(var t in transitions){
      if(root.style[t] !== undefined){
        return transitions[t];
      }
    }
    return false;
  }
  function oneListener(el, type, fn, capture) {
    capture = capture || false;
    el.addEventListener(type, function handler(e) {
      fn.call(this, e);
      el.removeEventListener(e.type, handler, capture)
    }, capture);
  }
  function hasClass(cls, el) {
    return new RegExp("(^|\\s+)" + cls + "(\\s+|$)").test(el.className);
  }
  function addClass(cls, el) {
    if( ! hasClass(cls, el) )
      return el.className += (el.className === "") ? cls : " " + cls;
  }
  function removeClass(cls, el) {
    el.className = el.className.replace(new RegExp("(^|\\s+)" + cls + "(\\s+|$)"), "");
  }
  function toggleClass(cls, el) {
    ( ! hasClass(cls, el)) ? addClass(cls, el) : removeClass(cls, el);
  }

  function Tags(tag,tagsNameWrapper,inputTagId) {

    var el = $taglib(tag);

    if(el.instance) return;
    el.instance = this;

    var type = el.type;
    var transitionEnd = whichTransitionEnd();

    var tagsArray = [];
    var KEYS = {
      ENTER: 13,
      COMMA: 188,
      BACK: 8
    };
    var isPressed = false;

    var timer;
    var wrap;
    var field;

    function init() {
      
      wrap = create('div', {
        "className"   : tagsNameWrapper ? tagsNameWrapper : "tags-wr",
      });
      field = create("input", {
        "type"        : "text",
        "id"          : inputTagId ? inputTagId : " ",
        "className"   : "tag-enter",
        "placeholder" : el.placeholder || ""
      });

      wrap.appendChild(field);

      if(el.value.trim() !== "") {
        hasTags();
      }

      el.type = "hidden";
      el.parentNode.insertBefore(wrap, el.nextSibling);

      wrap.addEventListener("click", btnRemove, false);
      wrap.addEventListener("keydown", keyHandler, false);
      wrap.addEventListener("keyup", backHandler, false);
    }

    function hasTags() {
      var arr = el.value.trim().split(",");
      arr.forEach(function(item) {
        item = item.trim();
        if(~tagsArray.indexOf(item)) {
          return;
        }
        var tag = createTag(item);
        tagsArray.push(item);
        wrap.insertBefore(tag, field);

      });
    }

    function createTag(name) {
      var tag = create("div", {
        'className': "tag",
        'innerHTML': "<span class=\"tag_mention\">" + name + "</span>"+
                     "<button class=\"tag__remove\">&times;</button>"
      });
      return tag;
    }

    function btnRemove(e) {
      e.preventDefault();
      if(e.target.className === "tag__remove") {
        var tag  = e.target.parentNode;
        var name = $taglib(".tag_mention", tag);
        wrap.removeChild(tag);
        tagsArray.splice(tagsArray.indexOf(name.textContent), 1);
        el.value = tagsArray.join(",")
      }
      field.focus();
    }

    function keyHandler(e) {

      if(e.target.tagName === "INPUT" && e.target.className === "tag-enter") {

        var target = e.target;
        var code = e.which || e.keyCode;

        if(field.previousSibling && code !== KEYS.BACK) {
          removeClass("tag--marked", field.previousSibling);
        }

        var name = target.value.trim().toLowerCase().noSpace().ucFirst();

        // if(code === KEYS.ENTER || code === KEYS.COMMA) {
        if(code === KEYS.ENTER) {

          target.blur();

          addTag(name);

          if(timer) clearTimeout(timer);
          timer = setTimeout(function() { target.focus(); }, 10 );
        }
        else if(code === KEYS.BACK) {
          if(e.target.value === '' && !isPressed) {
            isPressed = true;
            removeTag();
          }
        }
      }
    }
    function backHandler(e) {
      isPressed = false;
    }

    function addTag(name) {

      // delete comma if comma exists
      name = name.toString().replace(/,/g, "").trim();

      if(name === '') return field.value = "";

      if(~tagsArray.indexOf(name)) {

        var exist = $$taglib(".tag", wrap);

        Array.prototype.forEach.call(exist, function(tag) {
          if(tag.firstChild.textContent === name) {

            addClass("tag--exists", tag);

            if(transitionEnd) {
              oneListener(tag, transitionEnd, function() {
                removeClass("tag--exists", tag);
              });
            } else {
              removeClass("tag--exists", tag);
            }


          }

        });

        return field.value = "";
      }

      var tag = createTag(name);
      wrap.insertBefore(tag, field);
      tagsArray.push(name);
      field.value = '';
      el.value += (el.value === "") ? name : "," + name;

      /***********ADD CUSTOM DATA-ATTRIBUTE**********/


      tag.firstChild.setAttribute("data-id",el.dataset.id ? el.dataset.id : "");

      /**********END CUSTOM DATA-ATTRIBUTE***********/
    }

    function removeTag() {
      if(tagsArray.length === 0) return;

      var tags = $$taglib('.tag', wrap);
      var tag = tags[tags.length - 1];

      if( ! hasClass("tag--marked", tag) ) {
        addClass("tag--marked", tag);
        return;
      }

      tagsArray.pop();

      wrap.removeChild(tag);

      el.value = tagsArray.join(",");
    }

    init();

    /* Public API */

    this.getTags = function() {
      return tagsArray;
    }

    this.clearTags = function() {
      if(!el.instance) return;
      tagsArray.length = 0;
      el.value = '';
      wrap.innerHTML = '';
      wrap.appendChild(field);
    }

    this.addTags = function(name) {
      if(!el.instance) return;
      if(Array.isArray(name)) {
        for(var i = 0, len = name.length; i < len; i++) {
          addTag(name[i])
        }
      } else {
        addTag(name);
      }
      return tagsArray;
    }

    this.destroy = function() {
      if(!el.instance) return;

      wrap.removeEventListener("click", btnRemove, false);
      wrap.removeEventListener("keydown", keyHandler, false);
      wrap.removeEventListener("keyup", keyHandler, false);

      wrap.parentNode.removeChild(wrap);

      tagsArray = null;
      timer = null;
      wrap = null;
      field = null;
      transitionEnd = null;

      delete el.instance;
      el.type = type;
    }
  }

  window.Tags = Tags;

})();

/*END TAGS INPUT */



let HighModal ={
      modaliHighest: function(Highestcontent){
        let H =overLayHighest;
        let content =Highestcontent;
        try{

          if(content){
            H.appendChild(content);
            document.body.appendChild(H);
          }else{

          }
          
         
        }catch(e){

        }
      },
      passBody: function(passBodycontent){
        let newContent =passBodycontent;
        HighModal.modaliHighest(newContent);
      }
    }
 

var ul;
var li_items;
var imageNumber;
var imageWidth;
var prev, next;
var currentPostion = 0;
var currentImage = 0;

function slideEventThemes(ul_,nxt_,bck_){

  ul =_(ul_);
  try{
    li_items        = ul.children;
    imageNumber     = li_items.length;
    imageWidth      = li_items[0].children[0].clientWidth;
    ul.style.width  = parseInt(imageWidth * imageNumber) + "px";
    prev =_(bck_);
    next =_(nxt_);
    //.onclike = slide(-1) will be fired when onload;
    /*
    prev.onclick = function(){slide(-1);};
    next.onclick = function(){slide(1);};*/
    prev.onclick = function(){ onClickPrev();};
    next.onclick = function(){ onClickNext();};
  }catch(e){

  }
}
function animate(opts){
  try{
    var start = new Date;
    var id = setInterval(function(){
      var timePassed = new Date - start;
      var progress = timePassed / opts.duration;
      if (progress > 1){
        progress = 1;
      }
      var delta = opts.delta(progress);
      opts.step(delta);
      if (progress == 1){
        clearInterval(id);
        opts.callback();
      }
    }, opts.delay || 17);
    //return id;
  }catch(e){

  }
}
function slideTo(imageToGo){
  try{
    
    var direction;
    var numOfImageToGo = Math.abs(imageToGo - currentImage);
    // slide toward left

    direction = currentImage > imageToGo ? 1 : -1;
    currentPostion = -1 * currentImage * imageWidth;
    var opts = {
      duration:1000,
      delta:function(p){return p;},
      step:function(delta){
        ul.style.left = parseInt(currentPostion + direction * delta * imageWidth * numOfImageToGo) + 'px';
      },
      callback:function(){currentImage = imageToGo;}  
    };
    animate(opts);
  }catch(e){

  }
}

function onClickPrev(){

  try{
    if (currentImage == 0){
      slideTo(imageNumber - 1);
    }     
    else{
      slideTo(currentImage - 1);
    }  
  }catch(e){

  } 
}

function onClickNext(){
 try{
    if (currentImage == imageNumber - 1){
      slideTo(0);
    }   
    else{
      slideTo(currentImage + 1);
    }   
 }catch(e){
  
 }
}

//document.getElementById("session").addEventListener("click",_t_0xt);document.title +=" (1)"//let span="<span id=\"close\">This is html content provided </span>";let para="<p></p>";let wrapperDiv="<div class=\"customM shw\" id=\"customM\">"+span+"</div>";let html=wrapperDiv;new modal(null,null,"p",".",null,null,"noScroll",html,true);new modal("success","Congatulation to you!","btn","#","bounce",null,"noScroll",null,true);_("dinamic").addEventListener("click",function(){modali(html);})

