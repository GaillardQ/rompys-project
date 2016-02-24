#!/bin/bash

/usr/bin/mogrify -resize 800x800 -auto-level -gravity center -quiet -format png -quality 100 -path "$1" "$1$2" && mv "$1$3.png" "$1$3_thumb.png" > $1thumbs.log;