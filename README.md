## Setup
```bash
composer install
```
## Run Tests
```bash
composer run-script test
```

## Basic Usage
```php
use IdealOctoTelegram\Controller\PlayersObject;

$playersObject = new PlayersObject();
$playersObject->display(php_sapi_name() === 'cli', 'file', './playerdata.json');
```

## Notes
- I made the assumption that the `IReadWritePlayers` interface and `PlayerObject` APIs couldn't be changed. This is a pretty common constraint when refactoring and I think makes for an interesting challenge.
- I did en up 'breaking' the API in a few places that didn't really make sense. Ex: `readPlayers()` no longer returns hard coded values for `array` and `json`. I'll argue those were bugs anyways :grinning:
- Normally I'd like to have more test coverage but for time's sake I focused on the critical stuff. Mainly, I wanted tests for PlayerObject before I refactored it so I could run them against the refactored version. This was mostly successful except for a few spots where I had to update the tests to account for changes I made to the API.
---


Development Exercise

  Please create a branch of this repository to complete your task. Name the branch whatever you like. When complete, open a Pull Request back to the master branch of this repository.
  
  The following code is poorly designed and error prone. Refactor the objects below to follow a more SOLID design.
  Keep in mind the fundamentals of MVVM/MVC and Single-responsibility when refactoring.

  Further, the refactored code should be flexible enough to easily allow the addition of different display
    methods, as well as additional read and write methods.

  Feel free to add as many additional classes and interfaces as you see fit.

  Note: The goal here is not 100% correctness, but instead a glimpse into how you
    approach refactoring/redesigning bad code. Commit often to your branch.
