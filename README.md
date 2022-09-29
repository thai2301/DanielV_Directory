Add county attribute to customer address, quote address, sales order address.
# Magento2 Directory

The extension allows you to manage geographic regions.  For each country, you can add the any region, whose name is based on a specific locale.

## Compatibility

Version | 2.4.*
--- | ---
Magento Community | :heavy_check_mark: 
Magento Enterprise | :heavy_check_mark:
Magento Cloud | :heavy_check_mark: |

## Install

#### Install via Composer (recommend)

1. Go to Magento2 root folder

2. Enter following commands to install module:

   For Magento CE (EE) 2.4.x

    ```bash
    composer require danielv/module-directory
    ```

   Wait while dependencies are updated.

#### Manual Installation

1. Create a folder {Magento root}/app/code/DanielV/Directory

2. Download the corresponding latest version

3. Copy the unzip content to the folder ({Magento root}/app/code/DanielV/Directory)

#### Completion of installation

1. Go to Magento2 root folder

2. Enter following commands:

    ```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy (optional)
    ```

This extension is distributed under the [Open Software License (OSL 3.0)](https://github.com/thai2301/DanielV_Directory/blob/master/LICENSE.md), and is thus open source software.

## Contribution

Want to contribute to this extension? The best possibility to provide any code is to open a [pull requests](https://github.com/thai2301/DanielV_Directory/pulls) on GitHub.
