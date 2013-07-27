<?php
class Category
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function of($name)
    {
        return new self($name);
    }

    // useless?
    public static function box($stringOrInstance)
    {
        if (is_string($stringOrInstance)) {
            return new self($stringOrInstance);
        }
        if ($stringOrInstance instanceof self) {
            return $stringOrInstance;
        }
        //return NullObject::instance();
        throw new Exception("Boxing a not valaid Category");
    }

    public function __toString()
    {
        return $this->name();
    }

    public function name()
    {
        return $this->name;
    }
}
