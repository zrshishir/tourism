Installation: 
Installation Process
Creating a new database into your server
Unzip the downloaded folder
Copy the files inside the zip folder : HRrequest into your server
The auto web installer will start
Follow on-screen instructions to finish the installation.
Enter your database settings
Press the "Install" button.
That's it!
Installation with apache

Make a virtual host pointing to your-project-directory/public
       <VirtualHost *:80>

            ServerName marketing.your-domain.com
            DocumentRoot "/home/user/hrrequest/public"
            Options Indexes FollowSymLinks

            <Directory "/home/user/email-marketing/public">
                AllowOverride All
                Require all granted
            </Directory>

        </VirtualHost>

Installation with Nginx

Make a virtual host pointing to your-project-directory/public
   server {
        listen 80;
        listen [::]:80;

        server_name hrrequest.your-domain.com;

        root /home/yourname/public_html/hrrequest/public;

        index index.php;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_read_timeout 15000;
        }      
    }

Creating a new database

Before Install you have to get ready your database first. Firstly, You have to create a new database before installing HRrequest in your mysql server. If you already know how to do this/or have already created one just skip to the next step. Your host will most likely be running phpMyAdmin as mysql manager, if that's the case here's a step by step guide (if not the proccess will be very similar on other managers). Login to your control panel, find and click phpMyAdmin link: Click on the database tab in the top menu, enter any name you like and click create




   

Uploading Files

After creating a database, unzpip the .zip file you donwloaded from CodeCanyon and upload the contents of HRrequest Login folder to your servers root folder (usually called www or html or something similar) or a sub-directory, shared hosting providers usually have a web based file manager, but you should use something like Filezilla to do the upload as the web based managers can cause various problems fairly often. Make sure that storage, bootstrap/cache and all the sub-folders are writable by your server (have 777 permissions if you are on shared hosting). You can change files and folders permissions by right-clicking them in the filemanager, clicking file permissions, and then entering 777 in the permissions field.


Installing HRrequest

After uploading ' HRrequest' files, simply open your site url and follow on-screen instructions to finish the installation.






Sotware Operation: 




First Registration after software installation will be super admin. After that all registration will be as user. Super admin have to give permission to the specific user as manager or hr in users module clicking edit button. Super admin can create manager/hr personnel and also can change any kind of actions. Activities can be shown only by the super admin.



Super admin can see all requests. Manage/hr also can see all requests but can change only their activities. Hr can change open to hr reviewed and manager can change hr reviewed to processed.

Users can see only their request, request status and make request. 



Request page for user


Activities page


Dashboard


