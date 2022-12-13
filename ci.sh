#!/bin/bash

set -ex

export COMPOSER_HOME=$(pwd)

function artisan-clear-cache {
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'php artisan cache:clear'
}

function artisan-migrate {
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'php artisan migrate'
}
function composer {
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'composer install'
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'composer dump-autoload'
}

function compose-up {
  # prepare runtime config
  if [ ! -f .env ]
  then
    cp .env.example .env
    ci-run-cmd "php artisan passport:keys || true"
    ci-run-cmd "php artisan key:generate"
  fi

  cd docker
  # prepare docker compose environment
  cat <<EOF >.env
PHP_FPM_UID=$(id -u)
PHP_FPM_GID=$(id -g)
EOF

  docker compose up -d
  docker compose ps
}

function ci-run-cmd {
    /bin/bash -c "${1}"
}

compose-up
composer
artisan-migrate
artisan-clear-cache
