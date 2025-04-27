<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{
    /**
     * Initialize method for ContactsController.
     *
     * This method is called before the controller's actions are executed.
     * Added recaptcha question upon the contact form completion to prevent spams and malicious attack.
     * It allows unauthenticated users to access the 'contactUs' action,
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        if (in_array($this->request->getParam('action'), ['contactUs'])) {
            $this->loadComponent('Recaptcha.Recaptcha', [
                'enable' => true, // true/false
                'sitekey' => env('RECAPTCHA_SITE_KEY'), //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'type' => 'image', // image/audio
                'theme' => 'light', // light/dark
                'lang' => 'en', // default 'en'
                'size' => 'normal', // normal/compact
                'callback' => null, // `callback` data attribute for the recaptcha div, default `null`
                'scriptBlock' => true]); // Value for `block` option for HtmlHelper::script() call
        }

        $this->Authentication->allowUnauthenticated(['contactUs']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Order contacts by date sent from latest to earliest by default
        $query = $this->Contacts->find()->orderBy([
            'Contacts.date_sent DESC',
            'Contacts.id' => 'DESC',
        ]);

        // Retrieve data from filter form
        $first_name = $this->request->getQuery('first_name');
        $last_name = $this->request->getQuery('last_name');
        $date_sent = $this->request->getQuery('date_sent');
        $replyStatus = $this->request->getQuery('reply_status');

        // Build on default query to get filter result
        // Filter Contacts by firstname (partial match)
        if (!empty($first_name)) {
            $query->where(['Contacts.first_name LIKE' => '%' . $first_name . '%']);
        }

        // Filter Contacts by lastname (partial match)
        if (!empty($last_name)) {
            $query->where(['Contacts.last_name LIKE' => '%' . $last_name . '%']);
        }

        // Filter contacts from date_sent and earlier
        if (!empty($date_sent)) {
            $query->where(['Contacts.date_sent <=' => $date_sent]);
        }

        // Filter Contacts by reply status (exact match)
        if ($replyStatus !== null && $replyStatus !== '') {
            $query->where(['Contacts.replied' => $replyStatus]);
        }

        $contacts = $this->paginate($query);

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \App\Controller\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $contact = $this->Contacts->get($id, contain: []);
        $this->set(compact('contact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \App\Controller\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $contact = $this->Contacts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \App\Controller\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * A method to update a contact's reply status
     *
     * @param string|null $id Contact id.
     */
    public function updateReplyStatus(?string $id = null)
    {
        // Find project record with specific id
        $contact = $this->Contacts->get($id);

        // Flip the status
        $contact->replied = !$contact->replied;

        // Save changes
        if ($this->Contacts->save($contact)) {
            $this->Flash->success(__('The contact reply status has been updated.'));
        } else {
            $this->Flash->error(__('The contact reply status could not be updated. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $contact->id]);
    }

    /**
     * A method to add for potential customer to create a contact details and send it to the system
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function contactUs()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) {
                // Get submitted data
                $data = $this->request->getData();

                // Patch sanitized data into the entity
                $contact = $this->Contacts->patchEntity($contact, $data);

                // Check for validation errors
                if ($contact->getErrors()) {
                    $this->Flash->error(__('Please correct the errors in the form.'));
                } else {
                    if ($this->Contacts->save($contact)) {
                        $this->Flash->success(__('Your contact details has been saved.'));

                        return $this->redirect(['controller' => 'Contacts', 'action' => 'contact_us']);
                    } else {
                        $this->Flash->error(__('Unable to send your contact details.'));
                    }
                }
            } else {
                // You can debug developers errors with
                $this->Flash->error(__('Please check your Recaptcha Box.'));
            }
        }
        $this->set(compact('contact'));
    }
}
