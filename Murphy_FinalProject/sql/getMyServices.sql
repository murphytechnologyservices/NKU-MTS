SELECT p.userid, p.service_name, u.name
FROM ptt_user_services p,
ptt_users u
WHERE 
p.userid = u.userid
and p.userid = :userid