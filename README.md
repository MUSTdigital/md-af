# MD Ajax Forms

## Description
MD Ajax Form is a simpliest way to ajaxify any html form on any Wordpress powered site.
Just add a `mdaf` class to any form and it will be ajaxified like totally!
Thanks to [Wordpress Plugin Boilerplate](https://github.com/devinvinson/WordPress-Plugin-Boilerplate/) for a starting point!

## Installation and usage
1. Install like any other plugin.
1. Add class `mdaf` to any form.
1. Profit.

This plugin is on a development stage and currently has quite a few options.

## Possibilities
1. Ajaxify any standart html form (which can be submitted, I mean, which generates the 'submit' event).
1. Save the submission to the DB as a post in the custom post type "Submissions".
1. Send email to the administrator.

## Changelog
##### 0.1.1
* TGM Plugin Activation (MD YAM will be needed for some additional features)
* Added success and fail events.
##### 0.1.0
* Initial version


## Roadmap
### 1.0
- [ ] Individual and common options for all forms
  - [ ] SendTo email
  - [ ] Post type
  - [ ] Allowable field names (remember - frontend can be easily compromised)
  - [ ] Text templates (for subjects, email bodies etc.)
- [x] Custom events
- [x] Mail to admin on submit

## Licence
[GPLv2](http://www.gnu.org/licenses/gpl-2.0.html)
