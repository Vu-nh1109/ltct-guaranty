# Project về Module Bảo hành và đổi trả hàng
## Truy cập `localhost:8000/api/pettion/{order_id}/{product_id}` để tạo 1 form yêu cầu đổi trả
## Truy cập `localhost:8000/pettions` để hiển thị list các yêu cầu đã tạo
- Click "Link" trên 1 hàng để hiển thị chi tiết yêu cầu
- Click "Accept", "Refuse" hay "Switch to Return" để thực hiện xử lý yêu cầu

# Hướng dẫn deploy local (Tiếng Anh):
Require: PHP 8.0
## Windows users:
- Download wamp: http://www.wampserver.com/en/
- Download and extract cmder mini: https://github.com/cmderdev/cmder/releases/download/v1.1.4.1/cmder_mini.zip
- Update windows environment variable path to point to your php install folder (inside wamp installation dir) (here is how you can do this http://stackoverflow.com/questions/17727436/how-to-properly-set-php-environment-variable-to-run-commands-in-git-bash)
 

cmder will be refered as console

## Mac Os, Ubuntu and windows users continue here:
- Create a database locally named `homestead` utf8_general_ci 
- Download composer https://getcomposer.org/download/
- Pull Laravel/php project from git provider.
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
  (windows wont let you do it, so you have to open your console cd your project root directory and run `mv .env.example .env` )
- Open the console and cd your project root directory
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan serve`

##### You can now access your project at localhost:8000 :)

## If for some reason your project stop working do these:
- `composer install`
- `php artisan migrate`

