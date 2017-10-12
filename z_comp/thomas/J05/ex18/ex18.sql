SELECT nom FROM distrib
WHERE (id_distrib = 42 or (id_distrib <= 69 and id_distrib >= 62) or id_distrib = 71 or id_distrib = 88 or id_distrib = 89 or id_distrib = 90) and (LENGTH(nom)-LENGTH(REPLACE(LOWER(nom), 'y',''))) = 2
LIMIT 5 OFFSET 2;