<?php

global $lang;

$lang['en_US']['Security']['IPADDRESSES'] = 'IP Addresses';
$lang['en_US']['SecurityAdmin']['IPADDRESSESHELP'] = '<p>You can restrict this group to a particular 
						IP address range (one range per line). <br />Ranges can be in any of the following forms: <br />
						203.96.152.12<br />
						203.96.152/24<br />
						203.96/16<br />
						203/8<br /><br />If you enter one or more IP address ranges in this box, then members will only get
						the rights of being in this group if they log on from one of the valid IP addresses.  It won\'t prevent
						people from logging in.  This is because the same user might have to log in to access parts of the
						system without IP address restrictions.';