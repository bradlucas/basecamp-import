<?php
require_once ('../lib/Basecamp.class.php');
require_once ('../lib/RestRequest.class.php');

/**
 * For this example to work you'll need to figure out a few things.
 * 
 * First, you'll need a spreadsheet which your to-do items in it. In this example
 * my spreadsheet has two columns, one of which is the priority and the other is the task.
 * If this doesn't work for you you'll need to modify the 'processFile' function below.
 * 
 * Next, you'll need to get your Basecamp login information together. You'll need
 * your username and password.
 * 
 * Lastly, you'll need to create or pick a To-do list from your project and figure out the 
 * IDs needed to programatically insert into it.
 * 
 * You need two ids. The first is your project ID and the second is your To-do list ID. The
 * easiest way to do this is to right-click on the To-do list and Copy link and paste it 
 * into an editor so you can examine it.
 * 
 * For example, I have a test list with the following url:
 * 
 * https://beaconhill.basecamphq.com/projects/6046393-web-site/todo_lists/15358056
 * 
 * The first number after projects is your project ID. The last number after todo_lists is your
 * To-do list ID.
 * 
 * Require information
 * - baseurl                        https://beaconhill.basecamphq.com
 * - username
 * - password
 * - todo_list_id                   15358056
 * - complete path to cvs file
 * 
 * 
 * 
 */


/**
 * This function expects a complete path to a CSV file. It will read this file
 * and return and array of values which consists of the first column data values
 * 
 */
function processFile ($filename) {
    $rtn = array();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rtn[] = $data[0];
        }
    }
    return $rtn;
}


/**
 * This function processes the list of values and inserts them into the
 * To-Do list identified by $todo_list_id
 */
function processData ($bc, $todo_list_id, $values) {
    foreach ($values as $data) {
      $bc->createTodoItemForList( (int) $todo_list_id, $data);
    }
}

/**
 * Creates an instance of Basecamp using your project's baseurl and 
 * your username and password
 */
function getInstance ($baseurl, $username, $password) {
    $bc = new Basecamp($baseurl, $username, $password);
    return $bc;
}

/** 
 * Simple usage help used if we don't see all the parameters
 */
function usage() {
  print "Usage:\n";
  print "\tphp -e main.php baseurl username password todo_list_id filename\n\n";
}

if ($argc != 6) {
  usage();
  exit();
}


$baseurl = $argv[1];
$username = $argv[2];
$password = $argv[3];
$todo_list_id = $argv[4];
$filename = $argv[5];

print "Create To-do items...\n";
$bc = getInstance($baseurl, $username, $password);

$values = processFile($filename);

processData($bc, $todo_list_id, $values);

print "Done\n\n";


