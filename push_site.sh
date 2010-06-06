#!/bin/bash

rsync -rltDv $1 *           \
--delete                    \
--omit-dir-times            \
--exclude=*.sh              \
--exclude=.git              \
--exclude=.                 \
--exclude=README            \
danbeamo@danbeam.org:public_html/sarabeam/
