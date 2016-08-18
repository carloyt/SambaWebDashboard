#!/bin/bash

apt-get --assume-yes install samba

DOCUMENTROOT_DEFAULT="/var/www/html/"
read -p "Please enter DocumentRoot path with the \"/\" at the end [$DOCUMENTROOT_DEFAULT]: " DOCUMENTROOT
DOCUMENTROOT="${DOCUMENTROOT:-$DOCUMENTROOT_DEFAULT}"

SMBROOTPATH="$DOCUMENTROOT""smb/"

mkdir "$SMBROOTPATH"
echo "Le dossier $SMBROOTPATH a bien été créé." 

SAMBACONFPATH_DEFAULT="/etc/samba/"
read -p "Please enter Samba configuration path with the \"/\" at the end (if you don't know put default) [$SAMBACONFPATH_DEFAULT]: " SAMBACONFPATH
SAMBACONFPATH="${SAMBACONFPATH:-$SAMBACONFPATH_DEFAULT}"

SAMBACONFPATH="$SAMBACONFPATH""conf/"
mkdir "$SAMBACONFPATH"
echo "Le dossier $SAMBACONFPATH a bien été créé."
touch "$SAMBACONFPATH""shares.conf"

cd SambaWebDashboard/files/
cp add.php $SMBROOTPATH
cp edit.php $SMBROOTPATH
cp conf.php $SMBROOTPATH

#cd $SMBROOTPATH
#mkdir files/
#cd files/
