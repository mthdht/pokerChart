# pokerCharts
a place to organize your scores on poker


### Installation ###

* type `git clone git@github.com:mthdht/pokerCharts.git` to clone the repository 
* type `cd pokerCharts`
* type `composer install`
* type `composer update`
* copy *.env.example* to *.env*
* type `php artisan key:generate`to generate secure key in *.env* file
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* if you use sqlite :
   * type `touch database/database.sqlite` to create the file
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails configuration

### Include ###

* [Laravel debugbar](https://github.com/barryvdh/laravel-debugbar)

### Contributing ###

1. Fork it!
2. Create your feature branch: git checkout -b my-new-feature
3. Commit your changes: git commit -am 'Add some feature'
4. Push to the branch: git push origin my-new-feature
5. Submit a pull request :D


