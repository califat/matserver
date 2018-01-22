<!DOCTYPE html>
<html>
	<head>		
		<title></title>
	</head>
	<body>
		<div class="" style="position: relative;width: 500px;height: 100px;margin: auto;border: 1px solid blue;text-align: center;padding: 10px 0px">
			<form id="form" method="POST" action="api/activate">
				<div id="authenfication">
					<input type="text" id="activationCode" data-stage-number="2" value="" style="position: relative;width: 90%;height: 30px;margin: auto;">
				</div>

				<div id="identification">
					<button id="submit" style="position: relative;padding: 5px 5px;cursor: pointer;margin-top: 20px;">Submit</button>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="nazam.js"></script>
		<script type="text/javascript">

			let submit 			=document.getElementById("submit");
			let form 			=document.getElementById("form");
			let activationCode 	=document.getElementById("activationCode");


			submit.addEventListener("click",function(event){
				event.preventDefault();
				makeRequest();
			})

		    function makeRequest(){
		  		
		      	let uriPost   		=form.getAttribute("action");
		      	let xhrPost   		=GethttpRequest();
		      	let fdPost    		=new FormData();
		      	let Action 			="create_stage";
		      	let Method 			=["POST","PATCH","GET","UPDATE","DELETE"];
		      	let Key 			="@k-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
		      	let Account_sid 	="@s-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
		      	let Account_token 	="@t-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
		      	let date 			=new Date();
				let number 			=date.getTime();
		      	let Bill 			=utf8_to_b64(number);

		      	let Csrf_token 		=utf8_to_b64(utf8_to_b64(utf8_to_b64(utf8_to_b64(Account_sid+Account_token+number+Bill))));

		      let data  = { 
		                    "ACC_SID"            	:Account_sid,
		                    "TOKEN" 				:Account_token,
		                    "PUBLIC_KEY" 			:Key,
		                    "CSRF_TOKEN" 			:Csrf_token,
		                    "BILL"					:Bill,
		                    "METHOD" 				:Method[0],
		                    "ACTION" 				:Action,
		                    "ELAPSE" 				:number,

		                    "require"           	:{

		                    	"stageId" 			:activationCode.getAttribute("data-stage-number"),
		                    	"activationCode" 	:activationCode.value

		                    }
		                 };

		      let JSONdata =JSON.stringify(data);             
		      fdPost.append("data",JSONdata);
		      xhrPost.open("POST" ,uriPost, true);
		      xhrPost.timeout = 3000;
		      xhrPost.onloadstart 	= function (){};
		      xhrPost.onload 		= function (){};
		      xhrPost.onloadend 	= function (){}
		      xhrPost.onprogress 	=function(){}

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
	</body>
</html>
