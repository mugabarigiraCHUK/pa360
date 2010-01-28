<?php

/************************
 * DB Bootstrap
 *************************/

/**
 * config global
 * @var array (mixed)
 */
$_CONFIG = $config;

/**
 * Database Connection
 * @var php connection link
 */
$_CON = db_connect(
	$config['db']['host'],
	$config['db']['username'], 
	$config['db']['password']);

mysql_select_db($config['db']['database']);
	
/**********************************
 * FUNCTION
 ***********************************/
	
/**
 * connect
 * @param unknown_type $host
 * @param unknown_type $user
 * @param unknown_type $passwd
 */

function db_connect($host, $user, $passwd){
	$con = mysql_pconnect($host, $user, $passwd);
	return $con;
}

function mysql_innodb_error($no){
if ($no==1000){ return mysql_error(); }//Error 1000 SQLSTATE: HY000 (ER_HASHCHK) Message: hashchk
if ($no==1001){ return mysql_error(); }//Error 1001 SQLSTATE: HY000 (ER_NISAMCHK) Message: isamchk
if ($no==1002){ return mysql_error(); }//Error 1002 SQLSTATE: HY000 (ER_NO) Message: NO
if ($no==1003){ return mysql_error(); }//Error 1003 SQLSTATE: HY000 (ER_YES) Message: YES
if ($no==1004){ return mysql_error(); }//Error 1004 SQLSTATE: HY000 (ER_CANT_CREATE_FILE) Message: Can't create file '%s' (errno: %d)
if ($no==1005){ return mysql_error(); }//Error 1005 SQLSTATE: HY000 (ER_CANT_CREATE_TABLE)Message: Can't create table '%s' (errno: %d)
if ($no==1006){ return mysql_error(); }//Error 1006 SQLSTATE: HY000 (ER_CANT_CREATE_DB)Message: Can't create database '%s' (errno: %d)
if ($no==1007){ return mysql_error(); }//Error 1007 SQLSTATE: HY000 (ER_DB_CREATE_EXISTS)Message: Can't create database '%s'; database exists
if ($no==1008){ return mysql_error(); }//Error 1008 SQLSTATE: HY000 (ER_DB_DROP_EXISTS)Message: Can't drop database '%s'; database doesn't existif ($no==1000){ return mysql_error(); }if ($no==1000){ return mysql_error(); }//Error 1009 SQLSTATE: HY000 (ER_DB_DROP_DELETE)Message: Error dropping database (can't delete '%s', errno: %d)
if ($no==1010){ return mysql_error(); }//Error 1010 SQLSTATE: HY000 (ER_DB_DROP_RMDIR)Message: Error dropping database (can't rmdir '%s', errno: %d)
if ($no==1011){ return mysql_error(); }//Error 1011 SQLSTATE: HY000 (ER_CANT_DELETE_FILE)Message: Error on delete of '%s' (errno: %d)
if ($no==1012){ return mysql_error(); }//Error 1012 SQLSTATE: HY000 (ER_CANT_FIND_SYSTEM_REC)Message: Can't read record in system table
if ($no==1013){ return mysql_error(); }//Error 1013 SQLSTATE: HY000 (ER_CANT_GET_STAT)Message: Can't get status of '%s' (errno: %d)
if ($no==1014){ return mysql_error(); }//Error 1014 SQLSTATE: HY000 (ER_CANT_GET_WD)Message: Can't get working directory (errno: %d)
if ($no==1015){ return mysql_error(); }//Error 1015 SQLSTATE: HY000 (ER_CANT_LOCK)Message: Can't lock file (errno: %d)
if ($no==1016){ return mysql_error(); }//Error 1016 SQLSTATE: HY000 (ER_CANT_OPEN_FILE)Message: Can't open file: '%s' (errno: %d)
if ($no==1017){ return mysql_error(); }//Error 1017 SQLSTATE: HY000 (ER_FILE_NOT_FOUND)Message: Can't find file: '%s' (errno: %d)
if ($no==1018){ return mysql_error(); }//Error 1018 SQLSTATE: HY000 (ER_CANT_READ_DIR)Message: Can't read dir of '%s' (errno: %d)
if ($no==1019){ return mysql_error(); }//Error 1019 SQLSTATE: HY000 (ER_CANT_SET_WD)Message: Can't change dir to '%s' (errno: %d)
if ($no==1020){ return mysql_error(); }//Error 1020 SQLSTATE: HY000 (ER_CHECKREAD)Message: Record has changed since last read in table '%s'if ($no==1000){ return mysql_error(); }if ($no==1000){ return mysql_error(); }//Error 1021 SQLSTATE: HY000 (ER_DISK_FULL)Message: Disk full (%s); waiting for someone to free some space...
if ($no==1022){ return mysql_error(); }//Error 1022 SQLSTATE: 23000 (ER_DUP_KEY)Message: Can't write; duplicate key in table '%s'
if ($no==1023){ return mysql_error(); }//Error 1023 SQLSTATE: HY000 (ER_ERROR_ON_CLOSE)Message: Error on close of '%s' (errno: %d)
if ($no==1024){ return mysql_error(); }//Error 1024 SQLSTATE: HY000 (ER_ERROR_ON_READ)Message: Error reading file '%s' (errno: %d)
if ($no==1025){ return mysql_error(); }//Error 1025 SQLSTATE: HY000 (ER_ERROR_ON_RENAME)Message: Error on rename of '%s' to '%s' (errno: %d)
if ($no==1026){ return mysql_error(); }//Error 1026 SQLSTATE: HY000 (ER_ERROR_ON_WRITE)Message: Error writing file '%s' (errno: %d)
if ($no==1027){ return mysql_error(); }//Error 1027 SQLSTATE: HY000 (ER_FILE_USED)Message: '%s' is locked against change
if ($no==1028){ return mysql_error(); }//Error 1028 SQLSTATE: HY000 (ER_FILSORT_ABORT)Message: Sort aborted
if ($no==1029){ return mysql_error(); }//Error 1029 SQLSTATE: HY000 (ER_FORM_NOT_FOUND)Message: View '%s' doesn't exist for '%s'
if ($no==1030){ return mysql_error(); }//Error 1030 SQLSTATE: HY000 (ER_GET_ERRNO)Message: Got error %d from storage engine
if ($no==1031){ return mysql_error(); }//Error 1031 SQLSTATE: HY000 (ER_ILLEGAL_HA)Message: Table storage engine for '%s' doesn't have this option
if ($no==1032){ return mysql_error(); }//Error 1032 SQLSTATE: HY000 (ER_KEY_NOT_FOUND)Message: Can't find record in '%s'
if ($no==1033){ return mysql_error(); }//Error 1033 SQLSTATE: HY000 (ER_NOT_FORM_FILE)Message: Incorrect information in file: '%s'
if ($no==1034){ return mysql_error(); }//Error 1034 SQLSTATE: HY000 (ER_NOT_KEYFILE)Message: Incorrect key file for table '%s'; try to repair it
if ($no==1035){ return mysql_error(); }//Error 1035 SQLSTATE: HY000 (ER_OLD_KEYFILE)Message: Old key file for table '%s'; repair it!
if ($no==1036){ return mysql_error(); }//Error 1036 SQLSTATE: HY000 (ER_OPEN_AS_READONLY)Message: Table '%s' is read only
if ($no==1037){ return mysql_error(); }//Error 1037 SQLSTATE: HY001 (ER_OUTOFMEMORY)Message: Out of memory; restart server and try again (needed %d bytes)
if ($no==1038){ return mysql_error(); }//Error 1038 SQLSTATE: HY001 (ER_OUT_OF_SORTMEMORY)Message: Out of sort memory; increase server sort buffer size
if ($no==1039){ return mysql_error(); }//Error 1039 SQLSTATE: HY000 (ER_UNEXPECTED_EOF)Message: Unexpected EOF found when reading file '%s' (errno: %d)
if ($no==1040){ return mysql_error(); }//Error 1040 SQLSTATE: 08004 (ER_CON_COUNT_ERROR)Message: Too many connections
if ($no==1041){ return mysql_error(); }//Error 1041 SQLSTATE: HY000 (ER_OUT_OF_RESOURCES)Message: Out of memory; check if mysqld or some other process uses all available memory; if not, you may have to use 'ulimit' to allow mysqld to use more memory or you can add more swap space
if ($no==1042){ return mysql_error(); }//Error 1042 SQLSTATE: 08S01 (ER_BAD_HOST_ERROR)Message: Can't get hostname for your address
if ($no==1043){ return mysql_error(); }//Error 1043 SQLSTATE: 08S01 (ER_HANDSHAKE_ERROR)Message: Bad handshake
if ($no==1044){ return mysql_error(); }//Error 1044 SQLSTATE: 42000 (ER_DBACCESS_DENIED_ERROR)Message: Access denied for user '%s'@'%s' to database '%s'
if ($no==1045){ return mysql_error(); }//Error 1045 SQLSTATE: 28000 (ER_ACCESS_DENIED_ERROR)Message: Access denied for user '%s'@'%s' (using password: %s)
if ($no==1046){ return mysql_error(); }//Error 1046 SQLSTATE: 3D000 (ER_NO_DB_ERROR)Message: No database selected
if ($no==1047){ return mysql_error(); }//Error 1047 SQLSTATE: 08S01 (ER_UNKNOWN_COM_ERROR)Message: Unknown command
if ($no==1048){ return mysql_error(); }//Error 1048 SQLSTATE: 23000 (ER_BAD_NULL_ERROR)Message: Column '%s' cannot be null
if ($no==1049){ return mysql_error(); }//Error 1049 SQLSTATE: 42000 (ER_BAD_DB_ERROR)Message: Unknown database '%s'
if ($no==1050){ return mysql_error(); }//Error 1050 SQLSTATE: 42S01 (ER_TABLE_EXISTS_ERROR)Message: Table '%s' already exists
if ($no==1051){ return mysql_error(); }//Error 1051 SQLSTATE: 42S02 (ER_BAD_TABLE_ERROR)Message: Unknown table '%s'
if ($no==1052){ return mysql_error(); }//Error 1052 SQLSTATE: 23000 (ER_NON_UNIQ_ERROR)Message: Column '%s' in %s is ambiguous
if ($no==1053){ return mysql_error(); }//Error 1053 SQLSTATE: 08S01 (ER_SERVER_SHUTDOWN)Message: Server shutdown in progress
if ($no==1054){ return mysql_error(); }//Error 1054 SQLSTATE: 42S22 (ER_BAD_FIELD_ERROR)Message: Unknown column '%s' in '%s'
if ($no==1055){ return mysql_error(); }//Error 1055 SQLSTATE: 42000 (ER_WRONG_FIELD_WITH_GROUP)Message: '%s' isn't in GROUP BY
if ($no==1056){ return mysql_error(); }//Error 1056 SQLSTATE: 42000 (ER_WRONG_GROUP_FIELD)Message: Can't group on '%s'
if ($no==1057){ return mysql_error(); }//Error 1057 SQLSTATE: 42000 (ER_WRONG_SUM_SELECT)Message: Statement has sum functions and columns in same statement
if ($no==1058){ return mysql_error(); }//Error 1058 SQLSTATE: 21S01 (ER_WRONG_VALUE_COUNT)Message: Column count doesn't match value count
if ($no==1059){ return mysql_error(); }//Error 1059 SQLSTATE: 42000 (ER_TOO_LONG_IDENT)Message: Identifier name '%s' is too long
if ($no==1060){ return mysql_error(); }//Error 1060 SQLSTATE: 42S21 (ER_DUP_FIELDNAME)Message: Duplicate column name '%s'
if ($no==1061){ return mysql_error(); }//Error 1061 SQLSTATE: 42000 (ER_DUP_KEYNAME)Message: Duplicate key name '%s'
if ($no==1062){ return mysql_error(); }//Error 1062 SQLSTATE: 23000 (ER_DUP_ENTRY)Message: Duplicate entry '%s' for key %d
if ($no==1063){ return mysql_error(); }//Error 1063 SQLSTATE: 42000 (ER_WRONG_FIELD_SPEC)Message: Incorrect column specifier for column '%s'
if ($no==1064){ return mysql_error(); }//Error 1064 SQLSTATE: 42000 (ER_PARSE_ERROR)Message: %s near '%s' at line %d
if ($no==1065){ return mysql_error(); }//Error 1065 SQLSTATE: 42000 (ER_EMPTY_QUERY)Message: Query was empty
if ($no==1066){ return mysql_error(); }//Error 1066 SQLSTATE: 42000 (ER_NONUNIQ_TABLE)Message: Not unique table/alias: '%s'
if ($no==1067){ return mysql_error(); }//Error 1067 SQLSTATE: 42000 (ER_INVALID_DEFAULT)Message: Invalid default value for '%s'
if ($no==1068){ return mysql_error(); }//Error 1068 SQLSTATE: 42000 (ER_MULTIPLE_PRI_KEY)Message: Multiple primary key defined
if ($no==1069){ return mysql_error(); }//Error 1069 SQLSTATE: 42000 (ER_TOO_MANY_KEYS)Message: Too many keys specified; max %d keys allowed
if ($no==1070){ return mysql_error(); }//Error 1070 SQLSTATE: 42000 (ER_TOO_MANY_KEY_PARTS)Message: Too many key parts specified; max %d parts allowed
if ($no==1071){ return mysql_error(); }//Error 1071 SQLSTATE: 42000 (ER_TOO_LONG_KEY)Message: Specified key was too long; max key length is %d bytes
if ($no==1072){ return mysql_error(); }//Error 1072 SQLSTATE: 42000 (ER_KEY_COLUMN_DOES_NOT_EXITS)Message: Key column '%s' doesn't exist in table
if ($no==1073){ return mysql_error(); }//Error 1073 SQLSTATE: 42000 (ER_BLOB_USED_AS_KEY)Message: BLOB column '%s' can't be used in key specification with the used table type
if ($no==1074){ return mysql_error(); }//Error 1074 SQLSTATE: 42000 (ER_TOO_BIG_FIELDLENGTH)Message: Column length too big for column '%s' (max = %lu); use BLOB or TEXT instead
if ($no==1075){ return mysql_error(); }//Error 1075 SQLSTATE: 42000 (ER_WRONG_AUTO_KEY)Message: Incorrect table definition; there can be only one auto column and it must be defined as a key
if ($no==1076){ return mysql_error(); }//Error 1076 SQLSTATE: HY000 (ER_READY)Message: %s: ready for connections. Version: '%s' socket: '%s' port: %d
if ($no==1077){ return mysql_error(); }//Error 1077 SQLSTATE: HY000 (ER_NORMAL_SHUTDOWN)Message: %s: Normal shutdown
if ($no==1078){ return mysql_error(); }//Error 1078 SQLSTATE: HY000 (ER_GOT_SIGNAL)Message: %s: Got signal %d. Aborting!
if ($no==1079){ return mysql_error(); }//Error 1079 SQLSTATE: HY000 (ER_SHUTDOWN_COMPLETE)Message: %s: Shutdown complete
if ($no==1080){ return mysql_error(); }//Error 1080 SQLSTATE: 08S01 (ER_FORCING_CLOSE)Message: %s: Forcing close of thread %ld user: '%s'
if ($no==1081){ return mysql_error(); }//Error 1081 SQLSTATE: 08S01 (ER_IPSOCK_ERROR)Message: Can't create IP socket
if ($no==1082){ return mysql_error(); }//Error 1082 SQLSTATE: 42S12 (ER_NO_SUCH_INDEX)Message: Table '%s' has no index like the one used in CREATE INDEX; recreate the table
if ($no==1083){ return mysql_error(); }//Error 1083 SQLSTATE: 42000 (ER_WRONG_FIELD_TERMINATORS)Message: Field separator argument is not what is expected; check the manual
if ($no==1084){ return mysql_error(); }//Error 1084 SQLSTATE: 42000 (ER_BLOBS_AND_NO_TERMINATED)Message: You can't use fixed rowlength with BLOBs; please use 'fields terminated by'
if ($no==1085){ return mysql_error(); }//Error 1085 SQLSTATE: HY000 (ER_TEXTFILE_NOT_READABLE)Message: The file '%s' must be in the database directory or be readable by all
if ($no==1086){ return mysql_error(); }//Error 1086 SQLSTATE: HY000 (ER_FILE_EXISTS_ERROR)Message: File '%s' already exists
if ($no==1087){ return mysql_error(); }//Error 1087 SQLSTATE: HY000 (ER_LOAD_INFO)Message: Records: %ld Deleted: %ld Skipped: %ld Warnings: %ld
if ($no==1088){ return mysql_error(); }//Error 1088 SQLSTATE: HY000 (ER_ALTER_INFO)Message: Records: %ld Duplicates: %ld
if ($no==1089){ return mysql_error(); }//Error 1089 SQLSTATE: HY000 (ER_WRONG_SUB_KEY)Message: Incorrect sub part key; the used key part isn't a string, the used length is longer than the key part, or the storage engine doesn't support unique sub keys
if ($no==1090){ return mysql_error(); }//Error 1090 SQLSTATE: 42000 (ER_CANT_REMOVE_ALL_FIELDS)Message: You can't delete all columns with ALTER TABLE; use DROP TABLE instead
if ($no==1091){ return mysql_error(); }//Error 1091 SQLSTATE: 42000 (ER_CANT_DROP_FIELD_OR_KEY)Message: Can't DROP '%s'; check that column/key exists
if ($no==1092){ return mysql_error(); }//Error 1092 SQLSTATE: HY000 (ER_INSERT_INFO)Message: Records: %ld Duplicates: %ld Warnings: %ld
if ($no==1093){ return mysql_error(); }//Error 1093 SQLSTATE: HY000 (ER_UPDATE_TABLE_USED)Message: You can't specify target table '%s' for update in FROM clause
if ($no==1094){ return mysql_error(); }//Error 1094 SQLSTATE: HY000 (ER_NO_SUCH_THREAD)Message: Unknown thread id: %lu
if ($no==1095){ return mysql_error(); }//Error 1095 SQLSTATE: HY000 (ER_KILL_DENIED_ERROR)Message: You are not owner of thread %lu
if ($no==1096){ return mysql_error(); }//Error 1096 SQLSTATE: HY000 (ER_NO_TABLES_USED)Message: No tables used
if ($no==1097){ return mysql_error(); }//Error 1097 SQLSTATE: HY000 (ER_TOO_BIG_SET)Message: Too many strings for column %s and SET
if ($no==1098){ return mysql_error(); }//Error 1098 SQLSTATE: HY000 (ER_NO_UNIQUE_LOGFILE)Message: Can't generate a unique log-filename %s.(1-999)
if ($no==1099){ return mysql_error(); }//Error 1099 SQLSTATE: HY000 (ER_TABLE_NOT_LOCKED_FOR_WRITE)Message: Table '%s' was locked with a READ lock and can't be updated
if ($no==1100){ return mysql_error(); }//Error 1100 SQLSTATE: HY000 (ER_TABLE_NOT_LOCKED)Message: Table '%s' was not locked with LOCK TABLES
if ($no==1101){ return mysql_error(); }//Error 1101 SQLSTATE: 42000 (ER_BLOB_CANT_HAVE_DEFAULT)Message: BLOB/TEXT column '%s' can't have a default value
if ($no==1102){ return mysql_error(); }//Error 1102 SQLSTATE: 42000 (ER_WRONG_DB_NAME)Message: Incorrect database name '%s'
if ($no==1103){ return mysql_error(); }//Error 1103 SQLSTATE: 42000 (ER_WRONG_TABLE_NAME)Message: Incorrect table name '%s'
if ($no==1104){ return mysql_error(); }//Error 1104 SQLSTATE: 42000 (ER_TOO_BIG_SELECT)Message: The SELECT would examine more than MAX_JOIN_SIZE rows; check your WHERE and use SET SQL_BIG_SELECTS=1 or SET SQL_MAX_JOIN_SIZE=# if the SELECT is okay
if ($no==1105){ return mysql_error(); }//Error 1105 SQLSTATE: HY000 (ER_UNKNOWN_ERROR)Message: Unknown error
if ($no==1106){ return mysql_error(); }//Error 1106 SQLSTATE: 42000 (ER_UNKNOWN_PROCEDURE)Message: Unknown procedure '%s'
if ($no==1107){ return mysql_error(); }//Error 1107 SQLSTATE: 42000 (ER_WRONG_PARAMCOUNT_TO_PROCEDURE)Message: Incorrect parameter count to procedure '%s'
if ($no==1108){ return mysql_error(); }//Error 1108 SQLSTATE: HY000 (ER_WRONG_PARAMETERS_TO_PROCEDURE)Message: Incorrect parameters to procedure '%s'
if ($no==1109){ return mysql_error(); }//Error 1109 SQLSTATE: 42S02 (ER_UNKNOWN_TABLE)Message: Unknown table '%s' in %s
if ($no==1110){ return mysql_error(); }//Error 1110 SQLSTATE: 42000 (ER_FIELD_SPECIFIED_TWICE)Message: Column '%s' specified twice
if ($no==1111){ return mysql_error(); }//Error 1111 SQLSTATE: HY000 (ER_INVALID_GROUP_FUNC_USE)Message: Invalid use of group function
if ($no==1112){ return mysql_error(); }//Error 1112 SQLSTATE: 42000 (ER_UNSUPPORTED_EXTENSION)Message: Table '%s' uses an extension that doesn't exist in this MySQL version
if ($no==1113){ return mysql_error(); }//Error 1113 SQLSTATE: 42000 (ER_TABLE_MUST_HAVE_COLUMNS)Message: A table must have at least 1 column
if ($no==1114){ return mysql_error(); }//Error 1114 SQLSTATE: HY000 (ER_RECORD_FILE_FULL)Message: The table '%s' is full
if ($no==1115){ return mysql_error(); }//Error 1115 SQLSTATE: 42000 (ER_UNKNOWN_CHARACTER_SET)Message: Unknown character set: '%s'
if ($no==1116){ return mysql_error(); }//Error 1116 SQLSTATE: HY000 (ER_TOO_MANY_TABLES)Message: Too many tables; MySQL can only use %d tables in a join
if ($no==1117){ return mysql_error(); }//Error 1117 SQLSTATE: HY000 (ER_TOO_MANY_FIELDS)Message: Too many columns
if ($no==1118){ return mysql_error(); }//Error 1118 SQLSTATE: 42000 (ER_TOO_BIG_ROWSIZE)Message: Row size too large. The maximum row size for the used table type, not counting BLOBs, is %ld. You have to change some columns to TEXT or BLOBs
if ($no==1119){ return mysql_error(); }//Error 1119 SQLSTATE: HY000 (ER_STACK_OVERRUN)Message: Thread stack overrun: Used: %ld of a %ld stack. Use 'mysqld -O thread_stack=#' to specify a bigger stack if needed
if ($no==1120){ return mysql_error(); }//Error 1120 SQLSTATE: 42000 (ER_WRONG_OUTER_JOIN)Message: Cross dependency found in OUTER JOIN; examine your ON conditions
if ($no==1121){ return mysql_error(); }//Error 1121 SQLSTATE: 42000 (ER_NULL_COLUMN_IN_INDEX)Message: Column '%s' is used with UNIQUE or INDEX but is not defined as NOT NULL
if ($no==1122){ return mysql_error(); }//Error 1122 SQLSTATE: HY000 (ER_CANT_FIND_UDF)Message: Can't load function '%s'
if ($no==1123){ return mysql_error(); }//Error 1123 SQLSTATE: HY000 (ER_CANT_INITIALIZE_UDF)Message: Can't initialize function '%s'; %s
if ($no==1124){ return mysql_error(); }//Error 1124 SQLSTATE: HY000 (ER_UDF_NO_PATHS)Message: No paths allowed for shared library
if ($no==1125){ return mysql_error(); }//Error 1125 SQLSTATE: HY000 (ER_UDF_EXISTS)Message: Function '%s' already exists
if ($no==1126){ return mysql_error(); }//Error 1126 SQLSTATE: HY000 (ER_CANT_OPEN_LIBRARY)Message: Can't open shared library '%s' (errno: %d %s)
if ($no==1127){ return mysql_error(); }//Error 1127 SQLSTATE: HY000 (ER_CANT_FIND_DL_ENTRY)Message: Can't find function '%s' in library
if ($no==1128){ return mysql_error(); }//Error 1128 SQLSTATE: HY000 (ER_FUNCTION_NOT_DEFINED)Message: Function '%s' is not defined
if ($no==1129){ return mysql_error(); }//Error 1129 SQLSTATE: HY000 (ER_HOST_IS_BLOCKED)Message: Host '%s' is blocked because of many connection errors; unblock with 'mysqladmin flush-hosts'
if ($no==1130){ return mysql_error(); }//Error 1130 SQLSTATE: HY000 (ER_HOST_NOT_PRIVILEGED)Message: Host '%s' is not allowed to connect to this MySQL server
if ($no==1131){ return mysql_error(); }//Error 1131 SQLSTATE: 42000 (ER_PASSWORD_ANONYMOUS_USER)Message: You are using MySQL as an anonymous user and anonymous users are not allowed to change passwords
if ($no==1132){ return mysql_error(); }//Error 1132 SQLSTATE: 42000 (ER_PASSWORD_NOT_ALLOWED)Message: You must have privileges to update tables in the mysql database to be able to change passwords for others
if ($no==1133){ return mysql_error(); }//Error 1133 SQLSTATE: 42000 (ER_PASSWORD_NO_MATCH)Message: Can't find any matching row in the user table
if ($no==1134){ return mysql_error(); }//Error 1134 SQLSTATE: HY000 (ER_UPDATE_INFO)Message: Rows matched: %ld Changed: %ld Warnings: %ld
if ($no==1135){ return mysql_error(); }//Error 1135 SQLSTATE: HY000 (ER_CANT_CREATE_THREAD)Message: Can't create a new thread (errno %d); if you are not out of available memory, you can consult the manual for a possible OS-dependent bug
if ($no==1136){ return mysql_error(); }//Error 1136 SQLSTATE: 21S01 (ER_WRONG_VALUE_COUNT_ON_ROW)Message: Column count doesn't match value count at row %ld
if ($no==1137){ return mysql_error(); }//Error 1137 SQLSTATE: HY000 (ER_CANT_REOPEN_TABLE)Message: Can't reopen table: '%s'
if ($no==1138){ return mysql_error(); }//Error 1138 SQLSTATE: 22004 (ER_INVALID_USE_OF_NULL)Message: Invalid use of NULL value
if ($no==1139){ return mysql_error(); }//Error 1139 SQLSTATE: 42000 (ER_REGEXP_ERROR)Message: Got error '%s' from regexp
if ($no==1140){ return mysql_error(); }//Error 1140 SQLSTATE: 42000 (ER_MIX_OF_GROUP_FUNC_AND_FIELDS)Message: Mixing of GROUP columns (MIN(),MAX(),COUNT(),...) with no GROUP columns is illegal if there is no GROUP BY clause
if ($no==1141){ return mysql_error(); }//Error 1141 SQLSTATE: 42000 (ER_NONEXISTING_GRANT)Message: There is no such grant defined for user '%s' on host '%s'
if ($no==1142){ return mysql_error(); }//Error 1142 SQLSTATE: 42000 (ER_TABLEACCESS_DENIED_ERROR)Message: %s command denied to user '%s'@'%s' for table '%s'
if ($no==1143){ return mysql_error(); }//Error 1143 SQLSTATE: 42000 (ER_COLUMNACCESS_DENIED_ERROR)Message: %s command denied to user '%s'@'%s' for column '%s' in table '%s'
if ($no==1144){ return mysql_error(); }//Error 1144 SQLSTATE: 42000 (ER_ILLEGAL_GRANT_FOR_TABLE)Message: Illegal GRANT/REVOKE command; please consult the manual to see which privileges can be used
if ($no==1145){ return mysql_error(); }//Error 1145 SQLSTATE: 42000 (ER_GRANT_WRONG_HOST_OR_USER)Message: The host or user argument to GRANT is too long
if ($no==1146){ return mysql_error(); }//Error 1146 SQLSTATE: 42S02 (ER_NO_SUCH_TABLE)Message: Table '%s.%s' doesn't exist
if ($no==1147){ return mysql_error(); }//Error 1147 SQLSTATE: 42000 (ER_NONEXISTING_TABLE_GRANT)Message: There is no such grant defined for user '%s' on host '%s' on table '%s'
if ($no==1148){ return mysql_error(); }//Error 1148 SQLSTATE: 42000 (ER_NOT_ALLOWED_COMMAND)Message: The used command is not allowed with this MySQL version
if ($no==1149){ return mysql_error(); }//Error 1149 SQLSTATE: 42000 (ER_SYNTAX_ERROR)Message: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use
if ($no==1150){ return mysql_error(); }//Error 1150 SQLSTATE: HY000 (ER_DELAYED_CANT_CHANGE_LOCK)Message: Delayed insert thread couldn't get requested lock for table %s
if ($no==1151){ return mysql_error(); }//Error 1151 SQLSTATE: HY000 (ER_TOO_MANY_DELAYED_THREADS)Message: Too many delayed threads in use
if ($no==1152){ return mysql_error(); }//Error 1152 SQLSTATE: 08S01 (ER_ABORTING_CONNECTION)Message: Aborted connection %ld to db: '%s' user: '%s' (%s)
if ($no==1153){ return mysql_error(); }//Error 1153 SQLSTATE: 08S01 (ER_NET_PACKET_TOO_LARGE)Message: Got a packet bigger than 'max_allowed_packet' bytes
if ($no==1154){ return mysql_error(); }//Error 1154 SQLSTATE: 08S01 (ER_NET_READ_ERROR_FROM_PIPE)Message: Got a read error from the connection pipe
if ($no==1155){ return mysql_error(); }//Error 1155 SQLSTATE: 08S01 (ER_NET_FCNTL_ERROR)Message: Got an error from fcntl()
if ($no==1156){ return mysql_error(); }//Error 1156 SQLSTATE: 08S01 (ER_NET_PACKETS_OUT_OF_ORDER)Message: Got packets out of order
if ($no==1157){ return mysql_error(); }//Error 1157 SQLSTATE: 08S01 (ER_NET_UNCOMPRESS_ERROR)Message: Couldn't uncompress communication packet
if ($no==1158){ return mysql_error(); }//Error 1158 SQLSTATE: 08S01 (ER_NET_READ_ERROR)Message: Got an error reading communication packets
if ($no==1159){ return mysql_error(); }//Error 1159 SQLSTATE: 08S01 (ER_NET_READ_INTERRUPTED)Message: Got timeout reading communication packets
if ($no==1160){ return mysql_error(); }//Error 1160 SQLSTATE: 08S01 (ER_NET_ERROR_ON_WRITE)Message: Got an error writing communication packets
if ($no==1161){ return mysql_error(); }//Error 1161 SQLSTATE: 08S01 (ER_NET_WRITE_INTERRUPTED)Message: Got timeout writing communication packets
if ($no==1162){ return mysql_error(); }//Error 1162 SQLSTATE: 42000 (ER_TOO_LONG_STRING)Message: Result string is longer than 'max_allowed_packet' bytes
if ($no==1163){ return mysql_error(); }//Error 1163 SQLSTATE: 42000 (ER_TABLE_CANT_HANDLE_BLOB)Message: The used table type doesn't support BLOB/TEXT columns
if ($no==1164){ return mysql_error(); }//Error 1164 SQLSTATE: 42000 (ER_TABLE_CANT_HANDLE_AUTO_INCREMENT)Message: The used table type doesn't support AUTO_INCREMENT columns
if ($no==1165){ return mysql_error(); }//Error 1165 SQLSTATE: HY000 (ER_DELAYED_INSERT_TABLE_LOCKED)Message: INSERT DELAYED can't be used with table '%s' because it is locked with LOCK TABLES
if ($no==1166){ return mysql_error(); }//Error 1166 SQLSTATE: 42000 (ER_WRONG_COLUMN_NAME)Message: Incorrect column name '%s'
if ($no==1167){ return mysql_error(); }//Error 1167 SQLSTATE: 42000 (ER_WRONG_KEY_COLUMN)Message: The used storage engine can't index column '%s'
if ($no==1168){ return mysql_error(); }//Error 1168 SQLSTATE: HY000 (ER_WRONG_MRG_TABLE)Message: Unable to open underlying table which is differently defined or of non-MyISAM type or doesn't exist
if ($no==1169){ return mysql_error(); }//Error 1169 SQLSTATE: 23000 (ER_DUP_UNIQUE)Message: Can't write, because of unique constraint, to table '%s'
if ($no==1170){ return mysql_error(); }//Error 1170 SQLSTATE: 42000 (ER_BLOB_KEY_WITHOUT_LENGTH)Message: BLOB/TEXT column '%s' used in key specification without a key length
if ($no==1171){ return mysql_error(); }//Error 1171 SQLSTATE: 42000 (ER_PRIMARY_CANT_HAVE_NULL)Message: All parts of a PRIMARY KEY must be NOT NULL; if you need NULL in a key, use UNIQUE instead
if ($no==1172){ return mysql_error(); }//Error 1172 SQLSTATE: 42000 (ER_TOO_MANY_ROWS)Message: Result consisted of more than one row
if ($no==1173){ return mysql_error(); }//Error 1173 SQLSTATE: 42000 (ER_REQUIRES_PRIMARY_KEY)Message: This table type requires a primary key
if ($no==1174){ return mysql_error(); }//Error 1174 SQLSTATE: HY000 (ER_NO_RAID_COMPILED)Message: This version of MySQL is not compiled with RAID support
if ($no==1175){ return mysql_error(); }//Error 1175 SQLSTATE: HY000 (ER_UPDATE_WITHOUT_KEY_IN_SAFE_MODE)Message: You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column
if ($no==1176){ return mysql_error(); }//Error 1176 SQLSTATE: HY000 (ER_KEY_DOES_NOT_EXITS)Message: Key '%s' doesn't exist in table '%s'
if ($no==1177){ return mysql_error(); }//Error 1177 SQLSTATE: 42000 (ER_CHECK_NO_SUCH_TABLE)Message: Can't open table
if ($no==1178){ return mysql_error(); }//Error 1178 SQLSTATE: 42000 (ER_CHECK_NOT_IMPLEMENTED)Message: The storage engine for the table doesn't support %s
if ($no==1179){ return mysql_error(); }//Error 1179 SQLSTATE: 25000 (ER_CANT_DO_THIS_DURING_AN_TRANSACTION)Message: You are not allowed to execute this command in a transaction
if ($no==1180){ return mysql_error(); }//Error 1180 SQLSTATE: HY000 (ER_ERROR_DURING_COMMIT)Message: Got error %d during COMMIT
if ($no==1181){ return mysql_error(); }//Error 1181 SQLSTATE: HY000 (ER_ERROR_DURING_ROLLBACK)Message: Got error %d during ROLLBACK
if ($no==1182){ return mysql_error(); }//Error 1182 SQLSTATE: HY000 (ER_ERROR_DURING_FLUSH_LOGS)Message: Got error %d during FLUSH_LOGS
if ($no==1183){ return mysql_error(); }//Error 1183 SQLSTATE: HY000 (ER_ERROR_DURING_CHECKPOINT)Message: Got error %d during CHECKPOINT
if ($no==1184){ return mysql_error(); }//Error 1184 SQLSTATE: 08S01 (ER_NEW_ABORTING_CONNECTION)Message: Aborted connection %ld to db: '%s' user: '%s' host: '%s' (%s)
if ($no==1185){ return mysql_error(); }//Error 1185 SQLSTATE: HY000 (ER_DUMP_NOT_IMPLEMENTED)Message: The storage engine for the table does not support binary table dump
if ($no==1186){ return mysql_error(); }//Error 1186 SQLSTATE: HY000 (ER_FLUSH_MASTER_BINLOG_CLOSED)Message: Binlog closed, cannot RESET MASTER
if ($no==1187){ return mysql_error(); }//Error 1187 SQLSTATE: HY000 (ER_INDEX_REBUILD)Message: Failed rebuilding the index of dumped table '%s'
if ($no==1188){ return mysql_error(); }//Error 1188 SQLSTATE: HY000 (ER_MASTER)Message: Error from master: '%s'
if ($no==1189){ return mysql_error(); }//Error 1189 SQLSTATE: 08S01 (ER_MASTER_NET_READ)Message: Net error reading from master
if ($no==1190){ return mysql_error(); }//Error 1190 SQLSTATE: 08S01 (ER_MASTER_NET_WRITE)Message: Net error writing to master
if ($no==1191){ return mysql_error(); }//Error 1191 SQLSTATE: HY000 (ER_FT_MATCHING_KEY_NOT_FOUND)Message: Can't find FULLTEXT index matching the column list
if ($no==1192){ return mysql_error(); }//Error 1192 SQLSTATE: HY000 (ER_LOCK_OR_ACTIVE_TRANSACTION)Message: Can't execute the given command because you have active locked tables or an active transaction
if ($no==1193){ return mysql_error(); }//Error 1193 SQLSTATE: HY000 (ER_UNKNOWN_SYSTEM_VARIABLE)Message: Unknown system variable '%s'
if ($no==1194){ return mysql_error(); }//Error 1194 SQLSTATE: HY000 (ER_CRASHED_ON_USAGE)Message: Table '%s' is marked as crashed and should be repaired
if ($no==1195){ return mysql_error(); }//Error 1195 SQLSTATE: HY000 (ER_CRASHED_ON_REPAIR)Message: Table '%s' is marked as crashed and last (automatic?) repair failed
if ($no==1196){ return mysql_error(); }//Error 1196 SQLSTATE: HY000 (ER_WARNING_NOT_COMPLETE_ROLLBACK)Message: Some non-transactional changed tables couldn't be rolled back
if ($no==1197){ return mysql_error(); }//Error 1197 SQLSTATE: HY000 (ER_TRANS_CACHE_FULL)Message: Multi-statement transaction required more than 'max_binlog_cache_size' bytes of storage; increase this mysqld variable and try again
if ($no==1198){ return mysql_error(); }//Error 1198 SQLSTATE: HY000 (ER_SLAVE_MUST_STOP)Message: This operation cannot be performed with a running slave; run STOP SLAVE first
if ($no==1199){ return mysql_error(); }//Error 1199 SQLSTATE: HY000 (ER_SLAVE_NOT_RUNNING)Message: This operation requires a running slave; configure slave and do START SLAVE
if ($no==1200){ return mysql_error(); }//Error 1200 SQLSTATE: HY000 (ER_BAD_SLAVE)Message: The server is not configured as slave; fix in config file or with CHANGE MASTER TO
if ($no==1201){ return mysql_error(); }//Error 1201 SQLSTATE: HY000 (ER_MASTER_INFO)Message: Could not initialize master info structure; more error messages can be found in the MySQL error log
if ($no==1202){ return mysql_error(); }//Error 1202 SQLSTATE: HY000 (ER_SLAVE_THREAD)Message: Could not create slave thread; check system resources
if ($no==1203){ return mysql_error(); }//Error 1203 SQLSTATE: 42000 (ER_TOO_MANY_USER_CONNECTIONS)Message: User %s already has more than 'max_user_connections' active connections
if ($no==1204){ return mysql_error(); }//Error 1204 SQLSTATE: HY000 (ER_SET_CONSTANTS_ONLY)Message: You may only use constant expressions with SET
if ($no==1205){ return mysql_error(); }//Error 1205 SQLSTATE: HY000 (ER_LOCK_WAIT_TIMEOUT)Message: Lock wait timeout exceeded; try restarting transaction
if ($no==1206){ return mysql_error(); }//Error 1206 SQLSTATE: HY000 (ER_LOCK_TABLE_FULL)Message: The total number of locks exceeds the lock table size
if ($no==1207){ return mysql_error(); }//Error 1207 SQLSTATE: 25000 (ER_READ_ONLY_TRANSACTION)Message: Update locks cannot be acquired during a READ UNCOMMITTED transaction
if ($no==1208){ return mysql_error(); }//Error 1208 SQLSTATE: HY000 (ER_DROP_DB_WITH_READ_LOCK)Message: DROP DATABASE not allowed while thread is holding global read lock
if ($no==1209){ return mysql_error(); }//Error 1209 SQLSTATE: HY000 (ER_CREATE_DB_WITH_READ_LOCK)Message: CREATE DATABASE not allowed while thread is holding global read lock
if ($no==1210){ return mysql_error(); }//Error 1210 SQLSTATE: HY000 (ER_WRONG_ARGUMENTS)Message: Incorrect arguments to %s
if ($no==1211){ return mysql_error(); }//Error 1211 SQLSTATE: 42000 (ER_NO_PERMISSION_TO_CREATE_USER)Message: '%s'@'%s' is not allowed to create new users
if ($no==1212){ return mysql_error(); }//Error 1212 SQLSTATE: HY000 (ER_UNION_TABLES_IN_DIFFERENT_DIR)Message: Incorrect table definition; all MERGE tables must be in the same database
if ($no==1213){ return mysql_error(); }//Error 1213 SQLSTATE: 40001 (ER_LOCK_DEADLOCK)Message: Deadlock found when trying to get lock; try restarting transaction
if ($no==1214){ return mysql_error(); }//Error 1214 SQLSTATE: HY000 (ER_TABLE_CANT_HANDLE_FT)Message: The used table type doesn't support FULLTEXT indexes
if ($no==1215){ return mysql_error(); }//Error 1215 SQLSTATE: HY000 (ER_CANNOT_ADD_FOREIGN)Message: Cannot add foreign key constraint
if ($no==1216){ return mysql_error(); }//Error 1216 SQLSTATE: 23000 (ER_NO_REFERENCED_ROW)Message: Cannot add or update a child row: a foreign key constraint fails
if ($no==1217){ return mysql_error(); }//Error 1217 SQLSTATE: 23000 (ER_ROW_IS_REFERENCED)Message: Cannot delete or update a parent row: a foreign key constraint fails
if ($no==1218){ return mysql_error(); }//Error 1218 SQLSTATE: 08S01 (ER_CONNECT_TO_MASTER)Message: Error connecting to master: %s
if ($no==1219){ return mysql_error(); }//Error 1219 SQLSTATE: HY000 (ER_QUERY_ON_MASTER)Message: Error running query on master: %s
if ($no==1220){ return mysql_error(); }//Error 1220 SQLSTATE: HY000 (ER_ERROR_WHEN_EXECUTING_COMMAND)Message: Error when executing command %s: %s
if ($no==1221){ return mysql_error(); }//Error 1221 SQLSTATE: HY000 (ER_WRONG_USAGE)Message: Incorrect usage of %s and %s
if ($no==1222){ return mysql_error(); }//Error 1222 SQLSTATE: 21000 (ER_WRONG_NUMBER_OF_COLUMNS_IN_SELECT)Message: The used SELECT statements have a different number of columns
if ($no==1223){ return mysql_error(); }//Error 1223 SQLSTATE: HY000 (ER_CANT_UPDATE_WITH_READLOCK)Message: Can't execute the query because you have a conflicting read lock
if ($no==1224){ return mysql_error(); }//Error 1224 SQLSTATE: HY000 (ER_MIXING_NOT_ALLOWED)Message: Mixing of transactional and non-transactional tables is disabled
if ($no==1225){ return mysql_error(); }//Error 1225 SQLSTATE: HY000 (ER_DUP_ARGUMENT)Message: Option '%s' used twice in statement
if ($no==1226){ return mysql_error(); }//Error 1226 SQLSTATE: 42000 (ER_USER_LIMIT_REACHED)Message: User '%s' has exceeded the '%s' resource (current value: %ld)
if ($no==1227){ return mysql_error(); }//Error 1227 SQLSTATE: 42000 (ER_SPECIFIC_ACCESS_DENIED_ERROR)Message: Access denied; you need the %s privilege for this operation
if ($no==1228){ return mysql_error(); }//Error 1228 SQLSTATE: HY000 (ER_LOCAL_VARIABLE)Message: Variable '%s' is a SESSION variable and can't be used with SET GLOBAL
if ($no==1229){ return mysql_error(); }//Error 1229 SQLSTATE: HY000 (ER_GLOBAL_VARIABLE)Message: Variable '%s' is a GLOBAL variable and should be set with SET GLOBAL
if ($no==1230){ return mysql_error(); }//Error 1230 SQLSTATE: 42000 (ER_NO_DEFAULT)Message: Variable '%s' doesn't have a default value
if ($no==1231){ return mysql_error(); }//Error 1231 SQLSTATE: 42000 (ER_WRONG_VALUE_FOR_VAR)Message: Variable '%s' can't be set to the value of '%s'
if ($no==1232){ return mysql_error(); }//Error 1232 SQLSTATE: 42000 (ER_WRONG_TYPE_FOR_VAR)Message: Incorrect argument type to variable '%s'
if ($no==1233){ return mysql_error(); }//Error 1233 SQLSTATE: HY000 (ER_VAR_CANT_BE_READ)Message: Variable '%s' can only be set, not read
if ($no==1234){ return mysql_error(); }//Error 1234 SQLSTATE: 42000 (ER_CANT_USE_OPTION_HERE)Message: Incorrect usage/placement of '%s'
if ($no==1235){ return mysql_error(); }//Error 1235 SQLSTATE: 42000 (ER_NOT_SUPPORTED_YET)Message: This version of MySQL doesn't yet support '%s'
if ($no==1236){ return mysql_error(); }//Error 1236 SQLSTATE: HY000 (ER_MASTER_FATAL_ERROR_READING_BINLOG)Message: Got fatal error %d: '%s' from master when reading data from binary log
if ($no==1237){ return mysql_error(); }//Error 1237 SQLSTATE: HY000 (ER_SLAVE_IGNORED_TABLE)Message: Slave SQL thread ignored the query because of replicate-*-table rules
if ($no==1238){ return mysql_error(); }//Error 1238 SQLSTATE: HY000 (ER_INCORRECT_GLOBAL_LOCAL_VAR)Message: Variable '%s' is a %s variable
if ($no==1239){ return mysql_error(); }//Error 1239 SQLSTATE: 42000 (ER_WRONG_FK_DEF)Message: Incorrect foreign key definition for '%s': %s
if ($no==1240){ return mysql_error(); }//Error 1240 SQLSTATE: HY000 (ER_KEY_REF_DO_NOT_MATCH_TABLE_REF)Message: Key reference and table reference don't match
if ($no==1241){ return mysql_error(); }//Error 1241 SQLSTATE: 21000 (ER_OPERAND_COLUMNS)Message: Operand should contain %d column(s)
if ($no==1242){ return mysql_error(); }//Error 1242 SQLSTATE: 21000 (ER_SUBQUERY_NO_1_ROW)Message: Subquery returns more than 1 row
if ($no==1243){ return mysql_error(); }//Error 1243 SQLSTATE: HY000 (ER_UNKNOWN_STMT_HANDLER)Message: Unknown prepared statement handler (%.*s) given to %s
if ($no==1244){ return mysql_error(); }//Error 1244 SQLSTATE: HY000 (ER_CORRUPT_HELP_DB)Message: Help database is corrupt or does not exist
if ($no==1245){ return mysql_error(); }//Error 1245 SQLSTATE: HY000 (ER_CYCLIC_REFERENCE)Message: Cyclic reference on subqueries
if ($no==1246){ return mysql_error(); }//Error 1246 SQLSTATE: HY000 (ER_AUTO_CONVERT)Message: Converting column '%s' from %s to %s
if ($no==1247){ return mysql_error(); }//Error 1247 SQLSTATE: 42S22 (ER_ILLEGAL_REFERENCE)Message: Reference '%s' not supported (%s)
if ($no==1248){ return mysql_error(); }//Error 1248 SQLSTATE: 42000 (ER_DERIVED_MUST_HAVE_ALIAS)Message: Every derived table must have its own alias
if ($no==1249){ return mysql_error(); }//Error 1249 SQLSTATE: 01000 (ER_SELECT_REDUCED)Message: Select %u was reduced during optimization
if ($no==1250){ return mysql_error(); }//Error 1250 SQLSTATE: 42000 (ER_TABLENAME_NOT_ALLOWED_HERE)Message: Table '%s' from one of the SELECTs cannot be used in %s
if ($no==1251){ return mysql_error(); }//Error 1251 SQLSTATE: 08004 (ER_NOT_SUPPORTED_AUTH_MODE)Message: Client does not support authentication protocol requested by server; consider upgrading MySQL client
if ($no==1252){ return mysql_error(); }//Error 1252 SQLSTATE: 42000 (ER_SPATIAL_CANT_HAVE_NULL)Message: All parts of a SPATIAL index must be NOT NULL
if ($no==1253){ return mysql_error(); }//Error 1253 SQLSTATE: 42000 (ER_COLLATION_CHARSET_MISMATCH)Message: COLLATION '%s' is not valid for CHARACTER SET '%s'
if ($no==1254){ return mysql_error(); }//Error 1254 SQLSTATE: HY000 (ER_SLAVE_WAS_RUNNING)Message: Slave is already running
if ($no==1255){ return mysql_error(); }//Error 1255 SQLSTATE: HY000 (ER_SLAVE_WAS_NOT_RUNNING)Message: Slave already has been stopped
if ($no==1256){ return mysql_error(); }//Error 1256 SQLSTATE: HY000 (ER_TOO_BIG_FOR_UNCOMPRESS)Message: Uncompressed data size too large; the maximum size is %d (probably, length of uncompressed data was corrupted)
if ($no==1257){ return mysql_error(); }//Error 1257 SQLSTATE: HY000 (ER_ZLIB_Z_MEM_ERROR)Message: ZLIB: Not enough memory
if ($no==1258){ return mysql_error(); }//Error 1258 SQLSTATE: HY000 (ER_ZLIB_Z_BUF_ERROR)Message: ZLIB: Not enough room in the output buffer (probably, length of uncompressed data was corrupted)
if ($no==1259){ return mysql_error(); }//Error 1259 SQLSTATE: HY000 (ER_ZLIB_Z_DATA_ERROR)Message: ZLIB: Input data corrupted
if ($no==1260){ return mysql_error(); }//Error 1260 SQLSTATE: HY000 (ER_CUT_VALUE_GROUP_CONCAT)Message: %d line(s) were cut by GROUP_CONCAT()
if ($no==1261){ return mysql_error(); }//Error 1261 SQLSTATE: 01000 (ER_WARN_TOO_FEW_RECORDS)Message: Row %ld doesn't contain data for all columns
if ($no==1262){ return mysql_error(); }//Error 1262 SQLSTATE: 01000 (ER_WARN_TOO_MANY_RECORDS)Message: Row %ld was truncated; it contained more data than there were input columns
if ($no==1263){ return mysql_error(); }//Error 1263 SQLSTATE: 22004 (ER_WARN_NULL_TO_NOTNULL)Message: Column was set to data type implicit default; NULL supplied for NOT NULL column '%s' at row %ld
if ($no==1264){ return mysql_error(); }//Error 1264 SQLSTATE: 22003 (ER_WARN_DATA_OUT_OF_RANGE)Message: Out of range value adjusted for column '%s' at row %ld
if ($no==1265){ return mysql_error(); }//Error 1265 SQLSTATE: 01000 (WARN_DATA_TRUNCATED)Message: Data truncated for column '%s' at row %ld
if ($no==1266){ return mysql_error(); }//Error 1266 SQLSTATE: HY000 (ER_WARN_USING_OTHER_HANDLER)Message: Using storage engine %s for table '%s'
if ($no==1267){ return mysql_error(); }//Error 1267 SQLSTATE: HY000 (ER_CANT_AGGREGATE_2COLLATIONS)Message: Illegal mix of collations (%s,%s) and (%s,%s) for operation '%s'
if ($no==1268){ return mysql_error(); }//Error 1268 SQLSTATE: HY000 (ER_DROP_USER)Message: Cannot drop one or more of the requested users
if ($no==1269){ return mysql_error(); }//Error 1269 SQLSTATE: HY000 (ER_REVOKE_GRANTS)Message: Can't revoke all privileges for one or more of the requested users
if ($no==1270){ return mysql_error(); }//Error 1270 SQLSTATE: HY000 (ER_CANT_AGGREGATE_3COLLATIONS)Message: Illegal mix of collations (%s,%s), (%s,%s), (%s,%s) for operation '%s'
if ($no==1271){ return mysql_error(); }//Error 1271 SQLSTATE: HY000 (ER_CANT_AGGREGATE_NCOLLATIONS)Message: Illegal mix of collations for operation '%s'
if ($no==1272){ return mysql_error(); }//Error 1272 SQLSTATE: HY000 (ER_VARIABLE_IS_NOT_STRUCT)Message: Variable '%s' is not a variable component (can't be used as XXXX.variable_name)
if ($no==1273){ return mysql_error(); }//Error 1273 SQLSTATE: HY000 (ER_UNKNOWN_COLLATION)Message: Unknown collation: '%s'
if ($no==1274){ return mysql_error(); }//Error 1274 SQLSTATE: HY000 (ER_SLAVE_IGNORED_SSL_PARAMS)Message: SSL parameters in CHANGE MASTER are ignored because this MySQL slave was compiled without SSL support; they can be used later if MySQL slave with SSL is started
if ($no==1275){ return mysql_error(); }//Error 1275 SQLSTATE: HY000 (ER_SERVER_IS_IN_SECURE_AUTH_MODE)Message: Server is running in --secure-auth mode, but '%s'@'%s' has a password in the old format; please change the password to the new format
if ($no==1276){ return mysql_error(); }//Error 1276 SQLSTATE: HY000 (ER_WARN_FIELD_RESOLVED)Message: Field or reference '%s%s%s%s%s' of SELECT #%d was resolved in SELECT #%d
if ($no==1277){ return mysql_error(); }//Error 1277 SQLSTATE: HY000 (ER_BAD_SLAVE_UNTIL_COND)Message: Incorrect parameter or combination of parameters for START SLAVE UNTIL
if ($no==1278){ return mysql_error(); }//Error 1278 SQLSTATE: HY000 (ER_MISSING_SKIP_SLAVE)Message: It is recommended to use --skip-slave-start when doing step-by-step replication with START SLAVE UNTIL; otherwise, you will get problems if you get an unexpected slave's mysqld restart
if ($no==1279){ return mysql_error(); }//Error 1279 SQLSTATE: HY000 (ER_UNTIL_COND_IGNORED)Message: SQL thread is not to be started so UNTIL options are ignored
if ($no==1280){ return mysql_error(); }//Error 1280 SQLSTATE: 42000 (ER_WRONG_NAME_FOR_INDEX)Message: Incorrect index name '%s'
if ($no==1281){ return mysql_error(); }//Error 1281 SQLSTATE: 42000 (ER_WRONG_NAME_FOR_CATALOG)Message: Incorrect catalog name '%s'
if ($no==1282){ return mysql_error(); }//Error 1282 SQLSTATE: HY000 (ER_WARN_QC_RESIZE)Message: Query cache failed to set size %lu; new query cache size is %lu
if ($no==1283){ return mysql_error(); }//Error 1283 SQLSTATE: HY000 (ER_BAD_FT_COLUMN)Message: Column '%s' cannot be part of FULLTEXT index
if ($no==1284){ return mysql_error(); }//Error 1284 SQLSTATE: HY000 (ER_UNKNOWN_KEY_CACHE)Message: Unknown key cache '%s'
if ($no==1285){ return mysql_error(); }//Error 1285 SQLSTATE: HY000 (ER_WARN_HOSTNAME_WONT_WORK)Message: MySQL is started in --skip-name-resolve mode; you must restart it without this switch for this grant to work
if ($no==1286){ return mysql_error(); }//Error 1286 SQLSTATE: 42000 (ER_UNKNOWN_STORAGE_ENGINE)Message: Unknown table engine '%s'
if ($no==1287){ return mysql_error(); }//Error 1287 SQLSTATE: HY000 (ER_WARN_DEPRECATED_SYNTAX)Message: '%s' is deprecated; use '%s' instead
if ($no==1288){ return mysql_error(); }//Error 1288 SQLSTATE: HY000 (ER_NON_UPDATABLE_TABLE)Message: The target table %s of the %s is not updatable
if ($no==1289){ return mysql_error(); }//Error 1289 SQLSTATE: HY000 (ER_FEATURE_DISABLED)Message: The '%s' feature is disabled; you need MySQL built with '%s' to have it working
if ($no==1290){ return mysql_error(); }//Error 1290 SQLSTATE: HY000 (ER_OPTION_PREVENTS_STATEMENT)Message: The MySQL server is running with the %s option so it cannot execute this statement
if ($no==1291){ return mysql_error(); }//Error 1291 SQLSTATE: HY000 (ER_DUPLICATED_VALUE_IN_TYPE)Message: Column '%s' has duplicated value '%s' in %s
if ($no==1292){ return mysql_error(); }//Error 1292 SQLSTATE: 22007 (ER_TRUNCATED_WRONG_VALUE)Message: Truncated incorrect %s value: '%s'
if ($no==1293){ return mysql_error(); }//Error 1293 SQLSTATE: HY000 (ER_TOO_MUCH_AUTO_TIMESTAMP_COLS)Message: Incorrect table definition; there can be only one TIMESTAMP column with CURRENT_TIMESTAMP in DEFAULT or ON UPDATE clause
if ($no==1294){ return mysql_error(); }//Error 1294 SQLSTATE: HY000 (ER_INVALID_ON_UPDATE)Message: Invalid ON UPDATE clause for '%s' column
if ($no==1295){ return mysql_error(); }//Error 1295 SQLSTATE: HY000 (ER_UNSUPPORTED_PS)Message: This command is not supported in the prepared statement protocol yet
if ($no==1296){ return mysql_error(); }//Error 1296 SQLSTATE: HY000 (ER_GET_ERRMSG)Message: Got error %d '%s' from %s
if ($no==1297){ return mysql_error(); }//Error 1297 SQLSTATE: HY000 (ER_GET_TEMPORARY_ERRMSG)Message: Got temporary error %d '%s' from %s
if ($no==1298){ return mysql_error(); }//Error 1298 SQLSTATE: HY000 (ER_UNKNOWN_TIME_ZONE)Message: Unknown or incorrect time zone: '%s'
if ($no==1299){ return mysql_error(); }//Error 1299 SQLSTATE: HY000 (ER_WARN_INVALID_TIMESTAMP)Message: Invalid TIMESTAMP value in column '%s' at row %ld
if ($no==1300){ return mysql_error(); }//Error 1300 SQLSTATE: HY000 (ER_INVALID_CHARACTER_STRING)Message: Invalid %s character string: '%s'
if ($no==1301){ return mysql_error(); }//Error 1301 SQLSTATE: HY000 (ER_WARN_ALLOWED_PACKET_OVERFLOWED)Message: Result of %s() was larger than max_allowed_packet (%ld) - truncated
if ($no==1302){ return mysql_error(); }//Error 1302 SQLSTATE: HY000 (ER_CONFLICTING_DECLARATIONS)Message: Conflicting declarations: '%s%s' and '%s%s'
if ($no==1303){ return mysql_error(); }//Error 1303 SQLSTATE: 2F003 (ER_SP_NO_RECURSIVE_CREATE)Message: Can't create a %s from within another stored routine
if ($no==1304){ return mysql_error(); }//Error 1304 SQLSTATE: 42000 (ER_SP_ALREADY_EXISTS)Message: %s %s already exists
if ($no==1305){ return mysql_error(); }//Error 1305 SQLSTATE: 42000 (ER_SP_DOES_NOT_EXIST)Message: %s %s does not exist
if ($no==1306){ return mysql_error(); }//Error 1306 SQLSTATE: HY000 (ER_SP_DROP_FAILED)Message: Failed to DROP %s %s
if ($no==1307){ return mysql_error(); }//Error 1307 SQLSTATE: HY000 (ER_SP_STORE_FAILED)Message: Failed to CREATE %s %s
if ($no==1308){ return mysql_error(); }//Error 1308 SQLSTATE: 42000 (ER_SP_LILABEL_MISMATCH)Message: %s with no matching label: %s
if ($no==1309){ return mysql_error(); }//Error 1309 SQLSTATE: 42000 (ER_SP_LABEL_REDEFINE)Message: Redefining label %s
if ($no==1310){ return mysql_error(); }//Error 1310 SQLSTATE: 42000 (ER_SP_LABEL_MISMATCH)Message: End-label %s without match
if ($no==1311){ return mysql_error(); }//Error 1311 SQLSTATE: 01000 (ER_SP_UNINIT_VAR)Message: Referring to uninitialized variable %s
if ($no==1312){ return mysql_error(); }//Error 1312 SQLSTATE: 0A000 (ER_SP_BADSELECT)Message: PROCEDURE %s can't return a result set in the given context
if ($no==1313){ return mysql_error(); }//Error 1313 SQLSTATE: 42000 (ER_SP_BADRETURN)Message: RETURN is only allowed in a FUNCTION
if ($no==1314){ return mysql_error(); }//Error 1314 SQLSTATE: 0A000 (ER_SP_BADSTATEMENT)Message: %s is not allowed in stored procedures
if ($no==1315){ return mysql_error(); }//Error 1315 SQLSTATE: 42000 (ER_UPDATE_LOG_DEPRECATED_IGNORED)Message: The update log is deprecated and replaced by the binary log; SET SQL_LOG_UPDATE has been ignored
if ($no==1316){ return mysql_error(); }//Error 1316 SQLSTATE: 42000 (ER_UPDATE_LOG_DEPRECATED_TRANSLATED)Message: The update log is deprecated and replaced by the binary log; SET SQL_LOG_UPDATE has been translated to SET SQL_LOG_BIN
if ($no==1317){ return mysql_error(); }//Error 1317 SQLSTATE: 70100 (ER_QUERY_INTERRUPTED)Message: Query execution was interrupted
if ($no==1318){ return mysql_error(); }//Error 1318 SQLSTATE: 42000 (ER_SP_WRONG_NO_OF_ARGS)Message: Incorrect number of arguments for %s %s; expected %u, got %u
if ($no==1319){ return mysql_error(); }//Error 1319 SQLSTATE: 42000 (ER_SP_COND_MISMATCH)Message: Undefined CONDITION: %s
if ($no==1320){ return mysql_error(); }//Error 1320 SQLSTATE: 42000 (ER_SP_NORETURN)Message: No RETURN found in FUNCTION %s
if ($no==1321){ return mysql_error(); }//Error 1321 SQLSTATE: 2F005 (ER_SP_NORETURNEND)Message: FUNCTION %s ended without RETURN
if ($no==1322){ return mysql_error(); }//Error 1322 SQLSTATE: 42000 (ER_SP_BAD_CURSOR_QUERY)Message: Cursor statement must be a SELECT
if ($no==1323){ return mysql_error(); }//Error 1323 SQLSTATE: 42000 (ER_SP_BAD_CURSOR_SELECT)Message: Cursor SELECT must not have INTO
if ($no==1324){ return mysql_error(); }//Error 1324 SQLSTATE: 42000 (ER_SP_CURSOR_MISMATCH)Message: Undefined CURSOR: %s
if ($no==1325){ return mysql_error(); }//Error 1325 SQLSTATE: 24000 (ER_SP_CURSOR_ALREADY_OPEN)Message: Cursor is already open
if ($no==1326){ return mysql_error(); }//Error 1326 SQLSTATE: 24000 (ER_SP_CURSOR_NOT_OPEN)Message: Cursor is not open
if ($no==1327){ return mysql_error(); }//Error 1327 SQLSTATE: 42000 (ER_SP_UNDECLARED_VAR)Message: Undeclared variable: %s
if ($no==1328){ return mysql_error(); }//Error 1328 SQLSTATE: HY000 (ER_SP_WRONG_NO_OF_FETCH_ARGS)Message: Incorrect number of FETCH variables
if ($no==1329){ return mysql_error(); }//Error 1329 SQLSTATE: 02000 (ER_SP_FETCH_NO_DATA)Message: No data - zero rows fetched, selected, or processed
if ($no==1330){ return mysql_error(); }//Error 1330 SQLSTATE: 42000 (ER_SP_DUP_PARAM)Message: Duplicate parameter: %s
if ($no==1331){ return mysql_error(); }//Error 1331 SQLSTATE: 42000 (ER_SP_DUP_VAR)Message: Duplicate variable: %s
if ($no==1332){ return mysql_error(); }//Error 1332 SQLSTATE: 42000 (ER_SP_DUP_COND)Message: Duplicate condition: %s
if ($no==1333){ return mysql_error(); }//Error 1333 SQLSTATE: 42000 (ER_SP_DUP_CURS)Message: Duplicate cursor: %s
if ($no==1334){ return mysql_error(); }//Error 1334 SQLSTATE: HY000 (ER_SP_CANT_ALTER)Message: Failed to ALTER %s %s
if ($no==1335){ return mysql_error(); }//Error 1335 SQLSTATE: 0A000 (ER_SP_SUBSELECT_NYI)Message: Subselect value not supported
if ($no==1336){ return mysql_error(); }//Error 1336 SQLSTATE: 0A000 (ER_STMT_NOT_ALLOWED_IN_SF_OR_TRG)Message: %s is not allowed in stored function or trigger
if ($no==1337){ return mysql_error(); }//Error 1337 SQLSTATE: 42000 (ER_SP_VARCOND_AFTER_CURSHNDLR)Message: Variable or condition declaration after cursor or handler declaration
if ($no==1338){ return mysql_error(); }//Error 1338 SQLSTATE: 42000 (ER_SP_CURSOR_AFTER_HANDLER)Message: Cursor declaration after handler declaration
if ($no==1339){ return mysql_error(); }//Error 1339 SQLSTATE: 20000 (ER_SP_CASE_NOT_FOUND)Message: Case not found for CASE statement
if ($no==1340){ return mysql_error(); }//Error 1340 SQLSTATE: HY000 (ER_FPARSER_TOO_BIG_FILE)Message: Configuration file '%s' is too big
if ($no==1341){ return mysql_error(); }//Error 1341 SQLSTATE: HY000 (ER_FPARSER_BAD_HEADER)Message: Malformed file type header in file '%s'
if ($no==1342){ return mysql_error(); }//Error 1342 SQLSTATE: HY000 (ER_FPARSER_EOF_IN_COMMENT)Message: Unexpected end of file while parsing comment '%s'
if ($no==1343){ return mysql_error(); }//Error 1343 SQLSTATE: HY000 (ER_FPARSER_ERROR_IN_PARAMETER)Message: Error while parsing parameter '%s' (line: '%s')
if ($no==1344){ return mysql_error(); }//Error 1344 SQLSTATE: HY000 (ER_FPARSER_EOF_IN_UNKNOWN_PARAMETER)Message: Unexpected end of file while skipping unknown parameter '%s'
if ($no==1345){ return mysql_error(); }//Error 1345 SQLSTATE: HY000 (ER_VIEW_NO_EXPLAIN)Message: EXPLAIN/SHOW can not be issued; lacking privileges for underlying table
if ($no==1346){ return mysql_error(); }//Error 1346 SQLSTATE: HY000 (ER_FRM_UNKNOWN_TYPE)Message: File '%s' has unknown type '%s' in its header
if ($no==1347){ return mysql_error(); }//Error 1347 SQLSTATE: HY000 (ER_WRONG_OBJECT)Message: '%s.%s' is not %s
if ($no==1348){ return mysql_error(); }//Error 1348 SQLSTATE: HY000 (ER_NONUPDATEABLE_COLUMN)Message: Column '%s' is not updatable
if ($no==1349){ return mysql_error(); }//Error 1349 SQLSTATE: HY000 (ER_VIEW_SELECT_DERIVED)Message: View's SELECT contains a subquery in the FROM clause
if ($no==1350){ return mysql_error(); }//Error 1350 SQLSTATE: HY000 (ER_VIEW_SELECT_CLAUSE)Message: View's SELECT contains a '%s' clause
if ($no==1351){ return mysql_error(); }//Error 1351 SQLSTATE: HY000 (ER_VIEW_SELECT_VARIABLE)Message: View's SELECT contains a variable or parameter
if ($no==1352){ return mysql_error(); }//Error 1352 SQLSTATE: HY000 (ER_VIEW_SELECT_TMPTABLE)Message: View's SELECT refers to a temporary table '%s'
if ($no==1353){ return mysql_error(); }//Error 1353 SQLSTATE: HY000 (ER_VIEW_WRONG_LIST)Message: View's SELECT and view's field list have different column counts
if ($no==1354){ return mysql_error(); }//Error 1354 SQLSTATE: HY000 (ER_WARN_VIEW_MERGE)Message: View merge algorithm can't be used here for now (assumed undefined algorithm)
if ($no==1355){ return mysql_error(); }//Error 1355 SQLSTATE: HY000 (ER_WARN_VIEW_WITHOUT_KEY)Message: View being updated does not have complete key of underlying table in it
if ($no==1356){ return mysql_error(); }//Error 1356 SQLSTATE: HY000 (ER_VIEW_INVALID)Message: View '%s.%s' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them
if ($no==1357){ return mysql_error(); }//Error 1357 SQLSTATE: HY000 (ER_SP_NO_DROP_SP)Message: Can't drop or alter a %s from within another stored routine
if ($no==1358){ return mysql_error(); }//Error 1358 SQLSTATE: HY000 (ER_SP_GOTO_IN_HNDLR)Message: GOTO is not allowed in a stored procedure handler
if ($no==1359){ return mysql_error(); }//Error 1359 SQLSTATE: HY000 (ER_TRG_ALREADY_EXISTS)Message: Trigger already exists
if ($no==1360){ return mysql_error(); }//Error 1360 SQLSTATE: HY000 (ER_TRG_DOES_NOT_EXIST)Message: Trigger does not exist
if ($no==1361){ return mysql_error(); }//Error 1361 SQLSTATE: HY000 (ER_TRG_ON_VIEW_OR_TEMP_TABLE)Message: Trigger's '%s' is view or temporary table
if ($no==1362){ return mysql_error(); }//Error 1362 SQLSTATE: HY000 (ER_TRG_CANT_CHANGE_ROW)Message: Updating of %s row is not allowed in %strigger
if ($no==1363){ return mysql_error(); }//Error 1363 SQLSTATE: HY000 (ER_TRG_NO_SUCH_ROW_IN_TRG)Message: There is no %s row in %s trigger
if ($no==1364){ return mysql_error(); }//Error 1364 SQLSTATE: HY000 (ER_NO_DEFAULT_FOR_FIELD)Message: Field '%s' doesn't have a default value
if ($no==1365){ return mysql_error(); }//Error 1365 SQLSTATE: 22012 (ER_DIVISION_BY_ZERO)Message: Division by 0
if ($no==1366){ return mysql_error(); }//Error 1366 SQLSTATE: HY000 (ER_TRUNCATED_WRONG_VALUE_FOR_FIELD)Message: Incorrect %s value: '%s' for column '%s' at row %ld
if ($no==1367){ return mysql_error(); }//Error 1367 SQLSTATE: 22007 (ER_ILLEGAL_VALUE_FOR_TYPE)Message: Illegal %s '%s' value found during parsing
if ($no==1368){ return mysql_error(); }//Error 1368 SQLSTATE: HY000 (ER_VIEW_NONUPD_CHECK)Message: CHECK OPTION on non-updatable view '%s.%s'
if ($no==1369){ return mysql_error(); }//Error 1369 SQLSTATE: HY000 (ER_VIEW_CHECK_FAILED)Message: CHECK OPTION failed '%s.%s'
if ($no==1370){ return mysql_error(); }//Error 1370 SQLSTATE: 42000 (ER_PROCACCESS_DENIED_ERROR)Message: %s command denied to user '%s'@'%s' for routine '%s'
if ($no==1371){ return mysql_error(); }//Error 1371 SQLSTATE: HY000 (ER_RELAY_LOG_FAIL)Message: Failed purging old relay logs: %s
if ($no==1372){ return mysql_error(); }//Error 1372 SQLSTATE: HY000 (ER_PASSWD_LENGTH)Message: Password hash should be a %d-digit hexadecimal number
if ($no==1373){ return mysql_error(); }//Error 1373 SQLSTATE: HY000 (ER_UNKNOWN_TARGET_BINLOG)Message: Target log not found in binlog index
if ($no==1374){ return mysql_error(); }//Error 1374 SQLSTATE: HY000 (ER_IO_ERR_LOG_INDEX_READ)Message: I/O error reading log index file
if ($no==1375){ return mysql_error(); }//Error 1375 SQLSTATE: HY000 (ER_BINLOG_PURGE_PROHIBITED)Message: Server configuration does not permit binlog purge
if ($no==1376){ return mysql_error(); }//Error 1376 SQLSTATE: HY000 (ER_FSEEK_FAIL)Message: Failed on fseek()
if ($no==1377){ return mysql_error(); }//Error 1377 SQLSTATE: HY000 (ER_BINLOG_PURGE_FATAL_ERR)Message: Fatal error during log purge
if ($no==1378){ return mysql_error(); }//Error 1378 SQLSTATE: HY000 (ER_LOG_IN_USE)Message: A purgeable log is in use, will not purge
if ($no==1379){ return mysql_error(); }//Error 1379 SQLSTATE: HY000 (ER_LOG_PURGE_UNKNOWN_ERR)Message: Unknown error during log purge
if ($no==1380){ return mysql_error(); }//Error 1380 SQLSTATE: HY000 (ER_RELAY_LOG_INIT)Message: Failed initializing relay log position: %s
if ($no==1381){ return mysql_error(); }//Error 1381 SQLSTATE: HY000 (ER_NO_BINARY_LOGGING)Message: You are not using binary logging
if ($no==1382){ return mysql_error(); }//Error 1382 SQLSTATE: HY000 (ER_RESERVED_SYNTAX)Message: The '%s' syntax is reserved for purposes internal to the MySQL server
if ($no==1383){ return mysql_error(); }//Error 1383 SQLSTATE: HY000 (ER_WSAS_FAILED)Message: WSAStartup Failed
if ($no==1384){ return mysql_error(); }//Error 1384 SQLSTATE: HY000 (ER_DIFF_GROUPS_PROC)Message: Can't handle procedures with different groups yet
if ($no==1385){ return mysql_error(); }//Error 1385 SQLSTATE: HY000 (ER_NO_GROUP_FOR_PROC)Message: Select must have a group with this procedure
if ($no==1386){ return mysql_error(); }//Error 1386 SQLSTATE: HY000 (ER_ORDER_WITH_PROC)Message: Can't use ORDER clause with this procedure
if ($no==1387){ return mysql_error(); }//Error 1387 SQLSTATE: HY000 (ER_LOGGING_PROHIBIT_CHANGING_OF)Message: Binary logging and replication forbid changing the global server %s
if ($no==1388){ return mysql_error(); }//Error 1388 SQLSTATE: HY000 (ER_NO_FILE_MAPPING)Message: Can't map file: %s, errno: %d
if ($no==1389){ return mysql_error(); }//Error 1389 SQLSTATE: HY000 (ER_WRONG_MAGIC)Message: Wrong magic in %s
if ($no==1390){ return mysql_error(); }//Error 1390 SQLSTATE: HY000 (ER_PS_MANY_PARAM)Message: Prepared statement contains too many placeholders
if ($no==1391){ return mysql_error(); }//Error 1391 SQLSTATE: HY000 (ER_KEY_PART_0)Message: Key part '%s' length cannot be 0
if ($no==1392){ return mysql_error(); }//Error 1392 SQLSTATE: HY000 (ER_VIEW_CHECKSUM)Message: View text checksum failed
if ($no==1393){ return mysql_error(); }//Error 1393 SQLSTATE: HY000 (ER_VIEW_MULTIUPDATE)Message: Can not modify more than one base table through a join view '%s.%s'
if ($no==1394){ return mysql_error(); }//Error 1394 SQLSTATE: HY000 (ER_VIEW_NO_INSERT_FIELD_LIST)Message: Can not insert into join view '%s.%s' without fields list
if ($no==1395){ return mysql_error(); }//Error 1395 SQLSTATE: HY000 (ER_VIEW_DELETE_MERGE_VIEW)Message: Can not delete from join view '%s.%s'
if ($no==1396){ return mysql_error(); }//Error 1396 SQLSTATE: HY000 (ER_CANNOT_USER)Message: Operation %s failed for %s
if ($no==1397){ return mysql_error(); }//Error 1397 SQLSTATE: XAE04 (ER_XAER_NOTA)Message: XAER_NOTA: Unknown XID
if ($no==1398){ return mysql_error(); }//Error 1398 SQLSTATE: XAE05 (ER_XAER_INVAL)Message: XAER_INVAL: Invalid arguments (or unsupported command)
if ($no==1399){ return mysql_error(); }//Error 1399 SQLSTATE: XAE07 (ER_XAER_RMFAIL)Message: XAER_RMFAIL: The command cannot be executed when global transaction is in the %s state
if ($no==1400){ return mysql_error(); }//Error 1400 SQLSTATE: XAE09 (ER_XAER_OUTSIDE)Message: XAER_OUTSIDE: Some work is done outside global transaction
if ($no==1401){ return mysql_error(); }//Error 1401 SQLSTATE: XAE03 (ER_XAER_RMERR)Message: XAER_RMERR: Fatal error occurred in the transaction branch - check your data for consistency
if ($no==1402){ return mysql_error(); }//Error 1402 SQLSTATE: XA100 (ER_XA_RBROLLBACK)Message: XA_RBROLLBACK: Transaction branch was rolled back
if ($no==1403){ return mysql_error(); }//Error 1403 SQLSTATE: 42000 (ER_NONEXISTING_PROC_GRANT)Message: There is no such grant defined for user '%s' on host '%s' on routine '%s'
if ($no==1404){ return mysql_error(); }//Error 1404 SQLSTATE: HY000 (ER_PROC_AUTO_GRANT_FAIL)Message: Failed to grant EXECUTE and ALTER ROUTINE privileges
if ($no==1405){ return mysql_error(); }//Error 1405 SQLSTATE: HY000 (ER_PROC_AUTO_REVOKE_FAIL)Message: Failed to revoke all privileges to dropped routine
if ($no==1406){ return mysql_error(); }//Error 1406 SQLSTATE: 22001 (ER_DATA_TOO_LONG)Message: Data too long for column '%s' at row %ld
if ($no==1407){ return mysql_error(); }//Error 1407 SQLSTATE: 42000 (ER_SP_BAD_SQLSTATE)Message: Bad SQLSTATE: '%s'
if ($no==1408){ return mysql_error(); }//Error 1408 SQLSTATE: HY000 (ER_STARTUP)Message: %s: ready for connections. Version: '%s' socket: '%s' port: %d %s
if ($no==1409){ return mysql_error(); }//Error 1409 SQLSTATE: HY000 (ER_LOAD_FROM_FIXED_SIZE_ROWS_TO_VAR)Message: Can't load value from file with fixed size rows to variable
if ($no==1410){ return mysql_error(); }//Error 1410 SQLSTATE: 42000 (ER_CANT_CREATE_USER_WITH_GRANT)Message: You are not allowed to create a user with GRANT
if ($no==1411){ return mysql_error(); }//Error 1411 SQLSTATE: HY000 (ER_WRONG_VALUE_FOR_TYPE)Message: Incorrect %s value: '%s' for function %s
if ($no==1412){ return mysql_error(); }//Error 1412 SQLSTATE: HY000 (ER_TABLE_DEF_CHANGED)Message: Table definition has changed, please retry transaction
if ($no==1413){ return mysql_error(); }//Error 1413 SQLSTATE: 42000 (ER_SP_DUP_HANDLER)Message: Duplicate handler declared in the same block
if ($no==1414){ return mysql_error(); }//Error 1414 SQLSTATE: 42000 (ER_SP_NOT_VAR_ARG)Message: OUT or INOUT argument %d for routine %s is not a variable or NEW pseudo-variable in BEFORE trigger
if ($no==1415){ return mysql_error(); }//Error 1415 SQLSTATE: 0A000 (ER_SP_NO_RETSET)Message: Not allowed to return a result set from a %s
if ($no==1416){ return mysql_error(); }//Error 1416 SQLSTATE: 22003 (ER_CANT_CREATE_GEOMETRY_OBJECT)Message: Cannot get geometry object from data you send to the GEOMETRY field
if ($no==1417){ return mysql_error(); }//Error 1417 SQLSTATE: HY000 (ER_FAILED_ROUTINE_BREAK_BINLOG)Message: A routine failed and has neither NO SQL nor READS SQL DATA in its declaration and binary logging is enabled; if non-transactional tables were updated, the binary log will miss their changes
if ($no==1418){ return mysql_error(); }//Error 1418 SQLSTATE: HY000 (ER_BINLOG_UNSAFE_ROUTINE)Message: This function has none of DETERMINISTIC, NO SQL, or READS SQL DATA in its declaration and binary logging is enabled (you *might* want to use the less safe log_bin_trust_function_creators variable)
if ($no==1419){ return mysql_error(); }//Error 1419 SQLSTATE: HY000 (ER_BINLOG_CREATE_ROUTINE_NEED_SUPER)Message: You do not have the SUPER privilege and binary logging is enabled (you *might* want to use the less safe log_bin_trust_function_creators variable)
if ($no==1420){ return mysql_error(); }//Error 1420 SQLSTATE: HY000 (ER_EXEC_STMT_WITH_OPEN_CURSOR)Message: You can't execute a prepared statement which has an open cursor associated with it. Reset the statement to re-execute it.
if ($no==1421){ return mysql_error(); }//Error 1421 SQLSTATE: HY000 (ER_STMT_HAS_NO_OPEN_CURSOR)Message: The statement (%lu) has no open cursor.
if ($no==1422){ return mysql_error(); }//Error 1422 SQLSTATE: HY000 (ER_COMMIT_NOT_ALLOWED_IN_SF_OR_TRG)Message: Explicit or implicit commit is not allowed in stored function or trigger.
if ($no==1423){ return mysql_error(); }//Error 1423 SQLSTATE: HY000 (ER_NO_DEFAULT_FOR_VIEW_FIELD)Message: Field of view '%s.%s' underlying table doesn't have a default value
if ($no==1424){ return mysql_error(); }//Error 1424 SQLSTATE: HY000 (ER_SP_NO_RECURSION)Message: Recursive stored functions and triggers are not allowed.
if ($no==1425){ return mysql_error(); }//Error 1425 SQLSTATE: 42000 (ER_TOO_BIG_SCALE)Message: Too big scale %lu specified for column '%s'. Maximum is %d.
if ($no==1426){ return mysql_error(); }//Error 1426 SQLSTATE: 42000 (ER_TOO_BIG_PRECISION)Message: Too big precision %lu specified for column '%s'. Maximum is %lu.
if ($no==1427){ return mysql_error(); }//Error 1427 SQLSTATE: 42000 (ER_M_BIGGER_THAN_D)Message: For float(M,D), double(M,D) or decimal(M,D), M must be >= D (column '%s').
if ($no==1428){ return mysql_error(); }//Error 1428 SQLSTATE: HY000 (ER_WRONG_LOCK_OF_SYSTEM_TABLE)Message: You can't combine write-locking of system '%s.%s' table with other tables
if ($no==1429){ return mysql_error(); }//Error 1429 SQLSTATE: HY000 (ER_CONNECT_TO_FOREIGN_DATA_SOURCE)Message: Unable to connect to foreign data source: %s
if ($no==1430){ return mysql_error(); }//Error 1430 SQLSTATE: HY000 (ER_QUERY_ON_FOREIGN_DATA_SOURCE)Message: There was a problem processing the query on the foreign data source. Data source error: %s
if ($no==1431){ return mysql_error(); }//Error 1431 SQLSTATE: HY000 (ER_FOREIGN_DATA_SOURCE_DOESNT_EXIST)Message: The foreign data source you are trying to reference does not exist. Data source error: %s
if ($no==1432){ return mysql_error(); }//Error 1432 SQLSTATE: HY000 (ER_FOREIGN_DATA_STRING_INVALID_CANT_CREATE)Message: Can't create federated table. The data source connection string '%s' is not in the correct format
if ($no==1433){ return mysql_error(); }//Error 1433 SQLSTATE: HY000 (ER_FOREIGN_DATA_STRING_INVALID)Message: The data source connection string '%s' is not in the correct format
if ($no==1434){ return mysql_error(); }//Error 1434 SQLSTATE: HY000 (ER_CANT_CREATE_FEDERATED_TABLE)Message: Can't create federated table. Foreign data src error: %s
if ($no==1435){ return mysql_error(); }//Error 1435 SQLSTATE: HY000 (ER_TRG_IN_WRONG_SCHEMA)Message: Trigger in wrong schema
if ($no==1436){ return mysql_error(); }//Error 1436 SQLSTATE: HY000 (ER_STACK_OVERRUN_NEED_MORE)Message: Thread stack overrun: %ld bytes used of a %ld byte stack, and %ld bytes needed. Use 'mysqld -O thread_stack=#' to specify a bigger stack.
if ($no==1437){ return mysql_error(); }//Error 1437 SQLSTATE: 42000 (ER_TOO_LONG_BODY)Message: Routine body for '%s' is too long
if ($no==1438){ return mysql_error(); }//Error 1438 SQLSTATE: HY000 (ER_WARN_CANT_DROP_DEFAULT_KEYCACHE)Message: Cannot drop default keycache
if ($no==1439){ return mysql_error(); }//Error 1439 SQLSTATE: 42000 (ER_TOO_BIG_DISPLAYWIDTH)Message: Display width out of range for column '%s' (max = %lu)
if ($no==1440){ return mysql_error(); }//Error 1440 SQLSTATE: XAE08 (ER_XAER_DUPID)Message: XAER_DUPID: The XID already exists
if ($no==1441){ return mysql_error(); }//Error 1441 SQLSTATE: 22008 (ER_DATETIME_FUNCTION_OVERFLOW)Message: Datetime function: %s field overflow
if ($no==1442){ return mysql_error(); }//Error 1442 SQLSTATE: HY000 (ER_CANT_UPDATE_USED_TABLE_IN_SF_OR_TRG)Message: Can't update table '%s' in stored function/trigger because it is already used by statement which invoked this stored function/trigger.
if ($no==1443){ return mysql_error(); }//Error 1443 SQLSTATE: HY000 (ER_VIEW_PREVENT_UPDATE)Message: The definition of table '%s' prevents operation %s on table '%s'.
if ($no==1444){ return mysql_error(); }//Error 1444 SQLSTATE: HY000 (ER_PS_NO_RECURSION)Message: The prepared statement contains a stored routine call that refers to that same statement. It's not allowed to execute a prepared statement in such a recursive manner
if ($no==1445){ return mysql_error(); }//Error 1445 SQLSTATE: HY000 (ER_SP_CANT_SET_AUTOCOMMIT)Message: Not allowed to set autocommit from a stored function or trigger
if ($no==1446){ return mysql_error(); }//Error 1446 SQLSTATE: HY000 (ER_MALFORMED_DEFINER)Message: Definer is not fully qualified
if ($no==1447){ return mysql_error(); }//Error 1447 SQLSTATE: HY000 (ER_VIEW_FRM_NO_USER)Message: View '%s'.'%s' has no definer information (old table format). Current user is used as definer. Please recreate the view!
if ($no==1448){ return mysql_error(); }//Error 1448 SQLSTATE: HY000 (ER_VIEW_OTHER_USER)Message: You need the SUPER privilege for creation view with '%s'@'%s' definer
if ($no==1449){ return mysql_error(); }//Error 1449 SQLSTATE: HY000 (ER_NO_SUCH_USER)Message: There is no '%s'@'%s' registered
if ($no==1450){ return mysql_error(); }//Error 1450 SQLSTATE: HY000 (ER_FORBID_SCHEMA_CHANGE)Message: Changing schema from '%s' to '%s' is not allowed.
if ($no==1451){ //Error 1451 SQLSTATE: 23000 (ER_ROW_IS_REFERENCED_2)Message: Cannot delete or update a parent row: a foreign key constraint fails (%s) 
	return "Proses penghapusan gagal. Data sebagai refensi tidak dapat dihapus !!!"; }
if ($no==1452){ return mysql_error(); }//Error 1452 SQLSTATE: 23000 (ER_NO_REFERENCED_ROW_2)Message: Cannot add or update a child row: a foreign key constraint fails (%s)
if ($no==1453){ return mysql_error(); }//Error 1453 SQLSTATE: 42000 (ER_SP_BAD_VAR_SHADOW)Message: Variable '%s' must be quoted with `...`, or renamed
if ($no==1454){ return mysql_error(); }//Error 1454 SQLSTATE: HY000 (ER_TRG_NO_DEFINER)Message: No definer attribute for trigger '%s'.'%s'. The trigger will be activated under the authorization of the invoker, which may have insufficient privileges. Please recreate the trigger.
if ($no==1455){ return mysql_error(); }//Error 1455 SQLSTATE: HY000 (ER_OLD_FILE_FORMAT)Message: '%s' has an old format, you should re-create the '%s' object(s)
if ($no==1456){ return mysql_error(); }//Error 1456 SQLSTATE: HY000 (ER_SP_RECURSION_LIMIT)Message: Recursive limit %d (as set by the max_sp_recursion_depth variable) was exceeded for routine %s
if ($no==1457){ return mysql_error(); }//Error 1457 SQLSTATE: HY000 (ER_SP_PROC_TABLE_CORRUPT)Message: Failed to load routine %s. The table mysql.proc is missing, corrupt, or contains bad data (internal code %d)
if ($no==1458){ return mysql_error(); }//Error 1458 SQLSTATE: 42000 (ER_SP_WRONG_NAME)Message: Incorrect routine name '%s'
if ($no==1459){ return mysql_error(); }//Error 1459 SQLSTATE: HY000 (ER_TABLE_NEEDS_UPGRADE)Message: Table upgrade required. Please do "REPAIR TABLE `%s`" to fix it!
if ($no==1460){ return mysql_error(); }//Error 1460 SQLSTATE: 42000 (ER_SP_NO_AGGREGATE)Message: AGGREGATE is not supported for stored functions
if ($no==1461){ return mysql_error(); }//Error 1461 SQLSTATE: 42000 (ER_MAX_PREPARED_STMT_COUNT_REACHED)Message: Can't create more than max_prepared_stmt_count statements (current value: %lu)
if ($no==1462){ return mysql_error(); }//Error 1462 SQLSTATE: HY000 (ER_VIEW_RECURSIVE)Message: `%s`.`%s` contains view recursion
if ($no==1463){ return mysql_error(); }//Error 1463 SQLSTATE: 42000 (ER_NON_GROUPING_FIELD_USED)Message: non-grouping field '%s' is used in %s clause
if ($no==1464){ return mysql_error(); }//Error 1464 SQLSTATE: HY000 (ER_TABLE_CANT_HANDLE_SPKEYS)Message: The used table type doesn't support SPATIAL indexes
if ($no==1465){ return mysql_error(); }//Error 1465 SQLSTATE: HY000 (ER_NO_TRIGGERS_ON_SYSTEM_SCHEMA)Message: Triggers can not be created on system tables
if ($no==1466){ return mysql_error(); }//Error 1466 SQLSTATE: HY000 (ER_REMOVED_SPACES)Message: Leading spaces are removed from name '%s'
if ($no==1467){ return mysql_error(); }//Error 1467 SQLSTATE: HY000 (ER_AUTOINC_READ_FAILED)Message: Failed to read auto-increment value from storage engine
if ($no==1468){ return mysql_error(); }//Error 1468 SQLSTATE: HY000 (ER_USERNAME)Message: user name
if ($no==1469){ return mysql_error(); }//Error 1469 SQLSTATE: HY000 (ER_HOSTNAME)Message: host name
if ($no==1470){ return mysql_error(); }//Error 1470 SQLSTATE: HY000 (ER_WRONG_STRING_LENGTH)Message: String '%s' is too long for %s (should be no longer than %d)
if ($no==1471){ return mysql_error(); }//Error 1471 SQLSTATE: HY000 (ER_NON_INSERTABLE_TABLE)Message: The target table %s of the %s is not insertable-into
if ($no==1472){ return mysql_error(); }//Error 1472 SQLSTATE: HY000 (ER_ADMIN_WRONG_MRG_TABLE)Message: Table '%s' is differently defined or of non-MyISAM type or doesn't exist
if ($no==1473){ return mysql_error(); }//Error 1473 SQLSTATE: HY000 (ER_TOO_HIGH_LEVEL_OF_NESTING_FOR_SELECT)Message: Too high level of nesting for select
if ($no==1474){ return mysql_error(); }//Error 1474 SQLSTATE: HY000 (ER_NAME_BECOMES_EMPTY)Message: Name '%s' has become ''
if ($no==1475){ return mysql_error(); }//Error 1475 SQLSTATE: HY000 (ER_AMBIGUOUS_FIELD_TERM)Message: First character of the FIELDS TERMINATED string is ambiguous; please use non-optional and non-empty FIELDS ENCLOSED BY
if ($no==1476){ return mysql_error(); }//Error 1476 SQLSTATE: HY000 (ER_LOAD_DATA_INVALID_COLUMN)Message: Invalid column reference (%s) in LOAD DATA
if ($no==1477){ return mysql_error(); }//Error 1477 SQLSTATE: HY000 (ER_LOG_PURGE_NO_FILE)Message: Being purged log %s was not found
if ($no==1478){ return mysql_error(); }//Error 1478 SQLSTATE: XA106 (ER_XA_RBTIMEOUT)Message: XA_RBTIMEOUT: Transaction branch was rolled back: took too long
if ($no==1479){ return mysql_error(); }//Error 1479 SQLSTATE: XA102 (ER_XA_RBDEADLOCK)Message: XA_RBDEADLOCK: Transaction branch was rolled back: deadlock was detected
if ($no==1480){ return mysql_error(); }//Error 1480 SQLSTATE: HY000 (ER_TOO_MANY_CONCURRENT_TRXS)Message: Too many active concurrent transactions
}