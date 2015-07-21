=== Paid Memberships Pro - Better Logins Report ===
Contributors: strangerstudios
Tags: pmpro, paid memberships pro, reports, logins, visits, views, tracking, user tracking
Requires at least: 3.5
Tested up to: 4.2.2
Stable tag: .2.2

Adds login, view, and visit stats for "This Week" and "This Year".

== Description ==

Adds login, view, and visit stats for "This Week" and "This Year".


== Installation ==

1. Upload the `pmpro-better-logins-report` directory to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Visit the Memberships --> Reports page in your dashboard.

== Frequently Asked Questions ==

= I found a bug in the plugin. =

Please post it in the issues section of GitHub and we'll fix it as soon as we can. Thanks for helping. https://github.com/strangerstudios/pmpro-better-logins-report/issues

= I need help installing, configuring, or customizing the plugin. =

Please visit our premium support site at http://www.paidmembershipspro.com for more documentation and our support forums.

== Changelog ==
= .2.2 =
* Only loading reports/better-logins.php and functions if PMPro activated.

= .2.1 =
* Fixed some notices.

= .2 =
* Fixed issue where stats were not properly reset every week/month/etc if the user has not accessed the site recently. We are now checking and resetting values every time they are loaded on the reports page.
* Added pmproblr_getValues, pmproblr_trackValues, and pmproblr_getAllValues to better-logins, simplifying the code a bit.

= .1 =
* Initial version.
