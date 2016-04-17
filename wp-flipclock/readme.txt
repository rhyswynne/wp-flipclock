=== WP Flipclock ===
Contributors: rhyswynne
Donate link: https://www.winwar.co.uk/plugins/wp-flipclock/#donate
Tags: flipclock, jquery, clocks, timers, countups, countdown
Requires at least: 3.8.1
Tested up to: 4.4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Quickly and easily add a flipclock to your site’s posts and pages via a shortcode.

== Description ==

WP Flipclock is a plugin that allows you to quickly and easily add a flipclock to your site’s posts and pages via a shortcode.

The plugin allows you to count down or up from a specific date, as well as choose whether you count down days, hours or minutes.

To use the plugin in your site, all you need to add to the page is the `[flipclock]` shortcode. There are various attributes you can add as well:-

* **name** - Give the flipclock a name. Default is “flipclock”. If you have more than one flipclock on any page it’s useful to give them unique names.
* **countdown (True/False)** - Allows you to count down to a date (true), or count up from a date (false). Default is *false*.
* **date** – Any date string, formatted how you like, which the clock will count up from/down to. Default is *none*.
* **face (days/hours/minutes)** - The face of the clock. Default is hours. Options are:-

* days – Days : Hours : Minutes : Seconds
* hours - Hours : Minutes : Seconds
* minutes - Minutes : Seconds

* **lang** - Changes the language of the labels (days,hours,minutes,seconds). Supported languages: English, Russian, Spanish, French, German.
* **timezone** - Sets timezone for date. Now it shows the correct time before the event. The time zones have unique names in the form "Area/Location", e.g. "America/New_York".
* **seconds** - Hides|shows seconds in face-mode "days". 

*1 - shows seconds
*0 - hide seconds

This plugin uses the [Flipclock.js](http://www.flipclockjs.com) library from [ObjectiveHTML](https://www.objectivehtml.com/).

Further support and examples are on the [WP Flipclock Documentation](https://www.winwar.co.uk/documentation/wp-flipclock/?utm_source=description&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock) page.

= About Winwar Media =
This plugin is made by [**Winwar Media**](https://www.winwar.co.uk/?utm_source=aboutwinwarmedia&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock), a WordPress Development and Training Agency in Manchester, UK.

Why don't you?

* Check out our book, [bbPress Complete](https://www.winwar.co.uk/books/bbpress-complete/?utm_source=aboutwinwarmedia&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock)
* Check out our other [WordPress Plugins](https://www.winwar.co.uk/plugins/?utm_source=aboutwinwarmedia&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock), including [WP Email Capture](http://wpemailcapture.com)
* Follow us on Social Media, such as [Facebook](https://www.facebook.com/winwaruk), [Twitter](https://twitter.com/winwaruk) or [Google+](https://plus.google.com/+WinwarCoUk)
* [Send us an email](https://www.winwar.co.uk/contact-us/?utm_source=aboutwinwarmedia&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock)! We like hearing from plugin users.

= For Support =
We offer support in two places:-

* Support on the [WordPress.org Support Board](http://wordpress.org/support/plugin/wp-flipclock)
* A [priority support forum](https://www.winwar.co.uk/priority-support/?utm_source=forsupport&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock), which offers same-day responses.

= On Github =
This project is now on github, [you can view the repository here](https://github.com/rhyswynne/wp-flipclock). There are other versions, but this is the one I've put up, so where all the developmental will be tracked.

== Changelog ==
= 1.7.2 =
* Fixed bug in hidelabel not displaying (thanks [CInsights](https://github.com/CInsights/)).

= 1.7 =
* Added Responsiveness.

= 1.6 =
* Adds the ability to hide the labels.
* Add the ability to have a 24 hour and 12 hour clock

= 1.5.1 =
* Fixed a small bug that "countdown='false'" ends with a countdown. Allows people to specify no countdown and then still work.

= 1.5 =
* Now doesn't display negative time if the countdown has passed,.
* Fixed a bug where the clock was out dependant on timezones (thanks [gleave75](https://github.com/gleave75))

= 1.4 =
* Now allows two different clocks on the same page (if given different names).
* Added the "lang" Shortcode attribute to choose the languages.
* Added the "timezone" attribute to set the timezone for the date.
* Added the "seconds" attribute to hide/show seconds attribute which shows/hides the seconds.
* Upgraded to flipclock.js version 0.5.5.

A big thank you to Den Kalinin for a lot of the changes in this update.

= 1.3 =
* Rolled back to previous version of flipclock.js, as it caused issues. Will look at when I have time (patches welcome!)

= 1.2 =
* Upgraded to latest version of flipclock.js

= 1.1 =
* Fix display bug in TwentyTwelve

= 1.0 = 
* First Release on WordPress' official site

= 0.1 =
* First Private Release on Github & Plugin Official Site

== Installation ==
1. Upload the plugin (unzipped) into `/wp-content/plugins/`.
2. Activate the plugin under the “Plugins” menu.

== Found a Bug? ==
Any bugs found, please [contact us](http://winwar.co.uk/contact-us/?utm_source=foundabug&utm_medium=wordpressorgreadme&utm_campaign=wpflipclock).