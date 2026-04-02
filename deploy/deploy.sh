#!/bin/bash

set -e

APP_DIR=app_dir_change
REPO=https://github.com/mafpbiaggi/cadastra-visitante
LOG_FILE=/tmp/deploy.log

function log() {
    echo -e "[$(date '+%Y-%m-%d %H:%M:%S')] $1" >> $LOG_FILE
}

function set_env() {
    cp $APP_DIR/docker/.env.example $APP_DIR/docker/.env
    
    DB_HOST=db_host_change
    DB_DATABASE=db_database_change
    DB_USER=db_user_change
    DB_PASS=db_pass_change
    DB_PORT=db_port_change
    PORT_MAPPING=port_mapping_change

    sed -i \
    -e "s/DB_HOST=.*/DB_HOST=$DB_HOST/" \
    -e "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" \
    -e "s/DB_USER=.*/DB_USER=$DB_USER/" \
    -e "s/DB_PASS=.*/DB_PASS=$DB_PASS/" \
    -e "s/DB_PORT=.*/DB_PORT=$DB_PORT/" \
    -e "s/PORT_MAPPING=.*/PORT_MAPPING=$PORT_MAPPING/" \
    -e "s|ROOT_DIR=.*|ROOT_DIR=$APP_DIR|" \
    "$APP_DIR/docker/.env"
}

function git_clone() {
    log "Repository cloning $APP_DIR..."
    git clone "$REPO" "$APP_DIR"
    set_env
}

function git_pull() {
    log "Updating project files..."
    git -C "$APP_DIR" pull
}

function set_permissions() {
    chgrp -R www-data "$APP_DIR"
}

function docker_up() {
    docker compose -f "$APP_DIR/docker/docker-compose.yaml" up -d --build
    docker network connect scripts_proxy_network app_cadastra_visitante 2>/dev/null || true
    docker network connect sig app_cadastra_visitante 2>/dev/null || true
}

function docker_down() {
    docker compose -f "$APP_DIR/docker/docker-compose.yaml" down || true
}

function compose_install() {
    docker container exec app_cadastra_visitante composer install 
}

function deploy() {
    docker_down
    set_permissions
    docker_up
    
    if [ "$1" == "clone" ] ; then
        compose_install
    fi
}

if [ -d "$APP_DIR" ] && [ -n "$(ls -A "$APP_DIR")" ]; then
    git_pull
    deploy "pull"

else
    log "Directory $APP_DIR not found ... Creating ..."
    mkdir -p "$APP_DIR"
    git_clone
    deploy "clone"
fi

log "Deploy status: Success."
