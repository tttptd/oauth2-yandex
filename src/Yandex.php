<?php
namespace Aego\OAuth2\Client\Provider;

use League\OAuth2\Client\Entity\User;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Psr\Http\Message\ResponseInterface;

class Yandex extends AbstractProvider
{

    public function getBaseAuthorizationUrl()
    {
        return 'https://oauth.yandex.ru/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://oauth.yandex.ru/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://login.yandex.ru/info?oauth_token='.$token;
    }

    protected function getDefaultScopes()
    {
        return $this->scopes;
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            $message = $data['error'] . ': '.$data['error_description'];
            throw new IdentityProviderException(
                $message,
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new YandexUser($response, $token);
    }

}
