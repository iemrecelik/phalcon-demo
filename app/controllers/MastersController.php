<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MastersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }



    /**
     * Searches for masters
     */
    public function listAction()
    {
        $parameters["order"] = "id";

        $masters = Masters::find($parameters);
        if (count($masters) == 0) {
            $this->flash->notice("The search did not find any masters");

            $this->dispatcher->forward([
                "controller" => "masters",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $masters,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for masters
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Masters', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $masters = Masters::find($parameters);
        if (count($masters) == 0) {
            $this->flash->notice("The search did not find any masters");

            $this->dispatcher->forward([
                "controller" => "masters",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $masters,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a master
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $master = Masters::findFirstByid($id);
            if (!$master) {
                $this->flash->error("master was not found");

                $this->dispatcher->forward([
                    'controller' => "masters",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $master->id;

            $this->tag->setDefault("id", $master->id);
            $this->tag->setDefault("name", $master->name);
            $this->tag->setDefault("surname", $master->surname);
        }
    }

    /**
     * Creates a new master
     */
    public function createAction()
    {
        if (!$this->request->isPost() && !$this->request->isAjax()) {
            $this->dispatcher->forward([
                'controller' => "masters",
                'action' => 'index'
            ]);

            return;
        }

        $master = new Masters();
        $master->name = $this->request->getPost("name");
        $master->surname = $this->request->getPost("surname");
        

        if (!$master->save()) {
            foreach ($master->getMessages() as $message) {
                $this->flash->error($message);
            }
            die;
        }

        $this->flash->success("master was created successfully");
        die;
    }

    /**
     * Saves a master edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost() && !$this->request->isAjax()) {
            $this->dispatcher->forward([
                'controller' => "masters",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $master = Masters::findFirstByid($id);

        if (!$master) {
            $this->flash->error("master does not exist " . $id);
            die;
        }

        $master->name = $this->request->getPost("name");
        $master->surname = $this->request->getPost("surname");
        

        if (!$master->save()) {

            foreach ($master->getMessages() as $message) {
                $this->flash->error($message);
            }

            die;
        }

        $this->flash->success("master was updated successfully");
        die;
    }

    /**
     * Deletes a master
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $master = Masters::findFirstByid($id);
        if (!$master) {
            $this->flash->error("master was not found");

            $this->dispatcher->forward([
                'controller' => "masters",
                'action' => 'list'
            ]);

            return;
        }

        if (!$master->delete()) {

            foreach ($master->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "masters",
                'action' => 'list'
            ]);

            return;
        }

        $this->flash->success("master was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "masters",
            'action' => "list"
        ]);
    }

}
