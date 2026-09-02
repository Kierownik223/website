---
title: "Netgear WNDR3700 v1"
category: "Networking"
description: "OpenWrt 25.12.5"
hostname: "Firma-X-AP1"
meaningful: true
---

### Netgear WNDR3700 v1

An access point for my [Cisco 897VA](cisco-897va) as I don't want to run Ethernet cables everywhere. Upgraded to it from my old Ovislink as I wanted to run multiple SSID's for multiple VLAN's.

Currently broadcasting:
- 2,4 GHz
    - SSID 1 (VLAN 10), WPA3-PSK
    - SSID 2 (VLAN 20), WPA2-PSK
    - SSID 3 (VLAN 6), WPA3-PSK
- 5 GHz
    - SSID 1 (VLAN 10), WPA3-PSK
    - SSID 2 (VLAN 20), WPA2-PSK
    - SSID 3 (VLAN 6), WPA3-PSK

### Extroot

With the newest OpenWrt version the Extroot setup turned out to be extra challenging. When `firstboot` is ran and the router is rebooted, only 500-600 **kilobytes** of writable disk space are available, you can't fit `block-mount`, `kmod-fs-ext4` and `kmod-usb-storage` even if you try your hardest.

After failing miserably for a few hours I decided to try and build a custom image, for which I chose to remove the DHCPv6 client, all PPP-related packages and included `kmod-usb-storage` and `kmod-fs-ext4`. I built it and flashed it, somehow the router still works, I then went and installed `block-mount` and FINALLY it didn't shit itself, I plugged in a trash-picked 1GB USB flash drive pre-formatted with ext4 and I now have almost a gigabyte of free space to mess around with, and mess around I did...

### nginx

...I settled on the great idea to use this (now) access point as a web server to host the [Firma X website](https://firmax.kier.ovh). This was the whole reason for the extroot fiasco, I could've lived with this being a plain old access point.

To install packages before I put it up on my IPv6-only subnet, because *why not?* so I decided to keep it that way, the IP is `2001:470:5a5e:dead::2115`, for some reason. The Cisco is set up in such a way as to allow all traffic to all devices on the subnet, as it's the free IPv6 subnet afterall, for testing, I guess.

I opened port 80 and 443 on the firewall, just for IPv6 tho, put LuCI on a different port for management, got around to learn UCI and configured nginx like in the elden days (I use [Caddy](https://caddyserver.com) now).

And then I uploaded my amazing website I made in... *Microsoft Expression Web 4*, the shittiest software I could've used to the `/var/www` folder, only to find out it's a symlink to `/tmp`... scratch that. I uploaded the website to `/www/firmax`, ~~beat up~~ got Acme.sh to work and... boom! Now Firma X has got a website and it's in the most roundabout way I could've done it (tho I could have probably hosted it on the Cisco but I don't feel like torturing the flash).
