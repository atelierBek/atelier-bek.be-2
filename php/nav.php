<div class="quart" id="navDiv">
    
    <div id="researchArea">
    <h2>Recherche</h2>

	<input id="researchInput" type="text">

    </div>
    
    <div id="authorFilterArea" value="authors">
    <h2>Auteur(s)</h2>
    
	<?php
	foreach ($authorArr as $author) {
	    echo "<span data-filterType=\"author\" class=\"filterBtn\">$author</span>";
	}
	?>
    
    </div>

    <div id="categoryFilterArea" value="categorys">
    <h2>Categorie(s)</h2>

	<?php
	foreach ($categoryArr as $category) {
	    echo "<span data-filterType=\"category\" class=\"filterBtn\">$category</span>";
	}
	?>
    
    </div>
    
</div>
