#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <sys/ptrace.h>
#include <string.h>
#include <dlfcn.h>


/* a | b | c | d | e | f | g | h | i | j | k | l | m | n | o | p | q | r | s | t | u | v | w | x | y | z | { | '|' | } | <space>
   0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 |10 |11 |12 |13 |14 |15 |16 |17 |18 |19 |20 |21 |22 |23 |24 |25 |26 | 27  | 28| 29
*/

char lower[] = "abcdefghijklmnopqrstuvwxyz{|} ";
char digits[] ="0123456789" ;
char upper[]= "ABCDEFGHIJKLMNOPQRSTUVWXYZ" ;


// Obfuscate the
char* arrayToString(char charArray[], int length) { 
	
    char* result = malloc(length + 1);  // +1 for the null terminator
    /*if (result == NULL) {
        fprintf(stderr, "Memory allocation failed\n");
        exit(EXIT_FAILURE);
    }*/

    for (int i = 0; i < length; i++) {
        result[i] = charArray[i];
    }

    result[length] = '\0';  // Null-terminate the string
    return result;
}

 


int SimpleRandGen(){
    // Seed the random number generator with the current time
    srand(time(NULL));

    // Generate and print a random number between 0 and RAND_MAX
    int random_number = 5;//rand();
    return random_number;

    
}


int custom_compare( char* str1, char* str2, size_t num){

	char obf_strncmp[]={lower[18],lower[19],lower[17],lower[13],'c','m','p','\0'};
	
    // Load the libc library dynamically at runtime
    void* libc =dlopen(NULL, RTLD_NOW); //dlopen("/lib/x86_64-linux-gnu/libc.so.6", RTLD_LAZY);//
    
	typedef int (*StrcmpFunction)(const char* str1,const char* str2, size_t num);
    
    StrcmpFunction strcmp_ptr = (StrcmpFunction)dlsym(libc, obf_strncmp);

    if (!strcmp_ptr) {
        //fprintf(stderr, "Error getting address of strcmp: %s\n", dlerror());
        dlclose(libc);
        return -1;
    }
    
    int res = strcmp_ptr(str1, str2, 14);
    
    //Strings are equal    
    if (res == 0) {

        dlclose(libc);
    	return 0;
    } 
    //Strings are not equal
    else {
      
        dlclose(libc);
    	return 1;
    	
    }


    
    
}




int guard() {
    //hide ptrace from static analysis
	char obf_ptrace[]={lower[15],lower[19],'r','a','c','e','\0'};
    
    // Load the libc library dynamically at runtime
    void* libc = dlopen(NULL, RTLD_NOW);
    /*if (libc == NULL) {
        fprintf(stderr, "Failed to load libc: %s\n", dlerror());
        return 0;
    }*/

    // Load the ptrace function from libc
    long (*my_ptrace)(enum __ptrace_request request, pid_t pid, void *addr, void *data) =  (long (*)(enum __ptrace_request, pid_t, void *, void *))dlsym(libc, obf_ptrace);

    

    // Use the loaded ptrace function
    
    if (my_ptrace(PTRACE_TRACEME, 0, NULL, NULL) == -1) {
        char angry_emoji[] = "\xF0\x9F\x98\xA1"; // ASCII representation of an angry emoji
        printf("I don't like cheaters! %s \n Exiting...\n",angry_emoji);
        exit(1);
    }
}

int final_round(){

   char message_1[15]={upper[7],lower[4],lower[17],lower[4],lower[18],lower[29],lower[19],lower[7],lower[4],lower[29],lower[5],lower[11],lower[0],lower[6],'\0'}; //"Heres the flag
   char message_2[6]={lower[5],lower[11],lower[0],lower[6],lower[26],'\0'}; //flag{
   char input[15];
   char result[15];
   int result_index=0;
   
  // hidden ASCII value "Luck1s0nUr5id3"
  int offsets[] = {76 - 'a', 117 - 'a', 99 - 'a', 107 - 'a', 49 - 'a', 115 - 'a', 48 - 'a', 110 - 'a', 85 - 'a', 114 - 'a', 53 - 'a', 105 - 'a', 
                   100 - 'a', 51 - 'a'};
   
   
   printf("Can you guess the flag ? \n");
   scanf("%s",input);  
  
  
  for (int j = 0; j < sizeof(offsets)/sizeof(offsets[0]); j++) {
    int offset = offsets[j]; //if the subtraction e.g 100 - 'a'
    int new_offset=0;
    
    if (offset >=0  && offset < 26){
        
        result[result_index++]=lower[offset];
        //printf("lower[%d]=%d\n",j,offset);
    }
    else if (offset >= (-32) && offset < (-6)) {
        new_offset=offset+32;
        result[result_index++]=upper[new_offset];
        //printf("upper[%d]=%d\n",j,new_offset);
    }
    else if (offset >= (-49) && offset <= (-40)) {
        new_offset=offset+49;
        result[result_index++]=digits[new_offset];
        //printf("digits[%d]=%d\n",j,new_offset);
    }
    else {
        continue;
        }
   
   }


 if (custom_compare(result,input,14)==0){
 
 	//char *m1=arrayToString(message_1,15);
 	printf("%s\n",message_1);
 	//free(m1);
 	
 	//printf("%s\n",message_1);
    printf("%s%s}\n",message_2,result);
    exit(1);
    
    }
 else { 
     printf("Wrong Flag :( . You may try again !\n");
    exit(1);}
}




int main(){
	
	char hintArray[24]={lower[18],lower[14],lower[12],lower[4],lower[29],lower[18],lower[19],lower[17],lower[8],lower[13],lower[6],lower[18],lower[29],lower[0],lower[17],lower[4],lower[29],lower[7],lower[8],lower[3],lower[3],lower[4],lower[13],'\0'};//"some strings are hidden"
    guard(); //check for debugger
    
    int attempts=3;
    int num=0;
    
    while (attempts > 0){ 
    
        
        printf("Can you guess the number?\n number=");
        scanf("%d",&num);
        printf("You entered=%d\n",num);
        
        int random=SimpleRandGen();
        
        
        if ( num == 5){ //random ) {
            //printf("\nNice\n!");
            //printf("====Almost there! KEEP GOING !!!====\n");
            printf("==== Well Done ! Here's a HINT for you ====\n");
            char *hint=arrayToString(hintArray,24);
 	
 			printf("%s\n",hint);
 			free(hint);
            
            final_round();
            
            
            
        }
        
        else {
            attempts=attempts-1;
            printf("I'm sorry :(\nYou have %d attemps\n",attempts);
        }
     }
    }
