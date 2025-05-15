<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Exception;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class FaqsController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Faqs->find();

        // Apply filters based on query parameters
        $filters = $this->request->getQuery();
        if (!empty($filters['title'])) {
            $query->where(['Faqs.title LIKE' => '%' . $filters['title'] . '%']);
        }
        if (!empty($filters['answer'])) {
            $query->where(['Faqs.answer LIKE' => '%' . $filters['answer'] . '%']);
        }

        // Apply sorting based on the 'sort' parameter
        $sort = $this->request->getQuery('sort');
        $order = ['Faqs.clicks' => 'DESC']; // Default sorting: Created (Descending)
        if ($sort === 'title_asc') {
            $order = ['Faqs.title' => 'ASC'];
        } elseif ($sort === 'title_desc') {
            $order = ['Faqs.title' => 'DESC'];
        } elseif ($sort === 'created_asc') {
            $order = ['Faqs.created' => 'ASC'];
        } elseif ($sort === 'created_desc') {
            $order = ['Faqs.created' => 'DESC'];
        } elseif ($sort === 'clicks_asc') {
            $order = ['Faqs.clicks' => 'ASC'];
        } elseif ($sort === 'clicks_desc') {
            $order = ['Faqs.clicks' => 'DESC'];
        }
        // Apply the sorting to the query
        $query->orderBy($order);

        // Paginate the filtered and sorted query
        $faqs = $this->paginate($query);

        $this->set(compact('faqs'));
    }

    /**
     * Customer Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function customerIndex()
    {
        $query = $this->Faqs->find();
        $query->orderBy(['Faqs.clicks' => 'DESC']);

        // Paginate the sorted query
        $faqs = $this->paginate($query);

        $this->set(compact('faqs'));
    }

    /**
     * View method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('FAQ not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $faq = $this->Faqs->get($id);
            $this->set(compact('faq'));
        } catch (Exception $exception) {
            $this->Flash->error(__('FAQ not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faq = $this->Faqs->newEmptyEntity();
        // $this->Authorization->authorize($faq);
        if ($this->request->is('post')) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The faq has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faq could not be saved. Please, try again.'));
        }
        $this->set(compact('faq'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        if (!ctype_digit($id)) {
            $this->Flash->error(__('FAQ not found.'));

            return $this->redirect(['action' => 'index']);
        }
        try {
            $faq = $this->Faqs->get($id, contain: []);
            // $this->Authorization->authorize($faq);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
                if ($this->Faqs->save($faq)) {
                    $this->Flash->success(__('The faq has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The faq could not be saved. Please, try again.'));
            }
            $this->set(compact('faq'));
        } catch (Exception $exception) {
            $this->Flash->error(__('FAQ not found.'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        // Block access to action using GET method
        // Block user to manually access the action (e.g. faqs/delete/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid access to delete action'));

            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        // $this->Authorization->authorize($faq);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('The faq has been deleted.'));
        } else {
            $this->Flash->error(__('The faq could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Update Click Count method
     *
     * Handles AJAX requests to increment the click count for a specific FAQ.
     *
     * @return \Cake\Http\Response|null
     */
    public function updateClickCount()
    {
        // $this->request->allowMethod(['post']); // Only allow POST requests
        // Block access to action using GET method
        // Block user to manually access the action (e.g. products/delete/1 in URL)
        if ($this->request->is('get')) {
            $this->Flash->error(__('Invalid action'));

            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'ajax']); // Allow only POST and AJAX requests

        $data = $this->request->getData();
        $response = ['success' => false, 'message' => 'Unable to update click count'];
        if (!empty($data['id'])) {
            $faq = $this->Faqs->get($data['id']);
            $faq->clicks += 1;

            if ($this->Faqs->save($faq)) {
                $response = ['success' => true, 'message' => 'Click count updated successfully'];
            }
        }

        return $this->response->withType('application/json')->withStringBody(json_encode($response));

        // // Set the response data and serialize it to JSON
        // $this->set(compact('response'));
        // $this->viewBuilder()->setOption('serialize', ['response']);
        // $this->viewBuilder()->disableAutoLayout(); // Disable the layout rendering
        // $this->render(null, null); // Render the response without a view
    }

    /**
     * Before Filter method
     *
     * @param \Cake\Event\EventInterface $event Event instance.
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['customerIndex', 'updateClickCount']);
        if ($this->request->getParam('action') === 'updateClickCount') {
            $this->Authorization->skipAuthorization();
            $this->getEventManager()->off($this->FormProtection);
        }
    }
}
