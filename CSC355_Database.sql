DROP DATABASE IF EXISTS `CSC355_Capstone`;
CREATE DATABASE `CSC355_Capstone`;
USE `CSC355_Capstone`;


CREATE TABLE course_info (
  Courses INT,
  Course_Instructors VARCHAR(50) NOT NULL
);

INSERT INTO course_info (Courses, Course_Instructors)
VALUES
#125
(125, 'Pham'),
(125, 'Schwesinger'),
(125, 'Shim'),
(125, 'Zhang'),
#135
(135, 'Carelli'),
(135, 'Demarco'),
(135, 'Frye'),
(135, 'Hussain'),
(135, 'Pham'),
(135, 'Shim'),
(135, 'Tan'),
(135, 'Zhang'),
#136
(136, 'Carelli'),
(136, 'Demarco'),
(136, 'Frye'),
(136, 'Pham'),
#225
(225, 'Shim'),
(225, 'Zhang'),
#235
(235, 'Carelli'),
(235, 'Spiegel'),
#237
(237, 'Parson'),
(237, 'Schwesinger'),
(237, 'Spiegel'),
(237, 'Zhang'),
#242
(242, 'Carelli'),
(242, 'Frye'),
(242, 'Hussain'),
(242, 'Schwesinger'),
(242, 'Spiegel'),
(242, 'Tan'),
#253
(253, 'Pham'),
(253, 'Shim'),
#311
(311, 'Frye'),
(311, 'Shim'),
#328
(328, 'Frye'),
#341
(341, 'Frye'),
(341, 'Pham'),
(341, 'Shim'),
(341, 'Zhang'),
#343
(343, 'Hussain'),
(343, 'Parson'),
#354
(354, 'Demarco'),
(354, 'Hussain'),
(354, 'Parson'),
(354, 'Tan'),
#355
(355, 'Demarco'),
(355, 'Hussain'),
(355, 'Parson'),
(355, 'Tan'),
#356
(356, 'Hussain'),
(356, 'Shim');


