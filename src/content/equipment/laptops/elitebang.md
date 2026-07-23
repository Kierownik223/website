---
priority: 1
title: "EliteBang"
category: "Laptops"
description: "Primary laptop"
meaningful: true
---

## EliteBang

My current laptop, bought as refurbished for a fair price.

### Specifications

- Processor: 11th Gen Intel Core i5-1145G7 @ 4.40 GHz
- Model: HP EliteBook 830 G8
- Memory (Total: 16GB):
    - Slot 0: Kingston 16GB DDR4 3200MT/s
    - Slot 1: Empty
- Mass storage:
    - Boot drive: KIOXIA KXG6AZNV256G 256GB NVMe SSD
- Graphics card: Intel Iris Xe Graphics (Integrated)
- Display: 1920x1080 IPS LCD 13" 60Hz

### Accessories:

- Power supply: HP 45W
- Docking station: HP Elite x3 Desk Dock

### Uses:

- General development
- Server administation
- Internet browsing
- E-book reading

### Mute LEDs

On newer revisions of the motherboard, in my case 8AB8, the mute LEDs do not function by default on Linux.  
I have since submitted [a patch](https://lore.kernel.org/linux-sound/4dab5622-9100-4730-8c99-b58da939549b@marmak.net.pl/), which fixes said issue.

### LTE modem

My example of this machine has shipped from the factory with a **Fibocom L850-GL** LTE-Advanced PCI-e modem. The modem is perfectly functional, including the GPS/GLONASS receiver.  
Fact of the matter is, I use arch btw, and so do I on this machine. So I kinda wanted the modem to function as it was a factory configuration.  

Then I started digging, and came across [this amazing Github repo](https://github.com/xmm7360/xmm7360-pci), which says it is a PCI-e driver for this exact chipset. Bingo! Or so I thought.  
I realised quickly I had to put in more effort than just copying commands. I had to ask an LLM (kill me please) to fix the driver on newer kernel versions, as I have absolutely zero experience with such low-level driver engineering. After wasting countless kilowatts of electricity, I got the driver to compile and successfully load to the kernel.  

The driver worked and the modem successfully connected! Tho, just connecting wasn't going to cut it for me, I wanted to continue the adventorous streak from yesterday and get at least *something* more than a basic IP link.  

That's when I started digging, and I found [a document](https://www.data.proidea.org.pl/plnog/12edycja/day2/track4/01_ipv6_implementation.pdf) describing Orange's (who is my mobile operator of choice) technicals behind IPv6 on their mobile network.  I then out of curiosity changed my APN from `internet` to `internetipv6`, expecting IPv4 to still work, however, I was flabbergasted when I saw a public IP address in the inet field of `ip a`.  

Then I messaged one of my friends, [mily](https://mily.ovh), what's up with that, long story short, he told me about some tunelling I had to do. Well, in that document they state about the presence of IPv4v6 xLAT in their network.  

Then it hit me, I needed to translate my v4 packets to v6 on *my* machine for it to work. I found [clatd](https://github.com/toreanderson/clatd), which fit my usecase perfectly. I then did a little bit of systemd tomfoolery and now I have an easy to setup and stable IPv4 and IPv6 LTE-based link on my mobile workstation. Lovely!  

I became a bit fed up of going to the terminal every time I wanted to connect to mobile internet, and I didn't feel like leaving it on all the time was a great idea since I'm very much concerned about the battery life on my machine. I then started digging, and pretty quickly ruled ModemManager integration out, as I kind of liked the indie nature and raw exposure to the things happening to my packets, but I still wanted an easy toggle. Then it hit me, during my initial research I came across [this Github issue](https://github.com/xmm7360/xmm7360-pci/issues/246) on the [xmm7360-pci repo](https://github.com/xmm7360/xmm7360-pci). It claimed to fix all my issues! I use GNOME and find the control center handy, so this was perfect. I kanged the project and modified it, just *slightly*, to work with my existing setup, added Orange Poland's MNC and MCC to the csv file and voila, now I have a working LTE toggle in my control panel!  

I still wasn't fully satisfied, being fascinated with all things radio I kinda wanted to get GPS up and running. The only known way to do that is on Windows, where I spent a total of **three hours** wasting my time on all the drivers which didn't install automatically for some reason, then to discover the Maps app I wanted so badly isn't even there and even after installation fails to find my location.  

So there I am again, spending another three hours, this time installing Windows 11 Enterprise IoT LTSC or whatever it's called, along with all the useless security updates and drivers, just to then fight with the App Installer to get Maps to install and to find out it only fetched the location from my IP, which was off by a mere 100 kilometers.  

I then went on a side tangent and got the LTE connection set up and running, it worked the same as on Linux btw, only difference being that it's native.  

But then, randomly, in some sketchy app I got from the Microsoft Store it showed up with more precise coordinates than ever, I looked at the source, and it showed... **Satellite**. Success!!  

While on Windows I managed this modem can also receive SMS, not sure about sending them as I don't have cash on my card at the moment, but receiving sure does work. Windows shows all of these messages as "operator messages", even tho I had my friends send me texts, so that's not really the operator, or is it?

### LTE modem — part two

A few days have passed and I've been happily using the modem under Linux as my backup Internet uplink in case my ISP decided to fail me.

It was right as I was trying to upload [Live Store](https://store.live.net.co) version 1.4.2.0 to the public that tragedy struck. Before, I had updated my kernel, as I have started using the regular kernel package from Arch after submitting [my patch](#mute-leds). But now my laptop won't boot past GRUB, with an immediate kernel panic.

So I started diagnosing, the first thing that came to mind, my LTE modem setup, was absolutely correct. I have blacklisted the `xmm7360` module using `module_blacklist=xmm7360` as my kernel parameter and... the system booted. Do note that my modem was still working even after blacklisting the module(!)

I then completely forgot about the issue at hand only to discover it the next day when I went to turn on my laptop. 
I then went ahead to remove the problematic module, which in my case was via DKMS, so `xmm7360-pci-spat-dkms-git`, but it said to also remove `xmm7360-pci-spat-utils-git`, so I did...

Little did I know that second package contained my modified to hell `open_xdatachannel.py` file and the systemd service I used to start it. I said "no biggie, I'll just redownload it". Boy was I wrong.

I then downloaded it again, set it up like I thought I have, but... it wouldn't get an IPv6 address. My debugging even went to the point of downloading a Fedora 44 live ISO and booting off it to find IPv6 working.

What I didn't know at the time, was that before the whole incident has happened, I was using the `iosm` driver ALL THAT DAMN TIME. So after it working on Fedora and not Arch again, I have read up on [the Github issue](https://github.com/xmm7360/xmm7360-pci/issues/222) I have used to set it up on Fedora initially, to then discover this *one little line*:

> I found that the `open_xdatachannel.py` script actually works with the mainline kernel's `iosm` module because the script can pick up the `/dev/wwan0xmmrpc0` device and initialize the modem from there. Hence, no further kernel changes are required - all changes required are now in ModemManager, see https://gitlab.freedesktop.org/mobile-broadband/ModemManager/-/issues/612#note_1700608.

Then it struck me, what if I was using `iosm` all the time?  
I rushed to my terminal and ran
```
sudo rmmod xmm7360
sudo insmod iosm
sudo insmod /usr/lib/modules/7.1.4-arch1-1/kernel/drivers/net/wwan/iosm/iosm.ko.zst
```
With that second command failing, of course. I ran the `open_xdatachannel.py` file again, and... IT WORKED!! I had working IPv6 again.

But I wasn't going to give up this easy now, so I went in the config and enabled DBus. To my absolute amazement and surprise (I literally jumped out of my chair in disbelief) it showed an active connection in GNOME Control Center!!!! I'm flabbergasted even writing this a few hours later, and I'm using the modem connection right now.

One caveat of this DBus integration is the fact you can't really get IPv6, which is what led me down this path in the first place. But I had to pick my poison and ultimately wanted to see the signal strength and "Cellular" in my settings and have its power properly managed rather than IPv6 which makes my Internet barely faster yet I still don't have it at home so it's a bummer.

Hope this might help somebody someday, if anyone's here for the code I used, it's up on [MARMAK's Git instance](https://git.marmak.net.pl/Kierownik223/xmm7360-pci).

### Backstory

One day my bag fell off a table, and in that bag was my old laptop [EliteBook](elitebook). Some plastics broke, but I decided to glue it back together.  
All was good until one day that decided to break too. That's when I decided to start looking for a new laptop under 1000 zł (somewhere in the US$250 range).  
I originally was going for a ThinkPad X280, but for the same price as that I found this; metal, 3 Intel generations newer, more upgradeable and (most important for me) HP laptop.  
I asked my dad if 759 zł was a good price for an 11th gen Intel, and he said hell yeah, so he bought me this laptop.  
I've been happy with it ever since I got it in February, 2026.
