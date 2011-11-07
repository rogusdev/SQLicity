<?php

/*

	Welcome to Sqlicity,
		"SQL Simplicity"

	copyright 2008-2011, by Chris Rogus
		http://www.sqlicity.com/

	THIS APPLICATION IS NOT GPL'D!!!

	build 2011031611



**********************
	COPYRIGHT NOTICE:
**********************

	FIX ME FIXME --
		what about hosting companies selling services
		advertising access to this software?...
		That should be ok... right?
		My current copyright implies that this is NOT ok.



	IF YOU ARE _NOT_ ME, AND I STRONGLY DOUBT YOU ARE,
		DO _NOT_ DISTRIBUTE THIS FILE WITHOUT
		MY EXPRESS PERMISSION.  FURTHERMORE, DO NOT MODIFY
		THIS FILE IN ANY WAY AND THEN DISTRIBUTE IT.
		ANY MONEY MADE BY SELLING THIS PROGRAM BELONGS TO ME,
		ADVISE ME IF PROFIT IS AVAILABLE AND THEN
		_ASK ME FOR MY PERMISSION_ BEFORE DOING ANYTHING.
		MODIFICATION FOR PRIVATE USE IS ENCOURAGED.
		LEARN FROM MY MISTAKES AND TRIUMPHS.


	Sqlicity is NOT "free software" in the GPL/BSD license sense.
		It is freely available and freely distributed but
		it is most definitely MY software.  I retain the copyright
		and while you are allowed to make changes for private usage,
		(obviously -- the source code is right here already...)
		distributing those changes is NOT OK.
		Claiming that you made this software is ABSOLUTELY NOT OK.
		Selling copies of this software or even access to this software
		is NOT OK -- UNLESS you discuss with me terms for MY compensation.

	In short, I am allowing you a limited single usage license for free.
		Each instance of that limited single usage license is
		an arrangement with me, and can NEVER be between you and a third party.
		(Again, unless you discuss terms of compensation with me FIRST.)

	You ABSOLUTELY AGREE, by using this software,
		that you will be fully responsible for ANY damages
		that occur from its use.  I am _suggesting_ this software
		for the purposes I have described herein,
		I make NO guarantees as to its usability or suitability
		for ANY function or to its being error-free and safe on data.

	There are plenty of companies who charge you a lot of money
		to give you guarantees like that.  If it's that important to you
		(and for some people it really is, and I understand that fully)
		go find them and pay through the nose.
		Or pay me to test & develop that degree of certainty with Sqlicity.




**********************
	FIRST TIME:
**********************

	To configure Sqlicity for your database,
		simply jump past the "KILL BAD PHP" code block
		just below these comments, and change the "CONNECTION INFORMATION"
		which has the lock-down (login) user/pass and the
		database login (user/pass/server) and available db array


**********************
	IMPORTANT:
**********************

	The intention behind Sqlicity is for it to be used
		only to aid in the development and debugging of
		web applications that do more specialized management
		of the data in the databases, knowing what the data represents
		(e.g. content management systems, e-commerce sites)
	Thus, I have deliberately designed Sqlicity to be so simple
		that it is meant ONLY for people who
		ALREADY KNOW WHAT THEY ARE DOING!!
	Meaning, it is IMPERATIVE that you already moreorless
		know your way through raw MySQL commands!!!!!
	Sqlicity provides absolutely minimal interpretation of
		the data, and relies on the user's understanding of
		the way that MySQL respresents information.

	** To my mind, Sqlicity is just a slightly
		more sophisiticated version of the command line client!


	If you need every feature under the sun, fully supporting
		every version of MySQL going back to version 3.0 or something,
		use PhpMyAdmin.  I made Sqlicity because I hate PhpMyAdmin's interface,
		but it does do more stuff than Sqlicity and it always will.
		(I have no intention of fighting a features war with them,
		my goal is and will remain to minimize features to the bare essentials.)



**********************
	WARNING:
**********************

	Sqlicity works great as it is, I use it for everything I do,
		so it's already been tested quite a bit, in production environments.
	However, I have my suspicions that errors could pop up
		if you use strings for primary key values that include certain characters:
		specifically, "s or 's or ,s (double-quotes, single-quotes and commas)
		And these same chars or any html might also break things
		if used in column/field names, or table or db names.
		(Column values are html safe, of course, and well tested.)
	I have prepared for all of these cases, but they are not extensively tested.
		Thus, while I do not expect such errors to happen, they might.
		You use this software acknowledging these risks.
		Furthermore, there might be more, unanticipated risks
		and you accept responsibilty for those dangers as well.
	**** I AM NOT LIABLE FOR LOSS OR DAMAGE TO YOUR DATA!!!! ****



**********************
	KNOWN ISSUES:
**********************

	1) NO support for spatial column types.  This is not likely to change.
	2) Currently, only primary keys or entire row values
		are used to identify individual rows -- isolating the non-null uniques
		is not a currently supported method of identification, and might never be.
	3) the SET clause of LOAD DATA INFILE (mysql 5.0.3+) is NOT simulated in sqlicity!
		at best it would only ever offer very limited functionality,
		it is highly unlikely that I will ever even attempt that simulation but just in case:
		"Lines ignored by an IGNORE clause are not processed for the column/variable list or SET clause."
	4) You need a pretty big screen resolution to see sqlicity
		properly all the time (I use a 17" flat panel at 1280x1024)
		I _DO_ want to make versions of sqlicity for cellphones/PDAs/etc
		but that's long, long term.  So, eventually, someday, maybe,
		you'll find a link to open sqlicity in your micro-browser
		and I will have come up with some creative way to navigate
		a db effectively with extremely limited screen space.
	5) Lots of columns in a table will stretch the page... a LOT.
		It's on my list, I'm just working on a more creative way to
		display such information -- I've got good ideas, just you wait...
	6) ENUMs and SETs are not handled specially yet.  They will be.
	7) System variable display/editing is not yet implemented.  It's coming.
	8) User management is not yet implemented.  It's coming.
	9) MySQL 5.0 features: VIEWs, TRIGGERs and STORED PROCEDURES/FUNCTIONS
		are not handled at all yet.  Thus, Sqlicity will display Views
		as regular tables (which will cause errors if you try to alter them, etc)
		and will completely ignore Triggers, and stored procedues/etc
	10) Export & import file compression is not yet implemented
		Furthermore, the import/export could certainly use more testing of extreme special cases
	11) Currently, there is no way to upload binary data for BLOBs
		This will change in the future, once I implement it.
		Relatedly, BLOBs will be... awkwardly displayed in data lists
		(i.e. SELECTs and Data Views will show the binary data as text)
	12) Localization is FAAAAARRRRR from complete -- many more strings need
		to be added to the localization hash array, as I work with them, I replace them (sometimes...)
	13) I do not use the $mysql_server variable (database link id) in calling ANY of the mysql_query()s
		I consider to be acceptable since I don't expect anyone adding their own db code in the middle of this
		(perhaps at the beginning as with db+cookie authentication systems), but I might change that eventually anyway.


CHRIS: FIXME FIX ME -- doesn't work when you specify a headerlist!!!
 (problem is $display_columns_defaults not matched to headerlist)

DELIMITER !!!!
SHOW PROCEDURE STATUS
SHOW FUNCTION STATUS
SHOW CREATE PROCEDURE MY_PROC


export file -- compress export gz/bz2/etc & also with SQL export!
import file -- allow compressed even with LOAD DATA
edit data -- upload file for blob columns
edit data -- enums/sets should be dropdown/multi
mysql5
sysvars
users
select row/col display invert
data view scrolling for rows/cols




****g******************
	Table of Contents:
**********************

	** line ~  300 ** ACTION PREPARATION BLOCKS ** handle the core workload
		1) "KILL BAD PHP" -- sanitize the environment against magic_quotes_gpc and register_globals
	*	2) "CONNECTION INFORMATION" -- DEFINE USER CONFIGURATION: db login, etc
		3) "LOCKDOWN DATA" -- manages the Sqlicity lock-down feature
		4) "INITIALIZE PAGE" -- connect to the db, etc
		5) "MYSQL COMMANDS" -- takes action on the db, based on your choices in Sqlicity
		6) "CURRENT VIEW" -- barely more than a big switch(), picks page to display

	** line ~ 1000 ** DATABASE STRUCTURE PAGES
		1) MASSIVE ERROR CONTENT -- content_massive_error()
		2) DB MUTLI TABLE CONTENT -- content_db_multi_table()
		3) CREATE TABLE CONTENT -- content_create_table()
		4) TABLE CONTENT -- content_table()
		5) FIELDS CONTENT -- content_fields()

	** line ~ 1200 ** IMPORT/EXPORT PAGES
		1) EXPORT STRUCTURE CONTENT -- content_export_structure()
		2) EXPORT DATA CONTENT -- content_export_data
		3) DO EXPORT DATA CONTENT -- content_do_export_data
		4) IMPORT DATA CONTENT -- content_import_data
		5) DO IMPORT DATA CONTENT -- content_do_import_data
		6) DO EXPORT DB SQL CONTENT -- content_do_db_sql_export

	** line ~ 2100 ** MYSQL SYSTEM INFORMATION PAGES
		1) SELECT CONTENT -- content_select()
		2) PROCESSLIST CONTENT -- content_processlist()
		3) USERLIST CONTENT -- content_userlist()
		4) EDIT USER CONTENT -- content_edit_user()
		5) SYSTEM VARS CONTENT -- content_system_vars()

	** line ~ 2400 ** DATA MANAGEMENT PAGES
		1) DATA CONTENT -- content_data()
		2) EDIT ROW CONTENT -- content_edit_row()

	** line ~ 3000 ** DISPLAYED HTML CONTENT
		1) Javascript for sending sqlicity commands controlling the db
		2) "Header" chunk -- db and table listing
		3) "Footer" chunk -- pure sql input and copyright



**********************
	Making Changes:
**********************

	Remember, Sqlicity is designed to be barely more
		than a visual (textual -- NOT graphical!) interface
		to execute SQL statements directly on the db,
		(i.e. only in a 1:1 interface:SQL relationship)
		don't expect more than that and don't waste time
		trying to add it -- that's not the goal here.


	Feel free to contact me and recommend your changes
		if you think you've got something really worth contributing,
		(that is NOT an invitation to request features, ONLY
		to suggests changes that you have already made and would
		like added to the publicly available version of Sqlicity)
		although it is my personal opinion that not much more is needed
		in a barebones SQL db management tool than what Sqlicity has.
		(Plus what's in my to-do/bugs list above, of course.)

	However, if you have corporate business needs for enhancements/extensions
		to Sqlicity, please, do contact me and I will gladly assist you
		in developing such extras, for the appropriate price.
		Furthermore, since this is NOT "free software" it is possible
		to develop such extras as private add-ons instead of sharing
		them with the public as is officially required with GPL software.
		(such as the GPL'd PhpMyAdmin...)




**********************
**********************

	Enjoy Sqlicity!

**********************
**********************

*/




/*************************************************************************************
======================================================================================

		ACTION PREPARATION BLOCKS

Configure the environment, connect to the db,
	execute commands, pick the view, etc -- initialize the page

======================================================================================
*************************************************************************************/



// default is 5 minutes -- 0 is NO timeout
set_time_limit(300);


/******************************************

	KILL BAD PHP

For security, cleanliness and proper functioning
	we need to kill some "features" of PHP:
	magic_quotes_gpc and register_globals

******************************************/

// fix register_globals
//  http://www.php.net/manual/en/security.globals.php
if (ini_get('register_globals'))
 foreach ($_REQUEST as $key => $value)
  { unset($GLOBALS[$key]); }


// make sure db results are not escaped
set_magic_quotes_runtime(0);


// fix magic_quotes_gpc
//  http://www.php.net/manual/en/security.magicquotes.php
if (get_magic_quotes_gpc())
{
	// http://www.php.net/manual/en/security.magicquotes.disabling.php
	function stripslashes_deep ($value)
	 { return (!is_array($value) ? stripslashes($value) : array_map('stripslashes_deep', $value)); }

	// I only use POST on this page, so that's all I fix
	$_POST = stripslashes_deep($_POST);
}


// THESE ARE VERY BASIC INITIALIZATION VARS
//  BUT THEY MUST COME _AFTER_ THE FIXING OF register_globals
//  AND _BEFORE_ EVERYTHING ELSE!

// init vars to handle database errors
$small_error = $massive_error = '';


// this is optional, for visual effect only
$datetime_format = 'r';

// mark the beginning of page load
$start_timestamp = date($datetime_format);



/******************************************

	LOCALIZATION LANGUAGE OPTIONS

Define the text strings for output
	i.e. interface messages to the user

******************************************/

$output_text = array(

 'sqlicity_failed_login' => 'This area is restricted.',
 'cannot_open_db' => 'Cannot open the SQL database: ',
 'no_db_available' => 'No mysql database available to connect to!',
 'command_query_failed' => 'failed',
 'command_query_action' => array(
  'table_empty' => 'Empty table',
  'table_drop' => 'Drop table',
  'table_create' => 'Create table',
  'table_rename' => 'Rename table',
  'alter_table' => 'Alter table',
  'table_add_col' => 'Add column',
  'table_del_col' => 'Delete column',
  'table_chg_col' => 'Change column',
  'table_copy' => 'Copy table with LIKE',
  'table_copy2' => 'Copy table with SELECT LIMIT 0',
  'db_tables_drop' => 'Drop multiple tables',
  'db_tables_empty' => 'Empty multiple tables',
  'kill_process' => 'Kill process',
  'data_row_delete' => 'Delete row',
  'data_row_save_EDIT' => 'Edit row',
  'data_row_save_ADD' => 'Add row',
  'pure_sql_ONE' => 'Your pure SQL command',
  'pure_sql' => 'Your multi-query SQL command',
  'upload_pure_sql' => 'Your uploaded SQL commands',
 ),

 'row_added_number' => '<b>Row{#ROW_ADDED_NUMBER} added.</b> Add another row or hit cancel to return to the data view.',
 'select_failed' => 'Select failed: ',
 'executed_pure_sql' => 'Executed pure SQL command',
 'executed_multi_sql' => 'Executed multi-query SQL command',
 'executed_upload_sql' => 'Executed uploaded SQL commands',
 'rows_affected' => 'rows affected.',
 'no_submitted_command' => 'No SQL commands were submitted for execution.',
 'upload_executed_sql' => '## UPLOADED SQL ##',
 'unknown_sqlicity_command' => 'Unknown Sqlicity command.<br />Try again or go to the <a href="http://www.sqlicity.com">Sqlicity website</a> and report this error.',
 'upload_file_unreadable' => 'COULD NOT OPEN FILE FOR READ: ',
 'upload_file_error' => 'Upload error: ',
 'began_command_exec' => 'Began MySQL command execution at',
 'ended_command_exec' => 'and ended at',
 'show_tables_failed' => 'Show tables failed: ',

 'NAME' => 'HTML_TEXT',

);




/******************************************

	INITIALIZE PAGE

Make the connection to the MySQL DB,
	select current db, table, view, etc

******************************************/

// list the user names which are ok to login to this page
$limitedUserList = array();  // empty means anyone can login
//$limitedUserList = array('root');  // just list them as strings

// hold current username and password
$sqlicity_username = $_SERVER['PHP_AUTH_USER'];
$sqlicity_password = $_SERVER['PHP_AUTH_PW'];

// define the server to connect to
$mysql_server_name = 'localhost';

// will be included if present, otherwise ignored -- see sample below
@include 'sqlicity_connect.php';

/*

optionally, can set sqlicity to always connect
 as a specific user and to specific dbs

SAMPLE sqlicity_connect.php:


$sqlicity_username = 'alogin';
$sqlicity_password = 'apass';

$mysql_dbs = array(
 'db1',
 'db2',
 'db3',
);

*/



// flag if we should ignore the POST db list
$resetDBs = FALSE;

// send them the box to demand a log in
//  http://www.php.net/manual/en/features.http-auth.php
function show_auth_box ()
{
	global $output_text;

	header('WWW-Authenticate: Basic realm="Sqlicity"');
	header('HTTP/1.0 401 Unauthorized');
	echo $output_text['sqlicity_failed_login'];
	exit;
}


// see if user just attempted to sign out
if ($_POST['logout_submitted'] == $sqlicity_username) { show_auth_box(); }

// see if no user given
if ($sqlicity_username == '') { show_auth_box(); }

// see if this user is even allowed to login on this page
if (count($limitedUserList) && !in_array($sqlicity_username, $limitedUserList)) { show_auth_box(); }


// try to connect to the server using these given logins
$mysql_server = @mysql_connect($mysql_server_name, $sqlicity_username, $sqlicity_password);

// verify the db connection (login details) worked
if (!$mysql_server) { show_auth_box(); }


// if they just signed back in after signing out, reload the db list
if ($_POST['logout_submitted']) { $resetDBs = TRUE; }


// get all the available dbs -- if they aren't hardcoded already, find them
//  since this is kinda slow, we try to carry this in the viewstate form
if (is_array($mysql_dbs)) {}  // got specified ones, just use those
elseif (!$resetDBs && is_array($_POST['mysql_dbs'])) { $mysql_dbs = $_POST['mysql_dbs']; }
else
{
	// get all the known databases to start
	$mysql_dbs = array();
	$db_res = mysql_query("SHOW DATABASES");
	while ($newdb = mysql_fetch_assoc($db_res))
	{
		// then narrow it down to ones we can connect to
		if (mysql_select_db($newdb['Database'], $mysql_server))
		 { $mysql_dbs[] = $newdb['Database']; }
	}
}


// make sure we found at least one db to connect to at all!
if (count($mysql_dbs) > 0)
{
	// if no db is selected, pick the first one on the list
	$cur_mysql_db = $_POST['cur_mysql_db'];
	if (!$cur_mysql_db || $resetDBs) { $cur_mysql_db = $mysql_dbs[0]; }

	// open the current db
	if (!$massive_error &&
	 !(mysql_select_db($cur_mysql_db, $mysql_server)))
	  $massive_error = $output_text['cannot_open_db'].htmlutf($cur_mysql_db);
}
else  // in case we somehow have no dbs available right now
 { $massive_error = $output_text['no_db_available']; }


// describes current view
$current_view = $_POST['current_view'];
$cur_mysql_table = $_POST['cur_mysql_table'];
$show_puresql = $_POST['show_puresql'];

// default puresql to on.
if (!isset($show_puresql)) { $show_puresql = 1; }


// get MySQL version as a helper fact, and split out just the numbers
$mysql_version_string = mysql_result(mysql_query("SELECT VERSION()"), 0);
preg_match('/([0-9]+)\.([0-9]+)\.([0-9]+)(\-.*)?/', $mysql_version_string, $mysql_version);
$mysql_version_numbers = array($mysql_version[1],$mysql_version[2],$mysql_version[3]);

// checks a minimum mysql version for some action
function check_mysql_version_min ($big=0,$med=0,$sml=0)
{
	global $mysql_version_numbers;

	// first check easy ones -- big and middle versions
	return (($mysql_version_numbers[0]>$big)
	 || (($mysql_version_numbers[0]==$big) && (($mysql_version_numbers[1]>$med)
	// then just the small version
	 || ($mysql_version_numbers[1]==$med && $mysql_version_numbers[2]>=$sml))));
}


// use utf8 instead of simple latin1
//  http://malevolent.com/weblog/archive/2007/03/12/unicode-utf8-php-mysql/
//  http://www.richnetapps.com/php-mysql-speak-unicode/
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
function htmlutf ($v) { return htmlentities($v, ENT_QUOTES | ENT_IGNORE, "UTF-8"); }



/******************************************

	MYSQL COMMANDS

Handle mysql commands sent from sqlicity

******************************************/

$mysql_command = $_POST['mysql_command'];
$executed_sql = '';  // empty this for security, appending, etc

// timestamp start/end for query times
$mysql_query_start = 0;
$mysql_query_end = 0;


// We need to use some ASCII codes, PHP does not have escape sequences for these chars
//  there are no OS's running PHP that have diff ASCII tables are there?...
// NOTE: you have to be very careful with str_replace!
//  if a later value is a subset of an earlier value, it will be replaced again!
//  therefore, since we later str_replace by these keys,
//  the escape char key MUST come before the others,
//  or they will all get doubled backslashes!
$mysql_escaped_chars = array(
 "\\" => "\\", // backslash
 '0' => chr(0),  // "\0",  // ASCII 0 (NUL)
 "'" => "'",   // single quote
 '"' => '"',   // double quote
 'n' => "\n",  // newline/linefeed
 'r' => "\r",  // carriage return
 'Z' => chr(26), // "\Z",  // control-Z, EOF in Windows
 'b' => chr(8),  // "\b",  // backspace
 't' => "\t",  // tab
 // these two are special: the backslash stays... VERY UNCOOL
 '%' => '\%',  // percent sign
 '_' => '\_',  // underscore
);

// shortcut vars, rather than repeatedly calculating these
$mysql_escaped_chars_values = array_values($mysql_escaped_chars);
$mysql_escaped_chars_keys = array_map(create_function('$c', 'return "\\\\".$c;' ), array_keys($mysql_escaped_chars));


// proper addslashes/mysql_real_escape_string replacement
function add_mysql_slashes ($string)
{
	global $mysql_escaped_chars_values, $mysql_escaped_chars_keys;

	return ($string !== NULL ? str_replace($mysql_escaped_chars_values, $mysql_escaped_chars_keys, $string) : $string);
}

// same, but now with = then single quotes around non-null values and IS NULL for nulls
function add_mysql_slashes_where ($string)
{
	global $mysql_escaped_chars_values, $mysql_escaped_chars_keys;

	return ($string !== NULL ? "='".str_replace($mysql_escaped_chars_values, $mysql_escaped_chars_keys, $string)."'" : ' IS NULL');
}



// clean off the semicolon and whitespace
function clean_semiwhite ($s)
{
	// do a regex trim, while also removing the semi colon
	//  NOTE: for some reason I _must_ use the /s modifier with .*
	//  as opposed to no modifer and [\S\s]*
	//  -- for some inexplicable reason, this doesn't catch vertical tabs (ascii 11)!!
	preg_match('/^\s*(\S.*?)\s*\;?$/s',$s,$s1);
	return $s1[1];
}


// used w/ nextSQLstatement for pure_sql (as opposed to upload)
function sqlicity_empty_read_func ($a, $b) { return NULL; }


// get the next SQL query in a [possibly compressed] file
//  get the file read function -- for compressed files, etc
function nextSQLstatement ($readfunc, $sqlfile, &$leftoversql)
{
	// define the open/close char pairs for strings/identifiers
	$closers = array(
	 '`' => '`',
	 '\'' => '\'',
	 '"' => '"',
	);

	// track FSM state
	$state = 1;  // current FSM state
	$closechar = NULL;  // the char to close this string
	$escaped = FALSE;  // in case of escaped chars inside strings
	$statement = '';  // holds the next statement we find


	// loop over all the lines of the file
	//  until we hit a semicolon, or EOF
	// first use the leftovers from the last statement, if present
	while ($sqltext = (!$leftoversql ? $readfunc($sqlfile, 1024) : $leftoversql))
	{
		// we've included the leftovers, don't need them anymore
		$leftoversql = '';


		// loop through all the chars in the next line of text we pull
		$maxlen = strlen($sqltext);
		for ($i=0; $i<$maxlen; $i++)
		{
			// and process each char according to current state
			$char = $sqltext{$i};

			// check for comments, this is a temporary state change
			//  NEW comments only happen OUTSIDE matching quotes and NOT in comments!
			//  (i.e. NOT in states 2 or 3, which leaves only 1)
			if ($char == '#' && $state == 1) { $state = 3; }

			// first of all, we store every single char onto the current statement
			$statement .= $char;

			// now check if we end a statement, go in/out of matching/etc
			switch($state)
			{
			case 1:  // OUTside matching string&block quotes/etc
				// hit a semicolon outside matches, means we finished a statement
				if ($char == ';')
				{
					// save the leftovers to start the next statement
					$leftoversql = substr($sqltext, $i+1);

					// return the statement without the semicolon and whitespace
					return clean_semiwhite($statement);
				}
				// hit a string/identifier opener char (a key in $closers), means we entered matching quotes/etc
				elseif (($closechar = $closers[$char]) !== NULL) { $state = 2; }
			break;

			case 2:  // INside matching STRING quotes/etc
				// we completely ignore escaped chars, whatever they may be
				//  EXCEPT identifier quotes have no escape chars:
				// http://dev.mysql.com/doc/mysql/en/legal-names.html
				//  doubled identifier quotes are handled just fine as-is
				if ($escaped) { $escaped = FALSE; }  // the current character was escaped, i.e. completely ignored
				else  // unescaped chars we check for string closers and the escape char
				{
					// once inside string matching quotes/etc, we only look for the closer char to get back outside
					if ($closechar == $char) { $state = 1; }
					// except... the char might be escaped... -- but not inside an identifier!
					elseif ($char == "\\" && $closechar!='`') { $escaped = TRUE; }
				}
			break;

			case 3:  // finishing the line after a comment
				// everything until the newline is a comment and cannot split statements
				//  afterwards, return to being outside matching quotes/etc
				if ($char == "\n" || $char == "\r") { $state = 1; }
			break;
		}}
	}  // end loop over all the lines in the file


	// FSM finished, means we hit EOF
	//  assumedly the statement is finished now...
	//  return the statement without the semicolon and whitespace
	$leftoversql = NULL;  // NULL leftover marks EOF
	return clean_semiwhite($statement);
}


// execute all the statements in the uploaded file
//  also works with pure_sql by giving $leftoversql the $cmd_data
function execute_file_sql ($readfunc, $sqlfile, $leftoversql='')
{
	global $executed_sql, $mysql_command;

	// get the data from the file
	$command_count = 0;
	while ($leftoversql !== NULL)
	{
		// get the next statement to be executed
		$executed_sql = nextSQLstatement($readfunc, $sqlfile, $leftoversql);

		// empty statements, after semi colon removed, should be ignored
		//  if the statement is there and fails, we stop processing the file
		if ($executed_sql)
		{
			// track the number of executed commands
			$command_count++;
			if (!do_mysql_query($mysql_command)) { break; }
		}
	}

	// tell how many commands were executed
	return $command_count;
}


// runs a query, sets some vars, gives error, etc
function do_mysql_query ($actionname)
{
	global $executed_sql, $small_error, $output_text,
	 $mysql_query_start, $mysql_query_end;

	// did the query work or not?  assume yes
	$worked = TRUE;

	// mark start time
	$mysql_query_start = time();

	// run the query, check for errors
	if (!mysql_query($executed_sql))
	{
		$small_error = $output_text['command_query_action'][$actionname].' '
		 .$output_text['command_query_failed'].":</b><br />\n<i>"
		 .htmlutf($executed_sql)."</i><br />\n<b>".mysql_error();
		$worked = FALSE;
	}

	// mark end time
	$mysql_query_end = time();

	// so we know quickly if this query worked or not
	return $worked;
}


// handle changes to the database
if (!$massive_error && $mysql_command)
{
	// do this for all commands,
	//  even ones which don't use data
	$cmd_data = $_POST['mysql_command_data'];

	// empty current table
	if ($mysql_command == 'table_empty')
	{
		$executed_sql = "TRUNCATE TABLE `$cur_mysql_table`";
		do_mysql_query($mysql_command);
	}
	// drop current table
	elseif ($mysql_command == 'table_drop')
	{
		$executed_sql = "DROP TABLE `$cur_mysql_table`";
		if (do_mysql_query($mysql_command))
		 { $cur_mysql_table = '';  }  // it was just deleted, don't use it anymore
	}
	// create a new table
	elseif ($mysql_command == 'table_create')
	{
		$create_table_sql = $executed_sql = $cmd_data;
		if (do_mysql_query($mysql_command))
		{
			// get the name of the table
			//  and switch to use that new table as the current
			// FIXME FIX ME -- verify that even in later (than 3.23) MySQL vers, there must be at least one col!
			$cur_mysql_table = array();
			preg_match('/\s*CREATE(\s+TEMPORARY)?\s+TABLE(\s+IF NOT EXISTS)?\s+`?(.*?)`?\s+\(/is', $cmd_data, $cur_mysql_table);
			$cur_mysql_table = $cur_mysql_table[3];

			// and go to its default table view
			$current_view = '';
		}
	}
	// rename current table
	elseif ($mysql_command == 'table_rename')
	{
		$executed_sql = "RENAME TABLE `$cur_mysql_table` TO `$cmd_data`";
		if (do_mysql_query($mysql_command))
		 { $cur_mysql_table = $cmd_data; }  // it was just renamed, use new name
	}
	// alter the current table
	elseif ($mysql_command == 'alter_table')
	{
		$executed_sql = "ALTER TABLE `$cur_mysql_table` $cmd_data";
		do_mysql_query($mysql_command);
	}
	// add a column to current table
	elseif ($mysql_command == 'table_add_col')
	{
		$executed_sql = "ALTER TABLE `$cur_mysql_table` ADD COLUMN $cmd_data";
		do_mysql_query($mysql_command);
	}
	// remove a column from current table
	elseif ($mysql_command == 'table_del_col')
	{
		$executed_sql = "ALTER TABLE `$cur_mysql_table` DROP COLUMN `$cmd_data`";
		do_mysql_query($mysql_command);
	}
	// change a column
	elseif ($mysql_command == 'table_chg_col')
	{
		$executed_sql = "ALTER TABLE `$cur_mysql_table` CHANGE COLUMN $cmd_data";
		do_mysql_query($mysql_command);
	}
	// copy a table with LIKE
	elseif ($mysql_command == 'table_copy')
	{
		$executed_sql = "CREATE TABLE `$cmd_data` LIKE `$cur_mysql_table`";
		if (do_mysql_query($mysql_command))
		 { $cur_mysql_table = $cmd_data;  }  // switch to the new table
	}
	// copy a table with SELECT LIMIT 0
	elseif ($mysql_command == 'table_copy2')
	{
		$executed_sql = "CREATE TABLE `$cmd_data` SELECT * FROM `$cur_mysql_table` LIMIT 0";
		if (do_mysql_query($mysql_command))
		 { $cur_mysql_table = $cmd_data;  }  // switch to the new table
	}
	// drop multiple tables
	elseif ($mysql_command == 'db_tables_drop')
	{
		$executed_sql = "DROP TABLE IF EXISTS $cmd_data";
		do_mysql_query($mysql_command);
	}
	// empty multiple tables
	elseif ($mysql_command == 'db_tables_empty')
	{
		$executed_sql = "TRUNCATE TABLE $cmd_data";
		do_mysql_query($mysql_command);
	}
	// kill a process
	elseif ($mysql_command == 'kill_process')
	{
		$executed_sql = "KILL $cmd_data";
		do_mysql_query($mysql_command);
	}
	// remove a row from current table
	elseif ($mysql_command == 'data_row_delete')
	{
		$executed_sql = "DELETE FROM `$cur_mysql_table` WHERE $cmd_data LIMIT 1";
		do_mysql_query($mysql_command);
	}
	// save a single row -- can be update or insert
	elseif ($mysql_command == 'data_row_save')
	{
		// returns actual column values, for array_map
		//  FIXME FIX ME -- does NOT yet handle binary data (file uploads)!
		function actual_values ($col, $val)
		{
			// switch on the escape type
			switch ($val[1])
			{
			case 1:  // escaped data
				return "`$col`".
				 // php 4.3.0 is req for MRES()
				 //  so, for compatibility, we use mine
				 add_mysql_slashes_where($val[0]);
			break;

			case 2:  // unescaped data
				return "`$col`=$val[0]";
			break;

			case 3:  // NULL
				return "`$col`=NULL";
			break;
			}

			// if no valid escape type is given,
			//  the implode will happen anyway, on empty data
			//  and this will cause an error in the SQL!!!
		}

		// these are used to build the executed_sql
		//  so clear these first, to be safe
		$edit_row_key_identity = '';
		$edit_row_data = array();

		// this eval will create:
		//  $edit_row_key_identity -- WHERE clause for pri key
		//  $edit_row_data[col_name][0] -- column value
		//  $edit_row_data[col_name][1] -- escape type
		eval($cmd_data);

		// get the actual values to use in the SQL
		$row_data_new = implode(', ', array_map('actual_values',
		 array_keys($edit_row_data), array_values($edit_row_data)));

		// this is an UPDATE if identity exists, otherwise INSERT
		if ($edit_row_key_identity)
		{
			$executed_sql = "UPDATE `$cur_mysql_table` SET $row_data_new WHERE $edit_row_key_identity LIMIT 1";
			if (do_mysql_query($mysql_command.'_EDIT'))
			 { $current_view = 'data'; }  // go back to data view
		}
		else  // new row -- INSERT it
		{
			$executed_sql = "INSERT INTO `$cur_mysql_table` SET $row_data_new";
			// leave in row edit view, in case adding more
			if (do_mysql_query($mysql_command.'_ADD'))
			{
				$idnumber = mysql_insert_id();
				$small_error .= str_replace('{#ROW_ADDED_NUMBER}',
				 ($idnumber ? ' #'.$idnumber : ''), $output_text['row_added_number']);
			}
		}
	}
	// execute pure SQL code
	elseif ($mysql_command == 'pure_sql')
	{
		// first split into multiple statements, if that is the case
		//  "multiple" statements means at least one semicolon -- even if no query after it!
		$leftoversql = $cmd_data;
		$statement = nextSQLstatement('sqlicity_empty_read_func',NULL,$leftoversql);

		// if it's just one command, we allow for special cases
		//  "just one command" means no leftovers here
		if ($leftoversql === NULL)
		{
			// shortcut, and to do single queries on the semi-colon-less statement
			$executed_sql = $statement;

			// handle special displays for certain commands
			preg_match('/^\s*\(?([a-z]+)\s+\S.*$/Dis', $executed_sql, $top_command);
			$top_command = strtoupper($top_command[1]);


			// unfortunately, a pure sql table rename does wreak havoc on sqlicity
			//  so we need to handle it specially here
			if ($top_command == 'RENAME')
			 { $cur_mysql_table = NULL; }  // shortcut, to dodge figuring out the new name

			// display SELECT or SHOW results on the appropriate page
			if ($top_command == 'SELECT' || $top_command == 'SHOW')
			{
				$current_view = 'select_data';
				$cur_mysql_table = NULL;  // needed to show select data

				// include what we just executed as select sql, for the select page
				$select_sql = $cmd_data;

				// note that we need the return -- so we can't use do_mysql_query
				//  and must therefore mark start and end times ourselves
				$mysql_query_start = time();
				if (!($select_result = mysql_query($executed_sql)))
				 { $small_error = $output_text['select_failed'].mysql_error(); }
				$mysql_query_end = time();
			}
			// execute arbitray SQL
			else
			{
				$small_error = $output_text['executed_pure_sql'];
				// if it works, tell the number of affected rows
				if (do_mysql_query($mysql_command.'_ONE'))
				 { $small_error .= "<br />\n <i>".mysql_affected_rows()."</i> ".$output_text['rows_affected']."\n"; }
			}

			// restore this for display purposes
			$executed_sql = $cmd_data;
		}  // end single statement pure sql
		// we still want to avoid empty commands...
		elseif (strlen($statement) > 0)
		{
			$small_error = $output_text['executed_multi_sql'];

			// I need this to copy back over after using all the do_mysql_query()s
			$mysql_query_start_MULTI = time();

			// execute all the commands given
			//  this means, for laziness, that we process the first statement again
			//  so we clear it for memory reduction, just in case
			$statement = NULL;
			$small_error .= ' ('.execute_file_sql('sqlicity_empty_read_func',NULL,$cmd_data).')';

			// reset some things after do_mysql_query() -- it was a multi-query
			$mysql_query_start = $mysql_query_start_MULTI;
			$executed_sql = $cmd_data;
		}
		else  // no commands at all were submitted
		 { $small_error = $output_text['no_submitted_command']; }
	}
	// execute pure SQL code -- in an uploaded file!
	elseif ($mysql_command == 'upload_pure_sql')
	{
		// I need this to copy back over after using all the do_mysql_query()s
		$mysql_query_start_MULTI = time();

		// get the parameters for this upload
		if (!$_FILES['pure_sql_upload_file']['error'])
		{
			$upload_file = $_FILES['pure_sql_upload_file']['tmp_name'];
			$compression = $_POST['import_file_compression'];
			$upload_file_name = $_FILES['pure_sql_upload_file']['name'];

			// get ready to tell everyone the results
			$small_error = $output_text['executed_upload_sql']." '$upload_file_name'";


			// first, pull out the sql file, based on compression type
			// bzip2
			if ($compression == 'bz2')
			{
				// execute all the queries in the compressed file
				if ($bz = bzopen($upload_file, 'r'))
				{
					$small_error .= ' ('.execute_file_sql('bzread', $bz).')';
					bzclose($bz);
				}
				// could not open file for reading
				else { $small_error = $output_text['upload_file_unreadable']." '$upload_file'"; }
			}
			// gzip
			elseif ($compression == 'gz')
			{
				// execute all the queries in the compressed file
				if ($gz = gzopen($upload_file, 'r'))
				{
					$small_error .= ' ('.execute_file_sql('gzread', $gz).')';
					gzclose($gz);
				}
				// could not open file for reading
				else { $small_error = $output_text['upload_file_unreadable']." '$upload_file'"; }
			}
			// zip
			elseif ($compression == 'zip')
			{
				// open the zip archive
				if ($zip = zip_open($upload_file))
				{
					// zip can have multiple files
					while ($zip_entry = zip_read($zip))
					{
						// execute all the queries in ALL the zipped files
						if (zip_entry_open($zip, $zip_entry, 'r'))
						 { $small_error .= ' ('.execute_file_sql('zip_entry_read', $zip_entry).')'; }
						zip_entry_close($zip_entry);
					}

					// close the compressed file handle
					zip_close($zip);
				}
				// could not open file for reading
				else { $small_error = $output_text['upload_file_unreadable']." '$upload_file'"; }
			}
			// rar
			elseif ($compression == 'rar')
			{
				// open the rar archive
				if ($rar = rar_open($upload_file))
				{
					// rar can have multiple files
					$entries = rar_list($rar);

					// execute all the queries in ALL the rar'd files
					$rar_temp_name = tempnam(FALSE, 'sqlicity_rar');
					foreach ($entries as $entry)
					{
						// get the actual entry for extracting
						$entry = rar_entry_get($rar, $entry);

						// have to create the extracted file, read it then delete it...
						//  because rar ONLY has an extract() function, no direct read!
						$entry->extract(FALSE, $rar_temp_name);
						$rar_entry = fopen($rar_temp_name, 'rb');

						// execute the queries in this rar'd file
						$small_error .= ' ('.execute_file_sql('fread', $rar_entry).')';

						// close temp file for next interation
						fclose($rar_entry);
					}

					// close the compressed file handle and remove temp file
					rar_close($rar); unlink($rar_temp_name);
				}
				// could not open file for reading
				else { $small_error = $output_text['upload_file_unreadable']." '$upload_file'"; }
			}
			// no compression (plaintext)
			else
			{
				// execute all the queries in the plaintext file
				if ($pt = fopen($upload_file, 'rb'))
				{
					$small_error .= ' ('.execute_file_sql('fread', $pt).')';
					fclose($pt);
				}
				// could not open file for reading
				else { $small_error = $output_text['upload_file_unreadable']." '$upload_file'"; }
			}
		}
		// there was an error with the upload
		else { $small_error = $output_text['upload_file_error'].' #'.$_FILES['pure_sql_upload_file']['error']; }

		// reset some things after do_mysql_query() -- it was a multi-query
		$mysql_query_start = $mysql_query_start_MULTI;
		$executed_sql = $output_text['upload_executed_sql']." '$upload_file_name'";
	}
	// unknown command -- how did this happen?
	else
	 { $small_error = $output_text['unknown_sqlicity_command']; }

	// give the start and end times for the sql commands!
	$small_error .= "</b></p>\n\n<p style=\"font-size:90%;\">\n<i>$output_text[began_command_exec] ".
	 date($datetime_format,$mysql_query_start)."<br />\n $output_text[ended_command_exec] ".
	 date($datetime_format, $mysql_query_end).".</i><b>\n";
}


// shortcut: used in links, values, etc a lot -- ENT_QUOTES to cover all cases
//  HAS to be defined here because sqlicity commands can change the current table!
$cur_mysql_table_html = htmlutf($cur_mysql_table);
$cur_mysql_db_html = htmlutf($cur_mysql_db);





/******************************************

	CURRENT VIEW

Picks current view page

******************************************/

// tables should be empty for security, appending, etc
$curdb_tables = array();

// the vast majority of the time, we want to display standard sqlicity head/foot/etc
//  but sometimes (exporting data, etc) we want a page for just downloading stuff
//  then we cannot include the top/bottom/etc, we show ONLY the content page function
$show_only_content_page = FALSE;


// make sure nothing bad happened
//  connecting to the db before trying to pick a page...
if (!$massive_error)
{
	// TABLES
	$result_tables = mysql_query("SHOW TABLES");
	if ($result_tables)  // did we successfully load the tables?
	 { while($table = mysql_fetch_row($result_tables)) { $curdb_tables[] = $table[0]; } }
	else  // tables were not properly loaded
	{
		$small_error = $output_text['show_tables_failed'].mysql_error();
		$cur_mysql_table = '';
	}

	// define the content page for the current view
	if ($cur_mysql_table)
	{
		// COLUMNS
		if ($current_view == 'fields')
		 { $content_page = 'content_fields'; }
		// COLUMNS EDIT
		elseif ($current_view == 'edit_col')
		 { $content_page = 'content_edit_col'; }
		// DATA
		elseif ($current_view == 'data')
		 { $content_page = 'content_data'; }
		// DATA EDIT
		elseif ($current_view == 'edit_row')
		 { $content_page = 'content_edit_row'; }
		// IMPORT DATA
		elseif ($current_view == 'import_data')
		 { $content_page = 'content_import_data'; }
		// DO THE IMPORT
		elseif ($current_view == 'do_import_data')
		 // FIXME FIX ME -- eventually, this should NOT show_ony_content_page -- it should be in same window even!
		 { $content_page = 'content_do_import_data';
		  $show_only_content_page = TRUE; }
		// EXPORT DATA
		elseif ($current_view == 'export_data')
		 { $content_page = 'content_export_data'; }
		// DO THE EXPORT
		elseif ($current_view == 'do_export_data')
		 { $content_page = 'content_do_export_data';
		  $show_only_content_page = TRUE; }
		// EXPORT STRUCTURE
		elseif ($current_view == 'export_structure')
		 { $content_page = 'content_export_structure'; }
		// TABLE actions
		else  // is the default yes-table view
		 { $content_page = 'content_table'; }
	}
	// No table selected, typically db or system-wide information
	else
	{
		// SELECT
		if ($current_view == 'select_data')
		 { $content_page = 'content_select'; }
		// PROCESSLIST
		elseif ($current_view == 'show_processlist')
		 { $content_page = 'content_processlist'; }
		// USERLIST
		elseif ($current_view == 'show_userlist')
		 { $content_page = 'content_userlist'; }
		// CREATE TABLE
		elseif ($current_view == 'create_table')
		 { $content_page = 'content_create_table'; }
		// DO THE DB SQL EXPORT
		elseif ($current_view == 'do_db_sql_export')
		 { $content_page = 'content_do_db_sql_export';
		  $show_only_content_page = TRUE; }
		// DB MULTI TABLE actions
		else  // is the default no-table view
		 { $content_page = 'content_db_multi_table'; }
	}
}
else  // there has been a massive error with the database
 { $content_page = 'content_massive_error'; }






/*************************************************************************************
======================================================================================

		DATABASE STRUCTURE PAGES

Manage the database structure -- table, dbs, etc

======================================================================================
*************************************************************************************/




/******************************************

	MASSIVE ERROR CONTENT

Displayed when massive errors with database take place

******************************************/

function content_massive_error ()
{
	global $massive_error;
?>

<p>&nbsp;</p>
<p style="font-size: 130%; font-weight: bold;">
<?php echo $massive_error ?>
</p>
<p>&nbsp;</p>

<?php
}  // end content_massive_error




/******************************************

	DB MUTLI TABLE CONTENT

Select the mutliple tables for
 performing actions on all of them at once:
 e.g. exporting as SQL, dropping, etc

******************************************/

function content_db_multi_table ()
{
	global $curdb_tables, $cur_mysql_db_html;

	$curdb_tables_count = count($curdb_tables);
?>

<p>Select a single table to manage from the options on the left, or<br />
	here, to a limited extent, you can manage multiple tables at once:<br />
	export them as SQL, drop them, etc.
</p>

<p>Or, <a href="#" onClick="return setView('create_table');"
 class="button">CREATE a new table in this db</a><br />&nbsp;</p>

<script>
<!--

	// hold the number of tables we have to check
	var num_tables = <?php echo $curdb_tables_count ?>;

	// get all currently checked tables
	function getCheckedTables ()
	{
		theform = document.db_multi_table_form;
		checkedtables = new Array;

		// check all tables, see which ones are checked
		for (i=1;i<=num_tables;i++)
		 { t = theform['db_tables_'+i]; if (t.checked) { checkedtables.push(t.value); } }

		return checkedtables;
	}


	// get the list of tables, after confirming
	function confirm_multi_tables (actionname)
	{
		// get the checked tables
		checkedtables = getCheckedTables();
		checked_count = checkedtables.length;

		// make sure there are some tables to drop!
		if (checked_count < 1)
		 { alert('You must select tables to '+actionname+'!'); }

		// we have tables ready to send back
		else if (confirm('Are you sure you wish to '+actionname.toUpperCase()+' '+(checked_count>1 ? 'these '+checked_count+' tables?' : 'this 1 table?')))
		{
			// add the backticks/identifier quotes around the table names
			//  AND double up backticks/identifier quotes inside the names
			for (t in checkedtables) { checkedtables[t] = '`'+checkedtables[t].replace(/`/,'``')+'`'; }

			return checkedtables;
		}

		return null;
	}


	// drop selected tables
	function DB_DropTables ()
	{
		if (checkedtables = confirm_multi_tables('drop'))
		{
			if (!confirm('ALL DATA WILL BE LOST, are you SURE you want to DROP tables:\n '+checkedtables.join('\n ')+'\n?')) { return false; }

			return sendMySQLCommand('db_tables_drop', checkedtables.join(','));
		}

		return false;
	}

	// empty selected tables
	function DB_EmptyTables ()
	{
		if (checkedtables = confirm_multi_tables('empty'))
		{
			if (!confirm('ALL DATA WILL BE LOST, are you SURE you want to EMPTY tables:\n '+checkedtables.join('\n ')+'\n?')) { return false; }

			// since TRUNCATE only works on one table at a time,
			//  we have to build a multi query pure_sql command
			//  used to use command: db_tables_empty
			truncate_str = '';
			for (i in checkedtables)
			 { truncate_str += 'TRUNCATE TABLE '+checkedtables[i]+";\n"; }

			return sendMySQLCommand('pure_sql', truncate_str);
		}

		return false;
	}


	// export selected tables -- cmd decides struct/data/both
	function DB_SQLexport (command)
	{
		if (checkedtables = confirm_multi_tables('export'))
		{
			document.sqlicity_db_sql_export_form.tablelist.value = checkedtables.join(',');
			document.sqlicity_db_sql_export_form.submit();
		}

		return false;
	}


	// send a file to be processed as pure sql
	function DB_SQLupload ()
	{
		if (document.sqlicity_upload_sql_form.pure_sql_upload_file.value.length < 1)
		 { alert('You must select a file for upload!'); }
		else if (confirm('Are you sure you wish to EXECUTE the SQL in the uploaded file?'))
		 { document.sqlicity_upload_sql_form.submit(); }

		return false;
	}

//-->
</script>

<?php
	// make sure we have any tables to display!
	if ($curdb_tables_count > 0) {
?>

<form name="db_multi_table_form">
<table cellpadding="3" cellspacing="1" border="1">

	<tr><td colspan="5">
		&nbsp; <input type="checkbox"
		 onClick="for (i=1;i<=num_tables;i++) { this.form['db_tables_'+i].checked = this.checked; }" /> Select all
		&nbsp; &nbsp; &nbsp; <input type="checkbox"
		 onClick="for (i=1;i<=num_tables;i++) { t = this.form['db_tables_'+i]; t.checked = !t.checked; } return false;" /> Invert selection
	</td></tr>

	<tr>
		<th>&nbsp;</th>
		<th>Table Name</th>
		<th>Space Taken</th>
		<th># Columns</th>
		<th># Rows</th>
	</tr>

<?php
		// shortcut function
		function data_size ($size)
		{
			$a = array('number' => $size, 'suffix' => ' B', 'decimals' => 0);
			if ($a['number'] > 999) { $a['number'] /= 1024; $a['suffix'] = ' KB'; $a['decimals'] = 1; }
			if ($a['number'] > 999) { $a['number'] /= 1024; $a['suffix'] = ' MB'; $a['decimals'] = 2; }
			if ($a['number'] > 999) { $a['number'] /= 1024; $a['suffix'] = ' GB'; $a['decimals'] = 3; }
			return number_format($a['number'], $a['decimals']).$a['suffix'];
		}

		// draw all available tables
		$table_num = 0;
		$total_db_size = 0;
		$curdb_tables_full = mysql_query("SHOW TABLE STATUS");
		while ($table = mysql_fetch_assoc($curdb_tables_full))
//		foreach ($curdb_tables as $table)
		{
			// we need this to make the names to work in javascript
			$table_num++;

/*
array(18) {
  ["Name"]=>
  string(12) "custom_pages"
  ["Engine"]=>
  string(6) "MyISAM"
  ["Version"]=>
  string(1) "9"
  ["Row_format"]=>
  string(7) "Dynamic"
  ["Rows"]=>
  string(2) "18"
  ["Avg_row_length"]=>
  string(5) "12604"
  ["Data_length"]=>
  string(6) "226872"
  ["Max_data_length"]=>
  string(10) "4294967295"
  ["Index_length"]=>
  string(4) "2048"
  ["Data_free"]=>
  string(1) "0"
  ["Auto_increment"]=>
  string(2) "19"
  ["Create_time"]=>
  string(19) "2009-02-16 19:52:30"
  ["Update_time"]=>
  string(19) "2009-02-16 19:52:30"
  ["Check_time"]=>
  NULL
  ["Collation"]=>
  string(17) "latin1_swedish_ci"
  ["Checksum"]=>
  NULL
  ["Create_options"]=>
  string(0) ""
  ["Comment"]=>
  string(0) ""
}
*/

			// track total db size
			$total_db_size += $table['Data_length'];

			// draw the checkbox and that data
			//  adjust drawing based on zero vs nonzero rows in table
?>

	<tr>
		<td><input type="checkbox" name="db_tables_<?php echo $table_num ?>"
		 value="<?php echo htmlutf($table['Name']) ?>" /></td>
		<td><?php echo ($table['Rows'] > 0 ? htmlutf($table['Name']) : '<i>'.htmlutf($table['Name']).'</i>') ?></td>
		<td><?php echo data_size($table['Data_length']) ?></td>
		<td><?php echo @mysql_num_rows(mysql_query("SHOW COLUMNS FROM `$table[Name]`")) ?></td>
		<td><?php echo ($table['Rows'] > 0 ? $table['Rows'] : "<i>$table[Rows]</i>") ?></td>
	</tr>

<?php
		} // end table drawing
?>

<tr><td colspan="5"> &nbsp; <b>Total: &nbsp; <?php echo $curdb_tables_count ?> &nbsp; tables, &nbsp; <?php echo $total_db_size ?> &nbsp; KB used.</b></td></tr>

</table>
</form>

<p>
	<a href="#" onClick="return DB_DropTables();" class="button">Drop Tables</a><br />
	<a href="#" onClick="return DB_EmptyTables();" class="button">Empty Tables</a><br />
	&nbsp;
</p>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>"
 name="sqlicity_db_sql_export_form" method="POST" target="_blank">

	<input type="hidden" name="current_view" value="do_db_sql_export" />
	<input type="hidden" name="cur_mysql_db" value="<?php echo $cur_mysql_db_html ?>" />

<p>
	<a href="#" onClick="return DB_SQLexport();" class="button">Export Table SQL</a><br />
	<input type="hidden" name="tablelist" value="" />

	<input type="radio" name="structureordata" value="" checked="true" />Structure Only
	<input type="radio" name="structureordata" value="data" />Data Only
	<input type="radio" name="structureordata" value="full" />Data and Structure<br />

	Export with compression:
	<input type="radio" name="export_file_compression" value="" checked="true" /> None (plaintext)<br />
	<input type="radio" name="export_file_compression" value="zip"<?php if (!function_exists('zip_write')) { echo ' disabled="true"'; } ?>  /> Zip
	<input type="radio" name="export_file_compression" value="gz"<?php if (!function_exists('gzwrite')) { echo ' disabled="true"'; } ?> /> GZip
	<input type="radio" name="export_file_compression" value="bz2"<?php if (!function_exists('bzwrite')) { echo ' disabled="true"'; } ?>  /> BZip2
	<br />&nbsp;
</p>

</form>

<?php
	}  // end no tables conditional
	else  // tell the world
	 { echo "<p><b>There are no tables in this db yet!</b></p>\n"; }
?>

<hr />

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"
 enctype="multipart/form-data" name="sqlicity_upload_sql_form">

	<input type="hidden" name="mysql_command" value="upload_pure_sql" />
	<input type="hidden" name="cur_mysql_db" value="<?php echo $cur_mysql_db_html ?>" />

<p>
	<a href="#" onClick="return DB_SQLupload();" class="button">Upload SQL commands in a file</a><br />
	<input type="file" name="pure_sql_upload_file" />
	<br /> &nbsp; Compression:

	<input type="radio" name="import_file_compression" value="" checked="true" /> None (plaintext)<br />
	<input type="radio" name="import_file_compression" value="zip"<?php if (!function_exists('zip_open')) { echo ' disabled="true"'; } ?>  /> Zip
	<input type="radio" name="import_file_compression" value="gz"<?php if (!function_exists('gzopen')) { echo ' disabled="true"'; } ?> /> GZip
	<input type="radio" name="import_file_compression" value="bz2"<?php if (!function_exists('bzopen')) { echo ' disabled="true"'; } ?> /> BZip2
	<input type="radio" name="import_file_compression" value="rar"<?php if (!function_exists('rar_open')) { echo ' disabled="true"'; } ?> /> Rar

<?php
// PHP sometimes uses characters to shorten the text for the max upload filesize...
//  we want to convert that to an integer, and move this into KB instead of bytes
$upload_max_filesize = ini_get('upload_max_filesize');
switch ($upload_max_filesize{strlen($upload_max_filesize)-1})
{
	case 'G': $upload_max_filesize = substr($upload_max_filesize,0,-1)*1024*1024 -1; break;
	case 'M': $upload_max_filesize = substr($upload_max_filesize,0,-1)*1024 -1; break;
	case 'K': $upload_max_filesize = substr($upload_max_filesize,0,-1) -1; break;
	default: $upload_max_filesize = round($upload_max_filesize/1024)-1; break;
}
?>
	<br />Max allowed (by PHP) file size for upload:
	 <a href="http://us.php.net/manual/en/ini.core.php#ini.upload-max-filesize"><?php echo number_format($upload_max_filesize) ?></a> KB
</p>

</form>


<?php
}  // end content_db_multi_table




/******************************************

	CREATE TABLE CONTENT

Specialized interface to create a table

******************************************/

function content_create_table ()
{
	global $create_table_sql;
?>

<p><a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/create-table.html">CREATE</a>
	a new table below:
</p>

<p>Or, <a href="#" onClick="return setView('');"
 class="button">Return to multi-table actions page</a><br />&nbsp;</p>

<script>
<!--

function create_table ()
{
	if (confirm('Are you sure you wish to CREATE this table?'))
	 { return sendMySQLCommand('table_create', getByID('create_table_sql').value); }
	return false;
}

//-->
</script>

<p><textarea id="create_table_sql" cols="60" rows="10" wrap="off">
<?php

	if (!$create_table_sql)
	{
		$create_table_sql = "
CREATE TABLE `table` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

 `name` VARCHAR(255),
 `priority` INT NOT NULL,

 INDEX (`priority`),
 PRIMARY KEY (`id`)
)
";
	}  // end if table not just created

	// either way, echo it
	echo htmlutf($create_table_sql);

?>
</textarea></p>

<p><a href="#" onClick="return create_table()" class="button">Create a new table</a></p>

<?php
}  // end content_create_table




/******************************************

	TABLE CONTENT

Displays a single table's information

******************************************/

function content_table ()
{
	global $cur_mysql_table, $cur_mysql_table_html, $executed_sql, $mysql_version;
?>

<?php

	// if no already executed sql, give a default
	if (!$executed_sql)
	{
		$executed_sql = "
SELECT * FROM `$cur_mysql_table`

UPDATE `$cur_mysql_table` SET
 `col1`='val1'
WHERE
 `id`='111'
";
	}

?>

<p>Table <b><?php echo $cur_mysql_table_html ?></b></p>

<hr width="90%" />

<p>
	<a href="#" onClick="return setView('fields')" class="button">Fields (Columns) View</a>
	or
	<a href="#" onClick="return setView('data')" class="button">Data (Rows) View</a>
<?php
	// get # cols and # rows from db
	$num_cols = @mysql_num_rows(mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`"));
	$num_rows = @mysql_result(mysql_query("SELECT COUNT(*) FROM `$cur_mysql_table`"),0);
?>
	<br />Currently: <b><?php echo $num_cols ?></b> fields/columns and <b><?php echo $num_rows ?></b> rows of data found.
</p>

<hr width="90%" />

<p><a href="#" onClick="if (confirm('Are you sure you wish to EMPTY table `<?php echo $cur_mysql_table_html ?>`?')) {
	if (confirm('ALL DATA WILL BE LOST, are you SURE you want to EMPTY table `<?php echo $cur_mysql_table_html ?>`?')) {
	 return sendMySQLCommand('table_empty','') } } return false;" class="button">Empty Table</a></p>

<p><a href="#" onClick="if (confirm('Are you sure you wish to DROP table `<?php echo $cur_mysql_table_html ?>`?')) {
	if (confirm('ALL DATA WILL BE LOST, are you SURE you want to DROP table `<?php echo $cur_mysql_table_html ?>`?')) {
	 return sendMySQLCommand('table_drop','') } } return false;" class="button">Drop Table</a></p>

<script>
<!--

// used in command buttons
var old_table_name = '<?php echo $cur_mysql_table_html ?>';

function rename_table ()
{
	if ((name = prompt('Rename table `'+old_table_name+'` to:', old_table_name))
	 && (confirm('Are you sure you wish to RENAME table `'+old_table_name+'` to `'+name+'`?')))
	 { return sendMySQLCommand('table_rename',name) }

	return false;
}

function copy_table (copycmd)
{
	if (name = prompt('Copy table `'+old_table_name+'` to:', old_table_name))
	 { return sendMySQLCommand(copycmd,name) }

	return false;
}

//-->
</script>


<p><a href="#" onClick="return rename_table()" class="button">Rename Table</a></p>

<hr width="90%" />

<p><a href="#" onClick="return setView('export_structure');" class="button">Export Table Structure</a></p>

<p><a href="#" onClick="return setView('export_data');" class="button">Export Table Data</a></p>

<p><a href="#" onClick="return setView('import_data');" class="button">Import Table Data</a></p>

<hr width="90%" />

<?php if (check_mysql_version_min(4,1)) { ?>
<p><a href="#" onClick="return copy_table('table_copy');" class="button">Copy Table Structure</a></p>
<?php } else { ?>
<p>You need MySQL 4.1 to run a CREATE TABLE ... LIKE command.</p>
<?php } ?>

<p><a href="#" onClick="return copy_table('table_copy2');" class="button">Copy Table Structure Simple</a></p>


<?php
}  // end content_table




/******************************************

	FIELDS CONTENT

A page for displaying and modifying the fields in a table

******************************************/

function content_fields ()
{
	global $cur_mysql_table, $cur_mysql_table_html, $executed_sql, $mysql_version;
?>

<?php

	// if no already executed sql, give a default
	if (!$executed_sql)
	{
		$executed_sql = "
SELECT * FROM `$cur_mysql_table`

UPDATE `$cur_mysql_table` SET
 `col1`='val1'
WHERE
 `id`='111'
";
	}


	// get all field/column info from this table
	$columns = array();
	$result_cols = mysql_query("SHOW FULL COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the field/column data
	while($column = mysql_fetch_assoc($result_cols)) { $columns[] = $column; }

	// FULL is so that eventually I can show comments
	//  when working with higher MySQL version

?>

<p>Switch to <a href="#" onClick="return setView('data')" class="button">Data (Rows) View</a></p>

<p>Or,
	<a href="#" onClick="return sendMySQLCommand('pure_sql', 'SHOW INDEX FROM `<?php echo $cur_mysql_table_html ?>`');"
	 class="button">See table indices</a> or,
	<a href="#" onClick="return sendMySQLCommand('pure_sql', 'SHOW TABLE STATUS LIKE \'<?php echo $cur_mysql_table_html ?>\'');"
	 class="button">See table status</a><br />&nbsp;
</p>

<hr width="90%" />

<p>&nbsp;</p>

<script>
<!--

var cur_table = "<?php echo $cur_mysql_table_html ?>";
var last_table_field = "<?php echo htmlutf($columns[count($columns)-1]['Field']) ?>";
last_table_field = (last_table_field ? 'AFTER `'+last_table_field+'`' : 'FIRST');

function delete_field (field_name)
{
	if (confirm('Are you sure you wish to DELETE field `' + field_name + '`?'))
	 if (confirm('ALL DATA IN THIS COLUMN WILL BE LOST, are you SURE you want to DELETE field `' + field_name + '`?'))
	  { return sendMySQLCommand('table_del_col', field_name); }
	return false;
}

function field_change (field_name, allowNull, field_type, prev_field)
{
	promptstr = '`' + field_name + '` ' + field_type + (allowNull ? ' NULL' : ' NOT NULL');
<?php echo (check_mysql_version_min(4,0,1) ? "	promptstr += (prev_field ? ' AFTER `'+prev_field+'`' : ' FIRST');\n" : '') ?>

	if (name = prompt('Finish the SQL:\n ALTER TABLE `' + cur_table + '` CHANGE COLUMN `' + field_name + '` ', promptstr))
	 if (confirm('Are you sure you wish to\n ALTER TABLE `' + cur_table + '` CHANGE COLUMN `' + field_name + '` ' + name + '?'))
	  { return sendMySQLCommand('table_chg_col', '`' + field_name + '` ' + name); }
	return false;
}

function field_add ()
{
	promptstr = '`colname` INT NULL '<?php echo (check_mysql_version_min(3,22) ? ' + last_table_field' : '') ?>;
	if (name = prompt('Finish the SQL:\n ALTER TABLE `' + cur_table + '` ADD COLUMN ', promptstr))
	 { return sendMySQLCommand('table_add_col', name); }
	return false;
}

function alter_table ()
{
	if (name = prompt('Finish the SQL:\n ALTER TABLE `' + cur_table + '` ', 'ADD INDEX (`colname`)'))
	 if (confirm('Are you sure you wish to\n ALTER TABLE `' + cur_table + '` ' + name + '?'))
	  { return sendMySQLCommand('alter_table', name); }
	return false;
}

//-->
</script>


<p><table border="1" cellspacing="1" cellpadding="1" width="600">

	<tr class="table_name"><td colspan="9" align="center">
		<a href="#" class="button" onClick="return changeTable('<?php echo $cur_mysql_table_html ?>')"><?php echo $cur_mysql_table_html ?></a>
	</td></tr>

<?php
/*
 ATTEMPTED, doesn't look so hot...
  I NEED A BETTER WAY TO EXPRESS THE COMMENTS, PRIVILEGES AND COLLATION THAN THIS
  maybe table cell bg colors?...
  or empty rows entirely across the table between col/fields?


	// higher versions have extra info about columns/fields
	//  that we should display on extra rows, instead of just in extra columns
	$fieldrowspan = 1;
	if (check_mysql_version_min(3,23,32)) { $fieldrowspan = 2; }
	if (check_mysql_version_min(4,1)) { $fieldrowspan = 3; }
?>
	<tr class="column_title">
		<td valign="top"<?php echo ($fieldrowspan > 1 ? ' rowspan="'.$fieldrowspan.'"' : '')?>>Edit</td>
		<td valign="top"<?php echo ($fieldrowspan > 1 ? ' rowspan="'.$fieldrowspan.'"' : '')?>>Del</td>
		<td rowspan="<?php echo ((count($columns)+1)*$fieldrowspan) ?>">&nbsp;</td>
		<td width="25%">Field</td>
		<td width="25%">Type</td>
		<td width="10%">Null</td>
		<td width="10%">Key</td>
		<td width="10%">Default</td>
		<td width="20%">Extra</td>
<?php if (check_mysql_version_min(3,23,32)) { ?>
	</tr>
	<tr class="column_title">
		<td colspan="2">Collation</td>
		<td colspan="4">Privileges</td>
<?php } if (check_mysql_version_min(4,1)) { ?>
	</tr>
	<tr class="column_title">
		<td colspan="6">Comment</td>
<?php } ?>
	</tr>

<?php
	function nullcol ($name)
	 { global $column; return ($column[$name]===NULL ? '<i>NULL</i>' : $column[$name]); }

	// draw all the fields/columns
	$prev_field = NULL;  // previous column starts NULL for first col
	foreach ($columns as $column)
	{
?>
	<tr>

		<td<?php echo ($fieldrowspan > 1 ? ' rowspan="'.$fieldrowspan.'"' : '')?>>
			<input type="button" value="+" title="Edit this Field/Column"
			 onClick="return field_change('<?php echo htmlutf($column['Field'])."', ".($column['Null'] == 'YES' ? 'true' : 'false')
			 	.", '".htmlutf($column['Type'])."', '".htmlutf($prev_field) ?>');" />
		</td>

		<td<?php echo ($fieldrowspan > 1 ? ' rowspan="'.$fieldrowspan.'"' : '')?>>
			<input type="button" value="-" title="Remove this Field/Column"
			 onClick="return delete_field('<?php echo htmlutf($column['Field']) ?>');" />
		</td>

		<td>&nbsp;<?php echo htmlutf($column['Field']) ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Type'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Null'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Key'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Default'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Extra'] ?>&nbsp;</td>
<? if (check_mysql_version_min(3,23,32)) { ?>
	</tr>
	<tr>
		<td colspan="2">&nbsp;<?php echo $column['Collation'] ?>&nbsp;</td>
		<td colspan="4">&nbsp;<?php echo $column['Privileges'] ?>&nbsp;</td>
<? } if (check_mysql_version_min(4,1)) { ?>
	</tr>
	<tr>
		<td colspan="6">&nbsp;<?php echo $column['Comment'] ?>&nbsp;</td>
<? } ?>
	</tr>
<?php
		// remember this column for next one, to properly allow editing
		$prev_field = $column['Field'];
	}  // end column drawing

	END ADVANCED FIELD DISPLAY
*/
?>

	<tr class="column_title">
		<td>Edit</td>
		<td>Del</td>
		<td rowspan="<?php echo (count($columns) + 1) ?>">&nbsp;</td>
		<td width="25%">Field</td>
		<td width="25%">Type</td>
		<td width="10%">Null</td>
		<td width="10%">Key</td>
		<td width="10%">Default</td>
		<td width="20%">Extra</td>
	</tr>

<?php
	// draw all the fields/columns
	$prev_field = NULL;  // previous column starts NULL for first col
	foreach ($columns as $column)
	{
?>
	<tr>

		<td>
			<input type="button" value="+" title="Edit this Field/Column"
			 onClick="return field_change('<?php echo htmlutf($column['Field'])."', ".($column['Null'] == 'YES' ? 'true' : 'false')
			 	.", '".htmlutf($column['Type'])."', '".htmlutf($prev_field) ?>');" />
		</td>

		<td>
			<input type="button" value="-" title="Remove this Field/Column"
			 onClick="return delete_field('<?php echo htmlutf($column['Field']) ?>');" />
		</td>

		<td>&nbsp;<?php echo htmlutf($column['Field']) ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Type'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Null'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Key'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Default'] ?>&nbsp;</td>
		<td>&nbsp;<?php echo $column['Extra'] ?>&nbsp;</td>
	</tr>

<?php
		// remember this column for next one, to properly allow editing
		$prev_field = $column['Field'];
	}  // end column drawing
?>
</table></p>

<p>&nbsp;</p>

<?php if (!check_mysql_version_min(3,22)) { ?>
<p>You need MySQL version 3.22 to ADD columns with an AFTER/FIRST clause.</p>
<?php } elseif (!check_mysql_version_min(4,0,1)) { ?>
<p>You need MySQL version 4.0.1 to CHANGE columns with an AFTER/FIRST clause.</p>
<?php } ?>

<!-- FIXME FIX ME -- NEW FIELD STUFF HERE -- MORE INFO IS NEEDED THAN ABOVE (FOR EXTRAS) -->

<p><a href="#" onClick="return field_add();" class="button">Add New Column</a></p>

<p><a href="#" onClick="return alter_table();" class="button">Alter Table</a></p>

<?php
}  // end content_fields




/*************************************************************************************
======================================================================================

		IMPORT/EXPORT PAGES

These gives options and the actual output for doing data imports and exports

======================================================================================
*************************************************************************************/




/******************************************

	IMPORT/EXPORT FUNCTIONS

Functions used in importing and exporting

******************************************/

// function to determine if a column should be enclosed or not
function isEnclosedColumn ($type)
{
	// for OPTIONALLY enclosed, we need to know
	//  which field types do NOT need to be enclosed:
	// note that these are checked IN the actual field types
	//  and do not need to be identical to the field types
	//  (e.g. 'mediumint' will match to 'int')
	// NOTE: compared to output from phpmyadmin,
	//  they enclose all decimal and doubles
	//  assumedly also floats and bits
	$unenclosed_field_types = array(
	 'bit','int','float','double','decimal');
	// FIXME FIX ME -- not sure about BIT actually
	//  need to test this a bit for verification
	// AND decimal or float/double? -- are they strings?
	//  -- phpmyadmin dumps these enclosed

	// if this column is an unenclosed type, then... it's not enclosed
	//  have to do strpos not in_array because of different sizes: bigint/etc
	$type = strtolower($type);  // just in case
	foreach ($unenclosed_field_types as $unenc)
	 { if (strpos($type, $unenc) !== FALSE) { return FALSE; } }

	// if it's not an unenclosed type, then... it's enclosed
	return TRUE;
}


// replace mysql's escape chars properly
function unescape_mysql_chars ($string)
{
	global $mysql_escaped_chars;

	// cycle over every char in the string, look for escaped chars
	$string2 = '';  // the escaped string to return
	$escaped = FALSE;
	$maxlen = strlen($string);
	for($i=0;$i<$maxlen;$i++)
	{
		// get the char in question
		$c = $string{$i};

		// check for the escape char previously
		if (!$escaped)
		{
			// skip ALL first backslashes
			if ($c === "\\") { $escaped = TRUE; }
			// otherwise, it's a normal char, add it
			else { $string2 .= $c; }
		}
		else  // this char has been escaped
		{
			// next one starts escaping all over again
			$escaped = FALSE;
			// try to find the escape sequence replacement
			$c2 = $mysql_escaped_chars[$c];
			// if it doesn't exist, just use the original char
			$string2 .= ($c2 === NULL ? $c : $c2);
		}
	}

	// return the escaped string
	return $string2;
}


// output a table, given specific columns, in a specific order, as a SQL INSERT VALUES list
function output_sql_insert_values ($export_data, $display_columns, $enclosed_cols)
{
	global $cur_mysql_table, $mysql_escaped_chars,
	 $mysql_escaped_chars_values, $mysql_escaped_chars_keys;


	// some things do not need to be escaped for re-inserting (exports)
	//  the & and _ are pointless, really -- they escape to the same thing
	unset($mysql_escaped_chars['"']);
	unset($mysql_escaped_chars['b']);
	unset($mysql_escaped_chars['t']);
	unset($mysql_escaped_chars['%']);
	unset($mysql_escaped_chars['_']);

// shortcut vars, rather than repeatedly calculating these
$mysql_escaped_chars_values = array_values($mysql_escaped_chars);
$mysql_escaped_chars_keys = array_map(create_function('$c', 'return "\\\\".$c;' ), array_keys($mysql_escaped_chars));


	// start the INSERT VALUES statement
	$start_insert_values = "
INSERT INTO `$cur_mysql_table`
  (".implode(',', array_map(create_function(
   '$c', 'return "`$c`";'),$display_columns)).
  ")
 VALUES
";

	// handle each row one at a time
	//  track chars until draw a new insert values line
	$chars_so_far = $chars_until_reset = 100000; $firstinsert = TRUE;
	while ($exportrow = mysql_fetch_assoc($export_data))
	{
		// first of all, see if we need to draw the insert statement again
		if ($chars_so_far >= $chars_until_reset)
		{
			if (!$firstinsert) { echo ';'; }
			echo $start_insert_values;  // start a new insert values list
			$firstrow = TRUE; $firstinsert = FALSE;
			$chars_so_far = 0;  // reset the character counter
		}

		// after first row, add comma to separate value lists
		if (!$firstrow) { echo ', ('; }
		else { $firstrow = FALSE; echo '  (';  }

		// now handle every field in the row
		$firstcol = TRUE;  // to do separating on fields
		foreach ($exportrow as $name => $value)
		{
			// after first col, start with field terminator
			if (!$firstcol) { echo ','; }
			else { $firstcol = FALSE; }

			// handle NULLs specially
			if ($value !== NULL)
			{
				// empty strings MUST be enclosed, or it breaks the SQL
				//  FIXME FIX ME -- not sure if this could actually ever happen,
				//  it should be that only enclosed columns could have empty values
				if ($value === '') { echo "''"; $chars_so_far += 3; } else
				// enclosed data on _export_ (different when importing) will always need escaping
				//  while uneclosed data will never need escaping, almost by definition
				if ($enclosed_cols[$name])  // enclose and escape this data
				 { $value = add_mysql_slashes($value); echo "'$value'"; $chars_so_far += 3+strlen($value); }
				// no enclosing needed -- therefore no chance of escaped chars, so no escaping needed
				else { echo $value; $chars_so_far += strlen($value); }
			}
			// this is a NULL value -- in SQL output this is always 'NULL'
			else { echo 'NULL'; $chars_so_far += 5; }
		}

		// end the export line
		echo ")\n";
		$chars_so_far += 5;
	}

	// close off the values list sql statement
	echo ";\n";
}




/******************************************

	EXPORT STRUCTURE CONTENT

Display the SQL to recreate a table

******************************************/

function content_export_structure ()
{
	global $cur_mysql_table;
?>

<p align="left">
	Note that this is a <i>complete and exact</i> description
	of the structure of your table, generated by MySQL.
	You probably do not need to specify every detail
	contained here to recreate your table because many
	features will be defaults.  However, the below will
	certainly give you exactly what you have already.
</p>

<hr width="90%" />

<?php
	// get the create statement
	$create_statement = @mysql_result(mysql_query("SHOW CREATE TABLE `$cur_mysql_table`"),0,'Create Table');
?>

<p align="center"><textarea rows="25" cols="70" wrap="off">
<?php echo htmlutf($create_statement); ?>
</textarea></p>

<?php
}  // end content_export_structure




/******************************************

	EXPORT DATA CONTENT

Define the settings for exporting data

******************************************/

function content_export_data ()
{
	global $cur_mysql_table, $cur_mysql_db_html, $cur_mysql_table_html;


	// store all column names for building the select_columns
	$all_columns = array();  // store all column names (only the names)
	$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the column names
	while($column = mysql_fetch_assoc($result_cols))
	 { $all_columns[] = $column['Field']; }

	// NOW GET THE ACTUAL SEARCH DATA

	// defines the select condition
	$select_where = $_POST['select_where'];
	$select_columns = $_POST['select_columns'];


	// select_where MUST start with either: WHERE, ORDER, or LIMIT
	$select_where2 = strtoupper(substr(trim($select_where),0,5));
	if (($select_where2 !== NULL) && ($select_where2 !== '')
	 && (strpos($select_where2, 'WHERE') !== 0)
	 && (strpos($select_where2, 'ORDER') !== 0)
	 && (strpos($select_where2, 'LIMIT') !== 0))
	{
		echo "<p><span style=\"font-size:110%;\"><b>Invalid WHERE/etc clause!</b></span> -- <i>$select_where</i></p>\n";
		$select_where = 'WHERE 1=1 ORDER BY 1';
	}


	// defaults
	if (!$select_where && !$select_columns)
	{
		$select_columns = implode(', ', array_map(create_function(
		 '$c', 'return "`$c`";'), $all_columns));
		$select_where = 'WHERE 1=1 ORDER BY 1';
	}

	// this only happens if there is a where condition,
	//  but no columns were given to select
	if (!$select_columns) { $select_columns = '*'; }


	// FIXME FIX ME -- should I allow them to request that
	//  Sqlicity DOES write a file to the server?

?>

<script>
<!--

	// this way we can hit "Refresh Page" and not lose our select
	document.sqlicity_viewstate_form['select_where'].value = "<?php echo htmlutf($_POST['select_where']) ?>";
	document.sqlicity_viewstate_form['select_columns'].value = "<?php echo htmlutf($_POST['select_columns']) ?>";

	// for auto-filling certain standard formats for terminating/enclosing/etc values
	function fillStdFormat (ft,fn,fs, lt,ls, fo, dfe,nlft,eal)
	{
		theform = document.sqlicity_export_data_form;

		theform.fields_terminatedby.value = ft;
		theform.fields_enclosedby.value = fn;
		theform.fields_escapedby.value = fs;

		theform.lines_terminatedby.value = lt;
		theform.lines_startingby.value = ls;

		theform.fields_optionally_enclosed.checked = fo;

		theform.double_fields_encloser.checked = dfe;
		theform.noescape_lf_terminator.checked = nlft;
		theform.escape_all_newlines.checked = eal;

		theform.double_fields_encloser.disabled = (theform.fields_enclosedby.value.length < 1);
		theform.escape_all_newlines.disabled = (theform.fields_escapedby.value.length < 1);

		return false;
	}

//-->
</script>


<p>Export data in the format of <a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/select.html#id3247665">SELECT INTO OUTFILE</a><br />
	 (which is actually the format of <a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/load-data.html">LOAD DATA INFILE</a>)
</p>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>"
 name="sqlicity_export_data_form" method="POST" target="_blank">

	<input type="hidden" name="current_view" value="do_export_data" />
	<input type="hidden" name="cur_mysql_db" value="<?php echo $cur_mysql_db_html ?>" />
	<input type="hidden" name="cur_mysql_table" value="<?php echo $cur_mysql_table_html ?>" />


<p>
	SELECT<br />
	<textarea name="select_columns" rows="2" cols="60"
	 ><?php echo htmlutf($select_columns) ?></textarea><br />
	FROM `<b><?php echo $cur_mysql_table_html ?></b>`<br />
	<textarea name="select_where" rows="2" cols="60"
	 ><?php echo htmlutf($select_where) ?></textarea><br />
<p>

<p>
	<a href="#" class="button"
	 onClick="document.sqlicity_export_data_form.submit(); return false;">Export Data</a>
</p>


<table cellspacing="1" cellpadding="5" border="1" width="100%"><tr><td>

<p>
	<input type="radio" name="export_sqlinserts" value="sql"
	 onClick="getByID('selectout_options').style.display = 'none';" />
	 Export as SQL INSERT VALUES list.<br />
	<input type="radio" name="export_sqlinserts" value="" checked="true"
	 onClick="getByID('selectout_options').style.display = 'block';" />
	 Export as delimited text file, e.g. tab-delimited, CSV, etc -- SELECT INTO OUTFILE.<br />
</p>


<div id="selectout_options">

<p>&nbsp;<br />
	Pre-fill a standard format: |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','&quot;','\\\\','\\n','',true,false,true,true);">Sqlicity</a> |
	<a href="#" class="link" onClick="return fillStdFormat(',','','\\\\','\\n','',false,false,false,true);">CSV</a> |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','','\\\\','\\n','',false,false,false,true);">Tab-Delimited</a> |
	<a href="#" class="link" onClick="return fillStdFormat(',','&quot;','','\\r\\n','',true,true,true,false);">MS Access</a> |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','&quot;','\\\\','\\r\\n','',true,true,true,false);">MS Excel</a> |
</p>

<p>&nbsp;<br />
	<input type="checkbox" name="useSELECTINTOOUTFILE" value="yes"
	 onClick="document.sqlicity_export_data_form.addfirstlineheaders.disabled = this.checked;
	  getByID('sqlicity_export_options').style.display = (!this.checked ? 'block' : 'none');
	  getByID('mysql_export_options').style.display = (this.checked ? 'block' : 'none');"
	 onMouseOver="getByID('selectout_checked_message').style.display='block';"
	 onMouseOut="getByID('selectout_checked_message').style.display='none';" />
	Use MySQL SELECT INTO OUTFILE
</p>

<div id="mysql_export_options" style="display:none">
<p>&nbsp;<br />
	File on server -- to save export as:<br />
	&nbsp; <input type="text" name="sqlicity_exportfile" size="50" /><br />
	<input type="radio" name="exportfile_absolutepath" value="" checked="true" />
	 Relative to Sqlicity path
	<input type="radio" name="exportfile_absolutepath" value="yes" />
	 Relative to DB path (or an absolute path)
</p>
</div>

<div id="sqlicity_export_options">
<p>&nbsp;<br />
	<input type="checkbox" name="addfirstlineheaders" value="yes" />
	Inlcude a column header list for the first line.
</p>

<p>
	<input type="checkbox" name="sqlicity_export_saveonserver" value="yes"
	 onClick="getByID('sqlicity_saveonserver_location').style.display = (this.checked ? 'block' : 'none');"
	 onMouseOver="showHelpMsg(event,'export_saveonserver_message');"
	 onMouseOut="hideHelpMsg(event,'export_saveonserver_message');" />
	Save this file on the server, like SELECT INTO OUTFILE.<br />
</p>

<div id="sqlicity_saveonserver_location" style="display:none">
<p>&nbsp;<br />
	File on server -- to save export as:<br />
	&nbsp; <input type="text" name="sqlicity_exportfile2" size="50" /><br />
	<input type="radio" name="exportfile_absolutepath2" value="" checked="true" />
	 Relative to Sqlicity path
	<input type="radio" name="exportfile_absolutepath2" value="yes" />
	 An absolute path (NOT relative to the DB!)
</p>
</div>

<p>Compress file into format:<br />
	<input type="radio" name="export_file_compression" value="" checked="true" />
	 No compression, file will be plaintext.<br />
	<input type="radio" name="export_file_compression" value="zip"<?php if (!function_exists('zip_write')) { echo ' disabled="true"'; } ?>  /> Zip
	<input type="radio" name="export_file_compression" value="gz"<?php if (!function_exists('gzwrite')) { echo ' disabled="true"'; } ?> /> GZip
	<input type="radio" name="export_file_compression" value="bz2"<?php if (!function_exists('bzwrite')) { echo ' disabled="true"'; } ?>  /> BZip2
</p>

<p>Sqlicity only enhancements:<br />
	&nbsp; NOTE: all of these can be read perfectly by LOAD DATA INFILE without problems!<br />

	<span onMouseOver="showHelpMsg(event,'double_encloser_message');"
	 onMouseOut="hideHelpMsg(event,'double_encloser_message');">
		<input type="checkbox" name="double_fields_encloser" value="yes" disabled="true" />
		 Double field enclosing char (rather than escaping it)<br /></span>
	<span onMouseOver="showHelpMsg(event,'noescape_lft_message');"
	 onMouseOut="hideHelpMsg(event,'noescape_lft_message');">
		<input type="checkbox" name="noescape_lf_terminator" value="yes" />
		 Do NOT escape the first character of the line terminators in enclosed data<br /></span>
	<span onMouseOver="showHelpMsg(event,'esc_newlines_message');"
	 onMouseOut="hideHelpMsg(event,'esc_newlines_message');">
		<input type="checkbox" name="escape_all_newlines" value="yes" />
		 DO escape all newlines (rather than just outputting actual line breaks)<br /></span>
</p>
</div>


<p>&nbsp;<br /><b>FIELDS</b>:<br />
	&nbsp; TERMINATED BY <input type="text" name="fields_terminatedby" size="10" value="\t" /><br />
	&nbsp; <input type="checkbox" name="fields_optionally_enclosed" value="yes" />
	 OPTIONALLY ENCLOSED (unchecked will enclose ALL columns)<br />
	&nbsp; ENCLOSED BY <input type="text" name="fields_enclosedby" maxlength="2" size="4" value=""
	 onChange="document.sqlicity_export_data_form.double_fields_encloser.disabled = (this.value.length < 1);" /><br />
	&nbsp; ESCAPED BY <input type="text" name="fields_escapedby" maxlength="2" size="4" value="\\"
	 onChange="document.sqlicity_export_data_form.escape_all_newlines.disabled = (this.value.length < 1);" /><br />
</p>

<p><b>LINES</b>:<br />
	&nbsp; TERMINATED BY <input type="text" name="lines_terminatedby" size="10" value="\n" /><br />
	&nbsp; STARTING BY <input type="text" name="lines_startingby" size="10" value="" /><br />
</p>

</div>


<div id="export_saveonserver_message" class="helpwindow">
<p>
	&nbsp; Using Sqlicity's export with "Save this file on the server",
	the might be slightly different than SELECT INTO OUTFILE which
	runs as the user assigned to the mysqld application, while
	this will have the file permissions/access rights that PHP has.
	That might affect where you can save files.
</p>
</div>

<div id="selectout_checked_message" class="helpwindow">
<p>
	&nbsp; Using MySQL's SELECT INTO OUTFILE requires that
	you have the FILE privilege and that mysql has permission to write into the directory
	you request for the export file. It will write the file to the server,
	AND offer to let you download it directly from the server after it has been written.
</p>

<p>
	&nbsp; Unchecked, Sqlicity will use its own export functionality,
	which does NOT require you to have the FILE privilege -- the export file will never
	be written to the server, it will only be sent directly to you --
	and is <i>identical</i> when given proper input.<br /> &nbsp; However, it will give
	different results with bad input (e.g. a single \ instead of properly doubled: \\,
	or any other attempt to break the SQL such as "';SELECT * FROM `mysql`;"
	-- note: trying to hack the db in this way will never work, you obviously already have
	access through Sqlicity to everything that could work with sql injection attacks).
</p>
</div>

<div id="double_encloser_message" class="helpwindow">
<p>
	MESSAGE 1
</p>
</div>

<div id="noescape_lft_message" class="helpwindow">
<p>
	MESSAGE 2
</p>
</div>

<div id="esc_newlines_message" class="helpwindow">
<p>
	MESSAGE 3
</p>
</div>

</td></tr></table>

</form>

<center>

<?php
}  // end content_export_data




/******************************************

	DO EXPORT DATA CONTENT

Export data in CSV, tab-delimited, etc format

******************************************/

function content_do_export_data ()
{
	global $cur_mysql_table;


	// just a quick error message function for the export routine
	function draw_errmsg ($msg,$qry,$msg2)
	 { echo "<p><span style=\"font-size:110%;\"><b>$msg</b></span> -- <br />\n <i>$qry</i><br /><b>$msg2</b></p>\n"; }


	// see if they want MySQL to do the export, rather than Sqlicity:
	if ($_POST['useSELECTINTOOUTFILE'])
	{
		$sqlicity_exportfile = trim($_POST['sqlicity_exportfile']);

		// make sure they requested a file!
		if (!$sqlicity_exportfile)
		 { draw_errmsg('You need to specify a file location for the export to be saved!', '', ''); return; }

		// export location can be relative or absolute
		if ($_POST['exportfile_absolutepath'])
		 { $thefile = $sqlicity_exportfile; }
		else // relative path is the default
		 { $thefile = getcwd().'/'.$sqlicity_exportfile; }

		// do the export
		mysql_query($query = "SELECT * INTO OUTFILE '$thefile'
		 FIELDS
		  TERMINATED BY '$_POST[fields_terminatedby]'
		  ".(trim($_POST['fields_optionally_enclosed']) ? ' OPTIONALLY' : '')."
		  ENCLOSED BY '$_POST[fields_enclosedby]'
		  ESCAPED BY '$_POST[fields_escapedby]'
		 LINES
		  TERMINATED BY '$_POST[lines_terminatedby]'
		  STARTING BY '$_POST[lines_startingby]'
		 FROM `$cur_mysql_table`
		;");

		// see if they have an error trying this query
		if (mysql_error())
		 { draw_errmsg('Your SELECT INTO OUTFILE failed', nl2br($query), mysql_error()); return; }

		// ASSERT: it worked, give the user the file as well
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($thefile).'"');

		// read and output the file in chunks,
		//  this allows us to handle much bigger files here
		$export_filehandle = fopen($thefile, 'rb');
		while (!feof($export_filehandle))
		 { echo fread($export_filehandle, 8192); }
		fclose($export_filehandle);

		// quit now, the rest is for sqlicity's export functionality
		return;
	}


// FIRST, make sure the submitted stuff makes sense as a SELECT

	// get the select conditions from submitted form
	$select_where = $_POST['select_where'];
	$select_columns = $_POST['select_columns'];


	// store all column names, and enclosed columns+BLOB columns
	//  SEE THE COMMENTS WITH THE SELECT PAGE CONTENTS
	$all_columns = array();  // store all column names (only the names)
	$enclosed_cols = array();  // track enclosed string columns
	$blob_cols = array();  // track BLOB columns
	$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the columns and flag important ones
	while($column = mysql_fetch_assoc($result_cols))
	{
		// find out if this column should be enclosed on output
		if (isEnclosedColumn($column['Type']))
		 { $enclosed_cols[$column['Field']] = TRUE; }

		// handle BLOB type columns specially
		if (strtolower(substr($column['Type'],0,4)) == 'blob')
		 { $blob_cols[$column['Field']] = TRUE; }

		// store all column names in case no explicit select_columns was given
		$all_columns[] = $column['Field'];
	}


	// check for columns to select
	if (!$select_columns) { $select_columns = implode(', ', array_map(create_function('$c', 'return "`$c`";'), $all_columns)); }

	// select_where MUST start with either: WHERE, ORDER, or LIMIT
	$select_where2 = strtoupper(substr(trim($select_where),0,5));
	if (($select_where2 !== NULL) && ($select_where2 !== '')
	 && (strpos($select_where2, 'WHERE') !== 0)
	 && (strpos($select_where2, 'ORDER') !== 0)
	 && (strpos($select_where2, 'LIMIT') !== 0))
	 { draw_errmsg('Invalid WHERE/etc clause!', $select_where, ''); return; }


	// try the SELECT now so that we can verify it will actuall work!
	$export_data = mysql_query($query_temp = "SELECT $select_columns FROM `$cur_mysql_table` $select_where");

	// make sure their query was valid...
	if (mysql_error())
	 { draw_errmsg('ERROR in query', $query_temp, mysql_error()); return; }

	// make sure there is data to export!
	if (mysql_num_rows($export_data) < 1)
	 { draw_errmsg('NO data in this SELECT to export!', $query_temp, $cur_mysql_table); return; }


// ASSERT: now we have valid data for export selected already

	// get the actually displayed columns, for building the list with INSERT or column header list
	//  we just do the exact same export query, and pull off the first entry to get the column names from it
	// I'd like to do a LIMIT 1 in here, but there might already be a LIMIT in $select_where...
	$display_columns = mysql_query("SELECT $select_columns FROM `$cur_mysql_table` $select_where");
	$display_columns = mysql_fetch_assoc($display_columns);
	$display_columns = array_keys($display_columns);


	// are we doing SQL INSERTs or delimited output?
	$exportSQLinsert = ($_POST['export_sqlinserts'] ? TRUE : FALSE);

	// are we trying to save this to the server?
	$thefile = NULL;
	if ($_POST['sqlicity_export_saveonserver'])
	{
		// make sure they requested a file!
		if (!$_POST['sqlicity_exportfile2'])
		 { draw_errmsg('You need to specify a file location for the export to be saved!', '', ''); return; }

		// export location can be relative or absolute
		if ($_POST['exportfile_absolutepath2'])
		 { $thefile = $_POST['sqlicity_exportfile2']; }
		else // relative path is the default
		 { $thefile = getcwd().'/'.$_POST['sqlicity_exportfile2']; }

		// we will NOT overwrite existing files with this!
		if (@file_exists($thefile))
		 { draw_errmsg('That file already exists -- you cannot overwrite existing files!', $thefile, ''); return; }

		// name the file we send to the user after the export filename
		$export_filename = basename($thefile);
	}
	else  // normal sqlicity export: send directly to user
	{
		// name the file we send to the user after the table being exported
		$export_filename = $cur_mysql_table.'.';

		// if no compression requested, file extension is .txt or .sql
		if (!$_POST['export_file_compression'])
		{
			// if we are outputing sql, name it .sql
			if ($exportSQLinsert) { $export_filename .= 'sql'; }
			// basic delimited file is plaintext
			else { $export_filename .= 'txt'; }
		}
		// compression type defines file extension
		else { $export_filename .= $_POST['export_file_compression']; }
	}


	// identify this as a zip file being transferred
	//  or just generic binary data: application/octet-stream
	//  http://www.graphcomp.com/info/specs/mime.html
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.$export_filename.'"');

	// if this is going to be compressed or written to the server, save it all
	//  otherwise it's plaintext and I can just put it out as I go along
	if ($fileextension || $thefile) { ob_start(); }


	// if we're outputing SQL, we do that special -- same func as with db sql export
	if ($exportSQLinsert) { output_sql_insert_values($export_data, $display_columns, $enclosed_cols); }
	else  // normal output
	{
		// get field/line terminator/encloser/escape chars and optionally, etc
		//  these get overwritten if we're exporting sql inserts
		// the eval()s are needed to handle escaped chars like \n, etc properly
		$optionally_enclosed = ($_POST['fields_optionally_enclosed'] ? TRUE : FALSE);
		$field_enclose_char = unescape_mysql_chars($_POST['fields_enclosedby']);
		$field_enclose_char = $field_enclose_char{0};  // force only one char
		$field_escape_char = unescape_mysql_chars($_POST['fields_escapedby']);
		$field_escape_char = $field_escape_char{0};  // force only one char
		$field_terminatedby = unescape_mysql_chars($_POST['fields_terminatedby']);
		$line_terminatedby = unescape_mysql_chars($_POST['lines_terminatedby']);
		$line_startingby = unescape_mysql_chars($_POST['lines_startingby']);

		// this one picks which string to use in place of enclosers in data
		$encloser_in_data = ($_POST['double_fields_encloser'] ?
		 $field_enclose_char.$field_enclose_char : $field_escape_char.$field_enclose_char);


		// these are used only for escaping fields/lines terminated by sequence
		//  FIXME FIX ME -- have to test this properly:
		//  is this only inside enclosed data?
		//  what about newline chars when terminator is newline????
		$field_terminated_firstchar = $field_terminatedby{0};
		$line_terminated_firstchar = $line_terminatedby{0};


		// the list of chars that need to be escaped on output
		//  this is for the loop over all the field data in every row
		//  AND also for the column header list, if that is output
		$output_escaped_chars = array(
			// ASCII 0 (NUL) byte
			chr(0) => $field_escape_char.'0',

			// the escape char itself
			$fields_escape_char => $field_escape_char.$fields_escape_char,

			// the encloser char itself -- echo doubled or escaped, picked above
			$field_enclose_char => $encloser_in_data,

			// first char of fields terminated by
			$field_terminated_firstchar => $field_escape_char.$field_terminated_firstchar,

			// first char of lines terminated by
			$line_terminated_firstchar => $field_escape_char.$line_terminated_firstchar,
		);

		// just in case any empties (e.g. enclose_char) come in
		//  such empty keys can seriously break str_replace
		unset($output_escaped_chars['']);

		// remove line/field terminator escaped chars if requested
		if ($_POST['noescape_lf_terminator'])
		{
			unset($output_escaped_chars[$field_terminated_firstchar]);
			unset($output_escaped_chars[$line_terminated_firstchar]);
		}

		// add newline escape chars if requested
		if ($_POST['escape_all_newlines'])
		{
			$output_escaped_chars["\n"] = '\n';
			$output_escaped_chars["\r"] = '\r';
		}


		// when not outputting sql, we might want a header line
		if ($_POST['addfirstlineheaders'])
		{
			// we need to handle escaped chars in the column names!
			foreach($display_columns as $k => $col)
			{
				// if there is escaping going on, we do some here
				if ($field_escape_char)
				{
					// we do not handle enclosers here, that is outside this escaping
					//  so we TEMPORARILY turn this off
					unset($output_escaped_chars[$field_enclose_char]);

					// do the escaping needed for this identifier
					$col = str_replace(array_keys($output_escaped_chars),
					 array_values($output_escaped_chars), $col);

					// return this to original, IF there is an encloser at all!
					if ($field_enclose_char)
					 { $output_escaped_chars[$field_enclose_char] = $encloser_in_data; }
				}

				// even if there is no official escaping going on, we double enclosers anyway
				$col = str_replace($field_enclose_char, $field_enclose_char.$field_enclose_char, $col);

				// use the original or escaped identifier name (as it is now)
				//  and ALL identifiers get enclosed, whether an encloser exists or not
				$display_columns[$k] = $field_enclose_char.$col.$field_enclose_char;
			}

			// now that we've fixed encloser chars, echo it joinned
			//  make sure to include startingby and terminatedby strings
			//  -- this is a real line like the rest, and will be imported as such
			echo $line_startingby.implode($field_terminatedby, $display_columns).$line_terminatedby;
		}

		// handle each row one at a time -- using the select we did above
		while ($exportrow = mysql_fetch_assoc($export_data))
		{
			// start the row's "line" properly
			echo $line_startingby;

			// now handle every field in the row
			$firstcol = TRUE;  // to do separating on fields
			foreach ($exportrow as $name => $value)
			{
				// after first col, start with field terminator
				if (!$firstcol) { echo $field_terminatedby; }
				else { $firstcol = FALSE; }

				// handle NULLs specially
				if ($value !== NULL)
				{
					// enclosed data on _export_ (different when importing) will always need escaping
					//  while uneclosed data will never need escaping, almost by definition
					if ($enclosed_cols[$name] || !$optionally_enclosed)
					{
						// open enclosed data
						echo $field_enclose_char;

						// are we actually escaping chars?
						if ($field_escape_char)
						 { echo str_replace(array_keys($output_escaped_chars),
							array_values($output_escaped_chars), $value); }

						// no escaping is being done at all
						else { echo $value; }

						// close enclosed data
						echo $field_enclose_char;
					}
					// no enclosing needed -- therefore no chance of escaped chars, so no escaping needed
					else { echo $value; }
				}
				// this is a NULL value -- different with and without escape char
				else { echo ($field_escape_char ? $field_escape_char.'N' : 'NULL' ); }
			}

			// end the row's "line" properly
			echo $line_terminatedby;
		}
	}  // end non sql insert export version


	// do the compression, if requested
	$compressed_export_file = '';  // default to empty
	if ($fileextension)
	{
		// get all the content of the file to be compressed
		$export_file_contents = ob_get_contents();
		ob_end_clean();  // need to end before we try to echo the content!

		// have to do different compressions differently
		switch ($fileextension)
		{
		case 'zip':
			$compressed_export_file = 'zip';
		break;

		case 'gz':
			$compressed_export_file = 'gz';
		break;

		case 'bz2':
			$compressed_export_file = 'bz2';
		break;
		}


		// php does NOT write zip?!?!
		//  http://www.smiledsoft.com/demos/phpzip/index.shtml

		// consider alternative (open-source) compression:
		//  http://www.php.net/manual/en/wrappers.compression.php


		// this will not be written to the server, so just send it now
		if (!$thefile) { echo $compressed_export_file; }
	}  // end do compression conditional

	// allow for sqlicity exporting into a file on the server:
	if ($thefile)
	{
		// simluates a PHP 5 function -- named 2 to not conflict
		function file_put_contents2 ($filename, $data)
		{
			$retval = FALSE;
			if ($file_res = fopen($filename, 'wb'))
			 { $retval = fwrite($file_res, $data); fclose($file_res); }
			return $retval;
		}

		// did we compress the export file?
		//  NOTE: I made a choice, better to be told that the file
		//  was NOT saved on the server, than to download the file
		//  thinking that it did in fact happen
		if ($fileextension)
		{
			// write it to the server, then echo it for the user to download
			if (@file_put_contents2($thefile, $compressed_export_file) === FALSE)
			 { echo "\nFile NOT successfully saved on server at\n $_POST[sqlicity_exportfile2]\n-- are you sure your permissions are high enough?\n\nYou must redo the export WITHOUT trying to save to the server\n in order to download the export file.\n"; return; }
			echo $compressed_export_file;
		}
		// plaintext, not compressed -- export file contents come from OB
		else
		{
			// write it to the server, then echo it for the user to download
			$export_file_contents = ob_get_contents();
			ob_end_clean();  // need to end before we try to echo the content!
			if (@file_put_contents2($thefile, $export_file_contents) === FALSE)
			 { echo "\nFile NOT successfully saved on server at\n $_POST[sqlicity_exportfile2]\n-- are you sure your permissions are high enough?\n\nYou must redo the export WITHOUT trying to save to the server\n in order to download the export file.\n"; return; }
			echo $export_file_contents;
		}
	}  // end writing to server

}  // end content_do export_data



/******************************************

	IMPORT DATA CONTENT

Import data from CSV, etc format
	uses either FILE (if privileged)
	or vanilla INSERT VALUES

******************************************/

function content_import_data ()
{
	global $cur_mysql_table, $cur_mysql_db_html, $cur_mysql_table_html;

	// we need a list of the column names to default fill the column header list
	$all_columns = array();  // store all column names (only the names)
	$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the column names as a string list in SQL identifier format
	while($column = mysql_fetch_assoc($result_cols))
   { $all_columns[] = '`'.$column['Field'].'`'; }
  $all_columns = implode(',',$all_columns);

?>

<script>
<!--

	// for auto-filling certain standard formats for terminating/enclosing/etc values
	//  note that import is more lenient than export -- some export features
	//  are allowed to be either way while importing, even in the same field data/etc
	function fillStdFormat (ft,fn,fs, lt,ls)
	{
		theform = document.sqlicity_import_data_form;

		theform.fields_terminatedby.value = ft;
		theform.fields_enclosedby.value = fn;
		theform.fields_escapedby.value = fs;

		theform.lines_terminatedby.value = lt;
		theform.lines_startingby.value = ls;

		return false;
	}

//-->
</script>


<p>Import data in the format of <a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/load-data.html">LOAD DATA INFILE</a>
</p>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data"
 onSubmit="alert(this.sqlicity_importfile1.value); alert(this.importLOCALfile[0].value);"
 name="sqlicity_import_data_form" method="POST" target="_blank">

	<input type="hidden" name="current_view" value="do_import_data" />
	<input type="hidden" name="cur_mysql_db" value="<?php echo $cur_mysql_db_html ?>" />
	<input type="hidden" name="cur_mysql_table" value="<?php echo $cur_mysql_table_html ?>" />


<p>
	<a href="#" class="button"
	 onClick="theform = document.sqlicity_import_data_form;
	  // have to copy value into a hidden to get full local path, and need to handle windows backslashes!
	  theform.sqlicity_importfile1.value = theform.sqlicity_importfile_browser.value.replace(/\\/g,'\\\\');
	  theform.submit(); return false;">Import Data</a>
</p>

<table cellspacing="1" cellpadding="5" border="1" width="100%"><tr><td>

<p>
	<input type="radio" name="importLOCALfile" value="yes" checked="true"
	 onClick="getByID('absolutepath_display').style.display = 'none';" />
	 Use LOCAL file for input:<br />
	<input type="hidden" name="sqlicity_importfile1" />
	&nbsp; <input type="file" name="sqlicity_importfile_browser"
	 onChange="getByID('absolutepath_display').style.display = 'none';
	  document.sqlicity_import_data_form.importLOCALfile[0].checked=true;" />
</p>

<p>
	<input type="radio" name="importLOCALfile" value=""
	 onClick="getByID('absolutepath_display').style.display = 'block';" />
	 Use file already on server:<br />
	&nbsp; <input type="text" name="sqlicity_importfile2" size="50"
	 onChange="getByID('absolutepath_display').style.display = 'block';
	  document.sqlicity_import_data_form.importLOCALfile[1].checked=true;" />

<div id="absolutepath_display" style="display:none">
	<input type="radio" name="importfile_absolutepath" value="" checked="true" />
	 Relative to Sqlicity path
	<input type="radio" name="importfile_absolutepath" value="yes" />
	 Relative to DB path (or an absolute path)
</div>
</p>



<p>&nbsp;<br />
	<input type="checkbox" name="useLOADDATAINFILE" value="yes"
	 onClick="theform = document.sqlicity_import_data_form;
	 theform.firstlineheader[0].disabled = this.checked;
	 if (this.checked) { theform.firstlineheader[1].checked = true; }
	 getByID('filecompression').style.display = (this.checked ? 'none' : 'block');
	 getByID('lowpri_concset').style.display = (this.checked ? 'block' : 'none');" />
	Use MySQL LOAD DATA INFILE.
</p>

<div id="lowpri_concset" style="display:none">

<p>
	LOW_PRIORITY OR CONCURRENT?<br />
	 <input type="radio" name="ldi_lowpri_concur" value="" checked="true" /> Neither
	 <input type="radio" name="ldi_lowpri_concur" value="LOW_PRIORITY" /> LOW_PRIORITY
	 <input type="radio" name="ldi_lowpri_concur" value="CONCURRENT" /> CONCURRENT
</p>

<p>
	SET ...<br /><textarea name="ldi_setlist" rows="5" cols="40" disabled="true"></textarea>
</p>

</div>

<div id="filecompression">

<p>&nbsp;<br />File is compressed in format:<br />
	<input type="radio" name="import_file_compression" value="" checked="true" />
	 No compression, file is plaintext.<br />
	<input type="radio" name="import_file_compression" value="zip"<?php if (!function_exists('zip_open')) { echo ' disabled="true"'; } ?>  /> Zip
	<input type="radio" name="import_file_compression" value="gz"<?php if (!function_exists('gzopen')) { echo ' disabled="true"'; } ?> /> GZip
	<input type="radio" name="import_file_compression" value="bz2"<?php if (!function_exists('bzopen')) { echo ' disabled="true"'; } ?> /> BZip2
	<input type="radio" name="import_file_compression" value="rar"<?php if (!function_exists('rar_open')) { echo ' disabled="true"'; } ?> /> Rar
</p>

</div>

<p valign="center">&nbsp;<br />
	<input type="radio" name="firstlineheader" value="yes"
	 onClick="document.sqlicity_import_data_form.columnheaderlist.disabled=true;" />
	The first line of this file is the column header list.<br />
	<input type="radio" name="firstlineheader" value="" checked="true"
	 onClick="document.sqlicity_import_data_form.columnheaderlist.disabled=false;" />
	Use this column list (surrounding parentheses will be added by Sqlicity):<br />
	 &nbsp; <textarea name="columnheaderlist" rows="2" cols="40"><?php echo htmlutf($all_columns) ?></textarea><br />
</p>

<p>&nbsp;<br />
	Pre-fill a standard format: |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','&quot;','\\\\','\\n','');">Sqlicity</a> |
	<a href="#" class="link" onClick="return fillStdFormat(',','','\\\\','\\n','');">CSV</a> |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','','\\\\','\\n','');">Tab-Delimited</a> |
	<a href="#" class="link" onClick="return fillStdFormat(',','&quot;','','\\r\\n','');">MS Access</a> |
	<a href="#" class="link" onClick="return fillStdFormat('\\t','&quot;','\\\\','\\r\\n','');">MS Excel</a> |
</p>

<p><b>FIELDS</b>:<br />
	&nbsp; TERMINATED BY <input type="text" name="fields_terminatedby" size="10" value="\t" /><br />
	&nbsp; ENCLOSED BY <input type="text" name="fields_enclosedby" maxlength="2" size="4" value="" /><br />
	&nbsp; ESCAPED BY <input type="text" name="fields_escapedby" maxlength="2" size="4" value="\\" /><br />
</p>

<p><b>LINES</b>:<br />
	&nbsp; TERMINATED BY <input type="text" name="lines_terminatedby" size="10" value="\n" /><br />
	&nbsp; STARTING BY <input type="text" name="lines_startingby" size="10" value="" /><br />
</p>


<p>
	Existing Records:
	 <input type="radio" name="replaceexistingrecords" value="" checked="true" /> IGNORE
	 <input type="radio" name="replaceexistingrecords" value="REPLACE" /> REPLACE
</p>

<p>
	IGNORE <input type="text" name="linestoignore" size="5" value="0" /> LINES<br />
	&nbsp; Remember: really this is ignore the first # of <i>rows</i> parsed
	 (ready to be imported) from the file. It has nothing to do with line breaks.
</p>


</td></tr></table>

</form>

<?php
}  // end content_import_data




/******************************************

	DO IMPORT DATA CONTENT

Import data from CSV, tab-delimited, etc format

******************************************/

function content_do_import_data ()
{
	global $cur_mysql_table;


	// just a quick error message function for the export routine
	function draw_errmsg ($msg,$qry,$msg2)
	 { echo "<p><span style=\"font-size:110%;\"><b>$msg</b></span> -- <br />\n <i>$qry</i><br /><b>$msg2</b></p>\n"; }

	// used by both LOAD DATA and Sqlicity:
	$importLOCALfile = (trim($_POST['importLOCALfile']) ? TRUE : FALSE);
	$local_importfile = trim($_POST['sqlicity_importfile1']);
	$server_importfile = trim($_POST['sqlicity_importfile2']);
	$column_headerlist = trim($_POST['columnheaderlist']);
	$linestoignore = (int)trim($_POST['linestoignore']);
	$replaceexistingrecords = (trim($_POST['replaceexistingrecords']) ? TRUE : FALSE);

	// make sure they requested a file!
	if (!$local_importfile && !$server_importfile)
	 { draw_errmsg('You need to specify a file to import!', '', ''); return; }

	// check if they uploaded something but it didn't make it onto the server
	if ($importLOCALfile && $local_importfile && !$_FILES['sqlicity_importfile_browser']['tmp_name'])
	 { draw_errmsg('Your file was not properly uploaded - are you sure it is small enough for PHP to upload it?', '', ''); return; }


	// see if they want MySQL to do the export, rather than Sqlicity:
	if ($_POST['useLOADDATAINFILE'])
	{
		// check for LOCAL file reference
		if ($importLOCALfile)
		 { $thefile = $_FILES['sqlicity_importfile_browser']['tmp_name']; }
		else  // on the server
		{
			// import location can be relative or absolute
			if ($_POST['importfile_absolutepath'])
			 { $thefile = $server_importfile; }
			else // relative path is the default
			 { $thefile = getcwd().'/'.$server_importfile; }
		}

		// do the import
		mysql_query($query = "LOAD DATA $_POST[ldi_lowpri_concur]
		  ".($importLOCALfile ? 'LOCAL' : '')."
		  INFILE '$thefile' ".($replaceexistingrecords ? 'REPLACE' : 'IGNORE')."
		  INTO TABLE `$cur_mysql_table`
		 FIELDS
		  TERMINATED BY '$_POST[fields_terminatedby]'
		  ENCLOSED BY '$_POST[fields_enclosedby]'
		  ESCAPED BY '$_POST[fields_escapedby]'
		 LINES
		  TERMINATED BY '$_POST[lines_terminatedby]'
		  STARTING BY '$_POST[lines_startingby]'
		 IGNORE ".(int)$_POST['linestoignore']." LINES
		 ".($column_headerlist ? '('.$column_headerlist.')' : '')."
		 $_POST[ldi_setlist]
		;");

		// find out how many rows were inserted/replaced/ignored
		$import_affected_rows = mysql_affected_rows();
		echo 'imported: '.$import_affected_rows;

		// see if they have an error trying this query
		//  note that we "fix" the file name for LOCAL uploads, to maintain the illusion
		if (mysql_error())
		{
			draw_errmsg('Your LOAD DATA INFILE failed',
			 nl2br($importLOCALfile ? str_replace($thefile, $local_importfile, $query) : $query),
			 mysql_error()); return;
		}

		// quit now, the rest is for sqlicity's import functionality
		return;
	}



/*


IMPORTING RULES THAT I HAVE DETERMINED THROUGH EXPERIMENTATION AND TRUSTED READING:
======================================================================================
1) escape char itself is ignored completely,
 next char is escaped only if it is a valid escapable char
 -- escape char works inside enclosers AND not!
 -- valid escape chars are NOT just \N and \0 -- it's the full list:
  http://dev.mysql.com/doc/mysql/en/string-syntax.html
2) enclosing chars, if present ON EDGES (see !5) are removed, if not present, doesn't matter
!3) doubled enclosing char becomes single char -- ONLY inside same enclosers!
!4) If the line is missing commas to start some columns, those columns must be set to their "defaults":
 "If an input line has too few fields, the table columns
 for which input fields are missing are set to their default values."
** -- HOWEVER, 3.23 does not recognize the "DEFAULT" keyword on inserts, like all later versions do
		but, there is a column in the SHOW COLUMNS results... 'default' that I can just use anyway
		although this does require that I know the order of the columns,
		which I do -- the order in the SHOW COLUMNS results
!5) opening enclosing char MUST be first char,
 and closing enclosing char MUST come before a field terminator or line terminator
 -- IF enclosed string with SINGLE enclosing char NOT before field/line terminator,
  then this one enclosing char gets changed to "!!! (yes, a single double quote char) on 3.23.54
6) no such thing as comments exist in csvs -- EXCEPT
 I can have anything in between line terminator and line starting
!7) escaped N (e.g. \N) is ONLY NULL if it is the ONLY thing in the field!!
 otherwise it is just N (escape char dropped)
8) ESCAPED and ENCLOSED must be one single char,
 TERMINATED and STARTED can be any string
9) lots of weird interactions when all above empty,
 starting on load-data page: 'In certain cases, field- and line-handling options interact'
10) NULLs (\N) are imported in or out of enclosing chars,
 but are exported withOUT enclosing chars.


http://dev.mysql.com/doc/mysql/en/load-data.html

*/


	// check for LOCAL file reference
	if ($importLOCALfile)
	 { $thefile = $_FILES['sqlicity_importfile_browser']['tmp_name']; }
	else  // on the server
	{
		// import location can be relative or absolute
		if ($_POST['importfile_absolutepath'])
		 { $thefile = $server_importfile; }
		else // relative path is the default
		 { $thefile = getcwd().'/'.$server_importfile; }
	}

	// the file must exist!
	if (!@file_exists($thefile))
	 { draw_errmsg('That file does NOT exist!',
	  ($importLOCALfile ? $local_importfile : $thefile), ''); return; }


	// find out how many rows were inserted/replaced/ignored
	$import_affected_rows = 0;

	// store all column names as keys, and their defaults as values
	$display_columns_defaults = array();

	// store all column names, and enclosed columns+BLOB columns
	//  SEE THE COMMENTS WITH THE SELECT PAGE CONTENTS
	$blob_cols = array();  // track BLOB columns
	$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the columns, with their defaults, and flag important ones
	while($column = mysql_fetch_assoc($result_cols))
	{
		// find out if this column should be enclosed on output
		if (isEnclosedColumn($column['Type']))
		 { $enclosed_cols[$column['Field']] = TRUE; }

		// handle BLOB type columns specially
		if (strtolower(substr($column['Type'],0,4)) == 'blob')
		 { $blob_cols[$column['Field']] = TRUE; }

		// store all column names in case no explicit select_columns was given
		$display_columns_defaults[$column['Field']] = $column['Default'];
	}


	// is the first line supposed to be a column header list?
	$usefirstlineheader = (trim($_POST['firstlineheader']) ? TRUE : FALSE);

	// field/line enclosed/escaped/etc
	$field_enclose_char = unescape_mysql_chars($_POST['fields_enclosedby']);
	$field_enclose_char = $field_enclose_char{0};  // force only one char
	$field_escape_char = unescape_mysql_chars($_POST['fields_escapedby']);
	$field_escape_char = $field_escape_char{0};  // force only one char
	$field_terminatedby = unescape_mysql_chars($_POST['fields_terminatedby']);
	$line_terminatedby = unescape_mysql_chars($_POST['lines_terminatedby']);
	$line_startingby = unescape_mysql_chars($_POST['lines_startingby']);

	// shortcut to strlen on these, for finishing comparing them with input
	$line_startingby_len = strlen($line_startingby);
	$line_terminatedby_len = strlen($line_terminatedby);
	$field_terminatedby_len = strlen($field_terminatedby);

	// prep FSM variables
	//  whether or not there is a startingby string affects which state to start in
	$line_start_state = ($line_startingby_len ? 1 : 2);
	$importFSMstate = $line_start_state;  // line starting state: no line or new field?
	$escaped = FALSE;  // was the last char the escape char, trying to escape this current char?
	$enclosed = FALSE;  // is this an enclosed field or not?
	$linevalues = array();  // holds the list of values to insert
	$curcol = -1;  // incremented every col, including first, so need to start here to hit zero for first
	$check_line_i = -1;  // zero is skipped to avoid matching empty terminators/etc
	$check_field_i = -1;  // zero is... same here

	// VERY annoying special case -- need to track an extra bit of data
	//  inside enclosed data, single encloser followed by false L/F terminator
	$addtermchar = '';

	// this gets reused as the string gets too long (memory issues)
	$insert_values_list = '';

	// ... and this restarts it
	$restart_insert_values_list =
	 ($replaceexistingrecords ? 'REPLACE' : 'INSERT IGNORE')
	 ." INTO `$cur_mysql_table`\n  ("
	 .($column_headerlist ? $column_headerlist :
  	implode(',', array_map(create_function(
		 '$c', 'return "`$c`";'), array_keys($display_columns_defaults)))
	 ).")\n VALUES\n";

	// get the parameters for this upload
	$import_filehandle = tmpfile();
	$compression = $_POST['import_file_compression'];

	// make sure the file is readable
	if (!$import_filehandle)
	 { draw_errmsg('That file does is not readable!',
	  ($importLOCALfile ? $local_importfile : $thefile), ''); return; }


	// first, pull out the sql file, based on compression type
	// bzip2
	if ($compression == 'bz2')
	{
		// open file for reading
		$bz = bzopen($thefile, 'r');

		// get the data from the file
		while ($d = bzread($bz)) { fwrite($import_filehandle, $d); }

		// close the compressed file
		bzclose($bz);
	}
	// gzip
	elseif ($compression == 'gz')
	{
		// open file for reading
		$zp = gzopen($thefile, 'r');

		// get the data from the file
		while ($d = gzread($zp, 1024)) { fwrite($import_filehandle, $d); }

		// close the compressed file
		gzclose($zp);
	}
	// zip
	elseif ($compression == 'zip')
	{
		// open the zip archive
		if ($zip = zip_open($thefile))
		{
			// zip can have multiple files
			while ($zip_entry = zip_read($zip))
			{
				// include the data in ALL the zipped files
				if (zip_entry_open($zip, $zip_entry, "r"))
				 { fwrite($import_filehandle, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry))); }
				zip_entry_close($zip_entry);
			}

			// close the compressed file handle
			zip_close($zip);
		}
	}
	// rar
	elseif ($compression == 'rar')
	{
		// open the rar archive
		if ($rar = rar_open($thefile))
		{
			// rar can have multiple files
			$entries = rar_list($rar);

			// include the data in ALL the rar'd files
			$rar_temp_name = tempnam(FALSE, 'sqlicity_rar');
			foreach ($entries as $entry)
			{
				// get the actual entry for extracting
				$entry = rar_entry_get($rar, $entry);

				// have to create the extracted file, read it then delete it...
				//  because rar ONLY has an extract() function, no direct read!
				if ($entry->extract(FALSE, $rar_temp_name))
				 { fwrite($import_filehandle, file_get_contents($rar_temp_name)); }
			}

			// close the compressed file handle and remove temp file
			unlink($rar_temp_name);
			rar_close($rar);
		}
	}
	// no compression (plaintext)
	else
	{
		// open plaintext file for reading
		$pt = fopen($thefile, 'r');

		// get the data from the file
		while ($d = fread($pt, 1024)) { fwrite($import_filehandle, $d); }

		// close the plaintext file
		fclose($pt);
	}
//	else { fwrite($import_filehandle, file_get_contents($thefile))); }


	// needed for escaping input chars
	global $mysql_escaped_chars;

	// we just wrote the file for import, now back up to read it all in
	rewind($import_filehandle);  // fseek($import_filehandle, 0);
	while (!feof($import_filehandle))
	{
		// get this current line and iterate over all its chars
		//  max sure to check if this line is shorter than what we asked for...
		$next_import_line = fread($import_filehandle, 8192);
		$maxlen = strlen($next_import_line);
		for($i=0;$i<$maxlen;$i++)
		{
			// get the char to run through the FSM
			$char = $next_import_line{$i};

			// do the FSM itself
			switch($importFSMstate)
			{
			// no line started yet -- in-between lines -- ONLY if line starting by exists!
			case 1:

				// have we found a line starting beginning and are checking it now?
				if ($check_line_i > 0)
				{
					// is this the next char?
					if ($char == $line_startingby{$check_line_i})
					{
						// increment for the next char we'll check
						$check_line_i++;

						// ... unless it's the last char, then we're done -- start a new field
						if ($check_line_i == $line_startingby_len)
						 { $check_line_i = -1; $importFSMstate = 2; }
					}
					// this is not the next char, start from the beginning
					else { $check_line_i = -1; }
				}
				// did we just find the first char to begin our starting by sequence?
				elseif ($char == $line_startingby{0})
				{
					// remember, starting by could be only one char, then this would have just ended it
					if ($line_startingby_len == 1) { $importFSMstate = 2; }
					// otherwise, there are more chars to compare against
					else { $check_line_i = 1; }
				}

				// is this an escape char?  -- if so, we ignore the next char
				//  FIXME FIX ME -- not sure if escaping works on line starting by!
				elseif ($char == $field_escape_char) { $escaped = TRUE; }
				// if this char was just escaped, ignore it
				elseif ($escaped) { $escaped = FALSE; }

			break;

			// starting a new field -- only stays here for one char!
			case 2:

				// reset some markers every time we restart a field
				$enclosed = FALSE;
				$escaped = FALSE;

				// start this new column in the data
				$linevalues[++$curcol] = '';

				// awkward special case: escaped NULLs
				$justNULLdata = FALSE;

				// everything here goes to data read state no matter what
				//  except line/field terminator special cases below
				$importFSMstate = 3;


				// check for encloser, escape char and terminators
				if ($char == $field_enclose_char) { $enclosed = TRUE; }
				elseif ($char == $field_escape_char) { $escaped = TRUE; }
				elseif ($char == $line_terminatedby{0}) { $check_line_i = 1; }
				elseif ($char == $field_terminatedby{0}) { $check_field_i = 1; }

				// any other char means unenclosed data, and needs to be included in this column's data!
				else { $linevalues[$curcol] = $char; }

			break;

			// read in the data for a single field
			case 3:

				// we might have a line terminator here
				if ($check_line_i > 0)
				{
					// if it matches, we prepare to check the next char
					if ($char === $line_terminatedby{$check_line_i}) { $check_line_i++; }
					else  // we started matching, but it failed -- add the near match to this col's data
					{
						// include everything up to what did NOT work, then add this char
						$linevalues[$curcol] .= $addtermchar.substr($line_terminatedby,0,$check_line_i).$char;
						$check_line_i = -1;
						$addtermchar = '';
					}
				}

				// we might have a field terminator here
				elseif ($check_field_i > 0)
				{
					// if it matches, we prepare to check the next char
					if ($char === $field_terminatedby{$check_field_i}) { $check_field_i++; }
					else  // we started matching, but it failed -- add the near match to this col's data
					{
						// include everything up to what did NOT work, then add this char
						$linevalues[$curcol] .= $addtermchar.substr($field_terminatedby,0,$check_field_i).$char;
						$check_field_i = -1;
						$addtermchar = '';
					}
				}

				// we're NOT comparing terminators, it's just normal chars, handle them like normal
				else
				{
					// first check for escaped chars -- replace them
					if ($escaped)
					{
						// next one starts escaping all over again
						$escaped = FALSE;

						// try to find the escape sequence replacement
						$c2 = $mysql_escaped_chars[$char];
						// if it doesn't exist, just use the original char
						$linevalues[$curcol] .= ($c2 !== NULL ? $c2 : $char);

						// special case: escaped NULLs
						//  to be a NULL, has to be the only thing in the field, enclosed or not
						if ($linevalues[$curcol] == 'N') { $justNULLdata = TRUE; }
					}
					// escape char marks an escape sequence starting
					elseif ($char == $field_escape_char) { $escaped = TRUE; }

					// encloser (ONLY in enclosed data) might mean a lot of things -- check it out
					elseif ($enclosed && ($char == $field_enclose_char)) { $importFSMstate = 4; }

					// line/field terminators MIGHT be starting -- OUTSIDE enclosers!
					elseif (!$enclosed && ($char == $line_terminatedby{0})) { $check_line_i = 1; }
					elseif (!$enclosed && ($char == $field_terminatedby{0})) { $check_field_i = 1; }

					// this char is nothing special, add it to this column's data
					else { $linevalues[$curcol] .= $char; }
				}

			break;

			// we just had an encloser char, handle the single next char to transfer again
			case 4:

				// most of these options just go right back to data parsing, so that's the default
				$importFSMstate = 3;


				// double encloser -- add only one of them
				if ($char == $field_enclose_char) { $linevalues[$curcol] .= $field_enclose_char; }

				// line/field terminators might have just started, and enclosed data ended
				//  HOWEVER: if they DIDN'T just start, and it's a false alarm, I will need to
				//  add the encloser when they fail -- so I need to handle this stage specially
				elseif ($char == $line_terminatedby{0}) { $check_line_i = 1; $addtermchar = $field_enclose_char; }
				elseif ($char == $field_terminatedby{0}) { $check_field_i = 1; $addtermchar = $field_enclose_char; }

				// escape char, annoying special case -- see the pure "else" just below
				elseif ($char == $field_escape_char)
				 { $linevalues[$curcol] .= $field_enclose_char; $escaped = TRUE; }

				// this new char is nothing special which means
				//  the encloser before was just a single encloser in enclosed data
				//  -- bad form, but still acceptable: the encloser is just a character in the data
				//  so add that encloser as well as this new char to this column data
				else { $linevalues[$curcol] .= $field_enclose_char.$char; }

			break;

			}

			// lines/fields can terminate from any state except before there is any line (state 1)
			//  so we check for termination here for all but "no line"
			if ($importFSMstate > 1)
			{
				// did this field just end?
				if ($check_field_i == $field_terminatedby_len)
				{
					// handle special NULL values
					//  unenclosed 'NULL' is always NULL
					if ((!$enclosed && $linevalues[$curcol] == 'NULL')
					//  escaped NULLs -- has to be the only thing in the field data tho
					 || ($linevalues[$curcol] == 'N' && $justNULLdata))
					 { $linevalues[$curcol] = NULL; }

					// this one is done, start a new field
					$check_field_i = -1;
					$importFSMstate = 2;
				}

				// did this line just end?
				if ($check_line_i == $line_terminatedby_len)
				{
					// handle special NULL values
					//  unenclosed 'NULL' is always NULL
					if ((!$enclosed && $linevalues[$curcol] == 'NULL')
					//  escaped NULLs -- has to be the only thing in the field data tho
					 || ($linevalues[$curcol] == 'N' && $justNULLdata))
					 { $linevalues[$curcol] = NULL; }

					// start a new line
					$check_line_i = -1;
					$curcol = -1;
					$importFSMstate = $line_start_state;


					// is this first line a column header list?
					if ($usefirstlineheader)
					{
						// set the column header list for all the real lines following
						//  that means reorganizing the display columns defaults
						$display_columns_defaults2 = array();
						foreach ($linevalues as $identifier)
						{
							// build the array of column names mapped to defaults
							//  if the user used non-existent columns,
							//  it's their problem when this breaks
							$display_columns_defaults2[$identifier]
							 = $display_columns_defaults[$identifier];
						}

						// make sure there is actually something in that first line
						if (count($display_columns_defaults2) > 0)
						{
							// make the switch, we're using this new header instead
							$display_columns_defaults = $display_columns_defaults2;
							unset($display_columns_defaults2);

							// and rebuild the insert values list restart
							$restart_insert_values_list =
							 ($replaceexistingrecords ? 'REPLACE' : 'INSERT IGNORE')
							 ." INTO `$cur_mysql_table`\n  ("
							 // we don't even look at the given column header list here
							 .implode(',', array_map(create_function(
							  '$c', 'return "`$c`";'), array_keys($display_columns_defaults)))
							 .")\n VALUES\n";
						}

						// we got the header, turn this flag off
						$usefirstlineheader = FALSE;
					}  // end building new column header list

					//  it's not a first line column header list, it's a normal line, add it
					else
					{
						// add this line we just finished
						//  by building the INSERT VALUES list line items
						//  NOTE: this will not be visible to the user!
						//  so it doesn't need to be pretty!  -- I make it this way to be readable here only

						// first check if we are ignoring more lines -- if so, don't insert this line
						if ($linestoignore>0) { $linestoignore--; return; }

						// we are done ignoring lines, let's do the insert

						// do we need a , to start this linevalues list?  only if not restarted IVL
						$old_IVL = TRUE;

						// see if we're starting a new values list now
						if (!$insert_values_list)  // yes, copy the restart string to begin
						 { $old_IVL=FALSE; $insert_values_list = $restart_insert_values_list; }


						// now we can add the current linevalues as a values list item to our insert

						// start this current line -- comma for old IVLs adding extra list items, space for new ones
						$insert_values_list .= ($old_IVL ? ',' : ' ').' (';

						// we will need this, for escaping imported data strings
						global $insert_escaped_chars;

						// now handle every field that needs to be inserted
						//  -- we might not have values for all of them!
						$colnum = -1;  // track which value to use, and to do separating on fields
						foreach ($display_columns_defaults as $colname => $coldefault)
/*

CHRIS: FIXME FIX ME -- this doesn't work when you specify a headerlist!!!

*/
						{
							// after first col, start with field terminator
							if (++$colnum > 0) { $insert_values_list .= ','; }

							// make sure this column was even defined!
							if (isset($linevalues[$colnum])) { $value = $linevalues[$colnum]; }
							// use the default for columns which were not present on this line in the import file (undefined)
							else { $value = $coldefault; }

							// users can import all kinds of complete garbage
							//  therefore, we MUST enclose EVERY data field, in case it's trash
							//  and we must further escape all data as well
							$insert_values_list .= ($value !== NULL ? "'".add_mysql_slashes($value)."'" : 'NULL');
						}

						// finish this line
						$insert_values_list .= ")\n";


						// see if we're ready to start a new IVL or not
						//  if the size is getting big, run the IVL query and empty it for restart
						//  current max length is ~200 kb: 200,000 bytes
						if (strlen($insert_values_list) > 200000)
						{
							// do the actual insert
							mysql_query($insert_values_list);

							// see if they have an error trying this import query
							if ($myserr = mysql_error())
							 { draw_errmsg('Your Sqlicity import failed!', '', $myserr); return; }

							// update the affected rows and reset the insert string
							$import_affected_rows += mysql_affected_rows();
							$insert_values_list = '';
						}
					}  // end fist line column header conditional

					// reset the array of values we got off the current lines
					$linevalues = array();
				}  // end insert line ended (we just added a new line, or found the header)
			}
		}  // end loop over the characters of current string from import file to parse
	}  // end loop over remaining data in import file

	// get rid of the temporary file for uncompressed output
	fclose($import_filehandle);


	// run the final insert query we've built up
	mysql_query($insert_values_list);
	$import_affected_rows += mysql_affected_rows();

	// see if they have an error trying this import query
	if ($myserr = mysql_error())
	 { draw_errmsg('Your Sqlicity import failed!', $insert_values_list, $myserr); return; }

	// tell the import results
	echo 'imported: '.$import_affected_rows;
}  // end content_do_import_data




/******************************************

	DO EXPORT DB SQL CONTENT

Export structure and data
 from multiple tables in this db
 outputing SQL INSERTS/etc

******************************************/

function content_do_db_sql_export ()
{
	// need to do this so table changes will propogate to output_sql func
	global $cur_mysql_table, $cur_mysql_db, $mysql_version_string;


	// assumes backtick-quoted, comma separated text
	//  with potential doubled backticks
	// note: this is NOT easily/cleanly duplicated with a single regex
	//  so I prefer this, in case changes are ever required, etc
	function simple_comma_split ($text)
	{
		// intialize the fsm vars
		$allvalues = array();
		$FSMstate = 1;
		$curval = 0;

		$maxlen = strlen($text);
		for($i=0;$i<$maxlen;$i++)
		{
			// the current char in the line
			$char = $text{$i};

			switch($FSMstate)
			{
			case 1:  // before identifier, etc
				// empty out this current value when we start it
				$allvalues[$curval] = '';

				// ended the value before it started
				if ($char == ',') { $curval++; }
				// entered an identifier
				elseif ($char == '`') { $FSMstate = 2; }
				// unacceptable character -- error
				else { echo 'BAD'; }
			break;

			case 2:  // inside identifier
				// maybe ending this identifier
				if ($char == '`') { $FSMstate = 3; }
				// otherwise we're still hanging out inside it
				else { $allvalues[$curval] .= $char; }
			break;

			case 3:  // ending identifier or doubled?
				// doubled identifier quote (backtick)
				//  we NEED the doubled backtick to remain then!
				if ($char == '`') { $allvalues[$curval] .= '``'; $FSMstate = 2; }
				// end this current value
				elseif ($char == ',') { $curval++; $FSMstate = 1; }
				// unacceptable character -- error
				else { echo 'BAD'; }
			break;
			}
		}

		return $allvalues;
	}


	// first tell the world to download this file
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.$cur_mysql_db.'.sql"');


	// give some opening title/comments to this export
	echo "\n########################################################\n"
	 ."##########   Exported with Sqlicity 00.07.00  ##########\n"
	 ."###############      www.sqlicity.com    ###############\n"
	 ."########################################################\n";


	// for pretty formatting
	function pretty_comment_text ($str)
	{
		if (strlen($str) % 2) { $str = ' '.$str; }
		$str = '  '.$str.'  ';
		$len = (56 - strlen($str)) / 2;
		return str_repeat('#',$len).$str.str_repeat('#',$len)."\n";
	}

	// include the mysql and php version numbers, and timestamp, pretty-formated
	echo pretty_comment_text(' & MySQL '.$mysql_version_string);
	echo pretty_comment_text(' & PHP '.phpversion());
	echo pretty_comment_text(' at '.date('r'));

	// end the title comments
	echo "########################################################\n\n";


	// get the export options
	$structureordata = $_POST['structureordata'];
	$export_file_compression = $_POST['export_file_compression'];

	// echo the create/insert sql for these tables
	$alltables = simple_comma_split($_POST['tablelist']);
	foreach($alltables as $table)
	{
		// needed for output_sql_insert_values() to work
		//  and also to leave copied sql commands as they are
		$cur_mysql_table = $table;


		// did user request create statements?
		if (!$structureordata || $structureordata == 'full')
		{
			// get the create statement
			echo "\n\n#############\n### CREATE TABLE --- `$cur_mysql_table`\n#############\n\n";
			echo "DROP TABLE IF EXISTS `$cur_mysql_table`;\n";
			echo @mysql_result(mysql_query("SHOW CREATE TABLE `$cur_mysql_table`"),0,'Create Table').";\n";
		}  // end structure output conditional


		// did user request insert statements?
		if ($structureordata == 'full' || $structureordata == 'data')
		{
			// start the insert list
			echo "\n\n#############\n### INSERT VALUES --- `$cur_mysql_table`\n#############\n";

			// get the names of the displayed columns (all columns)
			//  and also the list of which columns are enclosed
			$display_columns = array();
			$enclosed_cols = array();
			$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

			// store all the columns and flag important ones
			while($column = mysql_fetch_assoc($result_cols))
			{
				// find out if this column should be enclosed on output
				if (isEnclosedColumn($column['Type']))
				 { $enclosed_cols[$column['Field']] = TRUE; }

				// store all column names as displayed columns
				$display_columns[] = $column['Field'];
			}

			// now get the data to output -- make sure there is some!
			$export_data = mysql_query("SELECT * FROM `$cur_mysql_table`");
			if (mysql_num_rows($export_data) > 0)
			 { echo output_sql_insert_values($export_data, $display_columns, $enclosed_cols); }
			else  // no data in the table right now
			 { echo "\n######  NO DATA IN THIS TABLE.\n"; }
		}  // end insert output conditional
	}  // end the loop over all exported tables


	// give some closing message
	echo "\n\n\n";
}  // end content_db_sql_export




/*************************************************************************************
======================================================================================

		MYSQL SYSTEM INFORMATION PAGES

These give non-table/db specific mysql information

======================================================================================
*************************************************************************************/




/******************************************

	SELECT CONTENT

A page for selecting the data in a database

******************************************/

function content_select ()
{
	global $select_sql, $select_result;
?>

<?php

	// check if we did NOT just submit a SELECT here
	if (!$select_sql)
	{
		// initialize the SELECT for convenience
		$select_sql = "
SELECT `id`,COUNT(*)
FROM `table`
WHERE 1=1 GROUP BY 1 ORDER BY 1 LIMIT 0,100
";
	}
	// we did submit select sql
	else
	{
		// HARD limit on rows returned!
		$hard_limit_rows = 1000;

		// store the resulting rows
		$row_data = array();
		if ($select_result)
		{
			// get the full number of rows resulting
			$total_rows = mysql_num_rows($select_result);

			// get each row of results
			for ($i = 0; $i < $hard_limit_rows &&
			 $r = mysql_fetch_assoc($select_result); $i++)
			 { $row_data[] = $r; }
		}

		// is there more data still?
		if (($i == $hard_limit_rows)
		 && mysql_fetch_assoc($select_result))
		{
			// too much data returned, you need a limit
			$select_note = "Your results exceeded the maximum result limit of $hard_limit_rows rows.<br />\n"
			 .'  You should add a LIMIT clause to your SELECT statement in order to reduce the server load.';
		}

		// track max rows
		$row_count = count($row_data);
	}

?>

<p>While this page is primarily intended to test <a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/select.html">SELECT</a> statements,
	you can just as easily run <a class="link" target="_blank"
	 href="http://dev.mysql.com/doc/mysql/en/show.html">SHOW</a> statements<br />
	and any other MySQL commands that return a table of information.
</p>

<p><b>Note:</b> To refresh the information on this page,
	hit the "Run Select" link/button again.<br />  Using the
	standard "Refresh Page" link will lose the SQL for SELECTing.
</p>

<p><textarea id="select_sql" cols="60" rows="10" wrap="off">
<?php echo $select_sql; ?>
</textarea></p>

<p><a href="#" onClick="return sendMySQLCommand('pure_sql', getByID('select_sql').value);" class="button">Run Select</a></p>

<hr width="90%" />

<?php

	// if there were any errors, etc, tell us
	if ($select_note) { echo "<p><b>$select_note</b></p>\n"; }

	// tell about the total number of resulting rows
	if ($total_rows > 0)
	 { echo "<p>Full result has <b>$total_rows</b> row".($total_rows!=1?'s':'').".</p>"; }

	// do we have results to show?
	if ($row_count > 0)
	{
		// if we have a successful result
		//  get the columns from the result itself
		$columns = array_keys($row_data[0]);

?>

<p><table border="1" cellspacing="1" cellpadding="1">
	<tr class="table_name"><td colspan="<?php echo (count($columns) + 2) ?>" align="center">table of results</td></tr>
	<tr class="column_title">
		<td width="40">Row #</td>
		<td rowspan="<?php echo ($row_count + 1) ?>">&nbsp;</td>
<?php

		// list all column names in the table
		foreach ($columns as $column)
		 { echo "  <td>$column</td>\n"; }

		echo " </tr>\n\n";

		// list each row of data
		foreach ($row_data as $row)
		{
			// count each row
			$cur_row++;
?>

	<tr>
		<td><?php echo $cur_row ?></td>

<?php

			// put each row of data's elements in correct columns
			foreach ($columns as $column)
			{
				// shortcut var
				$r = $row[$column];

				// open the html column
				echo '  <td>';

				// handle special cases
				if ($r !== NULL)
				{
					// empty string
					if ($r === '') { echo '&nbsp;'; }

					// regular data
					//  but cut it short for brevity
					//  == TEXT ... and BLOB -- do I want BLOB like this?
					//  well, when I start using BLOB, then I'll care...
					else { echo htmlutf(substr($r, 0, 300)); }
				} else { echo '<i>NULL</i>'; }  // NULL column value

				// close the html column
				echo "</td>\n";
			}
		}

?>

</table></p>

<?php

	}  // end showing SELECT results
	else  // no results
	 { echo "<p><b>No results found.</b></p>\n"; }
?>

<?php
}  // end content_select




/******************************************

	PROCESSLIST CONTENT

Display and Kill current processes

******************************************/

function content_processlist ()
{
?>

<?php

	// get the current processlist
	$process_res = mysql_query("SHOW FULL PROCESSLIST");
	$full_processlist = array();
	while ($process = mysql_fetch_assoc($process_res))
	 { $full_processlist[] = $process; }

	// make sure any processes exist at all
	if (($num_processes = count($full_processlist)) > 0)
	{
		// get the first process to show the column headers
		$process = $full_processlist[$i = 0];
?>

<table border="1" cellpadding="1" cellspacing="1">

	<tr>
		<td><b>Kill</b></td>
		<td rowspan="<?php echo 1+($num_processes*2) ?>">&nbsp;</td>

<?php
		// display all the columns in a processlist
		//  except the query: the query gets an entire row
		foreach ($process as $col => $val)
			if ($col != 'Info') { echo "  <td>$col</td>\n"; }
?>

</tr>

<?php
		// display all remaining processes
		while ($process)
		{
?>
	<tr>
		<td rowspan="2" valign="center"><input type="button" value="-" title="Kill this process"
		 onClick="if (confirm('Are you sure you want to KILL this process?'))
		  { return sendMySQLCommand('kill_process', '<?php echo $process['Id'] ?>') }" />
		</td>

<?php
			// display all the values in each process
			foreach ($process as $col => $val)
				if ($col != 'Info') { echo "  <td>".($val ? $val : '&nbsp;')."</td>\n"; }
?>

</tr>

<?php
			// display the query in its own row
			echo ' <tr><td colspan="'.count($process).'"><i>'.
			 htmlutf($process['Info'])."</i></td></tr>\n";

			// get the next process ready for display
			$process = $full_processlist[++$i];
		}
?>

</table>

<?php
	}  // end process existence conditional
	else  // no processes available
	 { echo "<p><b>No active processes.</b></p>\n"; }
?>

<?php
}  // end content_processlist




/******************************************

	USERLIST CONTENT

Displays the list of users, etc

******************************************/

function content_userlist ()
{
?>

<table>

	<tr><td>This page is not fully implemented yet!</td></tr>

<?php

	// get the current user privileges
	// $user_res = mysql_query("SELECT * FROM `mysql`.`user`");
	$user_res = mysql_query("SHOW GRANTS FOR CURRENT_USER");
	echo mysql_error();
	while ($user = mysql_fetch_assoc($user_res))
	{
?>

	<tr>
		<td><?php print_r($user) ?></td>
	</tr>

<?php
	}  // end loop over all processes
?>

</table>

<?php
}  // end content_userlist




/******************************************

	EDIT USER CONTENT

Edit an individual user's permissions/etc

******************************************/

function content_edit_user ()
{
?>

NOT IMPLEMENTED YET!

<?php
}  // end content_edit_user




/******************************************

	SYSTEM VARS CONTENT

Displays for editing all system vars and their values

******************************************/

function content_system_vars ()
{
?>

NOT IMPLEMENTED YET!

<?php
}  // end content_system_vars




/*************************************************************************************
======================================================================================

		DATA MANAGEMENT PAGES

These pages manage the actual data in the db

======================================================================================
*************************************************************************************/




/******************************************

	DATA CONTENT

A page for displaying the data in a table

******************************************/

function content_data ()
{
	global $cur_mysql_table, $cur_mysql_table_html, $executed_sql
	 , $mysql_limit_term, $mysql_where_clause, $executed_sql;
?>

<?php

	// store all column names, and primary key columns
	//  this is SEPARATE from the actual select query
	//  so that we can ascertain if we have the PRI keys or not
	// *****NOTE*****
	// The user can "cheat" if they rename result columns
	//  to match with the names of the primary key columns!
	//  This is assumed to be coounter-productive behavior
	//  and thus I do not waste time protecting the user from it.
	//  (Which is to say, I do not save you from yourselves.)
	// Similarly, if the user renames result columns to
	//  have the same names as TEXT columns or especially BLOBs,
	//  it WILL affect how those results are displayed!!!
	// However, with both of these issues, this should never happen
	//  since this page is for editing data, and it does not
	//  make much sense to edit derived data...  (it's not possible)
	//  (derived data being any result columns you would want to rename)
	$all_columns = array();  // store all column names (only the names)
	$key_cols = array();  // track primary key columns
	$blob_cols = array();  // track BLOB columns
	$result_cols = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");

	// make sure table still exists
	if (!$result_cols) { echo "<p><b>Table <i>`$cur_mysql_table`</i> no longer exists!</b></p>\n"; return; }

	// store all the columns and flag important ones
	while($column = mysql_fetch_assoc($result_cols))
	{
		// track the primary keys
		//  what about MySQL versions changing this data?...
		if ($column['Key'] == 'PRI')
		 { $key_cols[] = $column['Field']; }

		// handle BLOB type columns specially
		if (strtolower(substr($column['Type'],0,4)) == 'blob')
		 { $blob_cols[$column['Field']] = TRUE; }

		// store all column names
		//  we DO need this separate from displayed columns
		//  in case we need to use this as the key,
		//  or if no explicit select_columns was given
		$all_columns[] = $column['Field'];
	}


	// NOW GET THE ACTUAL SEARCH DATA

	// defines the select condition
	$select_where = $_POST['select_where'];
	$select_columns = $_POST['select_columns'];


	// select_where MUST start with either: WHERE, ORDER, or LIMIT
	$select_where2 = strtoupper(substr(trim($select_where),0,5));
	if (($select_where2 !== NULL) && ($select_where2 !== '')
	 && (strpos($select_where2, 'WHERE') !== 0)
	 && (strpos($select_where2, 'ORDER') !== 0)
	 && (strpos($select_where2, 'LIMIT') !== 0))
	{
		echo "<p><span style=\"font-size:110%;\"><b>Invalid WHERE/etc clause!</b></span> -- <i>$select_where</i></p>\n";
		$select_where = 'WHERE 1=1 ORDER BY 1 LIMIT 0,20';
	}


	// defaults
	if (!$select_where && !$select_columns)
	{
		$select_columns = implode(', ', array_map(create_function(
		 '$c', 'return "`$c`";'), $all_columns));
		$select_where = 'WHERE 1=1 ORDER BY 1 LIMIT 0,20';
	}

	// this only happens if there is a where condition,
	//  but no columns were given to select
	if (!$select_columns) { $select_columns = '*'; }


	// grab all requested data from the table, according to where
	$query_temp = "SELECT\n  $select_columns\n FROM `$cur_mysql_table`\n  $select_where";

	// don't overwrite executed_sql of updates/add/deletes, etc
	if (!$executed_sql) { $executed_sql = $query_temp; }

	// get all the rows of data
	$row_data = array();
	$result_data = mysql_query($query_temp);

	// make sure their query was valid...
	if (!mysql_error())
	 { while ($row = mysql_fetch_assoc($result_data)) { $row_data[] = $row; } }
	else
	 { echo "<p><span style=\"font-size:110%; font-weight: bold;\">ERROR in query</span> -- <i>$query_temp</i><br /><b>".mysql_error()."</b></p>\n"; }


	// track max rows and current row
	$row_count = count($row_data);
	$cur_row = 0;

?>

<script>
<!--

	// this way we can hit "Refresh Page" and not lose our select
	document.sqlicity_viewstate_form['select_where'].value = "<?php echo htmlutf($_POST['select_where']) ?>";
	document.sqlicity_viewstate_form['select_columns'].value = "<?php echo htmlutf($_POST['select_columns']) ?>";


	// change the select for editing
	function selectData ()
	{
		dataform = document.data_view_form;
		bigform = document.sqlicity_viewstate_form;

		bigform['select_columns'].value = dataform['select_columns'].value;
		bigform['select_where'].value = dataform['select_where'].value;

		bigform.submit();
		return false;
	}


	// adjust the position of the edit select input boxes
//	sqlicity_load.push("screenMiddle(getByID('edit_select_inputs'))");

//-->
</script>

<ul style="list-style: none;" id="edit_select_inputs">
<form name="data_view_form">

<li>Switch to <a href="#" onClick="return setView('fields')" class="button">Fields (Columns) View</a></li>

<li><hr width="95%" /></li>

<li>
	SELECT<br />
	<textarea name="select_columns" rows="2" cols="60"
	 ><?php echo htmlutf($select_columns) ?></textarea>
</li>
<li>
	FROM `<b><?php echo $cur_mysql_table_html ?></b>`<br />
	<textarea name="select_where" rows="2" cols="60"
	 ><?php echo htmlutf($select_where) ?></textarea>
</li>
<li>
	<a href="#" class="button"
	 onClick="return selectData()">Select Data for Edit</a>
</li>
</form></ul>

<?php

	// make sure there are rows to display!
	$row_data_count = count($row_data);
	if ($row_data_count > 0)
	{
		// we show only that which was searched for!
		$columns = array_keys($row_data[0]);

?>

<p>Found <b><?php echo $row_data_count ?></b> row<?php if ($row_data_count != 1) { echo 's'; } ?> of resultant data.</p>

</div>

<p><table border="1" cellspacing="1" cellpadding="1">
	<tr class="table_name"><td colspan="<?php echo (count($columns) + 3) ?>" align="center">
		<a href="#" class="button" onClick="return changeTable('<?php echo $cur_mysql_table_html ?>')"><?php echo $cur_mysql_table_html ?></a>
	</td></tr>
	<tr class="column_title">
		<td>Edit</td>
		<td>Del</td>
		<td rowspan="<?php echo ($row_count + 1) ?>">&nbsp;</td>

<?php

		// list all column names in the SEARCH RESULTS!
		foreach ($columns as $column)
		 { echo "		<td>$column</td>\n"; }

		echo "	</tr>\n\n";

		// list each row of data
		foreach ($row_data as $row)
		{
			// count each row
			$cur_row++;

			// build the row identifier
			//  - all primary key columns (no nulls!)
			//  - all unique non-NULL columns
			//  - all columns
			// NOTE: right now, key_cols has pri keys in it
			//  or is empty, at which point we pick all columns

			// $key_cols is used in creating row_identifier
			//  slashes_nulls handles nulls with IS NULL and adds = quotes for everything else
			$use_cols = (count($key_cols) > 0 ? $key_cols : $all_columns);
			$row_identifier = array(); foreach ($use_cols as $column)
			 { $row_identifier[] = "`".add_mysql_slashes($column)."`".add_mysql_slashes_where($row[$column]); }

/*
NO IDEA WHY I USED TO DO IT THIS WAY -- was there some reason?....

			if (count($key_cols) > 0) foreach ($key_cols as $column)
			{
				$col = add_mysql_slashes($column);
				$value = add_mysql_slashes($row[$column]);

				// make sure ALL of the primary key is included!
				if ($value === NULL)
WON'T THIS NEXT LINE BREAK THINGS... if it ever could happen, which I think is impossible since these are all prikeys, right?...
				 { $row_identifier = $col; break; }
				else  // this part of the key, at least, is present
				 { $row_identifier[] = "`$col`='$value'"; }
			}
			// use the whole row of data instead
			else foreach ($all_columns as $column)
			{
				$col = add_mysql_slashes($column);
				$value = add_mysql_slashes($row[$column]);

				$row_identifier[] = "`$col`=".($value !== NULL ? "'$value'" : 'NULL');
			}
*/

			// make the string for the WHERE clause
			//  make sure we found one first though...
			//  row_identifier is an array if we found all the keys
			//  and a string giving the name of the first missing key column
			if (is_array($row_identifier))
			{
				// we have to add these extra slashes for javascript
				//  without them, it ends the onClick string and gives errors
				$row_identifier = htmlutf(addslashes(
				 implode(' AND ', $row_identifier)));
?>

	<tr>

		<td align="center"><input type="button" value="+" title="Edit this row"
		 onClick="return setView2('edit_row', 'edit_row_identifier', '<?php echo $row_identifier ?>');" />
		</td>

		<td align="center"><input type="button" value="-" title="Delete this row"
		 onClick="if (confirm('Are you sure you want to DELETE this row?'))
		  { return sendMySQLCommand('data_row_delete', '<?php echo $row_identifier ?>') }" />
		</td>

<?php
			} else {  // no identifier for this row
?>

	<tr>
		<td align="center"><input type="button" value="?"
		 title="Missing column `<?php echo $row_identifier ?>` -- to have full primary key for UPDATE" /></td>
		<td align="center"><input type="button" value="?"
		 title="Missing column `<?php echo $row_identifier ?>` -- to have full primary key for DELETE" /></td>

<?php
			}  // end identifier conditional

			// put each row of data's elements in correct columns
			foreach ($columns as $column)
			{
				// convert html special chars for display
				//  IF this is not NULL, otherwise NULL row_html as well
				echo "		<td>\n";
				if ($row[$column] !== NULL)
				{
					// make sure it's not a BLOB
					if (!$blob_cols[$column])
					{
?>
			<input type="text" readonly="yes" name="<?php echo $column ?>"
			 value="<?php echo htmlutf(substr($row[$column], 0, 300)) ?>" />
<?php
					} else { echo "   <i>BLOB DATA<i>\n"; }
				} else { echo "   <i>NULL<i>\n"; }
			}  // end loop over columns of each row
		}  // end loop over rows of data
?>

	<tr><td colspan="<?php echo (count($columns) + 3) ?>">
	 &nbsp; &nbsp; &nbsp; <a href="#" class="button"
	  onClick="return setView('edit_row')">Add New Row</a>
	</td></tr>

</table></p>

<?php
	} else {  // there are no rows in these results!
?>

<p><b>There are no rows in these results!</b><br />
	<a href="#" class="button"
	 onClick="return setView('edit_row')">Add New Row</a>
</p>

<?php
	} // end row data existence conditional
?>

<?php
}  // end content_data




/******************************************

	EDIT ROW CONTENT

Edits a single row from the db

******************************************/

function content_edit_row ()
{
	global $cur_mysql_table, $cur_mysql_table_html;
?>

<?php

	// function to determine if this is a string column -- these need textareas
	function isStringColumn ($type)
	{
		// string columns
		$string_field_types = array(
		 'char', 'varchar', 'binary', 'varbinary', 'blob', 'text', 'enum', 'set');

		// if it's in the above list, it's a string type -- otherwise, it's not
		//  we need to account for char sizes, etc,
		//  so I need to pluck off the ( and everything after it
		$pos = strpos($type,'(');
		if ($pos === FALSE || $pos < 1) { $pos = strlen($type); }
		$type = strtolower(substr($type, 0, $pos));
		return (in_array($type, $string_field_types));
	}

	// primary key columns default to unsubmitted
	//  to find that out, need to get the columns from the table
	//  these are also used if it's a new row being made
	$colres = mysql_query("SHOW COLUMNS FROM `$cur_mysql_table`");
	$edit_row_data = array();  // for insert rows
	$special_cols = array();  // for special cols: pri key, text/blob, etc
	while ($column = mysql_fetch_assoc($colres))
	{
		// get the actual column name
		$colname = $column['Field'];

		// always want primary keys tracked -- default not submitted
		if ($column['Key'] == 'PRI')
		 { $special_cols[$colname]['key'] = TRUE; }

		// track non-string columns -- input=text
		if (!isStringColumn($column['Type']))
		 { $special_cols[$colname]['nonstring'] = TRUE; }


		// shortcut for checking special types
		$column_short_type = strtolower(substr($column['Type'],0,4));

		// track text columns (any size) -- textarea
		if ($column_short_type == 'text')
		 { $special_cols[$colname]['text'] = TRUE; }

		// track blob columns (any size) -- file upload
		if ($column_short_type == 'blob')
		 { $special_cols[$colname]['blob'] = TRUE; }

		// enums are also special -- give a dropbox (select)
		if ($column_short_type == 'enum')
		 { $special_cols[$colname]['enum'] = TRUE; }

		// sets are also special -- give a multi-select
		if (substr($column_short_type,0,3) == 'set')
		 { $special_cols[$colname]['set'] = TRUE; }

		// might use this data for inserting a new row
		$edit_row_data[$colname] = '';
	}


	// track the primary key identifier (WHERE clause) for this row
	$edit_row_identity = trim($_POST['edit_row_identifier']);

	// if it's an UPDATE, we pull the row
	//  no identity means it's a new row to be inserted
	//  and edit_row_data is already filled/prepped for new row
	if ($edit_row_identity)
	{
		// get the row to be edited
		global $executed_sql;
		$query_temp = "SELECT * FROM `$cur_mysql_table` WHERE $edit_row_identity";
		$rowres = mysql_query($query_temp);

		// don't overwrite executed_sql with the row select
		if (!$executed_sql) { $executed_sql = $query_temp; }

		// protect against rows that disappear while we're clicking
		if ($rowres) { $edit_row_data = mysql_fetch_assoc($rowres); }
		else { echo "<p><b>That row cannot be found!</b><br /> &nbsp; Perhaps it has been deleted or changed.</p>\n"; }
	}

?>

<script>
<!--

	// make sure to track the edit_row_identity in case of refresh
	document.sqlicity_viewstate_form['edit_row_identifier'].value = "<?php echo addslashes($edit_row_identity) ?>";

	// we track these so we can return to the same editsearch results
	document.sqlicity_viewstate_form['select_where'].value = "<?php echo $_POST['select_where'] ?>";
	document.sqlicity_viewstate_form['select_columns'].value = "<?php echo $_POST['select_columns'] ?>";


	// add slashes to a string to allow PHP to eval it
	function add_php_slashes (str)
	{
		str2 = '';  // we will copy into an empty string

		len = str.length;
		for (i=0;i<len;i++)
		{
			c = str.charAt(i);  // get the actual char, not just the index

			// escape blackslashes, double quotes and dollar signs
			if ((c == '\\') || (c == '"') || (c == '$'))
			 { str2 += '\\'+c; }
			else  // regular char, no escaping
			 { str2 += c; }
		}

		return str2;
	}

	// adds a column to the editrowdata array
	function add_edit_col (editrowdata, colname)
	{
		theform = document.edit_row_form;

		escaped = theform['E '+colname].value;
		if (escaped)  // make sure this column's supposed to be submitted
		{
			editrowdata.push('$edit_row_data[\''+colname+'\'][0] = "'+add_php_slashes(theform[colname].value)+'";');
			editrowdata.push('$edit_row_data[\''+colname+'\'][1] = "'+escaped+'";');
		}
	}


	// tracks if we made any changes at all
	var madeChanges = false;

	// build the array of columns for this row
	var all_columns = new Array;

<?php
	foreach ($edit_row_data as $column => $value)
	 { echo ' all_columns.push("'.htmlutf(add_mysql_slashes($column)).'");'."\n"; }
?>

	// submit all columns to database for update or insert
	//  asnew is true for insert, false for update
	function save_row (asnew)
	{
		if (!confirm('Are you SURE you wish to '+(asnew ? 'INSERT' : 'UPDATE')+' this data in the database?'))
		 { return false; }

		// we send the save data in PHP notation, ready for eval()
		editrowdata = new Array;
		// new rows have no identity, old rows have identity passed in
		//  we just set the identifier above, so we use that instead of php echo
		editrowdata.push('$edit_row_key_identity = "'+(asnew ? '' : add_php_slashes(document.sqlicity_viewstate_form['edit_row_identifier'].value))+'";');

		// add all the column data and their escape types
		for (c in all_columns) { add_edit_col(editrowdata, all_columns[c]); }

		// make sure we have something actually submitted!
		if (editrowdata.length > 1)
		 return sendMySQLCommand('data_row_save', editrowdata.join("\n"));
		else  // everything was marked "Not Submitted"
		 if (confirm("You aren't submitting anything!  Keep editing?")) { return false; }
		  else { return setView('data'); }
	}

	// changing all the columns
	function change_all_columns (prepend, newval)
	 { for (c in all_columns) { document.edit_row_form[prepend+all_columns[c]].value = newval; } return false; }

	// we just changed a value, make sure the stuff is submitted!
	function check_submit (colname)
	{
		theselect = document.edit_row_form['E '+colname];
		if (!theselect.value || theselect.value == 3) { theselect.value = 1; }
		madeChanges = true;
	}

//-->
</script>

<form name="edit_row_form"><table width="700">

	<tr>
		<td colspan="2">Change Submit For All:</td>
		<td colspan="3">&nbsp;</td>
		<td><select onChange="change_all_columns('E ',this.value)">
			<option value="1">Escaped Data</option>
			<option value="2">Unescaped Function</option>
			<option value="3">NULL</option>
			<option value="" selected="true">Not Submitted</option>
		</select></td>
		<td>&nbsp;</td>
		<td><a href="#" class="button"
			onClick="return change_all_columns('','')">Clear all Values</a></td>
	</tr>

	<tr><td colspan="8">&nbsp;</td></tr>

	<tr>
		<td colspan="2"><b>Field Name</b></td>
		<td>&nbsp;</td>
		<td><b>Key</b></td>
		<td>&nbsp;</td>
		<td><b>Submit Escape Type</b></td>
		<td>&nbsp;</td>
		<td><b>Column Value</b></td>
	</tr>

<?php

	foreach ($edit_row_data as $column => $value)
	{
		// figure out which escape type to default select
		// for now, always default to not submitted for eveything -- EXCEPT NULL
		$selected = ($value !== NULL ? -1 : 3);
		/*
		if ($special_cols[$column]['key'])
			{ $selected = -1; }  // primary keys are not submitted by default
		else  // all other columns are based on NULL or not
			{ $selected = ($value !== NULL ? 1 : 3); }
		*/

		// maybe sometime I'll want to default fill
		//  timestamps/datetime/date/time to NOW()
		//  but for now... laziness

?>

	<tr>
		<td>&nbsp;</td>
		<td><i><?php echo $column ?></i></td>
		<td>&nbsp;</td>
		<td align="center"><?php if ($special_cols[$column]['key']) { echo '*'; } ?></td>
		<td>&nbsp;</td>
		<td><select name="E <?php echo $column ?>">
			<option value="1"<?php if ($selected == 1) { echo ' selected="true"'; } ?>>Escaped Data</option>
			<option value="2">Unescaped Function</option>
			<option value="3"<?php if ($selected == 3) { echo ' selected="true"'; } ?>>NULL</option>
			<option value=""<?php if ($selected == -1) { echo ' selected="true"'; } ?>>Not Submitted</option>
		</select></td>
		<td>&nbsp;</td>

<?php
		// non string data (numbers, dates, etc) get just text input
		if ($special_cols[$column]['nonstring']) {
?>
		<td><input type="text" name="<?php echo $column ?>"
		 value="<?php echo htmlutf($value) ?>"
		 onKeyPress="check_submit(this.name)" onChange="check_submit(this.name)" /></td>
<?php
		// full text input -- big textarea, no maxlength limit
		} elseif ($special_cols[$column]['text']) {
?>
		<td><textarea name="<?php echo $column ?>" wrap="off" rows="6" cols="30"
		 onKeyPress="check_submit(this.name)" onChange="check_submit(this.name)"><?php echo htmlutf($value) ?></textarea></td>
<?php
		// blob input -- file input
		} elseif ($special_cols[$column]['blob']) {
?>
	<td>BLOB: <input type="file" name="<?php echo $column ?>"
		onChange="check_submit(this.name)" /></td>
<?php
		} else {  // standard input is a smaller textarea, to allow for newlines
?>
		<td><textarea name="<?php echo $column ?>" wrap="off" rows="3" cols="30" maxlength="255"
		 onKeyPress="check_submit(this.name)" onChange="check_submit(this.name)"><?php echo htmlutf($value) ?></textarea></td>
<?php
		}  // end switching through column types
?>
	</tr>

<?php
	}  // end loop over row columns
?>

	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
<?php
	// if this is an update, give different submit options
	if ($edit_row_identity)
	{
?>
		<td colspan="2"><a href="#" class="button"
		 onClick="return save_row(false)">Update This Row</a></td>
		<td>&nbsp;</td>
		<td colspan="6"><a href="#" class="button"
		 onClick="return save_row(true)">Save as New</a></td>
<?php
	} else {  // new rows only see add row
?>
		<td colspan="8"><a href="#" class="button"
		 onClick="return save_row(true)">Add New Row</a></td>
<?php
	}  // end insert/update conditional
?>
	</tr>

	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="7"><a href="#" class="button"
		 onClick="if (!madeChanges || confirm('Are sure you wish to abandon your changes?')) { return setView('data'); } return false;">Cancel Row Edit</a></td>
	</tr>

</table></form>

<?php
}  // end content_edit_row







/*************************************************************************************
======================================================================================

		DISPLAYED HTML CONTENT

This is the basic interface outline html
	(effectively, it is the header and footer code)

======================================================================================
*************************************************************************************/

// sometimes we want to create a page without the standard sqlicity header/footer
//  i.e. for user downloads, etc -- so we check this flag for that
//  if it's flagged, ALL we do is the content_page function and then quit
if ($show_only_content_page) { $content_page(); exit; }

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sqlicity MySQL Admin</title>

		<style type="text/css">

			.table_name
			{
				font-weight: bold;
				font-style: italic;
			}

			.column_title
			{
				font-style: italic;
			}

			a.button
			{
				color: #CC0000;
				text-decoration: none;
			}

			a.link
			{
				color: #0000CC;
				text-decoration: none;
			}

			.helpwindow
			{
				display:none;
				width:300px;
				background-color: #CCCC66;
				margin: 5px;
			}

		</style>

		<script>
		<!--

			// track what major features we have access to (equiv to browser testing)
			var ie4 = (document.all ? true : false);
			var ns4 = (document.layers ? true : false);
			var w3c = (document.getElementById ? true : false);

			// shortcut function to get object using appropriate browser feature
			function getByID (id)
			{
				if (w3c) { return document.getElementById(id); }
				else if (ie4) { return document.all[id]; }
				else if (ns4) { return document.layers[id]; }
				return null;
			}


			// change the db, and submit the form
			function changeDB (db_name)
			{
				theform = document.sqlicity_viewstate_form;

				// change the db
				theform['cur_mysql_db'].value = db_name;

				// empty some other variables, needed to show correct page
				theform['cur_mysql_table'].value = '';
				theform['current_view'].value = '';

				theform.submit();
				return false;
			}

			// change the table, and submit the form
			function changeTable (tbl_name)
			{
				theform = document.sqlicity_viewstate_form;

				// change the table
				theform['cur_mysql_table'].value = tbl_name;

				// empty some other variables, needed to show correct page
				theform['current_view'].value = '';

				// clear the data view stuff when changing tables
				theform['select_columns'].value = '';
				theform['select_where'].value = '';

				theform.submit();
				return false;
			}

			// change the view
			function setView (var_value)
			{
				document.sqlicity_viewstate_form['current_view'].value = var_value;
				document.sqlicity_viewstate_form.submit();
				return false;
			}

			// change the view, and a second variable
			function setView2 (new_view, var2_name, var2_value)
			{
				theform = document.sqlicity_viewstate_form;

				theform['current_view'].value = new_view;
				theform[var2_name].value = var2_value;

				theform.submit();
				return false;
			}

			// submit mysql command form
			function sendMySQLCommand (command, data)
			{
				theform = document.sqlicity_viewstate_form;

				theform['mysql_command'].value = command;
				theform['mysql_command_data'].value = data;

				theform.submit();
				return false;
			}


			// submit to the page to log out sqlicity
			function confirm_logout ()
			{
				if (confirm('Are you sure you want to login back in as some other user?'))
				{
					document.sqlicity_viewstate_form['logout_submitted'].value = "<?php echo htmlutf($sqlicity_username) ?>";
					document.sqlicity_viewstate_form.submit();
				}

				return false;
			}


			// open a rollover message box
			function showHelpMsg (e,name)
			{
				getByID(name).style.display='block';
			}

			// close a rollover message box
			function hideHelpMsg (e,name)
			{
				getByID(name).style.display='none';
			}


			// for placing an object in the middle of the screen
			//  gives a roundabouts pixel distance to use
			function screenMiddle (elem)
			{
				var widths = {};

				// browser width is the main focus
				widths.browser = document.innerWidth;
				if (!widths.browser) { widths.browser = document.documentElement.clientWidth; }
				if (!widths.browser) { widths.browser = document.body.clientWidth; }

				// if no browser size found, use something arbitrary
				if (!widths.browser) { return 100; }


				// if the page is bigger than the window
				widths.maintable = getByID('sqlicity_maintable').clientWidth;
				if (widths.maintable > widths.browser)
				{
					// widths of the major pieces of the window
					widths.spacer = getByID('spacer_left_cell').clientWidth;
					widths.links = getByID('table_links_cell').clientWidth;

					// calc the width of the content page area that is displayed
					widths.viewable = widths.browser - widths.links - widths.spacer;
				}

				// page fits in window so just center it in the content area
				else { widths.viewable = getByID('content_page_cell').clientWidth; }

				elem.style.marginLeft = ''+((widths.viewable/2)-(elem.clientWidth))+'px';
			}


			// handles onLoad for individual elements in a sqlicity page
			var sqlicity_load = []; function doSqlicityLoad ()
			 { for (line in sqlicity_load) { eval(sqlicity_load[line]); } }

		//-->
		</script>

	</head>

	<body onLoad="doSqlicityLoad();">

		<!-- VIEW STATE FORM -->

		<form method="post" name="sqlicity_viewstate_form" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<input type="hidden" name="current_view" value="<?php echo $current_view ?>" />
			<input type="hidden" name="cur_mysql_db" value="<?php echo $cur_mysql_db_html ?>" />
			<input type="hidden" name="cur_mysql_table" value="<?php echo $cur_mysql_table_html ?>" />
			<input type="hidden" name="show_puresql" value="<?php echo $show_puresql ?>" />

			<input type="hidden" name="select_where" value="<?php echo htmlutf($select_where) ?>" />
			<input type="hidden" name="select_columns" value="<?php echo htmlutf($select_columns) ?>" />

			<input type="hidden" name="mysql_command" />
			<input type="hidden" name="mysql_command_data" />

			<input type="hidden" name="edit_row_identifier" />

			<input type="hidden" name="logout_submitted" />

<?php foreach($mysql_dbs as $db) { ?>
			<input type="hidden" name="mysql_dbs[]" value="<?php echo htmlutf($db) ?>" />
<?php } ?>

		</form>


		<p>
			<span style="font-size: 60%">Pageload Started: &nbsp; <?php echo $start_timestamp ?></span><br />
			<span style="font-size: 80%">&nbsp; Welcome <b><?php echo $sqlicity_username ?></b> - &nbsp;<a href="#"
			 class="link" onClick="return confirm_logout()">Log back in as a different user</a></span>
		</p>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="sqlicity_maintable">
			<tr><td width="10%" id="spacer_left_cell">&nbsp;</td>

				<td>

					<!-- HEADER -->
					<table border="1" cellspacing="1" cellpadding="5">
<?php
if (false) { // kill this display, optional
?>
						<tr><td colspan="2" valign="top" align="center">
							&nbsp; Connected to &nbsp; <b><?php echo $cur_mysql_db_html?></b> &nbsp; in &nbsp; <b><?php echo $mysql_server_name?></b> &nbsp; as &nbsp; <b><?php echo $sqlicity_username?></b> &nbsp;
						</td></tr>
<?php
}  // end login display conditional
?>
						<tr><td colspan="2" valign="top" align="center">
<?php
// draw all the available dbs
//  if there are too many dbs, use a drop down
if (count($mysql_dbs) < 7)
{
	echo "Select current database:<br /> |\n";

	// print the short list of dbs
	foreach ($mysql_dbs as $db)
	{
		$db_html = htmlutf($db);
?>
| <a href="#" onClick="return changeDB('<?php echo htmlutf($db) ?>');"
	 class="button"><?php echo ($db != $cur_mysql_db ? $db_html : "<b>$db_html</b>") ?></a> |
<?php
	}  // end loop over the short db list

	echo " |\n";
}
else  // draw the long list of dbs as a drop down
{
	echo "Select current database: &nbsp;\n"
	 ."<select onChange=\"changeDB(this.value)\">\n";

	// print the long list of dbs
	foreach ($mysql_dbs as $db)
	{
		echo "	<option"
		 .($cur_mysql_db != $db ? '' : ' selected="true"')
		 .">".htmlutf($db)."</option>\n";
	}  // end loop over the long db list

	echo "</select>\n";
}  // end db drawing
?>
						</td></tr>

						<tr><td colspan="2" valign="top" align="center">
							MySQL Information: &nbsp; *** &nbsp;
							Working on MySQL version: <b><?php echo htmlutf($mysql_version_string) ?></b>
							<br /> |
							<a href="#" class="button"
							 onClick="return setView2('select_data', 'cur_mysql_table','');"
							 >Test SELECT statements</a> |
							<a href="#" class="button"
							 onClick="return setView2('show_processlist', 'cur_mysql_table','');"
							 >Show current processlist</a> |
							<a href="#" class="button"
							 onClick="return setView2('show_userlist', 'cur_mysql_table','');"
							 >Control user permissions</a> |
						</td></tr>

						<tr>

							<!-- TABLES -->
							<td valign="top" align="left" id="table_links_cell">
								<p><a href="#" onClick="return changeDB('<?php echo $cur_mysql_db_html ?>');"
								 class="button"><b><?php echo $cur_mysql_db_html ?></b></a></p>

								<p>TABLES:<br />

<?php
// draw all available tables
foreach ($curdb_tables as $table)
{
	$table_html = htmlutf($table);
?>
								<a href="#" onClick="return changeTable('<?php echo htmlutf($table) ?>');"
									class="button"><?php echo ($table != $cur_mysql_table ? $table_html : "<b>$table_html</b>") ?></a><br />
<?php
} // end table drawing
?>
								</p>
							</td>

							<!-- DISPLAY -->
							<td valign="top" align="center">

								<table>
									<tr><td align="left">
										<a href="#" style="font-size: 80%" class="link"
										 onClick="return sendMySQLCommand('','');">Refresh this page</a>
									</td></tr>

									<tr><td>&nbsp;</td></tr>

<?php
if ($small_error)  // draw non critical errors
 { echo "<tr><td align=\"center\"><p style=\"font-size:110%;\"><b>$small_error</b></p></td></tr>\n<tr><td>&nbsp;</td></tr>\n"; }
?>

									<tr><td align="center" id="content_page_cell">

<?php $content_page(); ?>

										<p>&nbsp;</p>

									</td></tr>
								</table>

							</td>

						</tr>

						<!-- PURE SQL -->
						<tr><td colspan="2">

<?php
if ($show_puresql) {  // display Pure SQL command box
?>
							<form><table><tr>
								<td>
									<p>Run PURE SQL:<br />
									 Intialized with last SQL query.</p>

									<p>&nbsp;</p>
								</td>

								<td>
									<textarea name="pure_sql" cols="40" rows="6" wrap="off"><?php echo $executed_sql ?></textarea><br />
								</td>

								<td>&nbsp;</td>

<script>
<!--

	// limit the sql text if:
	//  any line is too long, or too many lines
	// this text is used in an alert box!
	function showPureSQL (sqltext)
	{
		maxline = 50;
		maxlines = 16;

		if (typeof sqltext != "undefined")
		 { sqllines = sqltext.split(/\r\n|\n|\r/); }
		if (typeof sqllines == "undefined")
		 { return ">>>> ERROR PARSING <<<<<"; }

		// limit the number of lines
		extratext ='';
		if (sqllines.length > maxlines) { sqllines.length = maxlines; extratext = '\n......'; }

		// limit the length of each line
		for (line in sqllines)
		 if (typeof sqllines[line] != "undefined" && sqllines[line].length > maxline)
		{ sqllines[line] = sqllines[line].substr(0,maxline)+'...'; }

		return sqllines.join('\n')+extratext;
	}

//-->
</script>

								<td>
									<input type="button" value="Clear SQL"
									 onClick="this.form.pure_sql.value='';" /><br />
									<input type="button" value="Execute SQL"
									 onClick="if (confirm('Are you sure you wish to EXECUTE PURE SQL?\n\n'+showPureSQL(this.form.pure_sql.value)+'\n'))
									  { return sendMySQLCommand('pure_sql', this.form.pure_sql.value); }" />
								</td>
							</tr></table></form>
<?php
}  // end show pure sql
else { echo "&nbsp;"; }  // just to fill the table cell
?>

						</td></tr>

						<tr><td colspan="2" align="right">
							<p>View the
								<a class="link" target="_blank"
								 href="http://dev.mysql.com/doc/mysql/en/index.html">MySQL Documentation</a>
							</p>
						</td></tr>

					</table>

					<!-- FOOTER -->
					<p style="font-size: 80%; padding-left: 25%">Editing with
						<a class="link" target="_blank" href="http://www.sqlicity.com">Sqlicity</a>
						-- Copyright &copy; 2005, Chris Rogus.
					</p>

				</td>
			</tr>
		</table>


		<p style="font-size: 60%"><br />Pageload Finished: &nbsp; <?php echo date($datetime_format) ?></p>

	</body>
</html>
