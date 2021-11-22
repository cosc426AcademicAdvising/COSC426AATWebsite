# Academic Advising Tool

A web application that allows students to register for courses, view their progress towards graduation, view their major & minor plans/requirements, lookup advising information and more...

## Features
- [ ] Authentication
	- [x] User login/logout
	- [ ] Reset password
	- [ ] Sign-up form
- [x] Dashboard overview
	- [x] Personal information
	- [x] Credit information
	- [x] Enrollment information
- [ ] Handle transfer student data
- [ ] Show upcoming semester schedule based of four year plan
- [ ] Register for courses ([Program Planning Worksheet](https://www.salisbury.edu/academic-offices/advising-center/_files/Program_Planning_Worksheet.docx))
	- [ ] Save draft
- [x] Recommend major courses available for a given semester according to student progress
	- [x] Single major
	- [x] Double major
	- [x] Triple major
- [x] Show major(s) requirements and four year plan(s)
- [x] Show minor(s) requirements
- [x] Show student's courses history
- [ ] Show general service information
	- [ ] Advising
	- [ ] Counseling Center
	- [ ] IT/Library

## Tools Used
- PHP v5.2
- JavaScript
- jQuery v3.4.1
- CSS
- [RestAPI](https://github.com/quincden/COSC425AATRestAPI)
- [Heroku](https://cosc426website.herokuapp.com/)

### Dependencies
- rmccue/requests v1.8.1 see [composer.lock](https://github.com/quincden/COSC426AATWebsite/blob/main/composer.lock)

## File Structure

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
