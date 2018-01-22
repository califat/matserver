<!DOCTYPE html>
<html>
<head>		
	<title></title>
	<style type="text/css">
		.mainDiv{position: relative;margin: auto;width: 50%;border: 1px solid red;min-height: 100px;max-height: 600px;padding: 10px 10px;overflow-y: scroll;}
		.full{position: relative;display: inline-block;width: 100%}
		.middle{position: relative;display: inline-block;width: 40%}
		.border-down{position: relative;display: block;margin-bottom: 5px}
		.cpnHidden{position: relative;display: none;}
		.cpnVisible{position: relative;display: inline-block;}
	</style>
</head>
<body>
	<div class="mainDiv">
		<form id="formClient" action="api/client">
			<div id="identification">
				<section class="border-down">
					<label>
						<p>Nom et postnom</p>
						<input type="text" name="" id="clientFullName" class="middle" value="Kavira Maisara">
					</label>
					<label>
						<p>Etat civil</p>
						<select class="middle" id="clientCiviLStatus" name="civil_status">
							<option value="Mariee" selected="">mariee</option>
							<option value="celibataire">Celibataire</option>
						</select>
					</label>
					<label>
						<p>Date de naissance</p>
						<input type="date" id="clientAge" class="middle" value="<?= strftime("%Y-%m-%d")?>">
					</label> 
					<label>
						<p>Occupation/F</p>
						<input type="text" value="comercante" id="clientOccupation" class="middle">
					</label>
					<label>
						<p>Address</p>
						<input type="text" name="" value="Q himbi, Av du lac 12" id="clientAddress">
					</label>
					<label>
						<p>Tellephone</p>
						<input type="text" name="" id="clientPhone" value="+243979688045" class="middle">
					</label>
					<label>
						<p>Group sangain</p>
						<select class="middle" id="clientBloodGroup">
							<option value="A">A</option>
							<option selected="" value="B">B</option>
							<option value="C">C</option>
						</select>
					</label>
					<label>
						<p>Rh</p>
						<select class="middle" id="clientRh">
							<option>{unkown value}</option>
							<option>{unkown value}</option>
						</select>
					</label>
					<label>
						<p>Talle en (cm)</p>
						<input type="number" name="" id="clientSize" value="80" class="middle">
					</label>
					<label>
						<p>Electrophase Hb</p>
						<select class="middle" id="clientElectrophaseHb">
							<option>{unkown value}</option>
							<option>{unkown value}</option>
							<option>{unkown value}</option>
						</select>
					</label>
					<label>
						<p>Nom du partenaire</p>
						<input type="text" name="" class="middle" id="clientPartenerName">
					</label>
					<label>
						<p>Occupation/H</p>
						<input type="text" name="" class="middle" id="clientPartenerOccupation">
					</label>
					<label>
						<p>Contact d'urgence Nom:</p>
						<input type="text" name="Quartier, ville" class="middle" id="emergencyName">
						<p>Contact d'urgence Tellephone:</p>
						<input type="text" name="" class="middle" id="emergencyPhone" value="+243979688045">
					</label>
				</section>
				<section class="border-down" style="position: relative;display: block;">
					<label>
						<p>DDR</p>
						<!-- <input type="date" class="middle" id="clientDdr" data-signification="date dernier de rendez vous" value="<?=strftime("%Y-%m-%d")?>"> -->
						<select id="clientDdrSelect">
							<option value="1w">1 semaine</option>
							<option value="2w">2 semaine</option>
							<option value="3w">3 semaine</option>
							<option value="1m">1 mois</option>
							<option value="1m_1w">1 mois et 1 sem</option>
							<option value="1m_2w">1 mois et 2 sem</option>
							<option value="1m_3w">1 mois et 3 sem</option>
							<option value="2m">2 mois</option>
						</select>
					</label>
					<label>
						<p>DPA</p>
						<input type="date" class="middle" id="clientDpa" data-signification="date probalble d'accouchement" value="<?=strftime("%Y-%m-%d")?>">
					</label>
					<label>
						<p>Primipare</p>
						<select class="middle" id="clientPrimipare">
							<option value="19">19 ans ou moin</option>
							<option value="35">35 ans ou plus</option>
						</select>
					</label>
					<p><strong>ANTECENDENTS</strong></p>
					<div>
						<p><strong>Medicaux</strong></p>
						<label>
							<span>TBC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientTbc">
						</label>
						<label>
							<span>HTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientHta">
						</label>
						<br>
						<label>
							<span>SCA/SS&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientSca_SS">
						</label>
						<label>
							<span>DBT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientDbt">
						</label>
						<br>
						<label>
							<span>CAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientCar">
						</label>
						<label>
							<span>MGF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientMfg">
						</label>
						<br>
						<label>
							<span>RAA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientRaa">
						</label>
						<label>
							<span>SYPHYLIS</span>
							<input type="checkbox" name="" id="clientSyphylis">
						</label>
						<br>
						<label>
							<span>VIH/SIDA</span>
							<input type="checkbox" name="" id="clientVih_Sida">
						</label>
						<label>
							<span>VVS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientVvs">
						</label>
						<br>
						<label>
							<span>PEP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="CleintPep">
						</label>
					</div>
					<div>
						<p><strong>Gynecologique  et chirirgucaux</strong></p>
						<label>
							<span>Cesarienne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientCesarienne">
						</label>
						<label>
							<span>Cerclage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientCerclage">
						</label>
						<br>
						<label>
							<span>Fibrome uterien&nbsp;</span>
							<input type="checkbox" name="" id="cleintFibromeUterien">
						</label>
						<label>
							<span>Fracture bassin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientFractureBassin">
						</label>
						<br>
						<label>
							<span>GEU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="cleintGeu">
						</label>
						<label>
							<span>Fistule&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientFistule">
						</label>
						<br>
						<label>
							<span>Uterus cicatriciel</span>
							<input type="checkbox" name="" id="clientUterusCicatriciel">
						</label>
						<label>
							<span>Traitement pour sterilite</span>
							<input type="checkbox" name="" id="clientTraitementPourSterilite">
						</label>
					</div>
					<div>
						<p><strong>Obstetricaux</strong></p>
						<label>
							<span>Parite&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientParitee">
						</label>
						<label>
							<span>Gestile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientGestile">
						</label>
						<br>
						<label>
							<span>Enfants en vie&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="cleintEnfantEnVie">
						</label>
						<label>
							<span>Avortements&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientAvortement">
						</label>
						<br>
						<label>
							<span>Distocie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="cleintDistocie">
						</label>
						<label>
							<span>Eutocie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientEutocie">
						</label>
						<br>
						<label>
							<span>Plus gros poids de naissance (g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
							<input type="number" id="clientGrosPoidNaissance" value="300">
						</label><br>
						<label>
							<span>Plus de 4kg(nbr)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
							<input type="number" id="cientPlusDe4kg" value="300">
						</label>
						<br>
						<label>
							<span>Premature</span>
							<input type="checkbox" name="" id="clientPremature">
						</label>
						<label>
							<span>Post-premature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientPostMature">
						</label>
						<br>
						<label>
							<span>Mort-ne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientMortNe">
						</label><br>
						<label>
							<span>Mort avavnts 7jours&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientMortAvant7Jrs">
						</label><br>
						<label>
							<span>Dernier acouchement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="text" id="clientDernierAcouchementDate" value="<?= strftime("%Y")?>">
						</label><br>
						<label>
							<span>Intervalle < 2ans&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="" id="clientIntervalMoin2ans">
						</label>
						<br>
						<div class="card">
							<p>Complication post-parum</p>
							<label class="radio">
							  	<input id="complicationPostParumOui" type="radio" name="radios">
							  	OUI
							</label> <br>
							<label class="complicationPostParumNon">
							  	<input id="radio2" type="radio" name="radios">
							  	NON
							</label>
						</div>
						<label>
							<p>Si oui le quelles:</p>
							<input type="text" name="" id="clientComplicationPostParumDescription" value="complications">
						</label>	
					</div>
				</section>
				<button id="Forward" style="position: relative;padding: 5px 10px;cursor: pointer;">Next</button>
			</div>
		</form>	
		<form>
			<div id="cpn" class="cpnHidden">
				<label>
					<p>Date de la visite</p>
					<input type="date" name="" value="<?= strftime("%Y-%m-%d")?>">
				</label>
				<label>
					<p>Plainte d'evaluation rapide</p>
					<input type="text" name="">
				</label>
				<label>
					<p>Despitage des complications / problem</p>
					<input type="text" name="">
				</label>
				<div>
					<p><strong>Malnutrition</strong></p>
					<label>
						<p>Peau seche, hyper plissee</p>
						<input type="text" name="">
					</label>
					<label>
						<p>Etat general</p>
						<select>
							<option>Bon</option>
							<option>Mauvais</option>
						</select>
					</label>
					<label>
						<p>Poids</p>
						<input type="number" name="">
					</label>
					<label>
						<p>PB</p>
						<input type="number" name="">
					</label>
					<label>
						<p>Presence de cecte nocturne</p>
						<select>
							<option>NON</option>
							<option>OUI</option>
						</select>
					</label>
					<label>
						<p>Presence d'un goitre</p>
						<select>
							<option>NOM</option>
							<option>OUI</option>
						</select>
					</label>
				</div>
				<div>
					<p><strong>Infection</strong></p>
					<label>
						<p>plainte de fievre </p>
						<select>
							<option>NON</option>
							<option>OUI</option>
						</select>
					</label>
					<label>
						<p>Temperature (valeur)</p>
						<input type="number" name="">
					</label>
					<label>
						<p>Dyuire</p>
						<select>
							<option>NON</option>
							<option>OUI</option>
						</select>
					</label>
					<label>
						<p>Perte liquidienne anormale</p>
						<select>
							<option>NON</option>
							<option>OUI</option>
						</select>
					</label>
				</div>
				<div>
					<p><strong>Pre-eclamsie</strong></p>
					<label>
						<p>TA (mm hG)</p>
						<input type="number" name="">
					</label>
					<label>
						<p>Proteinurie</p>
						<select>
							<option>+</option>
							<option>-</option>
						</select>
					</label>
					<label>
						<p>Oedemes</p>
						<select>
							<option>+</option>
							<option>-</option>
						</select>
					</label>
				</div>
				<div>
					<p><strong>Anemie</strong></p>
					<label>
						<p>Coloration conjoctivale /palmaire</p>
						<select>
							<option>OUI</option>
							<option>NON</option>
						</select>
					</label>
					<label>
						<p>Pouls (valeur)</p>
						<input type="number" name="">
					</label>
				</div>
				<div>
					<p><strong>Seins</strong></p>
					<label>
						<p>Etat du sein (normal)</p>
						<select>
							<option>OUI</option>
							<option>NON</option>
						</select>
					</label>
					<label>
						<p>Presence d'une masse</p>
						<select>
							<option>OUI</option>
							<option>NON</option>
						</select>
					</label>
				</div>
				<div>
					<p><strong>Eat du foeutus</strong></p>
					<label>
						<p>Age de la grossesse</p>
						<input type="date" name="">
					</label>
					<label>
						<p>Mouvement du foetus</p>
						<input type="text" name="">
					</label>
					<label>
						<p>Hauteur uterien (cm)</p>
						<input type="number" name="">
					</label>
					<label>
						<p>Battements du coeur foetal</p>
						<select>
							<option>Present</option>
							<option>Absent</option>
						</select>
					</label>
					<label>
						<p>Presentation du foetus</p>
						<input type="text" name="">
					</label>
				</div>
				<div>
					<p><strong>Risque chirurgical</strong></p>
					<label>
						<p>Presentation transversale du foetus a partir de 36em semaine</p>
						<input type="checkbox" name="">
					</label>
					<label>
						<p>Eclampsie</p>
						<input type="checkbox" name="">
					</label>
				</div>
				<div>
					<p><strong>IST</strong></p>
					<label>
						<p>Signes /symptomes: ecoulement, pourit, ucleration</p>
						<input type="checkbox" name="">
					</label>
					<label>
						<p>Etat du coll</p>
						<input type="text" name="">
					</label>
				</div>
				<div>
					<p><strong>Conduite a tenir</strong></p>
					<label>
						<input type="text" name="">
					</label>
				</div>
				<button style="position: relative;margin: 10px ;float: left;padding: 5px 10px;cursor: pointer;" id="back">Back</button>
				<button style="position: relative;margin: 10px ;float: right;padding: 5px 10px;cursor: pointer;" id="submit">Submit</button>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="nazam.js"></script>
	<script type="text/javascript" src="app.js"></script>
</body>
</html>