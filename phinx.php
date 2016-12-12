<?php
include 'config/config.php';

return array(
    "paths" => array(
        "migrations" => "db/migrations"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => $_ENV['DB_NAME'],
        "dev" => array(
            "adapter" => env("DB_ADAPTER"),
            "host" => env("DB_HOST"),
            "port" => env("DB_PORT"),
            "name" => env("DB_NAME"),
            "user" => env("DB_USER"),
            "pass" => env("DB_PASS")
        )
    )
);