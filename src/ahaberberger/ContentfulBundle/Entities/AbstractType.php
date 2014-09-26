<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 13:54
 */

namespace ahaberberger\ContentfulBundle\Entities;

class AbstractType {

    /** @var   */
    protected $id;

    /** @var  array */
    protected $fields;

    function __construct()
    {

    }

    protected static function fromArray($data)
    {
        $instance = new static();

        $instance->id = $data['sys']['id'];

        $instance->fields = $data['fields'];

        return $instance;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

} 