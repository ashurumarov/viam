#!/bin/bash

set -ex

export COMPOSER_HOME=$(pwd)

function artisan-clear-cache {
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'php artisan cache:clear'
}

function artisan-migrate {
   docker compose exec -u "$(id -u):$(id -g)" -w "/app" viam_fpm /bin/bash -c 'php artisan migrate'
}

function ci-run-cmd {
  if [ "${CI}" = "true" ]
  then
    /bin/bash -c "${1}"
  else
    docker-run-bash "${1}"
  fi
}

function compose-up {
  # prepare runtime config
  if [ ! -f .env ]
  then
    cp .env.example .env
    ci-run-cmd "php artisan passport:keys || true"
    ci-run-cmd "php artisan key:generate"
    ci-run-cmd "composer dump-autoload"
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

compose-up
artisan-migrate
artisan-clear-cache
