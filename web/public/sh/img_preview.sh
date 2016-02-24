#!/bin/bash

/opt/local/bin/mogrify -resize 200x200 -contrast -contrast -gravity center -quiet -format png -quality 100 -path uploads/photos/$1 uploads/photos/$1/$2 && mv uploads/photos/$1/$3.png uploads/photos/$1/$3_preview.png ; kill `jobs -p`