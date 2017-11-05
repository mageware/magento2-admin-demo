# Admin Demo

Magento 2.x CE module for accessing admin in demo mode.

## Installation Instructions

1. Use composer to download the module:

   ```
   composer require mageware/magento2-admin-demo
   ```

2. Enable downloaded module:

   ```
   php bin/magento module:enable MageWare_Common MageWare_AdminDemo
   ```

3. Upgrade your database:

   ```
   php bin/magento setup:upgrade
   ```
