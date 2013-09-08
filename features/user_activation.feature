Feature: User Activation
In order to login as registered user, i need to activate my account

Scenario: Activate valid account
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And iam not logged in
    And i have "Guest" roles
    When i activate account with following informations:
        | username | activation_code |
        | BlackScorp | qwerty  | 
    Then i should be activated
    And i should have "Player" roles

Scenario: invalid activation code
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And iam not logged in
    And i have "Guest" roles
    When i activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then i should see an "OpenTribes\Core\Player\Activate\Exception\Invalid" Exception
   
Scenario: user not exists
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And iam not logged in
    And i have "Guest" roles
    When i activate account with following informations:
        | username | activation_code |
        | Dummy | 123456  | 
    Then i should see an "OpenTribes\Core\Player\Activate\Exception\NotExists" Exception

Scenario: user already active
    Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i activate account with following informations:
        | username | activation_code |
        | BlackScorp | 123456  | 
    Then i should see an "OpenTribes\Core\Player\Activate\Exception\Active" Exception