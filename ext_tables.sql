CREATE TABLE tx_bwjobs_domain_model_jobposition
(
	title                     		varchar(255)         NOT NULL DEFAULT '',
	slug                      		varchar(255)         NOT NULL DEFAULT '',
	teaser                    		text                 NOT NULL DEFAULT '',
	description               		text                 NOT NULL DEFAULT '',
	required_education        		text                 NOT NULL DEFAULT '',
	education_categories					varchar(255)         NOT NULL DEFAULT '',
	required_experience       		text                 NOT NULL DEFAULT '',
	required_qualifications   		text                 NOT NULL DEFAULT '',
	required_responsibilities 		text                 NOT NULL DEFAULT '',
	required_skills           		text                 NOT NULL DEFAULT '',
	required_commitments      		text                 NOT NULL DEFAULT '',
	benefits						      		text                 NOT NULL DEFAULT '',
	work_hours                		int(11)              NOT NULL DEFAULT '0',
	start_date                		date                          DEFAULT NULL,
	valid_through_date        		date                          DEFAULT NULL,
	salary_public             		smallint(1) unsigned NOT NULL DEFAULT '1',
	salary                    		int(11)              NOT NULL DEFAULT '0',
	homeoffice_public         		smallint(1) unsigned NOT NULL DEFAULT '1',
	homeoffice_possible       		smallint(1) unsigned NOT NULL DEFAULT '0',
	direct_application_possible   smallint(1) unsigned NOT NULL DEFAULT '0',
	currency                  		varchar(255)         NOT NULL DEFAULT '',
	payment_cycle             		varchar(255)         NOT NULL DEFAULT '',
	level                     		varchar(255)         NOT NULL DEFAULT '',
	date_posted               		date                          DEFAULT NULL,
	seo_title											varchar(255)  		   NOT NULL DEFAULT '',
	seo_description								varchar(255)  		   NOT NULL DEFAULT '',
	og_title											varchar(255)  		   NOT NULL DEFAULT '',
	og_description								varchar(255)  		   NOT NULL DEFAULT '',
	og_image											int(11) unsigned 		 NOT NULL DEFAULT '0',
	twitter_title									varchar(255)  		   NOT NULL DEFAULT '',
	twitter_description						varchar(255)  		   NOT NULL DEFAULT '',
	twitter_image									int(11) unsigned 		 NOT NULL DEFAULT '0',
	twitter_card									varchar(255) 		 		 NOT NULL DEFAULT '',
	employment_types_public   		smallint(1) unsigned NOT NULL DEFAULT '1',
	employment_types          		int(11) unsigned              DEFAULT '0',
	locations                 		int(11) unsigned              DEFAULT '0',
	categories_public         		smallint(1) unsigned NOT NULL DEFAULT '1',
	categories                		int(11) unsigned              DEFAULT '0',
	headlines_visible         		smallint(1) unsigned NOT NULL DEFAULT '1'
);

CREATE TABLE tx_bwjobs_domain_model_employmenttype
(
	title       varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	type        varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bwjobs_domain_model_contactperson
(
	title    varchar(255)     NOT NULL DEFAULT '',
	gender   varchar(255)     NOT NULL DEFAULT '',
	name     varchar(255)     NOT NULL DEFAULT '',
	email    varchar(255)     NOT NULL DEFAULT '',
	phone    varchar(255)     NOT NULL DEFAULT '',
	fax      varchar(255)     NOT NULL DEFAULT '',
	address  varchar(255)     NOT NULL DEFAULT '',
	image    int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_bwjobs_domain_model_category
(
	title       varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bwjobs_domain_model_location
(
	title           varchar(255)     NOT NULL DEFAULT '',
	organization    varchar(255)     NOT NULL DEFAULT '',
	description     text             NOT NULL DEFAULT '',
	street          varchar(255)     NOT NULL DEFAULT '',
	city            varchar(255)     NOT NULL DEFAULT '',
	zip             varchar(255)     NOT NULL DEFAULT '',
	region					varchar(255)     NOT NULL DEFAULT '',
	country         varchar(255)     NOT NULL DEFAULT '',
	country_zone    varchar(255)     NOT NULL DEFAULT '',
	image           int(11) unsigned NOT NULL DEFAULT '0',
	contact_persons int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_bwjobs_jobposition_employmenttype_mm
(
	uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
	sorting         int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local, uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_bwjobs_jobposition_location_mm
(
	uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
	sorting         int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local, uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_bwjobs_jobposition_category_mm
(
	uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
	sorting         int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local, uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_bwjobs_location_contactperson_mm
(
	uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
	sorting         int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local, uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


