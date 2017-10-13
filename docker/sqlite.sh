#!/bin/sh

cp sqlite.env .env
cp sqlite.env.testing .env.testing

if [ ! -f /var/www/monica/storage/app/public/monica.db ]; then
	touch /var/www/monica/storage/app/public/monica.db
fi

if [ ! -f /var/www/monica/storage/app/public/monica_testing.db ]; then
	touch /var/www/monica/storage/app/public/monica_testing.db
fi

ARTISAN="php /var/www/monica/artisan"

${ARTISAN} key:generate
${ARTISAN} migrate --force
${ARTISAN} migrate --force --database=testing
${ARTISAN} storage:link
${ARTISAN} db:seed --class ActivityTypesTableSeeder
${ARTISAN} db:seed --class ActivityTypesTableSeeder --database=testing
${ARTISAN} db:seed --class CountriesSeederTable
${ARTISAN} db:seed --class CountriesSeederTable --database=testing

/bin/sh
