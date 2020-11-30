#! /bin/bash

# 1. Install composer dependencies
composer i

# 2. Install npm dependencies
npm i

# 3. Give right to var folder
chmod -R 777 ./var

# 4. Create data.db sqlite file
if [[ ! -e ./var/data.db ]]; then
    mkdir -p ./var
    touch ./var/data.db
fi

# 5. Create tables
bin/console doctrine:schema:update --force

# 6. Load fixtures
bin/console doctrine:fixtures:load

# 7. Build front
npm run build

# 8. Run server
php -S localhost:1234 -t public