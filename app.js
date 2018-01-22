'use stric';

let nextButton 		=document.getElementById("Forward");
let registerBlock 	=document.getElementById("identification");
let cpnBlock 		=document.getElementById("cpn");
let BackButton 		=document.getElementById("back");
let submitForm 		=document.getElementById("submit");



try{

	if(nextButton && registerBlock && cpnBlock){
		nextButton.addEventListener("click",function(evt){
			evt.preventDefault();
			//registerBlock.style.cssText ="display: none";
			//cpnBlock.className 			="cpnVisible";
			validate();
		})
	}

}catch(e){
	aert(e)
}

try{

	if(BackButton && registerBlock && cpnBlock){

		BackButton.addEventListener("click",function(evt){

			evt.preventDefault();
			cpnBlock.className 			="cpnHidden";
			registerBlock.style.cssText ="display: inline-block";
		})

	}

}catch(e){
	alert(e);
}

try{
	if(submitForm){
		submitForm.addEventListener("click",function(evt){

			evt.preventDefault();
			alert("form submited");
		})
	}
}catch(e){
	alert()
}




	let clientFullName 		 	=_("clientFullName").value;
	let clientCiviLStatusIndex 	=_("clientCiviLStatus");
	let clientCiviLStatus	 	=clientCiviLStatusIndex.options[clientCiviLStatusIndex.selectedIndex].value;
	let clientAge 				=_("clientAge").value;
	let clientOccupation 		=_("clientOccupation").value;
	let clientAddress 			=_("clientAddress").value;
	let clientPhone 			=_("clientPhone").value;
	clientBloodGroupIndex 		=_("clientBloodGroup");
	let clientBloodGroup 		=clientBloodGroupIndex.options[clientBloodGroupIndex.selectedIndex].value;
	let clientRhIndex 			=_("clientRh");
	let clientRh 				=clientRhIndex.options[clientRhIndex.selectedIndex].value;
	let clientSize 				=_("clientSize").value;
	let clientElectrophaseHb 	=_("clientElectrophaseHb").value;
	let clientPartenerName 		=_("clientPartenerName").value;
	let clientPartenerOccupation=_("clientPartenerOccupation").value;
	let emergencyName 			=_("emergencyName").value;
	let emergencyPhone 			=_("emergencyPhone").value;
	let clientDdrSelectIndex 	=_("clientDdrSelect");
	let clientDdr 				=clientDdrSelectIndex.options[clientDdrSelectIndex.selectedIndex].value;
	//let clientDdr 			=_("clientDdr").value;
	let clientDpa 				=_("clientDpa").value;
	let clientPrimipareIndex 	=_("clientPrimipare");
	let clientPrimipare 		=clientPrimipareIndex.options[clientPrimipareIndex.selectedIndex].value;
	let clientTbc 				=_("clientTbc").checked;
	let clientHta 				=_("clientHta").checked;
	let clientSca_SS 			=_("clientSca_SS").checked;
	let clientDbt 				=_("clientDbt").checked;
	let clientCar 				=_("clientCar").checked;
	let clientMfg 				=_("clientMfg").checked;
	let clientRaa 				=_("clientRaa").checked;
	let clientSyphylis 			=_("clientSyphylis").checked;
	let clientVih_Sida 			=_("clientVih_Sida").checked;
	let clientVvs 				=_("clientVvs").checked;
	let CleintPep 				=_("CleintPep").checked;
	let clientCesarienne 		=_("clientCesarienne").checked;
	let clientCerclage 			=_("clientCerclage").checked;
	let cleintFibromeUterien 	=_("cleintFibromeUterien").checked;
	let clientFractureBassin 	=_("clientFractureBassin").checked;
	let cleintGeu 				=_("cleintGeu").checked;
	let clientFistule 			=_("clientFistule").checked;
	let clientUterusCicatriciel =_("clientUterusCicatriciel").checked;
	let clientTraitementPourSterilite =_("clientTraitementPourSterilite").checked;
	let clientParitee 			=_("clientParitee").checked;
	let clientGestile 			=_("clientGestile").checked;
	let cleintEnfantEnVie 		=_("cleintEnfantEnVie").checked;
	let clientAvortement 		=_("clientAvortement").checked;
	let cleintDistocie 			=_("cleintDistocie").checked;
	let clientEutocie 			=_("clientEutocie").checked;
	let clientGrosPoidNaissance =_("clientGrosPoidNaissance").value;
	let cientPlusDe4kg 			=_("cientPlusDe4kg").value;
	let clientPremature 		=_("clientPremature").checked;
	let clientPostMature 		=_("clientPostMature").checked;
	let clientMortNe 			=_("clientMortNe").checked;
	let clientMortAvant7Jrs 	=_("clientMortAvant7Jrs").checked;
	let clientDernierAcouchementDate =_("clientDernierAcouchementDate").value;
	let clientIntervalMoin2ans 	=_("clientIntervalMoin2ans").checked;
	let complicationPostParumOui=_("complicationPostParumOui").checked;
	//complicationPostParumNon
	let clientComplicationPostParumDescription =_("clientComplicationPostParumDescription").value;




	function validate(){

		if(clientFullName =="" || clientCiviLStatus =="" || clientAge=="" 
			|| clientBloodGroup =="" || clientSize =="" || clientGrosPoidNaissance ==""){

			alert("Veuillez complter tout les les valuer requise");

		}else{

			makeRequest();
		}

	}


	let submit 			=document.getElementById("submit");
	let form 			=document.getElementById("form");
	let activationCode 	=document.getElementById("activationCode");


	submit.addEventListener("click",function(event){
		event.preventDefault();
		validate();
	})

    function makeRequest(){

      	let uriPost   		=_("formClient").getAttribute("action");
      	let xhrPost   		=GethttpRequest();
      	let fdPost    		=new FormData();
      	let Action 			="create_client";
      	let Method 			=["POST","PATCH","GET","UPDATE","DELETE"];
      	let Key 			="@k-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
      	let Account_sid 	="@s-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
      	let Account_token 	="@t-bWF0NEtMQUItTWF0aWJhYnVBbGVydDIwMTc=";
      	let date 			=new Date();
		let number 			=date.getTime();
		//RR1-2008-1936
      	let Bill 			=utf8_to_b64("RR1-2008-1796:2:857569D2F00027E26170A067CC039AF6");

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

                    	name 						:clientFullName,
                    	civilStatus 				:clientCiviLStatus,
                    	age 						:clientAge,
                    	clientOccupation 			:clientOccupation,
                    	clientAddress 				:clientAddress,
                    	clientPhone 				:clientPhone,
                    	bloodGroup 					:clientBloodGroup,
                    	RH 							:clientRh,
                    	size 						:clientSize,
                    	electrophaseHB 				:clientElectrophaseHb,
                    	partenerName 				:clientPartenerName,
                    	partenerOccupation 			:clientPartenerOccupation,
                    	emergencyName 				:emergencyName,
                    	emergencyPhone 				:emergencyPhone,
                    	DDR 						:clientDdr,
                    	DPA 						:clientDpa,
                    	primipare 					:clientPrimipare,
                    	TBC 						:clientTbc,
                    	HTA 						:clientHta,
                    	SCA_SS 						:clientSca_SS,
                    	DBT 						:clientDbt,
                    	CAR 						:clientCar,
                    	MFG 						:clientMfg,
                    	RAA 						:clientRaa,
                    	Syphylis 					:clientSyphylis,
                    	VIH_SIDA 					:clientVih_Sida,
                    	VVS 						:clientVvs,
                    	PEP 						:CleintPep,
                    	Cesarienne 					:clientCesarienne,
                    	Cerclage 					:clientCerclage,
                    	FubromeUterien 				:cleintFibromeUterien,
                    	FractureBassin 				:clientFractureBassin,
                    	GEU 						:cleintGeu,
                    	Fistule 					:clientFistule,
                    	UterusCicatriciel 			:clientUterusCicatriciel,
                    	TraitementSterilite 		:clientTraitementPourSterilite,
                    	Paritee 					:clientParitee,
                    	Gestile 					:clientGestile,
                    	EnfantEnvie 				:cleintEnfantEnVie,
                    	Avortement 					:clientAvortement,
                    	Distocie 					:cleintDistocie,
                    	Eutocie 					:clientEutocie,
                    	GrosPoidNaissance 			:clientGrosPoidNaissance,
                    	PlusDe4kg 					:cientPlusDe4kg,
                    	Premature 					:clientPremature,
                    	PostMature 					:clientPostMature,
                    	MortNe 						:clientMortNe,
                    	MortAvant7Jrs 				:clientMortAvant7Jrs,
                    	DernierAcouchementDate 		:clientDernierAcouchementDate,
                    	IntervalMoin2ans 			:clientIntervalMoin2ans,
                    	complicationPostParumOui	:complicationPostParumOui,
                    	ComplicationPostParumDesc 	:clientComplicationPostParumDescription
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