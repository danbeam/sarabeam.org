#!/usr/bin/env perl

use strict;

use Test::More tests => 9;
use Test::WWW::Mechanize;

my $base_url = 'http://sarabeam.org/';

my $forbiddens = [
    '/.git/',
    '/.git/config',
    '/.git/hooks/',
    '/.git/hooks/pre-commit',
    '/.git/hooks/pre-commit.sample',
    '/push_site.sh',
    '/pull_site.sh',
    '/README',
];

my $mech = Test::WWW::Mechanize->new();

$mech->get_ok( $base_url );

# forbiddens
for my $url ( @{$forbiddens} ) {
    $mech->get( $base_url . $url );
    is( $mech->status(), 403, "Making sure $url is forbidden" );
}
