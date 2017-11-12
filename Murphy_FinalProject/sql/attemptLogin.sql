/* Select users where the username and password match those passed as parameters */
SELECT *
FROM PTT_users
WHERE
	username = :username AND
	password = :password
	