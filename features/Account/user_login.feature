@Account
Feature: User login
In order to to login as registered user, I have to input valid informations

Scenario: login with valid account
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123456  |
    Then I should be logged in
    And I should have "Player" roles

Scenario: login with invalid password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 654321  |
    Then I should see an "OpenTribes\Core\Player\Login\exception\Invalid" exception

Scenario: login with invalid usename
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | Black | 654321  |
    Then I should see an "OpenTribes\Core\Player\Login\exception\NotExists" exception

Scenario: login with not active account
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123456  |
    Then I should see an "OpenTribes\Core\Player\Login\exception\NotActive" exception

Scenario: login with empty username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        |  | 123456  |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Emptyexception" exception

Scenario: login with short username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | B | 123456  |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Short" exception

Scenario: login with long username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorpBlackScorpBlackScorpBlackScorpBlackScorpBlackScorp | 123456  |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Long" exception

Scenario: login with invalid username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | B!@ckS@rp | 123456  |
    Then I should see an "OpenTribes\Core\Player\exception\Username\Invalid" exception

Scenario: login with empty password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp |   |
    Then I should see an "OpenTribes\Core\Player\exception\Password\Emptyexception" exception

Scenario: login with short password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And I'm not logged in
    And I have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123 |
    Then I should see an "OpenTribes\Core\Player\exception\Password\Short" exception