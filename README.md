# I4CPRO_cviceni_bezpecnost
# Souhrn zranitelností

1.	SQL Injection (více míst).
2.	XSS (výpis komentářů bez filtrování).
3.	CSRF (všechny formuláře).
4.	Slabé & nehashované heslo (plaintext).
5.	Žádná validace vstupu (autor, komentář, login…).
6.	Žádné zabezpečení session.
7.	Žádná regenerace session ID.
8.	Vypisování citlivých chyb (informační únik).
9.	Žádná autorizace podle role.
10.	Možnosti DoS přes dlouhé vstupy.
11.	Chybějící omezení pokusů o přihlášení.
12.	Chybějící sanitace výstupu.
13.	Logout neukončuje session bezpečně.
14.	Chybějící ochrana proti brute-force.
15.	Chybějící bezpečnostní hlavičky (CSP, XSS-Protection, HSTS).
