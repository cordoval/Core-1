@Account
Feature: User Activation
In order to login as registered user, I need to activate my account

Scenario: activate valid account
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | qwerty  | 
    Then I should be activated
    And I should have "Player" roles

Scenario: invalid activation code
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then I should see an "OpenTribes\Core\Player\Activate\exception\Invalid" exception
   
Scenario: user not exists
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | Dummy | 123456  | 
    Then I should see an "OpenTribes\Core\Player\Activate\exception\NotExists" exception

Scenario: user already active
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When I activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then I should see an "OpenTribes\Core\Player\Activate\exception\Active" exception