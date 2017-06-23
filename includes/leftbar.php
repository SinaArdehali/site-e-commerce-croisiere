<!-- <div class="col-md-3">Left side bar,c'est la barre de recherche</div> -->
<!-- <?php header("Content-Type: text/html; charset=UTF-8");?> -->
<?php
$sql = "select * from croisiere";
$query = $db ->query($sql);

?>


<div class="col-md-3 couleurFond">

<!-- 		<div class="row"> -->
			<h2 class="text-center"><font color="#696969">Recherche</font></h2>
			<!-- <form action="index.php" method="POST"> -->
			<div class="ArrangeMarge">
				<h4 class="alignerAGauche"><font color="black" size="3" face="Playfair Display">Sélectionnner directement la croisière desiré:</font></h4>

				<select name="nomCrois" id="nomCrois" class="form-control div-inline"  style="width: 200px;">
										<option value=""></option>
										<?php while ($parent = mysqli_fetch_assoc($query)) :?>
											
										
										<option value="<?php echo $parent['nomCroisiere'];?>"><?php echo $parent['nomCroisiere'];?></option>
										<?php endwhile; ?>
				</select>

				<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1" onclick="rechercheOption()">Selectionner</button>

			</div>
			<!-- </form> -->


			<div class="ArrangeMarge"  >
				<h4 class="alignerAGauche"><font color="black" size="3" face="Playfair Display">Rechercher une croisière en tapant: <br>-une destination,<br>-le nom d'une des escales, <br>-ou le nom de la croisiere</font></h4>
				<input type="text" class="form-control div-inline" id="rech" name="rech" style="width: 200px;">

				<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1" onclick="rechercheTermes()">Rechercher</button>
			</div>

			


			<div class="ArrangeMarge">
			  
			  	<h4 class="alignerAGauche"><font color="black" size="3" face="Playfair Display">Rechercher une croisiere en entrant:<br>-soit une date,<br>-soit une fourchette de date</font></h4>
			    <div class="form-group row">
<!-- 			    jai enleve la class tab-box -->
			      <div class="col-md-12">
			        <div class="btn-group" role="group" aria-label="Specific date or date range search buttons">
			          <button type="button" id="search-specific" class="btn btn-default active">Date</button>
			          <button type="button" id="search-range" class="btn btn-default">Fourchette de date</button>
			        </div>
			      </div>
			    </div>   
			  
			    <div class="date-query-box form-group">			     
			        <div class="col-md-12 div-inline">			        
			        	<input id="dateDebut" type="date">
			        	 <!-- <select id="range_start_date" name="range_start_date" class="input-sm form-control" style="width: 125px;">
			                <option value="volvo"><font color="black" size="3" face="Playfair Display">Entrez la date</font></option>
			                <option value="saab">1</option>
			                <option value="saab">2</option>
			                <option value="saab">3</option>
			                <option value="saab">4</option>
			                <option value="saab">5</option>
			                <option value="saab">6</option>
			                <option value="saab">7</option>
			                <option value="saab">8</option>
			                <option value="saab">9</option>
			                <option value="saab">10</option>
			                <option value="saab">11</option>
			                <option value="saab">12</option>
			                <option value="saab">13</option>
			                <option value="saab">14</option>
			                <option value="saab">15</option>
			                <option value="saab">16</option>
			                <option value="saab">17</option>
			                <option value="saab">18</option>
			                <option value="saab">19</option>
			                <option value="saab">20</option>
			                <option value="saab">21</option>
			                <option value="saab">22</option>
			                <option value="saab">23</option>
			                <option value="saab">24</option>
			                <option value="saab">25</option>
			                <option value="saab">26</option>
			                <option value="saab">27</option>
			                <option value="saab">28</option>
			                <option value="saab">29</option>
			                <option value="saab">30</option>
			                <option value="saab">31</option>			                
			            </select>
						<br>
			          	<select id="range_start_month" name="range_start_month" class="input-sm form-control" style="width: 125px;">
			                <option value="volvo"><font color="black" size="3" face="Playfair Display">Entrez le MOIS</font></option>
			                <option value="saab">Janvier</option>
			                <option value="opel">Fevrier</option>
			                <option value="audi">Mars</option>
			                <option value="audi">Avril</option>
			                <option value="audi">Mai</option>
			                <option value="audi">Juin</option>
			                <option value="audi">Juillet</option>
			                <option value="audi">Aout</option>
			                <option value="audi">Septembre</option>
			                <option value="audi">Octobre</option>
			                <option value="audi">Novembre</option>
			                <option value="audi">Decembre</option>
			            </select>
						<br>
			          	<input id="range_start_year" type="text" placeholder="YYYY" class="input-sm form-control" style="width: 125px">
						 -->
						<br>		
			          <span id="dash" class="form-control-static hidden"><font color="black" size="3" face="Playfair Display">jusqu'au:<br></font>
			          <input id="dateFin" type="date" style="font-size: 1em" style="width:1em;height:1em;"></span>
					
						<br>

				          <!-- <select id="range_end_date" name="range_end_date" class="input-sm hidden form-control" style="width: 125px;">
				                <option value="volvo"><font color="	" size="3" face="Playfair Display">Entrer la DATE</font></option>
				                <option value="saab">1</option>
				                <option value="saab">2</option>
				                <option value="saab">3</option>
				                <option value="saab">4</option>
				                <option value="saab">5</option>
				                <option value="saab">6</option>
				                <option value="saab">7</option>
				                <option value="saab">8</option>
				                <option value="saab">9</option>
				                <option value="saab">10</option>
				                <option value="saab">11</option>
				                <option value="saab">12</option>
				                <option value="saab">13</option>
				                <option value="saab">14</option>
				                <option value="saab">15</option>
				                <option value="saab">16</option>
				                <option value="saab">17</option>
				                <option value="saab">18</option>
				                <option value="saab">19</option>
				                <option value="saab">20</option>
				                <option value="saab">21</option>
				                <option value="saab">22</option>
				                <option value="saab">23</option>
				                <option value="saab">24</option>
				                <option value="saab">25</option>
				                <option value="saab">26</option>
				                <option value="saab">27</option>
				                <option value="saab">28</option>
				                <option value="saab">29</option>
				                <option value="saab">30</option>
				                <option value="saab">31</option>
				            </select>
								<br>
				
				             <select id="range_end_month" name="range_end_month" class="input-sm hidden form-control"  style="width: 125px;">
				                <option value="volvo"><font color="black" size="3" face="Playfair Display">Entrer le MOIS</font></option>
				                <option value="saab">Janvier</option>
				                <option value="opel">Fevrier</option>
				                <option value="audi">Mars</option>
				                <option value="audi">Avril</option>
				                <option value="audi">Mai</option>
				                <option value="audi">Juin</option>
				                <option value="audi">Juillet</option>
				                <option value="audi">Aout</option>
				                <option value="audi">Septembre</option>
				                <option value="audi">Octobre</option>
				                <option value="audi">Novembre</option>
				                <option value="audi">Decembre</option>
				            </select>
								<br>							
			          		<input id="range_end_year" type="text" placeholder="YYYY" class="input-sm hidden form-control" style="width: 125px"> -->
			          	<br>
			        	<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1" onclick="rechercheParDate()">Rechercher</button>
			          <br>
			          <br>
			        </div>
			      </div>
			   </form>
			</div>




<script type="text/javascript">
	$( document ).ready(function() {


$(document).on("click", 'button#search-specific, button#search-range', function(event){

if (this.id == 'search-range') {
//alert("clicked search-range");
$("span#dash").removeClass("hidden");  $("select#range_end_month").removeClass("hidden");
$("select#range_end_date").removeClass("hidden");
$("input#range_end_year").removeClass("hidden");
$('button#search-specific').removeClass("active");
$('button#search-range').addClass("active");
    } else {
//alert("clicked search-specific");
$("span#dash").addClass("hidden");
$("select#range_end_month").addClass("hidden");
$("select#range_end_date").addClass("hidden");
$("input#range_end_year").addClass("hidden");
$('button#search-specific').addClass("active");
$('button#search-range').removeClass("active");
    }
  
   });

});






</script>











		<!-- </div>
 -->
</div>


