---
title: "MikroTik RB951G-2HnD"
category: "Networking"
description: "RouterOS 7.24.5"
hostname: "MikroDik"
meaningful: true
---

## MikroTik RB951

My first ever MikroTik device. Bought it on Vinted for 60 PLN + shipping, probably too much but I ain't paying for a 2011 or something.

### Initial setup

After I unboxed it, I tried to set it up as a PPPoE Client with [my Cisco](cisco-897va), but I found that the first Ethernet port isn't getting any link, probably my cable but I have no clue.

I decided to use the 5th Ethernet port as WAN, same as I do on my Cisco where the last port is WAN (Gi8 in its case). I set up a second user on my AAA, `customer2`, which I used for this link. I connected it, used the PPPoE Scanner and it picked up my Cisco just fine, so I connected it, but it was very unstable, dropping every two minutes.  
This time I am sure that this was my Ethernet cable lmao.

Regardless, I then reset it and the first issues came to light.

### Dualboot????

I found that after resetting it I was unable to connnect to it via WinBox, it also showed an older version via MNDP, tho WebFig was working.  
I connected to it, logged in as admin and took a look around. It was at this moment I noticed the "Partition" tab. Bruh. I set the ROS 7 partition as active and got it back up and running

### The power supply

As it came, it had a 24 volt power supply with it. I plugged the wallwort first as I always do, then tried to plug in the router, and the plug eroded with sparks, thank God this wasn't on a carpet...
