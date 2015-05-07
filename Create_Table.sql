drop table invlocat;

create table invlocat
	(
	idno       serial,
	locatcd    character (8) not null,
	locatnm    varchar (100),
	shortl     varchar (2) not null,
	locaddr1   varchar (100),
	locaddr2   varchar (100),
	telp       varchar (20),
	aumpcod    character (5),
	provcod    character (5),
	postcod    character (5),
	rundoc     character (1) default 'Y',
	rtax       character (2),
	closedt    date,
	balance    decimal (12,2) default 0,
	bldate     date,
	flsale     character (1) default 'Y',
	locatgrp   varchar (3),
	lcustcod   decimal (12) default 0,
	fax        character (10),
	hoffice    character (2) default 'b',
	locatnme   character (50),
	taxid      character (13),
	taxlocat   character (5) default '',
	typlocat   character (1) default 'l',
	accmstcod  character (12) default '',
	accmstcod2 character (12) default '',
	constraint unique_locatcd primary key (locatcd)
	);

drop table settype;

create table settype
	(
	typecod  character (20) not null,
	typedesc varchar (20),
	constraint unique_typecod primary key (typecod)
	);

drop table setmodel;

create table setmodel
	(
	modelcod  character (20) not null,
	modeldesc varchar (50),
	manuyr    decimal (4) default 0,
	price     decimal (12,2) default 0,
	intrate   decimal (6,2) default 0,
	intrate1  decimal (6,2) default 0,
	block     character (1) default 'N',
	constraint unique_modelcod primary key (modelcod)
	);

drop table setbaab;

create table setbaab
	(
	baabcod  character (20) not null,
	baabdesc varchar (20),
	constraint unique_baabcod primary key (baabcod)
	);

drop table setcolor;

create table setcolor
	(
	colorcod  character (20) not null,
	colordesc character (20),
	constraint unique_colorcod primary key (colorcod)
	);

drop table officer;

create table officer
	(
	code     character (8) not null,
	name     varchar (50),
	surname  varchar (50),
	addr     varchar (80),
	telp     varchar (20),
	workdt   date,
	status   character (1) default 'Y',
	expire   date,
	depcode  character (5),
	nocard   character (20),
	position character (20),
	email    character (30),
	nameeng  character (40),
	memo1    varchar (512),
	flagoff  character (1) default 'Y',
	division character (10),
	constraint unique_code primary key (code)
	);

drop table passwrd;

create table passwrd
	(
	idno         serial,
	userid       character (15) not null,
	passwd       varchar (15) not null,
	officecod    character (8),
	locatcd      character (8),
	level        character (1),
	chglocat     character (1) default 'N',
	backdt       character (1) default 'N',
	keydisc      character (1) default 'N',
	block        character (1) default 'N',
	design       character (1) default 'N',
	rprint       character (1) default 'N',
	"group"      character (2),
	expire       date,
	endcode      varchar (80),
	c_approv     character (1) default 'N',
	c_paid       character (1) default 'N',
	cuscod       character (8),
	deprt        character (2),
	srhactv      character (8),
	rprn         character (1) default 'N',
	bprn         character (1) default 'N',
	editprn      character (1) default 'N',
	chgloc       character (1),
	chgdate      character (1),
	update1      timestamp,
	editgl       character (1),
	overyear     character (1),
	flagid       character (1),
	editcust     character (1),
	approve      character (1) default 'N',
	approve_amnt decimal (12,2) default 0,
	ytypdisct    varchar (50),
	keycost      character (1) default 'N',
	keypay       character (1) default 'N',
	editpaytyp   character (1) default 'N',
	prntax       character (1) default 'N',
	chgpaytyp    character (1) default 'N',
	foreign key (officecod) references officer (code),
	foreign key (locatcd) references invlocat (locatcd),
	constraint unique_userid primary key (userid)
	);

drop table booklocat;

create table booklocat
	(
	idno        serial,
	locatcd     character (8) not null,
	bookcode    character (12) not null,
	bookdesc    character (100),
	balance     decimal (12,2) default 0,
	datebalance date,
	accmstcod   character (12),
	constraint un_booklocat unique (bookcode, locatcd),
	constraint unique_bookcode primary key (bookcode)
	);

drop table setaump;

create table setaump
	(
	aumpcod varchar (5) not null,
	aumpdes varchar (60),
	provcod varchar (5) not null,
	postcod varchar (5),
	foreign key (provcod) references setprov (provcod),
	constraint unique_aumpcod primary key (aumpcod)
	);

drop table setprov;

create table setprov
	(
	provcod varchar (5) not null,
	provdes varchar (60),
	constraint unique_provcod primary key (provcod)
	);


drop table condpay;

create table condpay
	(
	licen_no    character (12) not null default '1',
	comp_nm     character (100),
	comp_adr1   character (100),
	comp_adr2   character (100),
	telp        character (50),
	free_rate   decimal (6,2) default 0,
	int_rate    decimal (6,2) default 0,
	intadd_rate decimal (6,2) default 0,
	delay_day   decimal (6) default 0,
	caldsc      character (1) default '1',
	calint      character (1) default '1',
	h_mastno    character (2),
	h_tmpbill   character (2),
	h_cuscod    character (4),
	l_cuscod    character (12),
	h_aroth     character (2),
	h_taxno     character (2),
	workdt      date,
	memo1       varchar (1024),
	dirname     varchar (30),
	taxid       character (15),
	fulldue     character (1),
	h_txpay     character (2),
	ratefee     decimal (12,2) default 0,
	rateprofit  decimal (12,2) default 0,
	appdate     date,
	timeout     integer,
	vatrate     decimal (6,2),
	colamt      decimal (12,2) default 0,
	spechar     character (15),
	h_payno     character (2),
	inform      varchar (1024),
	color       integer,
	h_cashbank  character (2),
	closetime   time
	);