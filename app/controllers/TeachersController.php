<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TeachersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for teachers
     */
    public function listAction()
    {
        $parameters["order"] = "name";

        $teachers = Teachers::find($parameters);
        if (count($teachers) == 0) {
            $this->flash->notice("The search did not find any teachers");

            $this->dispatcher->forward([
                "controller" => "teachers",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $teachers,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for teachers
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Teachers', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "name";

        $teachers = Teachers::find($parameters);
        if (count($teachers) == 0) {
            $this->flash->notice("The search did not find any teachers");

            $this->dispatcher->forward([
                "controller" => "teachers",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $teachers,
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
     * Edits a teacher
     *
     * @param string $name
     */
    public function editAction($name)
    {
        if (!$this->request->isPost()) {

            $teacher = Teachers::findFirstByname($name);
            if (!$teacher) {
                $this->flash->error("teacher was not found");

                $this->dispatcher->forward([
                    'controller' => "teachers",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->name = $teacher->name;

            $this->tag->setDefault("name", $teacher->name);
            $this->tag->setDefault("surname", $teacher->surname);
            
        }
    }

    /**
     * Creates a new teacher
     */
    public function createAction()
    {
        if (!$this->request->isPost() && !$this->request->isAjax()) {
            $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'index'
            ]);

            return;
        }

        $teacher = new Teachers();
        $teacher->name = $this->request->getPost("name");
        $teacher->surname = $this->request->getPost("surname");
        

        if (!$teacher->save()) {
            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            /* $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'new'
            ]); */

            die;
        }

        $this->flash->success("teacher was created successfully");
        die;

       /*  $this->dispatcher->forward([
            'controller' => "teachers",
            'action' => 'index'
        ]); */
    }

    /**
     * Saves a teacher edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost() && !$this->request->isAjax()) {
            $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'index'
            ]);

            return;
        }

        $name = $this->request->getPost("name");

        $teacher = Teachers::findFirstByname($name);

        if (!$teacher) {
            $this->flash->error("teacher does not exist " . $name);

            /* $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'index'
            ]); */

            die;
        }

        $teacher->name = $this->request->getPost("name");
        $teacher->surname = $this->request->getPost("surname");
        

        if (!$teacher->save()) {

            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }
            
            /* foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'edit',
                'params' => [$teacher->name]
            ]); */

            die;
        }

        /* if ($this->request->isAjax()) {
            $this->response->setContent("Sorry, the page doesn't exist");
            $this->response->send();
            die;
        } */

        $this->flash->success("teacher was updated successfully");
        die;

        /* $this->dispatcher->forward([
            'controller' => "teachers",
            'action' => 'index'
        ]); */
    }

    /**
     * Deletes a teacher
     *
     * @param string $name
     */
    public function deleteAction($name)
    {
        $teacher = Teachers::findFirstByname($name);
        if (!$teacher) {
            $this->flash->error("teacher was not found");

            $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'index'
            ]);

            return;
        }

        if (!$teacher->delete()) {

            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "teachers",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("teacher was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "teachers",
            'action' => "index"
        ]);
    }

}
