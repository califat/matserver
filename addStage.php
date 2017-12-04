<!DOCTYPE html>
<html>
<head>		
	<title></title>
	<style type="text/css">
		.mainDiv{position: relative;margin: auto;width: 50%;border: 1px solid red;min-height: 100px;max-height: 600px;padding: 10px 10px;overflow-y: scroll;}
		.full{position: relative;display: inline-block;width: 100%}
		.middle{position: relative;display: inline-block;width: 40%}
		.border-down{position: relative;display: block;margin-bottom: 5px}
		#cpn{display: none;}
	</style>
</head>
<body>
	<div class="mainDiv">
		<form>
			<div id="authenfication">
				<input type="hidden" name="province" value="A">
				<input type="hidden" name="numero" value="123456789">
				<input type="hidden" name="district_san" value="afia himbi">
				<input type="hidden" name="date" value="<?= strftime("%Y-%m-%d")?>">
				<input type="hidden" name="zone_sanitaire" value="carmel">
				<input type="hidden" name="form_sanitaire" value="centre de sante">
			</div>
			<div id="identification">
				<section class="border-down">
					<label>
						<p>Nom de la structure</p>
						<input type="text" id="satgeName" name="satgeName" class="middle">
					</label>
					<label>
						<p>Identification</p>
						<input type="text" id="stageId" name="stageId" class="middle">
					</label>
					<label>
						<p>Province</p>
						<select id="stageProvince">
							<option value="A">Bas-uele</option>
							<option value="B">Equateur</option>
							<option value="C">Haut-katanga</option>
							<option value="D">Haut-lomami</option>
							<option value="E">Haut-uele</option>
							<option value="F">Ituri</option>
							<option value="G">Kassai</option>
							<option value="H">Kassai occidental</option>
							<option value="I">Kassai oriental</option>
							<option value="J">Kwango central</option>
							<option value="K">Kwamgo</option>
							<option value="L">Kwilu</option>
							<option value="M">Lomami</option>
							<option value="N">Lualaba</option>
							<option value="O">Maindombe</option>
							<option value="P">Maniema</option>
							<option value="Q">Mongala</option>
							<option value="R">Nork-kivu</option>
							<option value="S">Nord-ubangi</option>
							<option value="T">Sankuru</option>
							<option value="U">Sud-kivu</option>
							<option value="V">Sud-ubangi</option>
							<option value="W">Tanganyika</option>
							<option value="X">Tshopo</option>
							<option value="Y">Tshuapa</option>
							<option value="Z">Kinshasa</option>

						</select>
					</label>
					<label>
						<p>Zone de sante</p>
						<select id="stageProvince">
							<option value="A">Bas-uele</option>
							<option value="B">Equateur</option>
							<option value="C">Haut-katanga</option>
						</select>
					</label>

					<label>
						<p>Niveau de la structure</p>
						<input type="text" id="stageLevel" name="" placeholder="Hopital, centre Hospitalier, zone de sante, cente de sante" class="full">
					</label>	
				</section>
				<button id="submit">Submit</button>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="nazam.js"></script>
	<script type="text/javascript">
		let submit 			=document.getElementById("submit");
		let satgeName 		=document.getElementById("satgeName");
		let stageId 		=document.getElementById("stageId");
		let stageProvince 	=document.getElementById("stageProvince");
		let stageLevel 		=document.getElementById("stageLevel");

		(function(){
			"use strict";
			try{
				if(submit){
					submit.addEventListener("click", function(event){

						event.preventDefault();
						
						try{
							if(satgeName && stageId && stageProvince && stageLevel){
		

								let Name =satgeName.value, Id =stageId.value, Province =stageProvince.options[stageProvince.selectedIndex].value, Level =stageLevel.value;
								
								if(Name =="" || stageId =="" || Province == "" || Level == ""){

									alert("completer tout les champs SVP!");

								}else{
									
									makeRequest(Name,Id,Province,Level);

								}

							}
						}catch(e){
							console.log(e);
						}

					})
				}
			}catch(e){
				console.log(e);
			}
		})();
	    function makeRequest(Name,Id,Province,Level){
	  
	      let uriPost   	="run";
	      let xhrPost   	=GethttpRequest();
	      let fdPost    	=new FormData();
	      let Action 		="create_stage";
	      let Method 		=["PUT","PATCH","GET","UPDATE","DELETE"];
	      let Key 			="@k-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";//DEFAULT VALUE FOR REGISTRATION
	      let Account_sid 	="@s-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";//DEFAULT VALUE FOR REGISTRATION
	      let Account_token ="@t-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";//DEFAULT VALUE FOR REGISTRATION
	      let Bill 			=utf8_to_b64(Name+Id+Province+Level);

	      let Csr_token 	="@-"+utf8_to_b64(utf8_to_b64(utf8_to_b64(utf8_to_b64(Name+Id+Province+Level))));

	      let data  = { 
	                    "ACC_SID"            	:Account_sid,
	                    "TOKEN" 				:Account_token,
	                    "PUBLIC_KEY" 			:Key,
	                    "CSRF_TOKEN" 			:Csr_token,
	                    "BILL"					:Bill,
	                    "METHOD" 				:Method[0],
	                    "ACTION" 				:Action,

	                    "require"           	:{
	                        "name"        		:Name,
	                        "id"        		:Id,
	                        "province"    		:Province,
	                        "level"        		:Level,
	                    },
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

	    }/*END MAKE REQUEST*/


		function utf8_to_b64( str ) {
		  return window.btoa(unescape(encodeURIComponent( str )));
		}

		function b64_to_utf8( str ) {
		  return decodeURIComponent(escape(window.atob( str )));
		}

	</script>
</body>
</html>
