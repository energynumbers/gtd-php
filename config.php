<?php
include_once('gtd_constants.inc.php');
/*
    Note that for any of these settings, if you wish to set them to blank,
    assign them an empty string, rather than deleting the line from the file:
    e.g.:
    "prefix" => '',
*/

/******************************************/
/**********   REQUIRED SETTINGS    ********/
/******************************************/


/*********  Database Settings ************/

// Database settings are NOT optional.

$config = array(

    //connection information
        "host"                      => 'localhost', //the hostname of your database server
        "db"                        => 'lasql1', //the name of your database
        "prefix"					=> 'gtd9a4_', // the GTD table prefix for your installation (optional)
        "user"                      => 'counter', //username for database access
        "pass"                      => 'retnuoc', //database password
    //database information
        "dbtype"                    => 'mysql',  //database type: currently only mysql is valid.  DO NOT CHANGE!
);

$config["debug"] = 0;
$config["debug"] = _GTD_NOTICE;
#$config["debug"] = _GTD_NOTICE | _GTD_WAIT | _GTD_DEBUG;

/******************************************/
/**********   OPTIONAL SETTINGS    ********/
/******************************************/


/*********  Interface Settings ************/

// The following settings change settings for the user interface.  
// These can be left at their default values, or changed if you have a different preference.

$config["title"]= 'GTD'; // site name (appears at the top of each page)
$config["datemask"] = 'Y-m-d D'; // date format - required
$config["theme"] = 'aps'; //default | menu_sidebar
$config["title_suffix"]	= true; // true | false - add filename to title tag
$config["trimLength"] = 100;     // max visible length of descriptions when listing items
$config["trimLengthInReport"] = 0;     // max visible length of descriptions when reporting children
$config["firstDayOfWeek"] = 1; // 0=Sunday, 1=Monday, ... 6=Saturday
$config['ReportMaxCompleteChildren']=1;  // maximum number of child items of any one type shown in itemReport
$config['useLiveEnhancements']=true; // javascript productivity aids: tested on PC/IE7, PC/Firefox2, Linux/Firefox2, Linux/Epiphany, Linux/Konqueror3

// These are the shortcut settings for menu options.  Add a key for any page or page view in the main menus.
// Note IE only allows 26 access keys (a-z).

$acckey = array(
	"about.php"								=> "", // License
	"achievements.php"						=> "", // Achievements
	"credits.php"							=> "", // Credits
	"donate.php"							=> "", // Donate
	"item.php?type=a"						=> "", // add Action
	"item.php?type=a&amp;nextonly=true"     => "", // add Next Action
	"item.php?type=g"						=> "", // add Goal
	"item.php?type=i"						=> "i", // add Inbox item
	"item.php?type=m"						=> "", // add Value
	"item.php?type=o"						=> "", // add Role
	"item.php?type=p"						=> "p", // add Project
	"item.php?type=p&amp;someday=true"	   	=> "", // add Someday/Maybe
	"item.php?type=r"						=> "", // add Reference
	"item.php?type=v"						=> "", // add Vision
	"item.php?type=w"						=> "", // add Waiting On
	"listItems.php?quickfind"				=> "f", // quick find
	"listItems.php?type=a"					=> "", // Actions
	"listItems.php?type=a&amp;nextonly=true"=> "a", // Next Actions
	"listItems.php?type=a&tickler=true"		=> "", // Tickler File
	"listItems.php?type=g"					=> "", // Goals
	"listItems.php?type=i"					=> "", // Inbox
	"listItems.php?type=m"					=> "", // Values
	"listItems.php?type=o"					=> "", // Roles
	"listItems.php?type=p"					=> "v", // Projects
	"listItems.php?type=p&someday=true"		=> "m", // Someday/Maybes
	"listItems.php?type=r"					=> "", // References
	"listItems.php?type=v"					=> "", // Visions
	"listItems.php?type=w"					=> "w", // Waiting On
	"listItems.php?type=C"					=> "c", // Checklists
	"listItems.php?type=L"					=> "l", // Lists
	"orphans.php"							=> "", // Orphaned Items
	"preferences.php"						=> "", // User Preferences
	"reportContext.php"						=> "x", // Space Contexts
	"index.php"        						=> "s", // Summary
	"weekly.php"							=> "r" // Weekly Review
);


/*********  Behavior Settings ************/

// The following settings change how the interface behaves.  
// These can be left at their default values, or changed if you have a different preference.

$config["contextsummary"] = 'all';  //all | nextaction (Show all actions on context report, or nextactions only?)
$config["nextaction"] = 'multiple'; //single | multiple (Allow single or multiple nextactions per project)
$config["afterCreate"]	= array (  // parent | item | list | another - default view after creating an item
			'i'		=>	'another', // inbox preference
			'a'		=>	'parent', // action preference
			'w'		=>	'parent', // waiting-on preference
			'r'		=>	'parent', // reference preference
			'p'		=>	'child', // project preference
			'm'		=>	'item', // value preference
			'v'		=>	'item', // vision preference
			'o'		=>	'item', // role preference
			'g'		=>	'list', // goal preference
			'C'		=>	'child', // checklist preference
			'L'		=>	'child', // list preference
			'T'		=>	'another' // (check)list item preference
	    );

// uses initials as above; so o=role, m=value, etc., each in single quotes, separated by commas
$config['suppressAsOrphans']="'i','m'"; // ,'v','o','g','p'";

/*********  Customize Weekly Review  ************/
$config['reviewProjectsWithoutOutcomes']=true; // false | true - list projects which have no outcome
$config['show7']=false; // false | true - show the Seven Habits of Highly Effective People and Sharpening the Saw in Weekly Review

// Entirely optional: add custom items to the weekly review.  
// Uncomment to use, add more fields to the array for more lines.

/*
$custom_review = array(
	"Play the Lottery" => "Before Saturday's drawing!",
	"Pay Allowances" => "I want the kids to let me move in after I retire.",
	"Check my Oil" => "Check the oil in the car.",
	"Send Update" => "Send Weekly Update to Tom"
);
*/


/*********  Advanced Settings  ************/

//A bit too complicated for the average admin.  Will be simplified in a later release.

//Default sort order for each query.  The sort order can be overridden within each page.

$sort = array(
    "spacecontextselectbox" => "cn.`name` ASC",
    "categoryselectbox"     => "c.`category` ASC",
    "checklistselectbox"    => "cl.`title` ASC",
    "listselectbox"         => "l.`title` ASC",
    "parentselectbox"       => "i.`title` ASC",
    "timecontextselectbox"  => "ti.`timeframe` DESC",
    "getlistitems"          => "li.`item` ASC",
    "getitemsandparent"     => "DATEDIFF(CURDATE(),dateCompleted) ASC, DATEDIFF(CURDATE(),deadline) DESC, type ASC, ptitle ASC, title ASC",
    "getorphaneditems"      => "`type` ASC, i.`title` ASC",
    "selectchecklist"       => "cl.`title` ASC",
    "getchecklists"         => "c.`category` ASC",
    "getlists"              => "c.`category` ASC",
    "getchecklistitems"     => "`checked` DESC, `item` ASC",
    "getchildren"           => "its.`dateCompleted` DESC, ia.`deadline` DESC, i.`title` ASC",
    "getitems"              => "i.`title` ASC"
);

$config["storeRecurrences"] = true; // false | true - when recurring items are completed, store each occurrence as a completed item
$config['useTypesForTimeContexts'] = false; // false | true - Time Contexts will be bound to a particular type
$config['separator'] = '^&*#@#%&*%^@$^*$$&%#@#@^^'; // should be an arbitrary string that you'll never use in titles of items; used to separate titles in mysql queries
$config['forceAllFields'] = false; // false | true - all fields will always be displayed on item.php
$config['allowChangingTypes'] = false; // false | true - allows the user to change the types of any item (false=change only inbox items)
$config['showAdmin'] = true; // false | true - adds the Admin option to the menu items
$config['charset'] = 'ISO8859-15'; // the character-encoding for pages
$config['withholdVersionInfo']=false; // true | false - if false, will send the version numbers of your installations of gtd-php, PHP and MySQL when you report a bug
$config['radioButtonsForNextPage']=false; // false | true - uses radio buttons when true, and submit buttons when false, to allow user to select next page afterr editing an item
$config['allowCustomRecurrences']=true;

$config['events']=$config['addons']=array();

$config['addons']['achievements']=array(
        "link"=>"addons/achievements/achievements.php",
        'title'=>"Notable Achievements", 'label' => "Achievements",
        'where'=>'listItems.php?type=*&amp;tickler=true&amp;liveparents=*','when'=>'after',
        'options'=>array('jpgraphdir'=>'../jpgraph/'));

$config['addons']['booklet']=array(
        "link"=>"addons/actionBooklet/actionBooklet.php",
        'title'=>"Booklet of next actions", 'label' => "NA Booklet",
        'where'=>'reportContext.php','when'=>'after',
        'options'=>array('fpdf'=>'../fpdf/')
        );

$config['events'][_GTD_ON_HEADER]['*'][]="addons/ajax/insertjs.inc.php";
/*********  Developer Settings ************/

/* The debug value is generally for the developers of the application.  You will probably want this to remain 0
Values: (use "|" to combine, "&" to test)
            0 - no debugging output
_GTD_DEBUG    - display debugging text (there will be lots of it - use debugKey to toggle its display)
_GTD_FREEZEDB - do not execute commands which would otherwise update the items table: use in conjunction with _GTD_DEBUG to display sql commands without running them
_GTD_NOTICE   - force the display of PHP notices
_GTD_WAIT     - pause after updating an item, to allow user to view processing screen
*/
$config["debugKey"] = 'H'; // the key that will toggle the display of debug text - a letter here must typed in upper case.

// php closing tag has been omitted deliberately, to avoid unwanted blank lines being sent to the browser