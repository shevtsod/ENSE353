# ENSE353
My work in the ENSE 353 (Software Design and Architecture) labs and assignments. Also includes past work done in CS215 (Web and Database Programming).

>**Have a look at the final product at <https://daniel.ursse.org>**

## Overview
> **Assignment** - LAMP Stack Email Subscription Service  
> **Lab 1** - CentOS Installation  
> **Lab 2** - Ethernet Cables and Network Configuration  
> **Lab 3** - LAMP Stack Installation  
> **Lab 4** - phpMyAdmin, NTP, HTTPS, and self-signed SSL Certificate  
> **Lab 5** - DNS and Let's Encrypt  
> **Lab 6** - SMTP, IMAP, denyhosts, and POODLE Attack  
> **Lab 7** - KDE, VNC, and Virtual Machines  
> **Lab 8** - Turning the Machine Into a NAT Router  

## Details
### Assignment - LAMP Stack Email Subscription Service
Email subscription service made with LAMP stack that allows registering, verifying email, logging in, and changing subscriptions.

### Lab 1 - CentOS Installation
Installed RAM, HDD, keyboard and mouse to a given server machine and installed the CentOS 7 Linux Distribution.

### Lab 2 - Ethernet Cables and Network Configuration
Used a given Cat 5 cable to create a T-568A standard ethernet cable terminated by an RJ45 jack. Configured the Linux server's
network settings to connect to a network switch.

### Lab 3 - LAMP Stack Installation
Installed the Apache server, PHP server-side scripting language, and MySQL RDBMS to complete a LAMP stack on the Linux server.

### Lab 4 - phpMyAdmin, NTP, HTTPS, and self-signed SSL Certificate
Installed phpMyAdmin GUI for MySQL, Network Time Protocol to synchronize time through the Internet, 
and installed SSL to self-sign a certificate for the server.

### Lab 5 - DNS and Let's Encrypt
Installed and configured a DNS server for the Linux machine and used it to obtain a domain name (provided by the instructor). 
Cloned [Let's Encrypt Client (Certbot)](https://github.com/certbot/certbot) to obtain a valid certificate for the server from the Let's Encrypt CA.

### Lab 6 - SMTP, IMAP denyhosts, and POODLE Attack
Installed *sendmail* SMTP message transfer agent, *dovecot* IMAP server, and *squirrelmail* web email GUI to allow the Linux machine to
send and receive emails. Installed denyhosts to prevent unwanted login attempts to the machine, and disabled SSLv3 in Apache server to
prevent POODLE attack.

### Lab 7 - KDE, VNC, and Virtual Machines
Installed *KDE Plasma* GUI Desktop environment, *TigerVNC* server and *TightVNC* client to connect to the machine remotely, and *Oracle VM VirtualBox*
to run VMs of other Operating Systems on the machine.

### Lab 8 - Turning the Machine Into a NAT Router
Installed a PCIe network card into the machine, installed DHCP and configured network and firewall settings to turn
the machine into a NAT router that other devices can connect to.

## Known Issues
*   index.php - Background transition CSS effect causes a fade from white when first opening the page.
*   index.php - Low framerate in transition between background colors on click.