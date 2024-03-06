# quick tutorial
I will be giving a quick tutorial on the structure, website, code, etc in this README.


## page layout
```
Legend: '*' means it is included everywhere!

*[ HEAD ]       - loading styling, js, etc.
*[ HEADER ]     - navigation structure, cart, etc.
 [ MAIN ]       - here the main content is loaded like the products, overons text, etc.
*[ FOOTER ]     - here the footer content is loaded.
```


## structure
```bash
.
├── index.php
├── config
├── pages
├── src
│   ├── action
│   ├── class
│   ├── core
│   ├── inc
│   └── libs
└── webroot
    ├── js
    ├── styling
    ├── libs
    └── media
        └── products
```


## structure in-depth
### config
The config holds the configuration files like: app.php, app.local.php.
Here you configure the configuration variables like the database, debug mode, etc.

### pages
Here you put the page files (ONLY INCLUDE THE MAIN PART (NO HEADERS OR FOOTERS)),
like the product list displayed or the text in the overons

### src
In this folder the php source files are found.
<b>PS: file names must be as following: `name[.]folder[.]php` (e.g. `Database.class.php`, `init.core.php`)</b>

#### action
This is for the html form actions.
Example: `<form action="<?= $_PATHS['action'] ?>/addToCart.php" method="post">`

#### class
Here you will put all classes that will be autoloaded for each page (Like a database class).

#### core
In this folder the core files are stored like the init file.

#### inc
This is where the other files are supposed to go that you would like to be able to include like: function files, handlers, etc.

#### libs
Here the libraries for the backend will go (mailing, payment, etc).

### webroot
All files stored in this directory will be the webroot, here you will find things needed for frontend.

#### js
All the javascript files go here.

#### styling
Styling files go here like css, less, etc.

#### libs
Here the libraries for the frontend will go (bootstrap, less).

#### media
The media folder is for things like documents, downloadable content, images (logo, product images), etc.
