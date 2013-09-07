Feature: User registration
In order to create an account as unregistered user, i have to use valid values

Scenario: Create new account with valid data
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test.de |
    Then i should be registered
    And i should get an activation code
    And i should get an email with activation code

Scenario: username empty
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        |  | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\EmptyException" Exception

Scenario: username too short
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | b | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Short" Exception

Scenario: username too long
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | blackscorpblackscorpblackscorpblackscorp | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Long" Exception

Scenario: username has invalid character
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | b@ckscorp! | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Username\Invalid" Exception

Scenario: username already exists
    Given iam not registered user
    And i have "Guest" roles
    And user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | |
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Create\Exception\Username\Exists" Exception

Scenario: empty email
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 132456 | 132456 |  | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Email\EmptyException" Exception

Scenario: email already exists
    Given iam not registered user
    And i have "Guest" roles
    And user with follwoing informations:
       | id | username | password | email | activation_code |
       | 1 | BlackScorp | 123456 | test@test.de | |
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | Black | 123456  | 123456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Create\Exception\Email\Exists" Exception

Scenario: email is invalid
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | blackscorp | 123456  | 123456 | test@test | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Email\Invalid" Exception

Scenario: empty password
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp |  | 132456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Password\EmptyException" Exception

Scenario: password too short
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123 | 132456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Exception\Password\Short" Exception

Scenario: incorrect password confirm 
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 132456 | test@test.de | test@test.de |
    Then i should see an "OpenTribes\Core\Player\Create\Exception\Password\Confirm" Exception

Scenario: incorrect email confirm 
    Given iam not registered user
    And i have "Guest" roles
    When i register with following informations:
        | username | password | password_confirm | email | email_confirm |
        | BlackScorp | 123456  | 123456 | test@test.de | test@test1.de |
    Then i should see an "OpenTribes\Core\Player\Create\Exception\Email\Confirm" Exception