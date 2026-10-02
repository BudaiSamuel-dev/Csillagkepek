<?php 
	require_once 'osztaly/Csillagkep.php';
	use osztaly\Csillagkep;
	
	$csillagkepek = [];

	$mysqli = new mysqli('localhost:3333', 'root', 'pass', 'suli_csillagaszat');
	
	$sql = 'select * from csillagkep';

	$res = $mysqli->query($sql);

	while($row = $res->fetch_assoc()){
		array_push($csillagkepek, new Csillagkep($row['latin_nev'], $row['rovidites'], $row['magyar_nev'], $row['terulet']));
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Csillagképek</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>

        <!-- hero -->
        <header id="hero" class="pb-5">
            <div class="container">
                <div class="pt-5">
                    <h1 id="hero-title" class="pb-5">Csillagképek</h1>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 col-xl-3 text-center">
                        <img src="assets/images/orion.jpg" id="messier_kep" class="img-fluid mb-sm-3"  alt="Csillagképek" title="Csillagképek" />
                    </div>
                    <div class="col-12 col-lg-8 col-xl-9 text-white fs-4 justify">
                        <p>A csillagképek az éjszakai égbolt olyan jól elkülöníthető területei, amelyekben a fényesebb csillagok csoportjai jellegzetes alakzatokat formáznak.</p>
						<p>Az emberiség már évezredek óta vetíti ki saját mitológiai történeteit, isteneit és állatait az égre, hogy így tájékozódjon a csillagtengerben. Napjainkban a Nemzetközi Csillagászati Unió (IAU) hivatalosan 
						<span class="csk-szam"><?php echo count($csillagkepek) ?></span> csillagképet tart számon, amelyek teljesen lefedik a teljes gömbalakú égboltot.</p>
						<p>A csillagképeket alkotó égitestek a valóságban nincsenek fizikai kapcsolatban egymással; csupán a földi nézőpontunk miatt tűnnek úgy, mintha egymás mellett lennének, miközben a tértől és egymástól valójában óriási fényévtávolságok választják el őket. A csillagképek nemcsak gyönyörű látványt nyújtanak, hanem évszázadokon át a tengerészek navigációját és a földművesek naptárát is megbízhatóan szolgálták.</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- content -->
        <section id="lista" class="pb-3">
            <div class="container">
                <h2 class="pt-4 pb-4 section-title text-center">A csillagképek listája</h2>
                <table class="table table-striped">
					<thead>
						<tr>
							<th>Nr.</th>
							<th>Latin név</th>
							<th>Rövidítés</th>
							<th>Magyar név</th>
							<th>Terület (fok<sup>2</sup>)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i = 1;
							foreach($csillagkepek as $csillagkep){
								echo "<tr>
								<th>$i</th>
								<th>". $csillagkep->getLatinNev() ."</th>
								<th>". $csillagkep->getRovidites() ."</th>
								<th>". $csillagkep->getMagyarNev() ."</th>
								<th>". $csillagkep->getTerulet() ."</th>
								</tr>";

								$i++;
							}
						?>							
					</tbody>
				</table>
				
				<div class="pt-4 pb-4 fs-5 text-center">
					<?php 
						$legkisebbCsillagkep = null;
						$legnagyobbCsillagkep = null;
						foreach($csillagkepek as $csillagkep){
							$legkisebbCsillagkep =  $legkisebbCsillagkep == null || $csillagkep->getTerulet() < $legkisebbCsillagkep->getTerulet()  ?  $csillagkep : $legkisebbCsillagkep;
							$legnagyobbCsillagkep =	$legnagyobbCsillagkep == null || $csillagkep->getTerulet() > $legnagyobbCsillagkep->getTerulet() ? $csillagkep : $legnagyobbCsillagkep;
						}

						echo "<p>A legkisebb csillagkép: <span class='fw-bold'>". $legkisebbCsillagkep->getLatinNev() ."</span> (". $legkisebbCsillagkep->getMagyarNev() .") &#10230; ". $legkisebbCsillagkep->getTerulet() ." fok<sup>2</sup><br/>
						A legnagyobb csillagkép: <span class='fw-bold'>". $legnagyobbCsillagkep->getLatinNev() ."</span> (". $legnagyobbCsillagkep->getMagyarNev() .") &#10230; ". $legnagyobbCsillagkep->getTerulet() ." fok<sup>2</sup></p>";
					?>
				</div>
				
				<hr />
								
				<div class="pt-4 pb-4 fs-5">
					<h4>Rövidítések kezdőbetűk szerint:</h4>
					<ul>
						<?php 
							foreach($csillagkepek as $csillagkep){
								$rovidites = $csillagkep->getRovidites();
								$kezdoBetu = substr($rovidites, 0, 1);

								$roviditesek[$kezdoBetu][] = $rovidites;
							}

							foreach($roviditesek as $rovidites){
								echo "<li>". implode('-', $rovidites) ."</li>";
							}

						?>
					</ul>
				</div>
            </div>
        </section>

    </body>
</html>