<?php
declare(strict_types=1);

namespace App\Controller;

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

        $this->Authentication->addUnauthenticatedActions(['customerIndex']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Faqs->find();
        // $query = $this->Authorization->applyScope($query);
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
        // $query = $this->Authorization->applyScope($query);
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
    public function view($id = null)
    {
        $faq = $this->Faqs->get($id, contain: []);
        // $this->Authorization->authorize($faq);
        $this->set(compact('faq'));
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
    public function edit($id = null)
    {
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
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
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
}
