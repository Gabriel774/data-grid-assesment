<p align="center">
<img src="https://www.curotec.com/wp-content/uploads/2023/06/Curotec-Logo.svg" alt="Curotec" width="300"/>
</p>

# Curotec - Laravel & Vue Assessment

Skill assesment for Curotec's Laravel/Vue Full Stack Engineer role

## Install

Clone the project from github

```bash
 git clone link && cd curotect-laravel-vue-assesment
```

Up the containers

```bash
 docker compose up -d
```

Add the .env file for laravel

```bash
 cd src && cp .env.example .env
```

## Running tests

to run tests run the following commands

```bash
  docker exec -it laravel-app bash
```

```bash
  php artisan test --testdox
```
