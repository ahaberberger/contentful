<?php
/**
 * Created by IntelliJ IDEA.
 * User: andreas
 * Date: 26.09.14
 * Time: 13:55
 */

namespace ahaberberger\ContentfulBundle\Entities;


class Asset extends AbstractType {

    public static function fromArray($data)
    {
        $instance = parent::fromArray($data);

        return $instance;
    }
} 