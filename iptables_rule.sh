#iptables rule that kills connection when attacker-user try to gain access to db_folder (kill reverse tcp shell connection)
sudo iptables -A INPUT -m string --string "db_folder" -j DROP --algo kmp #db_folder contains the creds of database. 
