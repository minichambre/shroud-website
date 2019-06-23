#Install
- Composer install
- Yarn install

#Building Assets
- CSS & JS must be compiled via webpack encore.
- Run "yarn encore dev" to compile changes once.
- Alternatively, run "yarn encore dev --watch" to continue building whenever a change is made.
- Run "yarn encore production" for a production build.
- Restart encore whenever you change the webpack.config.js file

#Running
- Run "php bin/console server:run" or start if on non-windows OS.
