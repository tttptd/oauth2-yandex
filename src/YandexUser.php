<?php
namespace Aego\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

class YandexUser implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param  array $response
     */
    public function __construct(array $response, AccessToken $token)
    {
        $this->data = $response;
    }

    /**
     * Returns the ID for the user as a string if present.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getField('id');
    }

    /**
     * Returns the name for the user as a string if present.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getField('display_name');
    }

    /**
     * Returns the first name for the user as a string if present.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->getField('first_name');
    }

    /**
     * Returns the last name for the user as a string if present.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->getField('last_name');
    }

    /**
     * Returns the email for the user as a string if present.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getField('default_email');
    }

    /**
     * Return gender
     * @return string|null
     */
    public function getGender()
    {
        return $this->getField('sex');
    }

    /**
     * Returns all the data obtained about the user.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Returns a field from the Graph node data.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    private function getField($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
