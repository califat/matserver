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
						<p>Nom et postnom</p>
						<input type="text" name="nama_last_nale" class="middle">
					</label>
					<label>
						<p>Etat civil</p>
						<select class="middle" id="etat_civil" name="civil_status">
							<option selected="true" value="Marie">Marie</option>
							<option value="Celibataire">Celibataire</option>
						</select>
					</label>
<!-- 					<label>
						<p>Date de naissance</p>
						<input type="date" name="" class="middle">
						<p>Date de naissance</p>
						<input type="number" name="" class="middle" value="18">
					</label> -->
					<label>
						<p>Occupation/F</p>
						<input type="text" name="" class="middle">
					</label>
					<label>
						<p>Address</p>
						<input type="text" name="" placeholder="Quartier, ville" class="middle">
					</label>
					<label>
						<p>Tellephone</p>
						<input type="text" name="" class="middle">
					</label>
					<label>
						<p>Group sangun</p>
						<select class="middle">
							<option>A</option>
							<option>B</option>
							<option>C</option>
						</select>
					</label>
					<label>
						<p>Rh</p>
						<select class="middle">
							<option>{unkown value}</option>
							<option>{unkown value}</option>
						</select>
					</label>
					<label>
						<p>Talle en (cm)</p>
						<input type="number" name="" class="middle">
					</label>
					<label>
						<p>Electrophase Hb</p>
						<select class="middle">
							<option>{unkown value}</option>
							<option>{unkown value}</option>
							<option>{unkown value}</option>
						</select>
					</label>
					<label>
						<p>Nom du partenaire</p>
						<input type="text" name="" class="middle">
					</label>
					<label>
						<p>Occupation/H</p>
						<input type="text" name="" class="middle">
					</label>
					<label>
						<p>Contact d'urgence</p>
						<input type="text" name="" class="middle">
						<p>Address</p>
						<input type="text" name="Quartier, ville" class="middle">
						<p>Tellephone</p>
						<input type="text" name="" class="middle">
					</label>
				</section>
				<section class="border-down" style="position: relative;display: block;">
					<label>
						<p>DDR</p>
						<input type="date" name="" class="middle">
					</label>
					<label>
						<p>DPA</p>
						<input type="date" name="" class="middle">
					</label>
					<label>
						<p>Primipare</p>
						<select class="middle">
							<option>19 ans ou moin</option>
							<option>35 ans ou plus</option>
						</select>
					</label>
					<p><strong>ANTECENDENTS</strong></p>
					<div>
						<p><strong>Medicaux</strong></p>
						<label>
							<span>TBC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>HTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>SCA/SS&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>DBT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>CAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>MGF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>RAA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>SYPHYLIS</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>VIH/SIDA</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>VVS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>PEP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
					</div>
					<div>
						<p><strong>Gynecologique  et chirirgucaux</strong></p>
						<label>
							<span>Cesarienne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Cerclage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Fibrome uterien&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Fracture bassin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>GEU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Fistule&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Uterus cicatriciel</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Traitement pour sterilite</span>
							<input type="checkbox" name="">
						</label>
					</div>
					<div>
						<p><strong>Obstetricaux</strong></p>
						<label>
							<span>Parite&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Gestile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Enfants en vie&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Avortements&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Distocie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Eutocie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Plus gros poids de naissance (g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="number" name="">
						</label>
						<label>
							<span>Plus de 4kg(nbr)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="number" name="">
						</label>
						<br>
						<label>
							<span>Premature</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Post-premature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<span>Mort-ne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Mort avavnts 7jours&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<label>
							<span>Dernier acouchement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="date" name="">
						</label>
						<label>
							<span>Intervalle < 2ans&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="checkbox" name="">
						</label>
						<br>
						<label>
							<p>Complication post-parum</p>
							<span>
								NON
								<input type="radio" name="">
							</span>
							<span>
								OUI
								<input type="radio" name="">
							</span>
						</label>
						<label>
							<p>Si oui le quelles:</p>
							<input type="text" name="">
						</label>	
					</div>
				</section>
				<button id="Forward">Next</button>
			</div>
			<div id="cpn">
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
				<button style="position: relative;margin: 10px ;float: left;" id="back">Back</button>
				<button style="position: relative;margin: 10px ;float: right;" id="submit">Submit</button>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="nazam.js"></script>
	<script type="text/javascript" src="app.js"></script>
</body>
</html>