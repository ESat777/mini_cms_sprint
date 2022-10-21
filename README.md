

# Mini CMS Project
Content Management System

### Functions

1. Create page .
2. Update page name and content .
3. Delete page.
4. Login to admin panel.
5. Mini web site.

#### About project

* This project was created using:
            `PHP OOP`
            `MySQL`
            `HTML`
            `CSS` 
            `Bootstrap`
            `Composer`
            `ORM Doctrine`
            
  ![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/login.png)


    ![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/admin.png)
    ![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/edit.png)
    ![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/home.png)
    
    

### Installiation

1. First you need to have XAMPP and MYSQL workbench.

2. In XAMPP control panel start Apache and MySQL

![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/P5.png)

3. Clone the repository files `https://github.com/ESat777/mini_cms_sprint.git`


4. Cloned project folder paste to xammp/htdocs.
   

5. This app requires you to have `Composer` and `Doctrine` installed:
   - Install [Composer](https://getcomposer.org/download/) 
   - Go to the downloaded app folder and run this command in terminal
   - `php ../composer.phar install`
   - To install `Doctrine` run this command in terminal 
   - `php ../composer.phar require doctrine/orm`,
   - `php ../composer.phar require symfony/cache `
   - `php ../composer.phar dump-autoload`

6. Open MySQL workbench and connect.

![alt text](https://github.com/ESat777/mini_cms_sprint/blob/main/Pictures/dat_import.png)

7. Next steps:
   
   Server -> Data Import -> Import from Self-Containet File (choose:database_dump.sql) -> Default target schema (new - "sprint3") -> Start Import

8. Open the path where you can launch php interpreter, e.g.: `http://localhost/mini_cms_sprint/home`

9. Open the CMS Admin panel. Path : `http://localhost/mini_cms_sprint/admin`

10. Username: `Patestuojam`; Password: `1234`;



