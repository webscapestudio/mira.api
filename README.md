<!-- PROJECT LOGO -->
<br />
<div align="center">
  <h3 align="center">Docker Laravel postgres Nginx Starter</h3>

  <p align="center">
    Project Starter For Web Application Development with Laravel, Postgres, Nginx, and Docker.
    <br />
  </p>
</div>

<!-- ABOUT THE PROJECT -->

## Usage

- Create .env file for laravel environment from .env.example on src folder
- Run command `docker-compose build` on your terminal
- Run command `docker-compose up -d` on your terminal
- Run command `composer install` on your terminal after went into php container on docker
- Run command `docker exec -it php /bin/sh` on your terminal
- Run command `chmod -R 777 storage` on your terminal after went into php container on docker
- If app:key still empty on .env run `php artisan key:generate` on your terminal after went into php container on docker
- To run artisan command like migrate, etc. go to php container using `docker exec -it php /bin/sh`
- Go to http://localhost:8001 or any port you set to open laravel

**Note: if you got a permission error when running docker, try running it as an admin or use sudo in linux**

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/ishaqadhel/docker-laravel-mysql-nginx-starter.svg?style=for-the-badge
[contributors-url]: https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/ishaqadhel/docker-laravel-mysql-nginx-starter.svg?style=for-the-badge
[forks-url]: https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/network/members
[stars-shield]: https://img.shields.io/github/stars/ishaqadhel/docker-laravel-mysql-nginx-starter.svg?style=for-the-badge
[stars-url]: https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/stargazers
[issues-shield]: https://img.shields.io/github/issues/ishaqadhel/docker-laravel-mysql-nginx-starter.svg?style=for-the-badge
[issues-url]: https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/issues
[license-shield]: https://img.shields.io/github/license/ishaqadhel/docker-laravel-mysql-nginx-starter.svg?style=for-the-badge
[license-url]: https://github.com/ishaqadhel/docker-laravel-mysql-nginx-starter/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: images/screenshot.png

# mira.api
