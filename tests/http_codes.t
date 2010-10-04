#!/usr/bin/env perl

use strict;

use Test::More tests => 13;
use Test::WWW::Mechanize;

my $base_url = 'http://sarabeam.org';

my $forbiddens = [
    $base_url . '/.git/',
    $base_url . '/.git/config',
    $base_url . '/.git/hooks/',
    $base_url . '/.git/hooks/pre-commit',
    $base_url . '/.git/hooks/pre-commit.sample',
    $base_url . '/push_site.sh',
    $base_url . '/pull_site.sh',
    $base_url . '/README',
];

my $mech = Test::WWW::Mechanize->new();

# check the basics
$mech->get_ok($base_url, 'Checking if page loads');
$mech->title_is('sarabeam.org', 'Checking title of page');
#$mech->links_ok('Checking all links');

# check for jQuery, make sure it's alive
$mech->content_like(qr{<script(?:[^>]+)src=(?:['"]?)http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js(?:['"]?)(?:[^>]*)></script>});
$mech->content_like(qr{<link(?:[^>]+)href=(?:['"]?)default.css(?:['"]?)(?:[^>]*)>});

# make sure both jQuery and stylesheet are still alive
$mech->head_ok('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
$mech->head_ok($base_url . '/default.css');

# look for images with no alts
ok(!$mech->find_image(alt => ''), 'No images with blank alts');
ok(!$mech->find_image(alt => undef), 'No images without alts');# forbidden URLs

# make sure private pages are Forbidden
$mech->link_status_is($forbiddens, 403, "Making sure private URLS are forbidden");
