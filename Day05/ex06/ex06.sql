SELECT titre, resum
	from film 
	WHERE LOWER(resum)
	LIKE '%vincent%'
	ORDER BY id_film ASC;