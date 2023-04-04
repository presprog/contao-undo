# Improve the restore section of Contao Open Source CMS

> 📢This extension was originally developed to *research out in the open* how to improve the Contao core restore module. After many years of not working on this topic, [we improved the undo module in Contao 4.13](https://github.com/contao/contao/pull/3498). Since this is the latest LTS now we recommend you to upgrade your installations and enjoy the revamped undo module. This extension is therefore obsolete. 

This extension improves the restore section of Contao by providing more semantic information regarding the deleted elements. The existing core view only provides rather technical information, i.e. the table name the deleted element was stored in and the corresponding sql query. This might be a hurdle to many editors.

![Screenshot of the improved restore section](contao-undo-screenshot.jpg?raw=true)

## Installation

Install the bundle via Composer:

```
composer require presprog/contao-undo
```
