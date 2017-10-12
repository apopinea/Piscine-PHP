SELECT film.titre AS 'Titre',
	resum as 'Resume',
	film.annee_prod
	FROM film, genre
	WHERE genre.nom = 'erotic'
	AND genre.id_genre = film.id_genre
	ORDER BY annee_prod DESC;