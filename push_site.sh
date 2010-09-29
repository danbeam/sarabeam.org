#!/bin/bash

rsync -rltDvn $1 *          \
--delete                    \
--omit-dir-times            \
--exclude=*.sh              \
--exclude=.git              \
--exclude=.                 \
--exclude=tests/            \
--exclude=README            \
danbeamo@host240.hostmonster.org:public_html/sarabeam/
