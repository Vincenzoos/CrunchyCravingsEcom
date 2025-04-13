<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use CakeDC\Auth\Policy\PolicyInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * AllowDebugKitPolicy
 *
 * This policy class is used to explicitly allow access to the DebugKit plugin
 * in a CakePHP application that uses the CakeDC/Auth and Authorization plugins.
 *
 * When using custom authorization resolvers like MapResolver and CollectionPolicy,
 * this policy ensures that requests targeting DebugKit routes are allowed,
 * regardless of the user's identity.
 */
class AllowDebugKitPolicy implements PolicyInterface
{
    /**
     * Determines whether the given request can be accessed.
     *
     * This method checks if the current request is for the DebugKit plugin,
     * and if so, it grants access regardless of the identity.
     *
     * @param IdentityInterface|null $identity The identity of the current user, or null if unauthenticated.
     * @param ServerRequestInterface $resource The current server request instance.
     * @return bool True if the plugin is DebugKit, false otherwise.
     */
    public function canAccess(?IdentityInterface $identity, ServerRequestInterface $resource): bool
    {
        return $resource->getParam('plugin') === 'DebugKit';
    }
}
