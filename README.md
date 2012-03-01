# Security Extras for SilverStripe

A loose collection of tools to further lock down a SilverStripe installation.

## Features

### Group-based IP Restrictions

Adds an "IP Addresses" whitelist to each Group record in the CMS interface,
which means the users in this group will just be considered a member
when they're logging in from the specified IP range.

### New Zealand E-Government Password Validator

A password validator which enforces specific rules around password length and complexity.
Will be enforced when a `Member` record is saved, through `Member->validate()`.
The underlying password validation is a core feature, so can be easily adapted
to other validation standards.

	:::php
	// in mysite/_config.php
	Member::set_password_validator('NZGovtPasswordValidator');

## Maintainers

 * Sam Minnée (sam at silverstripe dot com)

## Requirements

Requires SilverStripe 3.0 or newer.

## Related

You might also be interested in the [secure-files](http://www.silverstripe.org/secure-files/) modules
for SilverStripe, which allows permission control on files hosted through a SilverStripe installation.