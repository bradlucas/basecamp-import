# basecamp-import

This project is an example which shows how you can transfer information into a Basecamp To-do list.

The reason this exists is I was working on a project where the project manager had a huge list inside of a Google Share Doc. We decided to move to Basecamp and needed a way to get that information out of Google and into Basecamp.

The first thing I found was a library that allows you to talk to Basecamp using PHP. It is called basecamp-php-api and is available at:

http://code.google.com/p/basecamp-php-api/

You can download the latest from that location. I've included the files for this example here in the lib directory.

This project is meant only to be an example. It works but doesn't have error checking or fancy command line processing. It is offered in hopes that someone else may find it useful. After I wrote this I was certainly was happy to have it to get things into Basecamp easily.

## Usage

To use the script as is you'll need the following:

1. Your basecamp project url. Something like https://company.basecamphq.com
2. Your basecamp username and password
3. The To-Do list id for the list you want to insert into (Right click on the list name and its the number at the end of the url
4. A csv file with the data you want to insert. For this example, the script reads the first column

Then cd into src and enter the above as parameters to main.php

$ php -e main.php https://company.basecamphq.com USERNAME PASSWORD 15358056 test.csv 






