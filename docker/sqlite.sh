#!/bin/sh

cp sqlite.env .env
if [ ! -f /var/www/monica/storage/app/public/monica.db ]; then
	touch /var/www/monica/storage/app/public/monica.db
fi
/bin/sh
