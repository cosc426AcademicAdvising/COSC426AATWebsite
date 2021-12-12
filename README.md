# Academic Planar

A web application that allows students to register for courses, view their progress towards graduation, view their major & minor plans/requirements, lookup advising information and more...<br/>

https://cosc426website.herokuapp.com

## Features
- [ ] Authentication
	- [x] User login/logout
	- [ ] Reset password
	- [x] Sign-up form
- [x] Dashboard overview
	- [x] Personal information
	- [x] Credit information
	- [x] Enrollment information
- [ ] Handle transfer student data
- [x] Show upcoming semester schedule based of four year plan
- [ ] Register for courses ([Program Planning Worksheet](https://www.salisbury.edu/academic-offices/advising-center/_files/Program_Planning_Worksheet.docx))
	- [x] Save draft
	- [ ] Submit with mail notification to advisor*
- [x] Recommend major courses available for a given semester according to student's progress
	- [x] Single major
	- [x] Double major
	- [x] Triple major
- [x] Show major(s) requirements and four year plan(s)
- [x] Show minor(s) requirements
- [x] Show student's courses history
- [x] Show general service information
	- [x] Advising
	- [x] Counseling Center
	- [x] IT/Library

## Tools Used
- PHP v5.2
- JavaScript
- jQuery v3.4.1
- CSS
- [RestAPI](https://github.com/quincden/COSC425AATRestAPI)
- [Heroku](https://cosc426website.herokuapp.com/)

### Dependencies
- rmccue/requests v1.8.1 see [composer.lock](composer.lock)

## [File Structure](files_structure.txt)
With the PHP framework, a routing class was implemented to help customize the application url link and also help decrease the excessive use of 'include' every where in the code. Its implementation can be found in `app/core/Router.php`.<br/>

Functions that were frequently used over the program to help pull information from the database and communicate with the API can be found in `app/resources/*`. Course related functions are in `CourseFunctions.php` and so on...<br />

All relative code that help define the website interface are located in `app/views/*`. <br />

The CSS and JS code for the files in the view folder can be found in `public/<css or js>/*`. Each css file is named after the view file it styles. <br />

An important thing to note is that `index.php` is always ran first before any other page. This is because of the rewrite rule in the `.htaccess` file. Without it, the program will not work.

## Future Goals
- Move to a Flask Framework
- Styling with Bootstrap
	- Mobile responsive
- Better message handling
	- errors
	- successful login/logout
	- last login time
	- failed/attemped logins
- Authentication
	- Temporarily lock an account after many failed logins
	- Logout inactive users

## Team
- Quincy Dennis
- Florent Dondjeu Tschoufack
- Brian Redderson
- Devin Schmidt
