#!/bin/bash

#apt-get --assume-yes install samba

DOCUMENTROOT_DEFAULT="/var/www/html/"
read -p "Please enter DocumentRoot path with the \"/\" at the end [$DOCUMENTROOT_DEFAULT]: " DOCUMENTROOT
DOCUMENTROOT="${DOCUMENTROOT:-$DOCUMENTROOT_DEFAULT}"
#echo "Document root = $DOCUMENTROOT"

SMBROOTPATH="$DOCUMENTROOT""smb/"
#echo $SMBROOTPATH

mkdir "$SMBROOTPATH"
echo "Le dossier $SMBROOTPATH a bien été créé." 
#touch /etc/samba/smb.conf

SAMBACONFPATH_DEFAULT="/etc/samba/"
read -p "Please enter Samba configuration path with the \"/\" at the end (if you don't know put default) [$SAMBACONFPATH_DEFAULT]: " SAMBACONFPATH
SAMBACONFPATH="${SAMBACONFPATH:-$SAMBACONFPATH_DEFAULT}"

SAMBACONFPATH="$SAMBACONFPATH""conf/"
mkdir "$SAMBACONFPATH"
echo "Le dossier $SAMBACONFPATH a bien été créé."

cd $SMBROOTPATH
wget https://github.com/carloyt/SambaWebDashboard/blob/master/LICENSE
mkdir files/
cd files/
wget https://github.com/carloyt/SambaWebDashboard/blob/master/files/add.php
wget https://github.com/carloyt/SambaWebDashboard/blob/master/files/conf.php
wget https://github.com/carloyt/SambaWebDashboard/blob/master/files/edit.php
