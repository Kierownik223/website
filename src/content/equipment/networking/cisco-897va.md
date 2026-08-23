---
title: "Cisco 897VA"
category: "Networking"
description: "IOS 15.9"
hostname: "Firma-X-R1"
meaningful: true
---

## Cisco 897VA

My experimental and practise router. Bought it for 45 PLN without a power supply, which justified the price as an original power supply costs upwards of 200 PLN which is crazy for such an old router.  
After it arrived, I inspected the power plug and found a power supply from an old HP system that had the same connector, so I chopped it off and wired it up to a terminal with a normal barrel jack. I then got a 1,5A 12V power supply and... the router sprang into life.

It was originally used at PremiumOil.eu in Poznań, Poland, but somehow ended up at the south where I live :O.

I then used the configuration register 0x2142 to make it not load the config and erased the NVRAM once booted into IOS.  
It came with IOS 15.2 but then I found a sketchy forum where someone shared a newer, IOS 15.9, image built in March, 2026(!).

In the following days I configured it to be Firma-X-R1 or Brand-X-Router1 in English, set up VLANs and paired it with an old OvisLink AirLive WL-5460AP I had in my room.

### Fun facts

- What was meant to be a practise router became the heart of my legacy phone LAN
- It used to have an ADSL card but I swiftly dismantled it due to thermal concerns
- PoE does not work with my power solution
- It has an ISDN and Ethernet jack next to one another which makes it easy to mistakenly plug your WAN into ISDN

### Photos

[![My makeshift power cable](/assets/cisco-897va-1.jpg)](/assets/cisco-897va-1.jpg)
[![Port selection](/assets/cisco-897va-2.jpg)](/assets/cisco-897va-2.jpg)
[![Current setup](/assets/cisco-897va-3.jpg)](/assets/cisco-897va-3.jpg)