#!/bin/bash

docker stop $(docker ps -qa)
docker-compose up