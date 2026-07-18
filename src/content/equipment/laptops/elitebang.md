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

### Backstory

One day my bag fell off a table, and in that bag was my old laptop [EliteBook](elitebook). Some plastics broke, but I decided to glue it back together.  
All was good until one day that decided to break too. That's when I decided to start looking for a new laptop under 1000 zł (somewhere in the US$250 range).  
I originally was going for a ThinkPad X280, but for the same price as that I found this; metal, 3 Intel generations newer, more upgradeable and (most important for me) HP laptop.  
I asked my dad if 759 zł was a good price for an 11th gen Intel, and he said hell yeah, so he bought me this laptop.  
I've been happy with it ever since I got it in February, 2026.
