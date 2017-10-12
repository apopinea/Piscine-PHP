/*
SELECT DATEDIFF(MAX(date), MIN(date)) as uptime
	FROM historique_membre
	GROUP BY id_film;
*/

SELECT DATEDIFF(MAX(date), MIN(date)) as uptime
	FROM historique_membre;