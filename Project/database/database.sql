create database if not exists course_system;
use course_system;

create table courses (
    id int auto_increment primary key,
    title varchar(100) not null,
    description text not null
);

create table students (
    id int auto_increment primary key,
    name varchar(100) not null,
    email varchar(100) not null unique
);

create table enrollments (
    id int auto_increment primary key,
    student_id int not null,
    course_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (student_id) references students(id),
    foreign key (course_id) references courses(id)
);

insert into courses (title, description) values
('Web Development', 'Learn the basics of HTML, CSS, JavaScript and PHP.'),
('Databases', 'Work with MySQL databases, tables and SQL queries.'),
('Docker Basics', 'Introduction to Docker, containers and Docker Compose.'),
('JavaScript Fundamentals', 'Learn the basics of JavaScript for web applications.'),
('PHP for Beginners', 'Learn server-side programming with PHP.'),
('UI Design Basics', 'Learn the basics of user interface and web design.');

