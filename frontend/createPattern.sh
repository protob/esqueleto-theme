#!/bin/bash

name=$2
d='components/'
c=$name$d$name
s="/"
e=$name$s$name
echo $d$1

cd $PWD/$d$1 && mkdir $name && cd $name && touch $name.php && touch _$name.scss
cd ..
printf "\n@import '$e';" >> '_style.scss'