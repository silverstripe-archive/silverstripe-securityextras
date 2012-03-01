<?php
class IpAddressRestrictedGroup extends DataExtension {

	function extraStatics() {
		return array(
			'db' => array(
				"IPRestrictions" => "Text",
			)
		);
	}

	/**
	 * Returns true if the given IP address is granted access to this group.
	 * For unrestricted groups, this always returns true.
	 */
	function allowedIPAddress($ip) {
		if(!$this->owner->IPRestrictions) return true;
		if(!$ip) return false;
		
		$ipPatterns = explode("\n", $this->owner->IPRestrictions);
		foreach($ipPatterns as $ipPattern) {
			$ipPattern = trim($ipPattern);
			if(preg_match('/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)$/', $ipPattern, $matches)) {
				if($ip == $ipPattern) return true;
			} else if(preg_match('/^([0-9]+\.[0-9]+\.[0-9]+)\/24$/', $ipPattern, $matches)
					|| preg_match('/^([0-9]+\.[0-9]+)\/16$/', $ipPattern, $matches)
					|| preg_match('/^([0-9]+)\/8$/', $ipPattern, $matches)) {
				if(substr($ip, 0, strlen($matches[1])) == $matches[1]) return true;
			}
		}
		return false;
	}

	function updateCMSFields(&$fields) {
		$fields->findOrMakeTab('Root.IPAddresses', _t('Security.IPADDRESSES', 'IP Addresses'));
		$fields->addFieldsToTab(
			'Root.IPAddresses',
			array(
				new LiteralField("", _t('SecurityAdmin.IPADDRESSESHELP',"<p>You can restrict this group to a particular 
					IP address range (one range per line). <br />Ranges can be in any of the following forms: <br />
					203.96.152.12<br />
					203.96.152/24<br />
					203.96/16<br />
					203/8<br /><br />If you enter one or more IP address ranges in this box, then members will only get
					the rights of being in this group if they log on from one of the valid IP addresses.  It won't prevent
					people from logging in.  This is because the same user might have to log in to access parts of the
					system without IP address restrictions.")),
				new TextareaField("IPRestrictions", false, 10)
			)
		);
	}

	function updateFieldLabels(&$labels) {
		$labels['IPRestrictions'] = _t('Group.IPRestrictions', 'IP Address Restrictions');
	}
	
}