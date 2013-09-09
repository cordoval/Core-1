@Account
Feature: Password recovery
In Order to recover a lost password as registered User you have to input valid informations

Scenario: request a code with valid use
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i request the code with following informations
        | email |
        | test@test.de |
    Then a recovery mail should be created
    And the mail should be send
    And i should have a recovery code