@Account
Feature: Password recovery
In order to recover a lost password as registered user I have to input valid informations

Scenario: request a code with valid user
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When I request the code with following informations
        | email |
        | test@test.de |
    Then a recovery mail should be created
    And the mail should be send
    And I should have a recovery code
