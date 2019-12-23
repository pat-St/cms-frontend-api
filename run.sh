#!/bin/sh
echo "build image"
docker build -t php-server .
echo "start container"
docker run -p 80:80 php-server