@servers(['dev' => ['root@194.233.73.208']])

@setup
$dir = "/www/wwwroot/ky-yeu-sungroup";
@endsetup

@story('deploy')
git
build
@endstory

@task('git', ['on' => $server])
cd {{ $dir }}
pwd
git pull
@endtask

@task('build', ['on' => $server])
cd {{ $dir }}
pwd
composer install
php artisan migrate --force
php artisan cache:clear
php artisan config:clear
php artisan view:clear
@endtask
