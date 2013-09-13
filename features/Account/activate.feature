@Account @Activate
Feature: User Activation
In order to login as registered user, I need to activate my account

Scenario: activate valid account
    Given user with follwoing informations:
       | id | username | password | email | activationCode |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | qwerty  | 
    Then I should be activated
    And I should have "User" roles

Scenario: invalid activation code
    Given user with follwoing informations:
       | id | username | password | email | activationCode |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then I should see "activation code is invalid"
   
Scenario: user not exists
    Given user with follwoing informations:
       | id | username | password | email | activationCode |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | Dummy | 123456  | 
    Then I should see "account not exists"

Scenario: user already active
    Given user with follwoing informations:
       | id | username | password | email |
       | 1 | BlackScorp | 123456 | test@test.de |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then I should see "account already active"