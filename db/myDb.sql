
/* Create the database*/
CREATE DATABASE blog;

/* This is my user table */
CREATE TABLE public.user
(
	user_id SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(100) NOT NULL,
	display_name VARCHAR(100) NOT NULL
);

/* This is my posts table */
CREATE TABLE public.posts
(
	post_id SERIAL NOT NULL PRIMARY KEY,
	user_id INT NOT NULL REFERENCES public.user(user_id),
	pDate DATE,
	title VARCHAR(100),
	body TEXT NOT NULL
);

/* This is my tags table which adds tags to my posts */
CREATE TABLE public.tags
(
	tag_id SERIAL NOT NULL PRIMARY KEY,
	body TEXT NOT NULL
)

/* This links the posts and tags table together */
CREATE TABLE public.post_tags
(
	post_tags_id SERIAL NOT NULL PRIMARY KEY,
	post_id INT NOT NULL REFERENCES public.posts(post_id),
	tag_id INT NOT NULL REFERENCES public.tags(tag_id)
)

/* This table is the comments table */
CREATE TABLE public.comments
(
	comment_id SERIAL NOT NULL PRIMARY KEY,
	post_id INT NOT NULL REFERENCES public.posts(post_id),
	cdate DATE,
	body TEXT
);