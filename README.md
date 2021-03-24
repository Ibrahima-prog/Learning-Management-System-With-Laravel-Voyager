

# Learning-Management-System-With-Laravel-Voyager
Using laravel voyager to crate a basic learning management system on laravel

This project is a learnnig management system designed on laravel voyager admin panel

It is mostly focused on the back-end functionalities, so it has a very basic front-end that you can modify however you want.

As reference i used this very good tutorial on youtube from "Laravel Daily" youtube channel, where he used another admin panel called "Laravel Quick Admin Panel"

Here is a link to the playlist of the tutorial: https://www.youtube.com/playlist?list=PLdXLsjL7A9k0NlUGL9M7ah9Fnvo3HybRl

  [lms_template.zip](https://github.com/Ibrahima-prog/Learning-Management-System-With-Laravel-Voyager/files/6198586/lms_template.zip)

Here are some Details:

1. Database: 
 
 1.1 Important Tables:
   
    a. Users
    b. Courses
    c. Lessons
    d. Tests
    e. Questions
    f. Questions Options
  1.2 Relationships: (All Many to Many)
  
    a. Users - Courses
    b. Courses - Lessons
    c. Lessons - Tests
    d. Tests - Questions
    e. Questions- Options
    
  1.3 Migrations:
  
    BE CAREFUL with migrations.
    All migrations are created but laravel voyager also have its own migrations, so put yours in a different folder
    and call it from that path or folder.
    Try not to mess around voyager's tables or backup the database before refreshing for example.
    
  1.4 Seeders:
      
      The Courses created will all be synced to the admin (you can change that in the CoursesSeeder.php)
      Use The CoursesSeeder.php that i created to make:
      5 Courses, each have
      5 Lessons, each have
      1 Test, each have 
      5 Questions, each have
      4 Options.

2. Structure And Functionalities:
  
  a. Users:
    
    There are 3 type of users (Admin, Teacher and Student)
    The admin have all permissions and can change the permissions of other users, he can also modify the admin panel.
    The teacher have permission to access the following (dashboard, courses, lessons, tests, questions and options).
    The student cannot access the admin only the front-end.
    
  b. Courses:
    
    Can only be created by the admin.
    Can only be edited, seen, browsed or deleted by the admin and the teacher affiliated with the course.
    After buying a course a student can rate it.
    Ratings are calculated and appear on the home page.
  
  c. Lessons:
   
    Can be created by admin and teacher.
    Can only be edited, seen, browsed or deleted by the admin and the teacher affiliated with the course.
    Only published lessons are displayed at the front end, the rest will remain hidden.
    There are free and paid for lessons, free lessons are accessible to all, their tests too but to access the other lessons,
    you will have to pay (i used stripe for testing purpose, use your own stipe key :)).
    Non purchased lessons will not display the description.(will ask to buy the course first)
    
  d.Tests:
   
    Can be created by admin and teacher.
    Can only be edited, seen, browsed or deleted by the admin and the teacher affiliated with the course.
    They are available on free lessons and have scores that will be displayed after you submit the test.
    For paid for lessons they are available after the purchase
  e. Questions:
  
  
    Can be created by admin and teacher.
    Can only be edited, seen, browsed or deleted by the admin and the teacher affiliated with the course.
    Available on free lessons
  f. Options:
  
    The options of the questions
    Can be created by admin and teacher.
    Can only be edited, seen, browsed or deleted by the admin and the teacher affiliated with the course.
    Available on free lessons
    Only 4 questions available by questions (you can change it in the code)
    
  Here is an sql dump file:
