# Assignment 2 & 3 - Build a scalable & full-stack app on Clouds
Lecturer: Nguyen Ngoc Thanh

Student name & ID: Le Nguyen Anh Tuan (s3574983), Do Quoc Toan (s3652979)

Summary: This assignment has accomplished some of the requirements which are settings admin and learner permissions.
For admin permission, an admin is able to CRUD words list and users list, in users list, an admin can CRUD the permission for
every users. For learner permission, a leaner is able to register for an account in order to login to the system,
learn random new words, and add words to words list. (Admin username: admin, password: admin || Learner username: tuanle, password: tuanle).
There are security functions in every files of this web application to deny any unauthorized access.
There are functions for checking the duplicate username and email and checking users' input.
In addition to assignment 3, learning new words sequentially function has been added to the application.
In order to switch between the two modes, learners/users have to finish the quiz before switching, without finished,
the application will force them learn the word all over again. Furthermore, the application is able to record sessions of learning,
and those records will be save every time they finished a word. Learners can view their owned records, while admins can view everyone's records.

Technology stack:
AWS EC2 hosting PHP running on Docker container for the front end.
AWS RDS using MySQL for the database.

How to use:

cd project-folder

sudo docker build -t app-name .

sudo docker run -d -p 90:80 app-name


[Deployed Link](http://ec2-54-255-234-168.ap-southeast-1.compute.amazonaws.com:90)

[GitHub](https://github.com/95tuanle/English-Learning-System)
