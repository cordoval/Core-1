@Account
Feature: User registration
In order to create an account as unregistered user, I have to input valid values

Scenario: create new account with valid data
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test.de |
    Then I should be registered
    And I should get an activation code
    And I should get an email with activation code

Scenario: username empty
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        |  | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Emptyexception" exception

Scenario: username too short
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | b | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Short" exception

Scenario: username too long
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | blackscorpblackscorpblackscorpblackscorp | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Long" exception

Scenario: username has invalid character
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | b@ckscorp! | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Invalid" exception

Scenario: username already exists
    Given I'm not registered user
    And I have "Guest" roles
    And user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | |
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\Create\exception\Username\Exists" exception

Scenario: empty email
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 132456 | 132456 |  | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Email\Emptyexception" exception

Scenario: email already exists
    Given I'm not registered user
    And I have "Guest" roles
    And user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | |
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | Black | 123456  | 123456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\Create\exception\Email\Exists" exception

Scenario: email is invalid
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | blackscorp | 123456  | 123456 | test@test | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Email\Invalid" exception

Scenario: empty password
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp |  | 132456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Password\Emptyexception" exception

Scenario: password too short
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123 | 132456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\exception\Password\Short" exception

Scenario: incorrect password confirm 
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 132456 | test@test.de | test@test.de |
    Then I should see an "OpenTribes\Core\Player\Create\exception\Password\Confirm" exception

Scenario: incorrect email confirm 
    Given I'm not registered user
    And I have "Guest" roles
    When I register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test1.de |
    Then I should see an "OpenTribes\Core\Player\Create\exception\Email\Confirm" exception