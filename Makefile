create-migration:
	php artisan make:migration $(name) --path=/database/migrations

migrate:
	php artisan migrate --path=/database/migrations

update-seed:
	composer dumpautoload
	php artisan db:seed --class=$(name)

example:
	make create-migration name=apa
	make migrate
	make rollback
	make update-seed name=NEWSTATUS_InsertNewStatus
