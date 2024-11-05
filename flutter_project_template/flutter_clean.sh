#!/bin/bash

# Remove all generated files

flutter clean

# check if example folder exists, if it does, go to example folder and run flutter clean

if [ -d "example" ]; then
  cd example
  flutter clean
  cd ..
fi