#!/bin/bash

##/usr/bin/java -Xss2m -mx1500m -classpath /Applications/ImageJ/ImageJ.app/Contents/Resoures/Java/headless.jar:/Applications/ImageJ/ImageJ.app/Contents/Resources/Java/ij.jar -Djava.awt.headless=true ij.ImageJ -ijpath /Applications/ImageJ/ImageJ.app/Contents/Resources/Java/ -batch $3/moteur/Corexpert_2013-07-18_Linux.ijm "$1"  > $2/carpaccio.out

xvfb-run -a /usr/bin/java -Xss2m -mx1500m -classpath /home/adagues/ImageJ/headless.jar:/home/adagues/ImageJ/ij.jar -Djava.awt.headless=true ij.ImageJ -ijpath /home/adagues/ImageJ/ -batch Corexpert_2013-07-18_Linux.ijm "$1"  > $2/carpaccio.out