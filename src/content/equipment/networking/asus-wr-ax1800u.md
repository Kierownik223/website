---
title: "ASUS WR-AX1800U"
category: "Networking"
description: "OpenWrt 25.12.5"
hostname: "Firma-X-AP2"
meaningful: true
---

## ASUS WR-AX1800U

Trash-picked "gaming" router found by my bro <3. At first, he thought it wasn't working and gave it to me as a decoration. Then I plugged it in and waited, it worked.

It lit up with a Ukrainian-language login page, the SSID "karpaty", which is the name for a mountain pass, the Carpathians. First thing I did was reset it to factory settings ~~with a Motorola ES400 stylus~~ and look online to see as if it was possible to install OpenWrt, and it sure was!

### OpenWrt

I followed [this installation method](https://openwrt.org/toh/asus/rt-ax53u?s[]=0#installation_with_mtd-write) after resetting it, setting the SSID "szopnt" ^lmao^ and enabling SSH access.

The router rebooted and I was in. I tried to import the configuration straight from [my Netgear](netgear-wndr3700-v1) but it kinda soft-bricked the router due to the differing port configurations, so I configured it all manually.

I ran into a problem as to where I couldn't enable VLANs on the WAN port, but it turned out to be the fact that `eth0` was in fact *not* the WAN port, as it was exposed as just `wan`, which was very new to me...

### Fun facts

- It's probably a better router than [my Cisco](cisco-897va) ever was/will be but I'm using it as just an access point
- The antennas on it are so great as to be picking up networks from like three streets away
- The wiki page lists 25.12.3 as the latest release but the firmware selector has 25.12.5?

### Photos

*soon!*
