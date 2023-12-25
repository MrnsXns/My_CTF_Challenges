def xor_hex_strings(hex_str1, hex_str2):
    # Convert hex strings to integers
    int_value1 = int(hex_str1, 16)
    int_value2 = int(hex_str2, 16)

    # Perform XOR operation
    result = int_value1 ^ int_value2

    # Convert the result back to a hex string
    result_hex = hex(result)[2:]  # Remove '0x' from the beginning

    # Pad with zeros to ensure the hex string has an even length
    if len(result_hex) % 2 != 0:
        result_hex = '0' + result_hex

    return result_hex

def StringtoHex(hex_string):
    import binascii
    # Convert the string to its hexadecimal representation
    hex_representation = binascii.hexlify(hex_string.encode()).decode()

    return hex_representation


def xor_bytes(byte_str1, byte_str2):
    if len(byte_str1) != len(byte_str2):
        raise ValueError("Input byte strings must be of the same length")

    result = bytearray()
    for b1, b2 in zip(byte_str1, byte_str2):
        result.append(b1 ^ b2)

    return bytes(result)

def hex_to_UTF8(hex_string):
    byte_data = bytes.fromhex(hex_string)
    utf8_text = byte_data.decode('utf-8')

    print(utf8_text)




# Example usage
#hex_str1 = "4865726573206120666c6167203420796f75722068656c7020666c61677b3074505f21736e27745f50337266456334217d"
#hex_str2 = "436f6e67726174732120596f752066696e6420746865206b65792e596f752063616e2046696e642074686520666c61672e"
#result_hex = xor_hex_strings(hex_str1, hex_str2)
#print("XOR result:", result_hex)


crib=['eid:43567289','pass:4!25as%8F','admin','flag{']
c1="0b0a17465228541d44453d4f014803490b095018071c450e45104a790e1b4443110f53351e0116445407030007080c0e40"
c2="02031c0e1509005d01683c1d10001f061b4441060d45450201431a6a5a43175159570036081d171a40495715071f445f68"
c3="0b0a1c0201411553474c3808551446100111525400004c1b451f4238080e1017313101350749107f245b1746230f554653"

#c1_b=bytes.fromhex(c1)
#c2_b=bytes.fromhex(c2)
#c3_b=bytes.fromhex(c3)

#convert crib to hex
crib_hex=[]

for i in crib:
    crib_hex.append(StringtoHex(i))

print(crib_hex)


b=len(c1)
print(b)

'''
for h in crib_hex:
    for i in range(b):
        if (len(c3[i:len(h)+i])< len(h)):
            break
        else:
            print(str(bytes.fromhex(h))+" XOR "+" c3["+str(i)+":"+str(len(h)+i)+"]"+ c3[i:len(h)+i]+'---'+str(bytes.fromhex(xor_hex_strings(h,c3[i:len(h)+i]))))
'''
#print(str(h),str(c1[i:len(h)]) + '='+ str(hex_to_UTF8(xor_hex_strings(h,c1[i:len(h)]))))
        
    



#ciphertexts=[c1,c2,c3]

#print(bytes.fromhex(c1))


#######b'admin' XOR  c1[97:107]0---b'admin'
#######b'eid:43567289' XOR  c1[97:121]0---b'eid:43567289'
#######b'pass:4!25as%8F' XOR  c2[70:98]36081d171a40495715071f445f68---b'Find the flag.'
#######b'pass:4!25as%8F' XOR  c1[97:125]0---b'pass:4!25as%8F'
#######b'eid:43567289' XOR  c2[44:68]450201431a6a5a4317515957---b' key.You can'
#######b'flag{' XOR  c3[50:60]1f4238080e---b'y.You'




#####b'admin' XOR  c1[88:98]07080c0e40---b'flag.'
#####b'eid:43567289' XOR  c2[44:68]450201431a6a5a4317515957---b' key.You can'
#####b'pass:4!25as%8F' XOR  c2[70:98]36081d171a40495715071f445f68---b'Find the flag.'
#####b'flag{' XOR  c3[50:60]1f4238080e---b'y.You'


print(c3[44:98])
