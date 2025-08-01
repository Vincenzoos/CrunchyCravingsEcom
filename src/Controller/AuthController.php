<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UsersTable;
// Used for cpanel testing
use Cake\Core\Configure;
use Cake\I18n\DateTime;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Exception;

/**
 * Auth Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class AuthController extends AppController
{
    /**
     * @var \App\Model\Table\UsersTable $Users
     */
    private UsersTable $Users;

    /**
     * Controller initialize override
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // By default, CakePHP will (sensibly) default to preventing users from accessing any actions on a controller.
        // These actions, however, are typically required for users who have not yet logged in.
        $this->Authentication->allowUnauthenticated([
            'login', 'register', 'forgetPassword', 'resetPassword',
            'customerIndex', 'customerView',
            'updateQuantityAjax',
            'updateClickCount',
            'orders',
        ]);

        // CakePHP loads the model with the same name as the controller by default.
        // Since we don't have an Auth model, we'll need to load "Users" model when starting the controller manually.
        $this->Users = $this->fetchTable('Users');
    }

    /**
     * Register method (for external user (customer only)
     * Admin register must be created manually to enhance security
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['role'] = 'customer';
            if ($this->Users->save($user)) {
                $this->Flash->success('You have been registered. Please log in. ');

                return $this->redirect(['action' => 'login']);
            }
            // Retrieve validation errors
            $errors = $user->getErrors();
            if (!empty($errors)) {
                $firstError = array_values(array_shift($errors))[0];
                $this->Flash->error($firstError);
            } else {
                $email = $this->request->getData('email');
                $this->Flash->error('Oops! We couldn’t register your account. This email (' . $email . ') is invalid or might already be taken. Please try again.');
            }

            return $this->redirect(['action' => 'register']);
        }
        $this->set(compact('user'));
    }

    /**
     * Forget Password method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful email send, renders view otherwise.
     */
    public function forgetPassword()
    {
        if ($this->request->is('post')) {
            $recoverEmail = $this->request->getData('email');

            // Server-side validation: Check if the email is empty or invalid
            if (empty($recoverEmail) || !filter_var($recoverEmail, FILTER_VALIDATE_EMAIL)) {
                $this->Flash->error(__('Please enter a valid email address for password recovery process.'));
                // Redirect back to the cart view
                return $this->redirect($this->referer());
            }
            // Retrieve the user entity by provided email address
            $user = $this->Users->findByEmail($recoverEmail)->first();

            if ($user) {
                // Set nonce and expiry date
                $user->nonce = Security::randomString(128);
                $user->nonce_expiry = new DateTime('7 days');
                if ($this->Users->save($user)) {
                    $recipient = $user->email;

                    // Load email override configuration
                    Configure::load('app_local');
                    $overrideEmailEnabled = Configure::read('Email.override_enabled', false);
                    $overrideEmail = Configure::read('Email.override');

                    // Determine the final recipient email
                    $finalRecipient = $overrideEmailEnabled && $overrideEmail ? $overrideEmail : $recipient;

                    // Now let's send the password reset email
                    $mailer = new Mailer('default');

                    // email basic config
                    $mailer
                        ->setEmailFormat('both')
                        ->setTo($finalRecipient)
                        ->setSubject('Reset your account password');

                    // select email template
                    $mailer
                        ->viewBuilder()
                        ->setTemplate('reset_password');

                    // transfer required view variables to email template
                    // Use original email address to display in the email (even if overridden)
                    $mailer
                        ->setViewVars([
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'nonce' => $user->nonce,
                            'email' => $recipient,
                        ]);

                    //Send email
                    if (!$mailer->deliver()) {
                        // Just in case something goes wrong when sending emails
                        $this->Flash->error('We have encountered an issue when sending you emails. Please try again. ');

                        return $this->render(); // Skip the rest of the controller and render the view
                    }
                } else {
                    // Just in case something goes wrong when saving nonce and expiry
                    $this->Flash->error('We are having issue to reset your password. Please try again. ');

                    return $this->render(); // Skip the rest of the controller and render the view
                }
            }

            /*
             * **This is a bit of a special design**
             * We don't tell the user if their account exists, or if the email has been sent,
             * because it may be used by someone with malicious intent. We only need to tell
             * the user that they'll get an email.
             */
            $this->Flash->success('Please check your inbox (or spam folder) for an email regarding how to reset your account password. ');

            return $this->redirect(['action' => 'login']);
        }
    }

    /**
     * Reset Password method
     *
     * @param string|null $nonce Reset password nonce
     * @return \Cake\Http\Response|null|void Redirects on successful password reset, renders view otherwise.
     */
    public function resetPassword(?string $nonce = null)
    {
        // Redirect early if nonce is null or empty.
        if (empty($nonce)) {
            $this->Flash->error('Your link is invalid or expired. Please try again.');
            $this->referer();

            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        $user = $this->Users->findByNonce($nonce)->first();

        // If nonce cannot find the user, or nonce is expired, prompt for re-reset password
        if (!$user || $user->nonce_expiry < DateTime::now()) {
            $this->Flash->error('Your link is invalid or expired. Please try again.');

            return $this->redirect(['action' => 'forgetPassword']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);

            // Also clear the nonce-related fields on successful password resets.
            // This ensures that the reset link can't be used a second time.
            $user->nonce = null;
            $user->nonce_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success('Your password has been successfully reset. Please login with new password. ');

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The password could not be reset. Please try again.');
        }

        $this->set(compact('user'));
    }

    /**
     * Change Password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword(?string $id = null)
    {
        $authUserId = $this->Authentication->getIdentity()->getIdentifier(); // Get current user ID

        // If the ID is not numeric or doesn't match the logged-in user's ID, block access
        if (!ctype_digit($id) || (int)$id !== (int)$authUserId) {
            $this->Flash->error(__('You are not authorized to change this password.'));

            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        try {
            $user = $this->Users->get($id, ['contain' => []]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                // Use a custom validation set for password
                $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);

                if ($this->Users->save($user)) {
                    $this->Flash->success('Your password has been updated.');

                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                }

                $this->Flash->error('Your password could not be updated. Please, try again.');
            }

            $this->set(compact('user'));
        } catch (Exception $exception) {
            $this->Flash->error(__('User not found.'));

            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirect to location before authentication
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // if user passes authentication, grant access to the system
        if ($result && $result->isValid()) {
            // Get the currently authenticated user
            $user = $this->request->getAttribute('identity');
            $userId = $user->get('id');

            // Determine redirect location based on role
            // set a fallback location in case user logged in without triggering 'unauthenticatedRedirect'
            if ($user->role === 'admin') {
                $fallbackLocation = ['controller' => 'Contacts', 'action' => 'index'];
            } else {
                $fallbackLocation = ['controller' => 'Products', 'action' => 'customerIndex'];
            }

            // // Merge session cart with database cart
            // $session = $this->request->getSession();
            // $sessionCart = $session->read('Cart') ?? [];

            // foreach ($sessionCart as $productId => $item) {
            //     $existingItem = $this->CartItems->find('all')
            //         ->where(['user_id' => $userId, 'product_id' => $productId])
            //         ->first();

            //     if ($existingItem) {
            //         $existingItem->quantity += $item['quantity'];
            //         $this->CartItems->save($existingItem);
            //     } else {
            //         $cartItem = $this->CartItems->newEmptyEntity();
            //         $cartItem->user_id = $userId;
            //         $cartItem->product_id = $productId;
            //         $cartItem->quantity = $item['quantity'];
            //         $this->CartItems->save($cartItem);
            //     }
            // }

            // // Clear session cart
            // $session->delete('Cart');

            // Redirect to the intended page or fallback to the landing page
            return $this->redirect($this->Authentication->getLoginRedirect() ?? $fallbackLocation);
        }

        // display error if user submitted their credentials but authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Email address and/or Password is incorrect. Please try again. ');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function logout()
    {
        // We only need to log out a user when they're logged in
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            $this->Flash->success('You have been logged out successfully. ');
        }

        // Otherwise just send them to the login page
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }
}
