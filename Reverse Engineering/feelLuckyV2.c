#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <sys/ptrace.h>
#include <string.h>




#include <dlfcn.h>


int SimpleRandGen() {
    // Seed the random number generator with the current time
    srand(time(NULL));

    // Generate and print a random number between 0 and RAND_MAX
    int random_number = rand();
    return random_number;

    
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
   
    
   char input[17];
   printf("Can you guess the flag ? ");
   scanf("%s",input);
    
  char lower[] = "abcdefghijklmnopqrstuvwxyz{|}";
  char digits[] = "0123456789" ;
  char upper[]= "ABCDEFGHIJKLMNOPQRSTUVWXYZ" ;
  
  // hidden ASCII value "Luck1s0nUr5id3"
  int offsets[] = {76 - 'a', 117 - 'a', 99 - 'a', 107 - 'a', 49 - 'a', 115 - 'a', 48 - 'a', 110 - 'a', 85 - 'a', 114 - 'a', 53 - 'a', 105 - 'a', 
                   100 - 'a', 51 - 'a'};


   
              
  
  int result_index=0;
   char result[20];
  
  for (int j = 0; j < sizeof(offsets)/sizeof(offsets[0]); j++) {
    const int offset = offsets[j]; //if the subtraction e.g 100 - 'a'
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
   }

 
 
 if (strcmp(result,input)==0){
    printf("Heres the flag\nflag_{%s}",result);
    exit(1);
    
    }
 else { 
     printf("Wrong Flag :( . You may try again !");
    return -1;}
}

int main(){

    guard(); //check for debugger
    
    int attempts=3;
    int num=0;
    
    while (attempts > 0){ 
    
        
        printf("Can you guess the number?\n number=");
        scanf("%d",&num);
        printf("You entered=%d",num);
        
        int random=SimpleRandGen();
        
        
        if ( num == random ) {
            printf("\nNice\n!");
            printf("====Almost there! KEEP GOING !!!====\n");
            final_round();
            
            
        }
        
        else {
            attempts=attempts-1;
            printf("I'm sorry :(\nYou have %d attemps\n",attempts);
        }
     }
    }
