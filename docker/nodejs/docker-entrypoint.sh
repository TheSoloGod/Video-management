#!/bin/bash

# Exit on fail
set -e

npm install

./node_modules/.bin/gulp

# Finally call command issued to the docker service
exec "$@"
