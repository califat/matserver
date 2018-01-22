<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div style="position: relative;width: 300px;margin: 100px auto;border: 1px solid #000;text-align: center;padding: 20px">
    <form method="POST" action="api/disconnect">
      <input type="submit" name="" value="Disconect device" id="submit" style="cursor: pointer;padding: 5px 5px">
    </form>
  </div>
</body>
</html>
<script type="text/javascript" src="nazam.js"></script>
<script type="text/javascript">
  
  let submit  =_("submit");
  let form  =document.querySelector("form");

  try{

    if(submit){

      submit.addEventListener("click",function(event){
        
        event.preventDefault();
        makeRequest();

      })

    }

  }catch(e){}

    function makeRequest(){

        let uriPost       =form.action;
        let xhrPost       =GethttpRequest();
        let fdPost        =new FormData();
        let Action        ="disconnect_device";
        let Method        =["POST","PATCH","GET","UPDATE","DELETE"];
        let Key           ="@k-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
        let Account_sid   ="@s-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
        let Account_token ="@t-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
        let date          =new Date();
        let number        =date.getTime();
        let Bill          =utf8_to_b64("RR1-2008-1796:1:C9E678B60F54FC1D5E704F9D65E3011C");

        let Csrf_token    =utf8_to_b64(utf8_to_b64(utf8_to_b64(utf8_to_b64(Account_sid+Account_token+number+Bill))));

        let data  = { 
                    "ACC_SID"       :Account_sid,
                    "TOKEN"         :Account_token,
                    "PUBLIC_KEY"    :Key,
                    "CSRF_TOKEN"    :Csrf_token,
                    "BILL"          :Bill,
                    "METHOD"        :Method[0],
                    "ACTION"        :Action,
                    "ELAPSE"        :number,

                    "require"         :{

                    }
                 };

        let JSONdata =JSON.stringify(data);             
        fdPost.append("data",JSONdata);
        xhrPost.open("POST" ,uriPost, true);
        xhrPost.timeout = 3000;
        xhrPost.onloadstart   = function (){};
        xhrPost.onload    = function (){};
        xhrPost.onloadend   = function (){}
      xhrPost.onprogress  =function(){}

        xhrPost.onreadystatechange =function(){

          if(xhrPost.readyState < 4){

          }else if(xhrPost.readyState === 4){

            if(xhrPost.status === 200){

            }else if(xhrPost.status !==200){

            }

          }


       }
        xhrPost.ontimeout = function (e){}
        xhrPost.onerror = function (){};
        xhrPost.onabort = function (){};
        xhrPost.overrideMimeType("text/plain; charset=x-user-defined-binary");
        xhrPost.setRequestHeader("Content-disposition", "form-data");
        xhrPost.setRequestHeader("X-Requested-With","xmlhttprequest");
        xhrPost.send(fdPost);
    }
  function utf8_to_b64( str ) {
    return window.btoa(unescape(encodeURIComponent( str )));
  }

  function b64_to_utf8( str ) {
    return decodeURIComponent(escape(window.atob( str )));
  }
</script>