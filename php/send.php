<div class="quart" id="sendDiv">

    <div id="dateArea">
	<h2>Date</h2>
	<p>Format : année-mois-jour</p>
	<p>Vide : date actuelle.</p>
	<input id="date" type="text" placeholder="16-05-05"></input>
    </div>
    
    <div id="timeArea">
	<h2>Heure</h2>
	<p>Format : heures-minutes-secondes</p>
	<p>Vide : heure actuelle.</p>
	<input id="time" type="text" placeholder="22-55-36"></input>
    </div>
    
    <div id="authorArea">
	<h2>Auteur(s)</h2>
	<p>Sélectionner les auteur(s).</p>
	<?php
	foreach ($authorArr as $author) {
	    echo "<input value=\"$author\" name=\"author\" type=\"checkbox\">$author</input>";
	}

	?>
    </div>
    
    <div id="categoryArea">
	<h2>Categorie(s)</h2>
	<p>Sélectionner les catégorie(s).</p>
	<?php
	foreach ($categoryArr as $category) {
	    echo "<input value=\"$category\" name=\"category\" type=\"checkbox\">$category</input>";
	}

	?>
    </div>

    <div id="textArea">
	<h2>Message</h2>
	<p>Entrer message ici.</p>
	<textarea id="text"></textarea>
    </div>
    
    <div id="fileArea">
	<h2>Fichier(s)</h2>
	<p>Sélectionner les fichiers à uploader.</p>
	<input id="file" name="file[]" multiple="multiple" type="file">
    </div>

    <div id="sendArea">
	<h2>Envoyer</h2>
	<p>Verifier message et envoyer.</p>
	<button id="sendBtn">Envoyer</button>
    </div>

</div>
