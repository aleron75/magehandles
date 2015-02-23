# magehandles

Introduction
------------

A Magento Module that adds some useful layout handles

Installation
------------

You can install this extension in several ways:

**Download**

Download the full package, copy the content of the `src` directory
in your magento base directory; pay attention not to overwrite
the `app` folder, only merge its contents into existing directory;

**Modman**

Install modman Module Manager: https://github.com/colinmollenhour/modman

After having installed modman on your system, you can clone this module on your
Magento base directory by typing the following command:

    $ modman init
    $ modman clone git@github.com:aleron75/magehandles.git

**Composer**

Install composer: http://getcomposer.org/download/

Install Magento Composer: https://github.com/magento-hackathon/magento-composer-installer

Add the dependency to your `composer.json`:

    {
      ...
      "require": {
        ...
        "aleron75/magehandles": "dev-master",
        ...
      },
      "repositories": [
        ...
        {
          "type": "vcs",
          "url":  "git@github.com:aleron75/magehandles.git"
        },
        ...
      ],
      ...
      "extra": {
        "magento-root-dir": "<magento_installation_dir>/"
      }
      ...
    }

Then run the following command from the directory where your composer.json file is contained:

    php composer.phar install

or

    $ composer install

**Common tasks**

After installation:

* if you have cache enabled, disable or refresh it;
* if you have compilation enabled, disable it or recompile the code base.

Usage example
-------------

After installation the following handles will be added to frontend layout:

* Season Handles
    * `season_winter` - from December 1 to February 29;
    * `season_spring` - from March 1 and to May 31;
    * `season_summer` - from June 1 to August 31;
    * `season_autumn` - from September 1 to November 30

* Customer Handles
    * `customer_gender_male` - if Customer specified his gender
    * `customer_gender_female` - if Customer specified her gender
    * `customer_birthday` - if Customer specified his/her date of birth and it's his/her birthday
    * `customer_subscribed` - if Customer subscribed to the newsletter
    * `customer_not_subscribed` - if Customer didn't subscribe to the newsletter

License
-------
This extension is published under the [Open Software License (OSL 3.0)](http://opensource.org/licenses/OSL-3.0).

Any contribution or feedback is extremely appreciated.
