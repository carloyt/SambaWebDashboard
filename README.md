# SambaWebDashboard
This is a dashboard for managing your Samba server.

#  Setup
You just have to run those lines :
```
git clone https://github.com/carloyt/SambaWebDashboard.git
sudo sh SambaWebDashboard/install.sh
```
The path of Apache document root will be asked you. If you don't know, let default value.
Idem for Samba config path. It must be /etc/samba/, except if you have changed something.

# What is install.sh ?
install.sh is a script that :
  1. Installs a web server, Apache;
  2. Installs php5, because the dashboard is developped in PHP;
  3. Installs Samba;
  4. Creates a folder "smb" in /var/www/html (or other path, if you've changed it) 
