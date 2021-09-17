# SIC Satellite
**This is the satellite PHP script for Site Info Center. In order to receive data from the SIC Satellite, you need Site Info Center:**

* [Site Info Center 2](https://github.com/digitalbricks/siclight2) (recommended)
* [Site Info Center 1](https://github.com/digitalbricks/siclight)

Please note the configuration process as described in the repositories of [Site Info Center 2](https://github.com/digitalbricks/siclight2) or [Site Info Center 1](https://github.com/digitalbricks/siclight).


### Currently supported CMS

| System identifier | CMS / System                                  | available since satellite version |
|-------------------|-----------------------------------------------|-----------------------------------|
| STATIC            | (static site, just return PHP version)        | v0.1                              |
| LEPTON            | Lepton CMS, below version 2.4                 | v0.1                              |
| WEBSITEBAKER      | WebsiteBaker                                  | v0.2                              |
| WORDPRESS         | WordPress                                     | v0.3                              |
| WBCE              | WBCE                                          | v0.4                              |
| PROCESSWIRE       | ProcessWire                                   | v0.5                              |
| MODX              | MODX Revolution                               | v0.6                              |
| GETSIMPLE         | GetSimple CMS                                 | v0.7                              |
| LEPTON24          | Lepton CMS, since version 2.4                 | v0.8                              |
| SHOPWARE5         | Shopware, since version 5                     | v0.9*<sup>1</sup>                              |
| PAGEKIT           | Pagekit, since version 1                      | v0.9                              |
| BLACKCAT          | BlackCat CMS, 1.x series                      | v0.10                             |
| JOOMLA            | Joomla! CMS, tested with  3.6 & 3.8.2         | v0.11                             |
| CONCRETE5         | Concrete5 CMS, tested w. 8.1.0 & 8.2.1        | v0.12                             |
| JOOMLA15          | legacy Joomla! CMS v1.5                       | v0.13                             |
| NEXTCLOUD         | NextCloud                                     | v0.15                             |
| PIWIK             | PIWIK / Matomo, tested with 3.9.1             | v0.16                             |
| JTLSHOP4          | JTL-Shop 4, tested with 4.06 Build 9          | v0.17                             |
| MODIFIEDSHOP      | modified eCommerce Shop, tested with 2.0.3.0  | v0.18                             |
| LEPTON4           | Lepton CMS, since version 4.x                 | v0.19                             |
| SHOPWARE6         | Shopware, since version 6, tested with 6.3.1.1| v0.20                             |
| MOODLE            | Moodle, tested with 3.10.1                    | v0.21                             |
| JTLSHOP5          | JTL-Shop 5, tested with 5.1.0                 | v0.23                             |

**Notes:**
* *<sup>1</sup> Function for Shopware 5 had a bug until v0.22 of the satellite where a wrong version number was returned for Shopware 5.6.x and above. Please consider upgrading the satellite to at least v0.22 if you encountered that issue.

## Configuration: Satellite 
Place a copy of the `satellite.php` in the root directory of all your configured sites via FTP.  Update the `$sat_secret` in the satellite to the one you configured for the corresponding site in SIC (don’t use the same secret across all your sites!) and make sure the satellite has a function for your CMS (if not, read the section “Add further CMS functions to satellite”). You are done.

Try hitting the refresh button next to a site in SIC or the _Refresh All_ button on top right and check if the SIC gets information from the satellite(s).

## Add further CMS functions to satellite
The satellite script comes with a handful functions for getting version info from CMS I was using or I am still using  - at the time of writing this is MODX Revolution, ProcessWire, WordPress and some small, mostly only known in Germany, CMS like WebsitBaker, LEPTON and WBCE (formerly WebsiteBaker Community Edition, now Way Better Content Editing). But you may extend the satellite for the CMS you use and you could also remove functions for CMS you don’t.

The satellite script is quite easy to understand: After checking that the shared secret provided from SIC matches that one set in the satellite, a simple `switch` functions checks the `sys` string provided from SIC an determines which function to be run.

So if you want to add your CMS, just write a new function, deliberate a `sys` string (system identifier) and add both to the `switch` function of the satellite. Afterward you can use your new imagined `sys` string when configuring sites in `config-sites.php` in SIC and the satellite will run your new function.
