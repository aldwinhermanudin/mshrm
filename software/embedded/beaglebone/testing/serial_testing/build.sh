#!/bin/sh

if [ $# -gt 0 ] ; then
    base=`basename $1 .c`
    echo "compiling $base"
    gcc -ggdb $(mysql_config --cflags) $base.c -o $base $(mysql_config --libs)
else
    for i in *.c; do
        echo "compiling $i"
        gcc -ggdb $(mysql_config --cflags) -o `basename $i .c` $i $(mysql_config --libs);
    done
    for i in *.cpp; do
        echo "compiling $i"
        g++ -ggdb $(mysql_config --cflags) -o `basename $i .cpp` $i $(mysql_config --libs);
    done
fi
