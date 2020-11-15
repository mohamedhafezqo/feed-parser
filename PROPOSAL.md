### Sequence Diagram

![Sequence Diagram](sequence-diagram.png)

## Installation
- for first time `make first`
- Create DB Run `make up`

## Run Tests
- Run `make test`

## Command to get recipe stats
- Run `make stats`
- Notes:-
    - First, you may need to change your stats criteria so, checkout `input.json` file
 to manipulate your criteria as you like.
    - For the previous command output/results checkout `output.json` file.

Note All those files `recipe-data.json`, `input.json` and `output.json` located in the root directory

## TODO
[ ] Use `Composite aggregation` instead of `terms aggregation`  to get all unique values without setting a magic number (size: 10000).

### Built With

* [PHP7](http://php.net)
* [Symfony5](http://www.symfony.com) 
* [ElasticSearch](https://www.elastic.co)
