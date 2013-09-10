@City
    Feature: Create a city
        In order to create a city
        as registered player
        I have to find the right place
     
    Background:
        Given a map with following tiles:
         |   y/x   |   0   |   1   |   2   |   3   |   4   |
         |  0   | Grass | Grass | Grass | Grass | Grass |
         |  1   | Grass | Forrest | Grass | Grass | Grass |
         |  2   | Grass | Grass | Grass | Grass | Grass |
         |  3   | Grass | Sea | Grass | Hill | Grass |
         |  4   | Grass | Grass | Grass | Grass | Grass |
        And following cities:
            | id | name | owner | x | y |
            | 1 | City1 | Owner1 | 0 | 0 |
            | 2 | City2 | Owner2 | 2 | 0 |
            | 3 | City3 | Owner1 | 4 | 4 |
        And user with follwoing informations:
            | id | username | password | email | activation_code |
            | 1 | BlackScorp | 123456 | test@test.de | |
            | 2 | Owner1 | 123456 | owner1@test.de | |
            | 3 | Owner2 | 123456 | owner2@test.de | |
     
    Scenario: create a city
        Given I'm logged in as user "BlackScorp"
        When I create a city at location x=2 and y=2
        Then I should have a city

