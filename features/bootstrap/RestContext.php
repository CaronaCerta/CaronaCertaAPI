<?php

use Behat\Behat\Context\BehatContext;
use Symfony\Component\Yaml\Yaml;
use GuzzleHttp\Client;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class RestContext extends BehatContext
{
    private $_restObject = null;
    private $_restObjectType = null;
    private $_restObjectMethod = 'get';
    private $_client = null;
    private $_response = null;
    private $_requestUrl = null;

    private $_parameters = array();

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here

        $this->_restObject = new stdClass();
        $this->_client = new Client();
        $this->_parameters = $parameters;
    }

    public function getParameter($name)
    {
        if (count($this->_parameters) === 0) {


            throw new \Exception('Parameters not loaded!');
        } else {

            $parameters = $this->_parameters;
            return (isset($parameters[$name])) ? $parameters[$name] : null;
        }
    }

    /**
     * Get the StdObject values separated by ".". Ex: firstLevel.secondLevel
     * @param $propertyName
     * @param $data
     * @return StdObject
     * @throws Exception
     */
    public function getObjectParameter($propertyName, $data)
    {
        $propertyNameArray = explode(".", $propertyName);
        foreach ($propertyNameArray as $propertyName) {
            if (!empty($data)) {
                if (!isset($data->$propertyName)) {
                    throw new Exception("Property '" . $propertyName . "' is not set!\n");
                } else {
                    $data = $data->$propertyName;
                }
            } else {
                throw new Exception("Response was not JSON\n" . $this->_response->getBody(true));
            }
        }

        return $data;
    }

    /**
     * @Given /^that I want to make a new "([^"]*)"$/
     */
    public function thatIWantToMakeANew($objectType)
    {
        $this->_restObjectType = ucwords(strtolower($objectType));
        $this->_restObjectMethod = 'post';
    }

    /**
     * @Given /^that I want to edit a "([^"]*)"$/
     */
    public function thatIWantToEditA($objectType)
    {
        $this->_restObjectType = ucwords(strtolower($objectType));
        $this->_restObjectMethod = 'put';
    }


    /**
     * @Given /^that I want to find a "([^"]*)"$/
     */
    public function thatIWantToFindA($objectType)
    {
        $this->_restObjectType = ucwords(strtolower($objectType));
        $this->_restObjectMethod = 'get';
    }

    /**
     * @Given /^that I want to delete a "([^"]*)"$/
     */
    public function thatIWantToDeleteA($objectType)
    {
        $this->_restObjectType = ucwords(strtolower($objectType));
        $this->_restObjectMethod = 'delete';
    }

    /**
     * @Given /^that its "([^"]*)" is "([^"]*)"$/
     */
    public function thatTheItsIs($propertyName, $propertyValue)
    {
        $this->_restObject->$propertyName = strtr($propertyValue, [
            '%str_rand' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15),
        ]);
    }

    /**
     * @When /^I request "([^"]*)"$/
     */
    public function iRequest($pageUrl)
    {
        $baseUrl = $this->getParameter('base_url');
        $this->_requestUrl = $baseUrl . $pageUrl;

        switch (strtoupper($this->_restObjectMethod)) {
            case 'GET':
                $response = $this->_client
                    ->get($this->_requestUrl . '?' . http_build_query((array)$this->_restObject));
                break;
            case 'PUT':
                $putFields = (array)$this->_restObject;
                $response = $this->_client
                    ->put($this->_requestUrl, [
                        'body' => $putFields,
                    ]);
            case 'POST':
                $postFields = (array)$this->_restObject;
                $response = $this->_client
                    ->post($this->_requestUrl, [
                        'body' => $postFields,
                    ]);
                break;
            case 'DELETE':
                $response = $this->_client
                    ->delete($this->_requestUrl . '?' . http_build_query((array)$this->_restObject));
                break;
        }
        $this->_response = $response;
    }

    /**
     * @Then /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        $data = json_decode($this->_response->getBody(true));

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->_response);
        }
    }

    /**
     * @Given /^the response has a "([^"]*)" property$/
     */
    public function theResponseHasAProperty($propertyName)
    {
        $data = json_decode($this->_response->getBody(true));

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->_response->getBody(true));
        }

        $this->getObjectParameter($propertyName, $data);
    }

    /**
     * @Then /^the "([^"]*)" property equals "([^"]*)"$/
     */
    public function thePropertyEquals($propertyName, $propertyValue)
    {
        $data = json_decode($this->_response->getBody(true));

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->_response->getBody(true));
        }

        $value = $this->getObjectParameter($propertyName, $data);

        if (in_array($propertyValue, ["true", "false"])) {
            if ($value !== filter_var($propertyValue, FILTER_VALIDATE_BOOLEAN)) {
                throw new \Exception('Property value mismatch! (given: ' . filter_var($propertyValue, FILTER_VALIDATE_BOOLEAN) . ', match: ' . $value . ')');
            }
        } elseif ($value !== $propertyValue) {
            throw new \Exception('Property value mismatch! (given: ' . $propertyValue . ', match: ' . $value . ')');
        }
    }

    /**
     * @Given /^the type of the "([^"]*)" property is ([^"]*)$/
     */
    public function theTypeOfThePropertyIs($propertyName, $typeString)
    {
        $data = json_decode($this->_response->getBody(true));

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->_response->getBody(true));
        }

        $value = $this->getObjectParameter($propertyName, $data);

        // check our type
        switch (strtolower($typeString)) {
            case 'numeric':
                if (!is_numeric($value)) {
                    throw new Exception("Property '" . $propertyName . "' is not of the correct type: " . $typeString . "!\n");
                }
                break;
        }
    }

    /**
     * @Then /^the response status code should be (\d+)$/
     */
    public function theResponseStatusCodeShouldBe($httpStatus)
    {
        if ((string)$this->_response->getStatusCode() !== $httpStatus) {
            throw new \Exception('HTTP code does not match ' . $httpStatus .
                ' (actual: ' . $this->_response->getStatusCode() . ')');
        }
    }

    /**
     * @Then /^echo last response$/
     */
    public function echoLastResponse()
    {
        $this->printDebug(
            $this->_requestUrl . "\n\n" .
            $this->_response
        );
    }
}
