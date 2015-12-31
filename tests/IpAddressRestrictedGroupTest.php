<?php
class IpAddressRestrictedGroupTest extends SapphireTest
{
    
    public static $fixture_file = 'IpAddressRestrictedGroupTest.yml';

    public function testRestrictions()
    {
        $unrestricted = $this->objFromFixture('Member', 'unrestricted');
        $restrictedSingleIp = $this->objFromFixture('Member', 'restricted-singleip');

        $groupUnrestricted = $this->objFromFixture('Group', 'unrestricted');
        $groupSingleIp = $this->objFromFixture('Group', 'restricted-singleip');

        $this->assertContains($groupUnrestricted->ID, $unrestricted->Groups()->column('ID'));
        $this->assertContains($groupUnrestricted->ID, $restrictedSingleIp->Groups()->column('ID'));
        $this->assertNotContains($groupSingleIp->ID, $restrictedSingleIp->Groups()->column('ID'));

        $oldRemote = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
        $_SERVER['REMOTE_ADDR'] = '17.0.0.1';
        $this->assertContains($groupUnrestricted->ID, $unrestricted->Groups()->column('ID'));
        $this->assertContains($groupUnrestricted->ID, $restrictedSingleIp->Groups()->column('ID'));
        $this->assertContains($groupSingleIp->ID, $restrictedSingleIp->Groups()->column('ID'));
        $_SERVER['REMOTE_ADDR'] = $oldRemote;
    }
}
