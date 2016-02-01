<?php

function afficherCitation(){

	$citations = array(							
							'Un bon site Web est toujours en "construction"',
							'La vie est trop courte pour attendre de retirer le périphérique en toute sécurité',
							'Le graal d\'un SEO gaulois : avoir une SERP d\'or',
							'Schrödinger\'s cat applied to web development: If I don\'t look at it in Internet Explorer then there\'s a chance it looks fine.',
							'In a perfect world, #666 would be red.',
							'Pour l\'intégrateur #CSS aussi, c’est la rentrée des class. Et il vaut mieux avoir de bonnes id.',
							'« Et ça, on peut le faire clignoter sur le site ? » ...A chaque fois que quelqu’un prononce ces mots, un graphiste meurt quelque-part...',
							'A cheap website is like a cheap tattoo. It sucks, and you have to pay even more to get it redone',
							'On ne dit pas... "Quand les poules auront des dents" ... mais on dit "Quand on branchera une clé USB dans le bon sens du premier coup..."',
							'Communication pragmatique : L\'urgent est fait, l\'impossible est en cours... Pour les miracles, prévoir un délai !',
							'Si tu ne sais pas où tu vas, tu risques de mettre longtemps à y arriver');

	$auteurs = array(
							'Anonyme',
							'Anonyme',
							'Olivier Andrieu',
							'Ben Howdle',
							'Daniel Collis Puro',
							'Nicolas Hoffmann',
							'Willy Bahuaud',
							'Sean Sasso',
							'onneditpas.bbxdesign.com',
							'Anonyme',
							'Proverbe Touareg');

	$nbre_citations = count($citations);

	$numero = rand(0,$nbre_citations) - 1;

	echo '<blockquote>' . $citations[$numero] . '<br /><small class="pull-right">' . $auteurs[$numero] . '</small></blockquote>';
}