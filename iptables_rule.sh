#1.(avoid mysql connection from remote shell or phpmyadmin)
sudo iptables -A OUTPUT -m string --string "ctf_user123" -j DROP --algo kmp


#2.(avoid getconnection from remote shell 
sudo iptables -A OUTPUT -m string --string "dbcon.php" -j DROP --algo kmp

#3.(avoid access to phpmyadmin interface)
sudo iptables -A INPUT -m string --string "phpmyadmin" -j DROP --algo kmp

#4.(in case of db hijack avoid queries execution)
sudo iptables -A INPUT -m string --string "DELETE" -j DROP --algo kmp
sudo iptables -A INPUT -m string --string "delete" -j DROP --algo kmp
sudo iptables -A INPUT -m string --string "UPDATE" -j DROP --algo kmp
sudo iptables -A INPUT -m string --string "update" -j DROP --algo kmp
