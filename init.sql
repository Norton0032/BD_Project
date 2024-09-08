CREATE DATABASE IF NOT EXISTS `course`;
USE `course` ;

create table IF NOT EXISTS creator_course (
id_creator_course int(10) AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
patronymic varchar(100) NOT NULL,
phone varchar(12) NOT NULL,
email varchar(100) NOT NULL,
`login` VARCHAR(50) NOT NULL,
`password` VARCHAR(50) NOT NULL,
PRIMARY KEY (id_creator_course)
);

create table IF NOT EXISTS candidate_course (
id_candidate_course int(10) AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
patronymic varchar(100) NOT NULL,
phone varchar(12) NOT NULL,
email varchar(100) NOT NULL,
`login` VARCHAR(50) NOT NULL,
`password` VARCHAR(50) NOT NULL,
PRIMARY KEY (id_candidate_course)
);

create table IF NOT EXISTS lesson (
id_lesson int(10) AUTO_INCREMENT,
lesson_name varchar(100) NOT NULL,
lesson_place varchar(100) NOT NULL,
lesson_time datetime NOT NULL,
id_creator_course int(10) NOT NULL,
PRIMARY KEY (id_lesson),
FOREIGN KEY (id_creator_course) REFERENCES creator_course (id_creator_course)
);

create table IF NOT EXISTS attendance (
id_attendance int(10) AUTO_INCREMENT,
id_lesson int(10) NOT NULL,
id_candidate_course int(10) NOT NULL,
PRIMARY KEY (id_attendance),
FOREIGN KEY (id_lesson) REFERENCES Lesson (id_lesson),
FOREIGN KEY (id_candidate_course) REFERENCES Candidate_course (id_candidate_course)
);

create table IF NOT EXISTS job_application (
id_job_application int(10) AUTO_INCREMENT,
resume text NOT NULL,
id_candidate_course int(10) NOT NULL,
PRIMARY KEY (id_job_application),
FOREIGN KEY (id_candidate_course) REFERENCES Candidate_course (id_candidate_course)
);


create table IF NOT EXISTS renter (
id_renter int(10) AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
patronymic varchar(100) NOT NULL,
phone varchar(12) NOT NULL,
PRIMARY KEY (id_renter)
);

create table IF NOT EXISTS classroom (
id_classroom int(10) AUTO_INCREMENT,
address varchar(200) NOT NULL,
id_creator_course int(10) NOT NULL,
id_renter int(10) NOT NULL,
PRIMARY KEY (id_classroom),
FOREIGN KEY (id_creator_course) REFERENCES creator_course (id_creator_course),
FOREIGN KEY (id_renter) REFERENCES renter (id_renter)
);


create table IF NOT EXISTS provider (
id_provider int(10) AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
patronymic varchar(100) NOT NULL,
phone varchar(12) NOT NULL,
list_of_equipment text NOT NULL,
PRIMARY KEY (id_provider)
);
create table IF NOT EXISTS equipment (
id_equipment int(10) AUTO_INCREMENT,
technical_specifications text NOT NULL,
id_creator_course int(10) NOT NULL,
quantity int NOT NULL,
id_provider int(10) NOT NULL,
PRIMARY KEY (id_equipment),
FOREIGN KEY (id_creator_course) REFERENCES creator_course (id_creator_course),
FOREIGN KEY (id_provider) REFERENCES provider (id_provider)
);

create table IF NOT EXISTS expert (
id_expert int(10) AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
patronymic varchar(100) NOT NULL,
phone varchar(12) NOT NULL,
email varchar(100) NOT NULL,
PRIMARY KEY (id_expert)
);

create table IF NOT EXISTS question (
id_question int(10) AUTO_INCREMENT,
text_of_question text NOT NULL,
id_creator_course int(10) NOT NULL,
id_expert int(10) NOT NULL,
PRIMARY KEY (id_question),
FOREIGN KEY (id_creator_course) REFERENCES creator_course (id_creator_course),
FOREIGN KEY (id_expert) REFERENCES expert (id_expert)
);

