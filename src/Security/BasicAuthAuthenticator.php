<?php

namespace Billbee\ForeignSystemsSdk\Security;

use Psr\Http\Message\RequestInterface;

class BasicAuthAuthenticator implements AuthenticatorInterface
{
    private string $username;
    private string $password;
    
    public function __construct(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function isAuthorized(RequestInterface $request): bool
    {
        $authorizationHeader = $request->getHeader("Authorization");
        if (!is_array($authorizationHeader)
            || count($authorizationHeader) != 1) {
            return false;
        }

        $parts = explode(" ", $authorizationHeader[0]);
        if (count($parts) != 2
            || $parts[0] != "Basic") {
            return false;
        }

        $decoded = base64_decode($parts[1]);
        list($username,$password) = explode(":",$decoded);
        if ($username != $this->username
            || $password != $this->password) {
            return false;
        }
        
        return true;
    }
}