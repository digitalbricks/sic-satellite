# Changelog Satellite
## v1.2.0
* added sat_TYPO3() for TYPO3, tested with 12.4.13

## v1.1.0
* added sat_PHPLIST() for phpList, tested with 3.6.14

## v1.0.0
* added ability to return phpinfo() if requested by SIC3
* switched to semver

## v0.27
**24.11.2023**
* added availabe system identifiers in PHP comment to be parsed by SIC3

## v0.26
**30.06.2023**
* added placeholders [YOUR_CONTACT_INFORMATION] and [YOUR_SECRET] wich can be auto-populated when generating a personalized satellite file using the SIC 3 interface (in development)
---

## v0.25
**26.10.2022**
* modified sat_PROCESSWIRE() for adding a debug mode hint "(Debug ON)" to sys_ver if ProcessWire debug mode is on beacuse this may be a security risk
---

## v0.24
**29.04.2022**
* modified sat_SHOPWARE6() for Shopware 6,tested with 6.10.1 – note that the function introduced in v0.20 does NOT return the correct version!
---

## v0.23
**17.09.2021**
* added sat_JTLSHOP_5() for JTL Shop 5, tested with 5.1.0
---

## v0.21
**14.07.2021**
* fixed fuction for Shopware 5, tested with 5.7.2
---

## v0.20
**29.09.2020**
* added sat_SHOPWARE6() for Shopware 6,tested with 6.3.1.1
---

## v0.19
**07.02.2020**
* added sat_LEPTON4() for LEPTON CMS since version 4,tested with 4.5.0
---

## v0.18
**23.01.2020**
* added sat_MODIFIEDSHOP() for modified eCommerce Shop,tested with 2.0.3.0
---

## v0.17
**02.08.2019**
* added sat_JTLSHOP() for JTL-Shop installations, tested with 4.06 (Build 9)
---

## v0.16
**29.03.2019**
* added sat_PIWIK() for PIWIK / Matomo installations, tested with 3.9.1
---

## v0.15
**28.03.2019**
* added sat_NEXTCLOUD() for NEXTCLOUD installations, tested with 14.0.4
---

## v0.14
**24.08.2018**
* changed `$wire->config->version()` to `$wire->config->version` in sat_PROCESSWIRE() because `$wire->config->version()` (with brackets) just returns _true_ starting in PW 3.110 (according to the API docs, the call without brackets is and was always the right one but former versions of PW returned the version number anyway)
---

## v0.13
**28.11.2017**
* added sat_JOOMLA15() for legacy Joomla! CMS version 1.5 (Thanks to contributor Olaf Buchheim)
---

## v0.12
**25.11.2017**
* added sat_CONCRETE5() for Concrete5 CMS, tested with 8.1.0 and 8.2.1
---

## v0.11
**24.11.2017**
* added sat_JOOMLA() for Joomla! CMS, tested with 3.6 and 3.8.2
---

## v0.10
**24.11.2017**
* added sat_BLACKCAT() for BlackCat CMS
* removed global $siteinfo from functions to prevent collisions
* with equal named variables in CMS includes
---

## v0.9
**24.11.2017**
* added sat_SHOPWARE for Shopware since version 5
* added sat_PAGEKIT for Pagekit since version 1 (Thanks to contributor "pictus")
---

## v0.8
**27.07.2017**
* added sat_LEPTON24() for LEPTON CMS since version 2.4
---

## v0.7
**03.03.2017**
* added sat_GETSIMPLE() for GetSimple CMS
---
## v0.6
**03.03.2017**
* added sat_MODX() for MODX Revolution
---

## v0.5
**03.03.2017**
* added sat_PROCESSWIRE() for ProcessWire
* added output for case STATIC
---

## v0.4
**03.03.2017**
* added sat_WBCE() for WebsiteBaker Community Edition
---

## v0.3
**03.03.2017**
* added sat_WORDPRESS() for WordPress
---

## v0.2
**03.03.2017**
* added sat_WB() for WebsiteBaker CMS