<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'victoryImageServer');

// Project repository
set('repository', 'git@github.com:abrahambosch/victoryImageServer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['./.env']);
add('shared_dirs', ['./storage']);

// Writable dirs by web server
add('writable_dirs', ['./storage', './bootstrap/cache']);
set('allow_anonymous_stats', false);

// Hosts

host('ec2-35-166-253-65.us-west-2.compute.amazonaws.com')
    ->user('ubuntu')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

