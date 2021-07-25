# Home_Grown
A home culture management system
=====
Home grown is a simple app intending to provide guidance for plants and veggies home cultures.
The user sets the information for each type of plants he will be growing (info such as needed light per day, or PH of the soil..) regarding the different stages of the culture (from sprout to flowering), then he will start a new culture on the app and get daily reports on his plant needs so that they grow big and strong.
It is a Symgony 5 app and in order to work properly after cloning this repo and setting a ```.env.local``` file with its db information the following commands should be run in a terminal :
``` 
$ composer install
$ yarn install
$ yarn encore dev
$ php bin/console d:d:c
$ php bin/console d:m:m
$ php bin/console server:start
```
Also included in the repo is a mysql ```home_grown.sql``` demo ddb if you want to test it out without adding plants details or anything.
Hope you will enjoy the app!

![alt text](https://i.ibb.co/j6HHzL5/homeg.png)
