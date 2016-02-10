CREATE TABLE prodcats (
	id int NOT NULL auto_increment primary key,
	ord int,
	active int,
	title_de varchar(255),
	title_en varchar(255)
);

INSERT INTO prodcats (ord, active, title_de, title_en) VALUES (1, 1, "Erste Kategorie", "First Category");

CREATE TABLE products (
	id int NOT NULL auto_increment primary key,
	prodcat_id int,
	ord int,
	active int,
	title_de varchar(255),
	title_en varchar(255),
	title_cd varchar(255),
	title_order varchar(255),
	composer varchar(255),
	composer_first varchar(255),
	interprets varchar(255),
	description text,
	description_cd text,
	instr_de varchar(255),
	instr_en varchar(255),
	transcription_en varchar(255),
	transcription_de varchar(255),
	transcription varchar(255),
	prod_nr varchar(127),
	ismn varchar(127),
	price_ch varchar(20),
	price_eu varchar(20),
	price_us varchar(20),
	img varchar(255),
	img_small varchar(255)
);

CREATE TABLE prodsamples (
    id int NOT NULL auto_increment primary key,
	product_id int,
	title_en varchar(255),
	title_de varchar(255),
	ord int,
	img varchar(255)
);

CREATE TABLE pagecats (
	id int NOT NULL auto_increment primary key,
	ord int,
	active int,
	title_de varchar(255),
	title_en varchar(255),
	uri varchar(40),
	controller varchar(40)
);

INSERT INTO pagecats (ord, active, title_de, title_en, uri, controller) VALUES (1, 1, "Erste Seite", "First Page", "first", "CatPage");
INSERT INTO pagecats (ord, active, title_de, title_en, uri, controller) VALUES (2, 1, "Zweite Seite", "Second Page", "second", "NormPage");

CREATE TABLE pageitems (
	id int NOT NULL auto_increment primary key,
	pagecat_id int,
	ord int,
	active int,
	title_de varchar(255),
	title_en varchar(255),
	content_de text,
	content_en text,
	img varchar(255)
);

CREATE TABLE users (
	id int NOT NULL auto_increment primary key,
	name varchar(255),
	mail varchar(255),
	pwdhash varchar(255),
	iforgothash varchar(40)
);
