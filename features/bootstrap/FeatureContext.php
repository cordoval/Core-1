<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use OpenTribes\Core\Collection,
    OpenTribes\Core\Player,
    OpenTribes\Core\City;

//
// Require 3rd-party libraries here:
//   
require_once 'vendor/autoload.php';


//
// Custom Autoloading registration
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

        /**
         * Initializes context.
         * Every scenario gets it's own context object.
         *
         * @param array $parameters context parameters (set them up through behat.yml)
         */
        public function __construct(array $parameters)
        {

                // Initialize your context here
        }

  /**
     * @Given /^following map:$/
     */
    public function followingMap(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^following Cities:$/
     */
    public function followingCities(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^iam player "([^"]*)"$/
     */
    public function iamPlayer($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^i found a city on location x = (\d+) and y = (\d+)$/
     */
    public function iFoundACityOnLocationXAndY($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^result schould be true$/
     */
    public function resultSchouldBeTrue()
    {
        throw new PendingException();
    }

    /**
     * @Given /^i should have a city$/
     */
    public function iShouldHaveACity()
    {
        throw new PendingException();
    }

    /**
     * @Given /^cities name should be "([^"]*)"$/
     */
    public function citiesNameShouldBe($arg1)
    {
        throw new PendingException();
    }
     /**
     * @Then /^result should be false$/
     */
    public function resultShouldBeFalse()
    {
        throw new PendingException();
    }

}
