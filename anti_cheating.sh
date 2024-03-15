
#execute with sudo privileges
inotifywait -m -e access "/var/db_folder/dbcon.php" | while read -r dir action file; do
    a=$(netstat -ntp |grep -Eo '[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+' | sort | uniq | tail -n 1)
    echo "CHEATING ATTEMPT"
    sudo iptables -A OUTPUT -d "$a" -j DROP
   
    
done

