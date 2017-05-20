100#define rnd abs(rand())
110static unsigned long next=1;
120int rand(){next=next*1103515245L+12345;return (unsigned)(next/65536L)%32768U;}
130srand(unsigned seed){next+=seed;}
140srnd(){next+=peek(254);poke(254,rnd%256);}
