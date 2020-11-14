### Sequence Diagram

![Sequence Diagram](sequence-diagram.png)

## Installation
- Run `make up`
- To index the data-set for first time 
    - `make fixtures`
    - #### Notes:-
        - The last command may be take some time if we are trying to index a big file.
        - Note the above command expecting the data set inside this file`recipe-data.json`

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
