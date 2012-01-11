#!/bin/bash

# run WWW::Mechanize test
prove tests/*.t || exit 1;

# run client-side JS GUI tests
export DISPLAY=":1.0";
pgrep Xvfb || ( startx -- `which Xvfb` :1 -screen 0 1024x768x24 & ) >> /var/log/Xvfb.log 2>&1;
java -jar /usr/lib/selenium-server-1.0.3/selenium-server.jar -htmlSuite "*firefox" "http://sarabeam.dbhn" $WORKSPACE/tests/test_suite.html $WORKSPACE/results.html || exit 1;
