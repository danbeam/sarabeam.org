#!/bin/bash

# run WWW::Mechanize test
prove tests/*.t || exit 1;

# run client-side JS GUI tests
export DISPLAY=":1.0";
pidof Xvfb || ( Xvfb :1 -ac -extension GLX & ) >> /var/log/xvfb.log 2>&1;
java -jar /usr/lib/selenium-server-1.0.3/selenium-server.jar -htmlSuite "*firefox" "http://sarabeam.org" $WORKSPACE/tests/test_suite.html $WORKSPACE/results.html || exit 1;
