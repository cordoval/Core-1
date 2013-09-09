@Account
Feature: User login
In Order to to login as Registered use, i have to input valid informations

Scenario: login with valid account
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123456  |
    Then i should be logged in
    And i should have "Player" roles

Scenario: login with invalid password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 654321  |
    Then i should see an "OpenTribes\Core\Player\Login\Exception\Invalid" Exception

Scenario: login with invalid usename
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | Black | 654321  |
    Then i should see an "OpenTribes\Core\Player\Login\Exception\NotExists" Exception

Scenario: login with not active account
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | qwerty |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123456  |
    Then i should see an "OpenTribes\Core\Player\Login\Exception\NotActive" Exception

Scenario: login with empty username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        |  | 123456  |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\EmptyException" Exception

Scenario: login with short username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | B | 123456  |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Short" Exception

Scenario: login with long username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorpBlackScorpBlackScorpBlackScorpBlackScorpBlackScorp | 123456  |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Long" Exception

Scenario: login with invalid username
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | B!@ckS@rp | 123456  |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Invalid" Exception

Scenario: login with empty password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp |   |
    Then i should see an "OpenTribes\Core\Player\Exception\Password\EmptyException" Exception

Scenario: login with short password
     Given user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de |  |
    And iam not logged in
    And i have "Guest" roles
    When i login with following informations:
        | username | password |
        | BlackScorp | 123 |
    Then i should see an "OpenTribes\Core\Player\Exception\Password\Short" Exception