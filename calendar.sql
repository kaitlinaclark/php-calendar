/* ****************************************/ 
/* USAGE OF .SQL FILE */
/* https://stackoverflow.com/questions/17666249/how-to-import-an-sql-file-using-the-command-line-in-mysql 
    (1) Create user
create user calendar identified by 'calendar123';
use mysql;
UPDATE mysql.user SET Host='localhost' WHERE Host='%' AND User='calendar'; 
grant all privileges on calendar.* to 'calendar'@'localhost' identified by 'calendar123' with grant option;
FLUSH PRIVILEGES;

    (2) import .sql file
mysql -u calendar -p calendar < calendar.sql
/*****************************************/

/*create tables*/
use calendar;

/*USERS = first and last name of user, username, password*/
CREATE table users
( user_id mediumint unsigned NOT NULL auto_increment,
	first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    primary key (user_id)
) engine = InnoDB default character set = utf8 collate = utf8_general_ci;

/*EVENTS = event title (title), date (assoc_date), time, way to reference user (user_id)*/
CREATE table events
( event_id mediumint unsigned NOT NULL auto_increment,
    user_id mediumint unsigned NOT NULL,
	title text NOT NULL,
    assoc_date date,
    assoc_time time,
    primary key (event_id),
	foreign key (user_id) references users (user_id)
) engine = InnoDB default character set = utf8 collate = utf8_general_ci;

/*CREATIVE PORTION*/
/*SHARED_EVENTS = reference to current user (current_user), reference to person event is being shared with (shared_with), reference to shared event (event_id)
CREATE table shared_events
( share_event mediumint unsigned NOT NULL auto_increment,
    user mediumint unsigned NOT NULL,
    shareUsername VARCHAR(100) NOT NULL,
    event_id mediumint unsigned NOT NULL,
    primary key (share_event),
	foreign key (user) references users (user_id),
    foreign key (event_id) references events (event_id)
) engine = InnoDB default character set = utf8 collate = utf8_general_ci;

/*SHARED_CALENDARS = reference to current user (current_user), reference to person calendar is being shared with (shared_with)
CREATE table shared_calendars
( share_calendar mediumint unsigned NOT NULL auto_increment,
    user mediumint unsigned NOT NULL,
    shareUsername VARCHAR(100) NOT NULL,
    primary key (share_calendar),
	foreign key (user) references users (user_id)
) engine = InnoDB default character set = utf8 collate = utf8_general_ci;*/