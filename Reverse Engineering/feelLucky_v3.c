#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <sys/ptrace.h>
#include <string.h>
#include <dlfcn.h>

char lower[] = "abcdefghijklmnopqrstuvwxyz{|}";
char digits[] ="0123456789" ;
char upper[]= "ABCDEFGHIJKLMNOPQRSTUVWXYZ" ;

int SimpleRandGen(){
    // Seed the random number generator with the current time
    srand(time(NULL));

    // Generate and print a random number between 0 and RAND_MAX
    int random_number = 5;// rand();
    return random_number;

    
}


int custom_compare( char* str1, char* str2, size_t num){
	char a[]={lower[18],lower[19],'r','n',lower[2],lower[12],'p','\0'};
    // Load the libc library dynamically at runtime
    void* libc = dlopen("/lib/x86_64-linux-gnu/libc.so.6", RTLD_LAZY);//dlopen(NULL, RTLD_NOW);
	typedef int (*StrcmpFunction)(const char* str1,const char* str2, size_t num);
    StrcmpFunction strcmp_ptr = (StrcmpFunction)dlsym(libc, a);

    if (!strcmp_ptr) {
        fprintf(stderr, "Error getting address of strcmp: %s\n", dlerror());
        dlclose(libc);
        return -1;
    }
    
    int res = strcmp_ptr(str1, str2, 14);
    printf("str1=%s \n str2=%s \n",str1,str2);

    // Print result
    if (res == 0) {
        printf("Strings are equal.\n");
        dlclose(libc);

    	return 0;
    } else {
        printf("Strings are not equal.\n");
        dlclose(libc);

    	return 1;
    }

    // Close the library
    
    
}




int guard() {
    //hide ptrace from static analysis
	char a[]={'p','t','r','a','c','e','\0'};
    // Load the libc library dynamically at runtime
    void* libc = dlopen(NULL, RTLD_NOW);
    /*if (libc == NULL) {
        fprintf(stderr, "Failed to load libc: %s\n", dlerror());
        return 0;
    }*/

    // Load the ptrace function from libc
    
    long (*my_ptrace)(enum __ptrace_request request, pid_t pid, void *addr, void *data) =  (long (*)(enum __ptrace_request, pid_t, void *, void *))dlsym(libc, a);

    

    // Use the loaded ptrace function
    
    if (my_ptrace(PTRACE_TRACEME, 0, NULL, NULL) == -1) {
        char angry_emoji[] = "\xF0\x9F\x98\xA1"; // ASCII representation of an angry emoji (Nonsence)
        printf("I don't like cheaters! %s \n Exiting...\n",angry_emoji);
        exit(1);
    }
}

int final_round(){

  
   char input[15];
   char result[15];
   int result_index=0;
   
   printf("1st result=%s\n",result);
   
   
   printf("Can you guess the flag ? \n");
   scanf("%s",input);
    
  
  
  // hidden ASCII value "Luck1s0nUr5id3"
  int offsets[] = {76 - 'a', 117 - 'a', 99 - 'a', 107 - 'a', 49 - 'a', 115 - 'a', 48 - 'a', 110 - 'a', 85 - 'a', 114 - 'a', 53 - 'a', 105 - 'a', 
                   100 - 'a', 51 - 'a'};


   
              
  
  
  
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
    //printf("Bad Character!");}
    printf("result[%d]=%s\n",j,result);
   }

 //printf("result=%s\ninput=%s\n",result,input);

 //int res=SECRET_STRCMP(result,input);
 if (custom_compare(result,input,14)==0){
    printf("Heres the flag\nflag_{%s}\n",result);
    exit(1);
    
    }
 else { 
     printf("Wrong Flag :( . You may try again !\n");
    exit(1);}
}




int main(){

    guard(); //check for debugger
    
    int attempts=2;
    int num=0;
    
    while (attempts > 0){ 
    
        
        printf("Can you guess the number?\n number=");
        scanf("%d",&num);
        printf("You entered=%d\n",num);
        
        int random=SimpleRandGen();
        
        
        if ( num == 5){ //random ) {
            //printf("\nNice\n!");
            printf("====Almost there! KEEP GOING !!!====\n");
            final_round();
            
            
            
        }
        
        else {
            attempts=attempts-1;
            printf("I'm sorry :(\nYou have %d attemps\n",attempts);
        }
     }
    }
