<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();

        // Retrieve sorting parameter
        $sort = $this->request->getQuery('sort');

        // Default sorting: Created (Ascending)
        $order = ['Users.created' => 'ASC'];

        // Apply sorting based on the 'sort' parameter
        if ($sort === 'email_asc') {
            $order = ['Users.email' => 'ASC'];
        } elseif ($sort === 'email_desc') {
            $order = ['Users.email' => 'DESC'];
        } elseif ($sort === 'created_asc') {
            $order = ['Users.created' => 'ASC'];
        } elseif ($sort === 'created_desc') {
            $order = ['Users.created' => 'DESC'];
        }

        // Apply the order to the query
        $query->orderBy($order);

        // Apply email filter
        $email = $this->request->getQuery('email');
        if (!empty($email)) {
            $query->where(['Users.email LIKE' => '%' . $email . '%']);
        }

        // Apply role filter
        $role = $this->request->getQuery('role');
        if (!empty($role)) {
            $query->where(['Users.role' => $role]);
        }

        // Paginate the filtered results
        $this->set('users', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('User not found.'));

            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->find()->where(['id' => $id])->first();
        if (!$user) {
            $this->Flash->error(__('User not found.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('User not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            // Fetch the user by ID
            $user = $this->Users->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                // Patch the user entity with the submitted data
                $data = $this->request->getData();

                // If the password field is empty, remove it from the data to avoid overwriting
                if (empty($data['password'])) {
                    unset($data['password']);
                }

                $user = $this->Users->patchEntity($user, $data);

                // Save the updated user
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been updated successfully.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('The user could not be updated. Please, try again.'));
            }

            // Pass the user entity to the view
            $this->set(compact('user'));
        } catch (Exception $exception) {
            $this->Flash->error(__('User not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        // Block access to action using GET method
        // Block user to manually access the action (e.g. users/delete/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid access to delete action'));

            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        try {
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            // This exception is thrown when a foreign key constraint fails.
            $this->Flash->error(__('The user is currently active and cannot be deleted.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
