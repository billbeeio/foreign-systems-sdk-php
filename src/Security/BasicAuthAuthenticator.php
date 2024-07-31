<?php

namespace Billbee\ForeignSystemsSdk\Security;

use Billbee\ForeignSystemsSdk\Http\Abstraction\Request;
use Psr\Http\Message\RequestInterface;

class BasicAuthAuthenticator implements AuthenticatorInterface
{
    private string $username;
    private string $password;

    /** @var string[] */
    private array $publicAccessActions;

    /**
     * @param string $username The BasicAuth username
     * @param string $password The BasicAuth password
     * @param string[] $publicAccessActions The actions that don't require authentication
     */
    public function __construct(string $username, string $password, array $publicAccessActions = ["GetProvisioningDetails"])
    {
        $this->username = $username;
        $this->password = $password;
        $this->publicAccessActions = $publicAccessActions;
    }

    public function isAuthorized(RequestInterface $request): bool
    {
        $actionHeader = $request->getHeader("X-BB-INTERNAL-ACTION");
        if (!empty($actionHeader) && in_array($actionHeader[0], $this->publicAccessActions)) {
            return true;
        }

        $userInfo = $request->getUri()->getUserInfo();
        if (empty($userInfo)) {
            return false;
        }

        list($username, $password) = explode(':', $userInfo);
        return $username == $this->username && $password == $this->password;
    }
}
