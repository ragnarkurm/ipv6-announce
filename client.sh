#!/bin/sh

# This script identifies FQDN and
# host IPv6 (expects teredo running).
# Then reports combination to server.
# Remember to put it to cron.
# Remember to configure your web script URL.

url="http://www.example.com/server.php"

export PATH=/bin:/sbin:/usr/bin:/usr/sbin

ipv6=`egrep '^2001.* teredo$' /proc/net/if_inet6 | cut -d ' ' -f 1`
if [ -z "$ipv6" ]; then
	echo "Unable to identify IPv6 address."
	exit
fi
ipv6=`echo "$ipv6" | sed -e 's/\(....\)/\1:/g' -e 's/:$//'`

fqdn=`hostname --fqdn`
if [ -z "$fqdn" ]; then
	echo "Unable to identify FQDN."
	exit
fi

curl \
	--data-urlencode "fqdn=$fqdn" \
	--data-urlencode "ipv6=$ipv6" \
	"$url"
