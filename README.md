Wdev test task

This plugin will show custom top bar on the website page based on the customer group.
Here some features on this plugin :
1. The plugin can be disable/enable from admin configuration
2. Content can be customized and use wyswyg editor
3. Content can be show based on the customer group (can select multiple customer groups for one content)
4. Validation to prevent customer group have double customer bar content.
5. Content can be set dynamically, it can be stored, edited and deleted
6. Work with cache like FPC
7. Plugin have no dependecies and portability with other extension, in other words you only need this plugin to make it running
8. Plugin support using blank or luma theme.

The technical approach used to build this plugin is create table using db_schema.xml to store custom bar content.
Form to manage custom bar in the admin using ui_component, and have own menu inside marketing menu.
Load config value using access to database and get customer group using httpcontext function so it will get actual value without clear cache.
to make it works with cache we using AJAX Request to load content and configuration, so event if cache still running the content will keep load latest and updated value.

to install plugin just 
- copy folder Wdevs/CustomBar on the app/code folder
- running command php bin/magento setup:upgrade
- running command php bin/magento setup:di:compile
- running command php bin/magento setup:static-content:deploy

Here is some screenshot

Configuration menu : 

<img src="https://i.ibb.co/C6bS0kG/Screen-Shot-2022-12-24-at-14-02-02.png" />

Manage custom bar content menu :

<img src="https://i.ibb.co/9Gpx3QD/Screen-Shot-2022-12-24-at-14-01-38.png" />

Custom bar list : 

<img src="https://i.ibb.co/2sNXx0b/Screen-Shot-2022-12-24-at-14-23-46.png" />

Custom bar content : 

<img src="https://i.ibb.co/4MGBDxD/Screen-Shot-2022-12-24-at-14-24-19.png" />

Result : 

<img src="https://i.ibb.co/92LcbWk/Screen-Shot-2022-12-24-at-14-45-23.png" />

Testing Environment : 

- PHP 7
- MySQL 5.7
- Magento 2.4.2

Thank you
