This pair of scripts are intended to keep fresh memory of fqdn and dynamic ipv6
in order to be able to ssh into any dynamic ipv6 box behind nats and firewalls.

On client side the script is run periodically by cron to report fqdn and ipv6 to server.
On server side the script collects pairs and stores to files.
File name fqdn, file content is ipv6.

Suppose you have alias named 'ipv6', then you coud do following:
ssh username@`ipv6 www.example.com`
and domain will be automatically translated into ipv6.
