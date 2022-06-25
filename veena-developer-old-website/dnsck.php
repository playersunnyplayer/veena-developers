<?php 

	$dnsbl_lookup = [
		/**/
        "all.s5h.net",
        "b.barracudacentral.org",
        "bl.spamcop.net",
        "blacklist.woody.ch",
        "bogons.cymru.com",
        "cbl.abuseat.org",
        "cdl.anti-spam.org.cn",
        "combined.abuse.ch",
        "db.wpbl.info",
        "dnsbl-1.uceprotect.net",
        "dnsbl-2.uceprotect.net",
        "dnsbl-3.uceprotect.net",
        "dnsbl.anticaptcha.net",
        "dnsbl.dronebl.org",
        "dnsbl.inps.de",
        "dnsbl.sorbs.net",
        "drone.abuse.ch",
        "duinv.aupads.org",
        "dul.dnsbl.sorbs.net",
        "dyna.spamrats.com",
        "dynip.rothen.com",
        "http.dnsbl.sorbs.net",
        "ips.backscatterer.org",
        "ix.dnsbl.manitu.net",
        "korea.services.net",
        "misc.dnsbl.sorbs.net",
        "noptr.spamrats.com",
        "orvedb.aupads.org",
        "pbl.spamhaus.org",
        "proxy.bl.gweep.ca",
        "psbl.surriel.com",
        "relays.bl.gweep.ca",
        "relays.nether.net",
        "sbl.spamhaus.org",
        "short.rbl.jp",
        "singular.ttk.pte.hu",
        "smtp.dnsbl.sorbs.net",
        "socks.dnsbl.sorbs.net",
        "spam.abuse.ch",
        "spam.dnsbl.anonmails.de",
        "spam.dnsbl.sorbs.net",
        "spam.spamrats.com",
        "spambot.bls.digibase.ca",
        "spamrbl.imp.ch",
        "spamsources.fabel.dk",
        "ubl.lashback.com",
        "ubl.unsubscore.com",
        "virus.rbl.jp",
        "web.dnsbl.sorbs.net",
        "wormrbl.imp.ch",
        "xbl.spamhaus.org",
        "z.mailspike.net",
        "zen.spamhaus.org",
        "zombie.dnsbl.sorbs.net",
        

        /*
        '0spam.fusionzero.com ',
		'all.s5h.net',
		'aspews.ext.sorbs.net',
		'backscatter.spameatingmonkey.net ',
		'bl.blocklist.de ',
		'bl.konstant.no',
		'bl.nosolicitado.org ',
		'bl.scientificspam.net ',
		'bl.spamcop.net ',
		'bl.suomispam.net ',
		'black.junkemailfilter.com ',
		'block.dnsbl.sorbs.net',
		'cbl.abuseat.org ',
		'dnsbl-1.uceprotect.net ',
		'dnsbl-3.uceprotect.net ',
		'dnsbl.dronebl.org',
		'dnsbl.kempt.net ',
		'dnsbl.sorbs.net',
		'dnsbl.tornevall.org ',
		'dnsrbl.swinog.ch',
		'dyna.spamrats.com',
		'exploit.mail.abusix.zone ',
		'hostkarma.junkemailfilter.com ',
		'ix.dnsbl.manitu.net ',
		'mail-abuse.blacklist.jippg.org',
		'multi.surbl.org ',
		'new.spam.dnsbl.sorbs.net',
		'old.spam.dnsbl.sorbs.net ',
		'problems.dnsbl.sorbs.net',
		'psbl.surriel.com ',
		'rbl.blockedservers.com',
		'rbl.interserver.net ',
		'recent.spam.dnsbl.sorbs.net',
		'rep.mailspike.net ',
		'sbl.spamhaus.org ',
		'socks.dnsbl.sorbs.net',
		'spam.dnsbl.sorbs.net',
		'spam.rbl.blockedservers.com',
		'spamlist.or.kr',
		'spamsources.fabel.dk ',
		'mail-abuse.com ',
		'torexit.dan.me.uk',
		'web.dnsbl.sorbs.net',
		'z.mailspike.net ',
		'zombie.dnsbl.sorbs.net',
		'access.redhawk.org ',
		'all.spamrats.com',
		'b.barracudacentral.org ',
		'bb.barracudacentral.org ',
		'bl.drmx.org',
		'bl.mailspike.net ',
		'bl.rbl.scrolloutf1.com ',
		'bl.score.senderscore.com ',
		'bl.spameatingmonkey.net ',
		'bl.worst.nosolicitado.org ',
		'black.mail.abusix.zone ',
		'cart00ney.surriel.com',
		'db.wpbl.info ',
		'dnsbl-2.uceprotect.net ',
		'dnsbl.cobion.com',
		'dnsbl.justspam.org ',
		'dnsbl.net.ua',
		'dnsbl.spfbl.net',
		'dnsbl.zapbl.net ',
		'dul.dnsbl.sorbs.net',
		'escalations.dnsbl.sorbs.net',
		'fnrbl.fast.net ',
		'http.dnsbl.sorbs.net',
		'ips.backscatterer.org ',
		'l4.bbfh.ext.sorbs.net',
		'misc.dnsbl.sorbs.net',
		'netscan.rbl.blockedservers.com',
		'noptr.spamrats.com ',
		'pbl.spamhaus.org ',
		'proxies.dnsbl.sorbs.net',
		'rbl.abuse.ro',
		'rbl.dns-servicios.com',
		'rbl2.triumf.ca ',
		'relays.dnsbl.sorbs.net',
		'safe.dnsbl.sorbs.net',
		'smtp.dnsbl.sorbs.net',
		'spam.dnsbl.anonmails.de',
		'spam.pedantic.org ',
		'spam.spamrats.com ',
		'spamrbl.imp.ch ',
		'st.technovision.dk ',
		'talosintelligence.com',
		'truncate.gbudb.net ',
		'xbl.spamhaus.org',
		'zen.spamhaus.org',
		*/
    ];

    $resp = [];
    $VALID = false;

	if (isset($_GET['check_ip'])){

		$CONTROL_IP = '103.155.223.136';
		$reverse_ip = implode(".", array_reverse(explode(".", $CONTROL_IP )));
		$control_host = 'pbl.spamhaus.org';

		if (checkdnsrr($reverse_ip . "." . $control_host . ".", "A")) {
			$VALID = true;
		}
		

		if( $VALID ){
			
	        foreach ($dnsbl_lookup as $host) {

	        	$host = trim($host);

	        	/*

	            if (checkdnsrr($_GET['check_ip'] . "." .  $host . ".", "A")){
	            	$resp[$host] = true;
	            }else{
	            	// $resp[$host] = false;
	            }
				*/

				// METHOD 1
				if( empty( $_GET['m'] ) ){

					$reverse_ip = implode(".", array_reverse(explode(".", $_GET['check_ip'] )));

					if (checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
						$resp[$host] = true;
					}

				}

				// METHOD 2
				if( !empty( $_GET['m'] ) && $_GET['m'] == 5 ){

					$reverse_ip = implode(".", array_reverse(explode(".", $_GET['check_ip'] )));

					$lookup = $reverse_ip . "." . $host;

					if ($lookup != gethostbyname($lookup)) {
						$resp[$host] = true;
					}

				}


			}

		}

    }

    echo json_encode([
    	"code" => 200,
    	"valid" => $VALID,
    	"data" => $resp,
    ]);
