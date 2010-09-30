#!/bin/bash

rsync -rltDv $1 .           \
--delete                    \
--omit-dir-times            \
--exclude=*.sh              \
--exclude=.git/             \
--exclude=.gitignore        \
--exclude=.                 \
--exclude=tests/            \
--exclude=results.html      \
--exclude=README            \
--exclude=dns_check         \
danbeamo@host240.hostmonster.com:public_html/sarabeam/
