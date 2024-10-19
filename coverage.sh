#!/bin/bash


## check if  .gitignore file contains `data/coverage/` 
## if not add it to the file
if ! grep -q "^coverage/[[:space:]]*$" .gitignore; then
    echo "# ignore coverage report" >> .gitignore
    echo "coverage/" >> .gitignore
fi


# Generate `coverage/lcov.info` file
flutter test --coverage
# Generate HTML report
# Note: on macOS you need to have lcov installed on your system (`brew install lcov`) to use this:
genhtml coverage/lcov.info -o coverage/html
# Open the report
open coverage/html/index.html
