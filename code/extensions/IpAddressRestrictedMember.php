<?php
class IpAddressRestrictedMember extends DataExtension
{
    public function updateGroups(&$groups)
    {
        // Filter out groups that aren't allowed from this IP
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
        $disallowedGroups = array();
        foreach ($groups as $group) {
            if (!$group->allowedIPAddress($ip)) {
                $disallowedGroups[] = $group->ID;
            }
        }
        if ($disallowedGroups) {
            $groups->where("\"Group\".\"ID\" NOT IN (" . implode(',', $disallowedGroups) . ")");
        }
    }
}
