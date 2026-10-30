---
layout: ../layouts/Base.astro
title: "Firma X"
current: "firmax"
---

## What's up with Firma X?

Firma X is a company "connecting the advanced world of computer networks with people, who need it". It is an alias I have started using around the time of the first contact with Cisco IOS on my [Cisco 897VA](equipment/networking/cisco-897va).

### Origin story

One day I was doing an assignment, a presentation to be exact, and I wanted to use PowerPoint, but I use Linux. That got me into setting up a VM with Windows just to run the app, but I kinda derailed my idea and decided to set up an Active Directory domain for practise. I decided to use the domain name FIRMA.COM, or literally COMPANY.COM.

One of my friends then started saying "braannnddd X", so I stuck with it. On a later AD domain I set up the domain name to be FIRMAX.COM that time. It is unclear where Brand X from the mind of my friend comes from, but it's probably from the terribly animated movie "Foodfight!".

The memes began from there.

Around that time I got my Cisco, and decided to make it `Firma-X-R1`, or `Brand-X-R1`, which kind of accelerated the whole thing.

### Current state

After a few months, in September, 2026 to be precise, we had HTML and CSS on IT class, so I decided to make a Firma X website for a grade, which I made in PHP, but then used the web browser save feature to export it as HTML, formatted it and sent it over, and I got an A+ (6 for the Polish readers), which motivated me to make it even better.  
The content is of course AI generated but the site around it is made by me <3.

### Firma X ISP

Firma X has basically become my labbing alias, and so when I decided to start my own PPPoE "ISP", I named it after Firma X, so Firma X ISP.

Their fleet of hardware used to include a Cisco 897VA as the access concentrator with local AAA, but that didn't last long. I have since read the RIPE-690 *Best Current Operational Practice for Operators: IPv6 prefix assignment for end-users - persistent vs non-persistent, and what size to choose*, from which I gathered that I should assign my "customers" persistent /56's and not go off of what is free on my pool.

It all went downhill from there.

I had tried to make it use RADIUS-assigned prefixes for at least three days to no avail. The moment I enabled 
```
aaa authorization network group radius
```
**everything** broke. PPP started randomly disconnecting after the user was authenticated, and it said *Authentication failure*, yeah, no.

It as at the time when I got my [MikroTik](equipment/networking/mikrotik-rb951g-2hnd), so I just decided to use it as the access concentrator.  
It was a breeze to set up and it's running to this day working perfectly with my RADIUS server.

#### Wireless ISP

One day I thought of the great idea of pushing PPPoE frames over Wi-Fi, but then the realisation hit me, people are already doing that!  
So I came up with an even greater idea, to connect to that PPPoE server directly from a Windows client device, as if it wasn't stupid enough to use an omni antenna to broadcast the network in the first place, but I digress.

I set it up so as to have [my laptop](equipment/laptops/hp-elitebook-830-g8) connect to the AP, disable its cellular modem and add a broadband profile in Windows and connect to it. Surpsiringly, it worked, almost flawlessly. The only complaint I have is the fact that Windows shows I am connected over a wire and doesn't show the Wi-Fi signal, just the normal wired icon.

*That's it, for now at least. Thanks for reading!*
