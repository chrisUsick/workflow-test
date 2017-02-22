# Bored Game Geek

*Note: code copied from [stungeye-RRC](https://github.com/StungEye-RRC/boredgamegeek)*  

Simplified PHP clone of the [Board Game Geek Website](https://boardgamegeek.com/https://boardgamegeek.com/).

This website is a framework-less Content Management System (CMS) implemented in PHP.

My goal was to create a CMS that can be understood by novice programmers using [php.net](http://php.net) as their only resource.

## Directory Structure

* css - All stylesheets will go here.
* db - A home for the most recent SQL dump of all database tables.
* includes - Helper php files go here.
* js - All javascript will go here.
* partials - Template php files go here.

## Build the database

Create database:  

```mysql
create database boardgamegeek;
```

Import the script from the terminal:  

```bash
mysql -u root -p boardgamegeek < boardgamegeek.sql
```

## Project info

### Creating a new page

Follow the example for existing pages. If additional functionality is needed create a file in the `includes/` directory and add it to `includes/includes.php`.  

### Contributing

 1. Fork
 2. Create feature branch, code
 3. run `rake bump:revision`
 4. Make a pull request

