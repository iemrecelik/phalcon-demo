<?php

class Teachers extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $surname;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalconDemo");
        $this->setSource("teachers");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'teachers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Teachers[]|Teachers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Teachers|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
