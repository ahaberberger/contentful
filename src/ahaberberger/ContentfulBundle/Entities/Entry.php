<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 13:54
 */

namespace ahaberberger\ContentfulBundle\Entities;


class Entry extends AbstractType {

    /** @var  string */
    protected $contentType;


    public static function fromArray($data)
    {
        $instance = parent::fromArray($data);

        return $instance;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

} 