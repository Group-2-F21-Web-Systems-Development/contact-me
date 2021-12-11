# contact-me
A "Virtual Business Card" -- group 2's term project

**SETUP**
/src/contactme.sql is where you will find our database file. You are going to want to go into phpMyAdmin and create a database called `contactme`. Then, you can import the sql file mentioned above. We have created some users and groups to get you started (each group has different whitelisted social medias). That information can be found below. The last thing you need to know that can't be done on our site is how to make a user an admin. This can be done in phpMyAdmin by changing the is_admin column from 0 to 1 for the user you would like to be an admin. Admin privileges include creating, editing, and deleting groups.

Group passwords:
Weird Al: tDtaTXqHFfgfOCfg6Zsv
Stress Relief: kj6x5WTzdVjPRqIS5mdU
BSA Fashion Show: f2aCkINBfCxKhwOZYbk9
Nutcracker: LP7oAUmfXsM2SOO7G3rm
Festival of Trees: IaFc6BPwD3SK6pQdUzcx

Username: jfilawo
Password: orangeplus
What’s your favorite movie? John Q

Username: silloc
Password: lsadfjlsnf;lsdnf;djfs
What’s your favorite movie? cars

Username: bartha
Password: sdfnskdsdf89nflkdsf
What sport did you play growing up? Lucia


**Navigating Our Website**
    Our group, JAC, created a website called ContactMe, which is a virtual business card that makes networking and saving contacts with people you meet at events very easy. The way our website works is that if you want to host an event using ContactMe, you will have to sign up on our page to create a username and password for your event. The group password will be entered by users to join a group. Attendees of a group will have to create an account on ContactMe so that they can join a group (also known as an event) using the password they were given by the group admin.
	
    When attendees create their account, their profile page will include their first name, last name, their social media, and the option to upload a profile picture. The picture size limit is 500,000 bytes (.5 MB/500 KB). There is also a link called “edit,” allowing users to make changes to their profile page. Once users make their changes, there will be a button on the bottom right called “save,” allowing all the changes to show on their profile page. 

    When a user logs in, there will be a group page listing all of the events he/she attended. On the groups page, users can click on an event they attended and once users click on an event/group, they will be taken to a page providing a description of the event, as well as a list of attendees for that event. The list of attendees will give users the opportunity to get in contact with people that were at the event, mainly those where they could not save or find their contact. When users click on an attendee’s profile page, their first name, last name, and social media will be provided (only those which were allowed by the group's whitelist). 

    When admins want to create a group, they must provide a title, description, whitelist of social medias, and an image of the event. When admins create a group, they still have the option of editing all of these attributes as well as deleting.

**Frontend (HTML, CSS, and Javascript, JSON/AJAX)**
   For the frontend part of our website, we wanted to make sure that the color theme was consistent on all pages, and users will see that we chose purple. We used different shades of purple with unique background images on the profile, logout, sign up, and edit pages. We made sure to include headers indicating the page the user is on, making it easier to navigate through our website. We also used HTML to provide the input fields for the following pages: login, sign up, edit page, create group page, and edit group page, so that users can input text. 

**Backend (PHP and mySQL)**
	For the backend part of our website, we are storing all the user information and group information in mySQL and using PHP to connect with and send queries to the database. 

    On the groups page where all of the list of groups joined, will show a list of the attendees, so people can connect with people after events. 

**Difficulties**
    When trying to put together the pages (profile, logout, sign up, and edit pages) where users had to input text in the fields, we had to make sure that that text area did not end up being the background image of the page. We had to make sure the background image would also fit the page and not be on the header area of our website. We searched for google images that would fit our purple theme and choose backgrounds that would appeal to our users. To avoid these errors and make sure the format of these pages were clean, we had to use chrome developer tools to look at the margins, to fix the alignment of the background images and the input fields, Other problems we ran into was allowing users to upload images when creating an account or making edits to their profile or groups page. 

**Future Plans**
    As of now, the only way a user can make themselves an admin is through phpmyadmin, but in the future we want users to be able to make themselves admins when they create an account. We want to also create QR codes that will provide the password for these groups. Lastly, we would like attendees of events to be able to follow each other and make friends with people they want to stay in contact with. 