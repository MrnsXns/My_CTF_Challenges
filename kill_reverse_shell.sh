# detect and kills tcp reverse shell
#based on specific payload in data 

sudo tshark -l -Y 'tcp contains "<some kind of string>"' -T fields -e ip.src | while read -r line; do sudo tcpkill host $line;break; done
