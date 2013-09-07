Feature: User login

Scenario: login with valid account
    Given iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123456  |
    Then i should be logged in