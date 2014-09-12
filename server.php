<?php

# This web script collects FQDN and IPv6
# and writes down to specified dir.
# Filename is FQDN and contents is IPv6.

# fullpath
# outside web-space
# make sure web can access and save there
# ls -lat  -- to sort by time
# tail *  -- to see contents of all files
# find . -mtime +1  -- find hosts that were last seen more than 1 day ago
$db = '/tmp/db';

$fqdn = $_POST['fqdn'];
$ipv6 = $_POST['ipv6'];

$fqdn = strtolower($fqdn);
$rx = '/^[a-z0-9.-]{3,255}$/';
if (!preg_match($rx, $fqdn)) {
  print "Invalid FQDN ($fqdn). Expected to match regex: $rx\n";
  exit;
}

$ipv6 = strtolower($ipv6);
$rx = '/^[a-f0-9:]{3,39}$/';
if (!preg_match($rx, $ipv6)) {
  print "Invalid IPv6 ($ipv6). Expected to match regex: $rx\n";
  exit;
}

$filename = "$db/$fqdn";
$f = fopen($filename, 'w');
if (empty($f)) {
  $error = error_get_last();
  $error = $error['message'];
  print "$error\n";
  exit;
}

fwrite($f, $ipv6);
fclose($f);
