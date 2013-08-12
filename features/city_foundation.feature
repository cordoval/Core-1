Feature: City Foundation

in order to play the Game as registered user, you have to found a city on a free location

Background:
    Given following map:
    | Grass | Grass | Grass | Grass |
    | Grass | Forrest | Grass | Grass |
    | Mountains | Grass | Grass | Grass |
    | Grass | Grass | Grass | Sea |
    And following Cities:
    | ID | Name | Owner | X | Y |
    | 1  | TestCity1 | TestPlayer1 | 2 | 1 |
    | 2  | TestCity2 | TestPlayer2 | 1 | 2 |

Scenario: User found successful a city
    Given iam player "BlackScorp"
    When i found a city on location x = 0 and y = 0
    Then result schould be true
    And i should have a city
    And cities name should be "BlackScorp's Village"

Scenario: location is being used
    Given iam player "BlackScorp"
    When i found a city on location x = 2 and y = 1
    Then result should be false

Scenario: location has unbuildable ground
    Given iam player "BlackScorp"
    When i found a city on location x = 1 and y = 1
    Then result should be false