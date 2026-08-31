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

### IPv6

As I am fascinated by IPv6 and this is my own router, I thereby think I should probably experiment with it, so here I am.

One day I heard of [HE's TunnelBroker service](https://tunnelbroker.net) and immediately thought I can get my own /48 for testing with my Cisco, so I immediately signed up and got to configuration.  
My excitement didn't last long tho as the tunnel never came up. As it turns out, I needed to forward IP protocol 41 on my NAT appliance upstream. Only problem is, I am double-NATted because of my ISP's Huawei ONT, so I can't do that as the ISP router can only forward TCP and UDP. Bummer.

But then it hit me, what if I avoid that completely and just use a VPS from Oracle to get the IPv6 tunnel up and then connect to it from the Cisco, somehow.  
After figuring the VPS side I settled on a PPP connection in an L2TP tunnel from my Cisco, as that's what I've been using for another WAN connection on it, so I set it up, enabled IPv6, routed the prefix and boom! It works!!

<a href="/assets/cisco-897va-4.jpg"><img src="/assets/cisco-897va-4.jpg" alt="My Lumia 930 connecting directly to my PC"></a>

Now I have a whole /48 all to my disposal, which is really neat, since I can also directly expose services thru it and split it up into how many VLANs I please.  
The speeds also aren't that bad, I manage to fully saturate my 20Mbit/s upload and get around 50Mbit/s download via Ethernet which is not bad considering the sophisticated topology we're dealing with.

#### MTU

At first, I didn't quite notice the almost nonexistent performance of my IPv6 link and it's inability to connect to sites like my friend [mily's website](https://mily.ovh). I narrowed down the issue to being MTU related. By that I mean, the 6in4 tunnel has an MTU of 1480, then the PPP session has an MTU of 1400 and the LAN had an MTU of 1500, which completely annihilated my PPP session. That meant I had to set the MTU to something lower, I settled on 1280.  
That turned out to be a mistake as shortly after I fixed IPv6 speeds, IPv4 broke to shit and TLS was taking like three seconds to connect, which was unacceptable.

That's when I discovered that on Cisco IOS you can set a separate MTU for legacy IP and IPv6, so I did just that — left v4 on 1500 and set v6 to 1280 and that's what fixed it.

As for anyone wondering how you do that, here it is:
```
Router#conf t
Router(config)#int vl10 (my vlan)
Router(config-int)#ip mtu 1500
Router(config-int)#ipv6 mtu 1280
Router(config-int)#end
```

The Virtual-PPP interface was still set to 1400 and the 6in4 tunnel was set to 1480 as intended.

### Fun facts

- What was meant to be a practise router became the heart of my legacy phone LAN
- It used to have an ADSL card but I swiftly dismantled it due to thermal concerns
- PoE does not work with my power solution
- It has an ISDN and Ethernet jack next to one another which makes it easy to mistakenly plug your WAN into ISDN

### Photos

[![My makeshift power cable](/assets/cisco-897va-1.jpg)](/assets/cisco-897va-1.jpg)
[![Port selection](/assets/cisco-897va-2.jpg)](/assets/cisco-897va-2.jpg)
[![Current setup](/assets/cisco-897va-3.jpg)](/assets/cisco-897va-3.jpg)