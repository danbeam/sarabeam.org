#!/bin/bash

rsync $1 -azv danbeamo@danbeam.org:public_html/sarabeam/ .
