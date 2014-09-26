<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 14:51
 */

namespace ahaberberger\ContentfulBundle\Entities;


class Link {

    /** @var  string */
    protected $linkType;

    /** @var  string */
    protected $id;

    public static function fromArray($data)
    {
        if (count($data) == 1 && array_key_exists('sys', $data)) $data = $data['sys'];
        $instance = new self();
        $instance->id = $data['id'];
        $instance->linkType = $data['linkType'];
        return $instance;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * @param string $linkType
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;
    }


} 