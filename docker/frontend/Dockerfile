FROM node:10-alpine

RUN npm install gulp-cli -g

WORKDIR /var/www

CMD npm ci --silent --prefix ./frontend && gulp build --silent --gulpfile ./frontend/gulpfile.js
