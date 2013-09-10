<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//

require_once 'vendor/autoload.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

    protected $userHelper;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters) {
        // Initialize your context here
        $this->parameters = $parameters;
        $this->userHelper = new UserHelper();
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
    /**
     * @Given /^I\'m not registered user$/
     */
    public function iamNotRegisteredUser() {
        $this->userHelper->newUser();
    }

    /**
     * @Given /^I have "([^"]*)" roles$/
     */
    public function iHaveRoles($arg1) {
        $this->userHelper->addRole($arg1);
    }

    /**
     * @When /^I register with following informations:$/
     */
    public function iRegisterWithFollowingInformations(TableNode $table) {
        $this->userHelper->create($table->getHash());
    }

    /**
     * @Then /^I should be registered$/
     */
    public function iShouldBeRegistered() {
        $this->userHelper->assertIsCreateResponse();
    }

    /**
     * @When /^I login with following informations:$/
     */
    public function iLoginWithFollowingInformations(TableNode $table) {
        $this->userHelper->login($table->getHash());
    }

    /**
     * @Then /^I should be logged in$/
     */
    public function iShouldBeLoggedIn() {
        $this->userHelper->assertIsLoginResponse();
    }

    /**
     * @Given /^I should get an activation code$/
     */
    public function iShouldGetAnActivationCode() {
        $this->userHelper->assertHasActivationCode();
    }

    /**
     * @Given /^I should get an email with activation code$/
     */
    public function iShouldGetAnEmailWithActivationCode() {
        $this->userHelper->sendActivationCode();
    }

    /**
     * @Then /^I should see an "([^"]*)" exception$/
     */
    public function iShouldSeeAnException($arg1) {
        $this->userHelper->assertException($arg1);
    }

    /**
     * @Given /^user with follwoing informations:$/
     */
    public function userWithFollwoingInformations(TableNode $table) {
        $this->userHelper->createDumpUser($table->getHash());
    }

    /**
     * @When /^I activate account with following informations:$/
     */
    public function iActivateAccountWithFollowingInformations(TableNode $table) {
        $this->userHelper->activateAccount($table->getHash());
    }

    /**
     * @Then /^I should be activated$/
     */
    public function iShouldBeActivated() {
        $this->userHelper->assertActivated();
    }

    /**
     * @Given /^I\'m not logged in$/
     */
    public function iamNotLoggedIn() {
        $this->userHelper->newUser();
    }

    /**
     * @Given /^I should have "([^"]*)" roles$/
     */
    public function iShouldHaveRoles($arg1) {
        $this->userHelper->assertHasRole($arg1);
    }

    /**
     * @When /^I request the code with following informations$/
     */
    public function iRequestTheCodeWithFollowingInformations(TableNode $table) {
        throw new PendingException();
    }

    /**
     * @Then /^a recovery mail should be created$/
     */
    public function aRecoveryMailShouldBeCreated() {
        throw new PendingException();
    }

    /**
     * @Given /^the mail should be send$/
     */
    public function theMailShouldBeSend() {
        throw new PendingException();
    }

    /**
     * @Given /^I should have a recovery code$/
     */
    public function iShouldHaveARecoveryCode() {
        throw new PendingException();
    }

}
