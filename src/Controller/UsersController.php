<?php
declare(strict_types=1);

namespace App\Controller;

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
        $user = $this->Users->find()->where(['id' => $id])->first();
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
