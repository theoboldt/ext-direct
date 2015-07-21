<?php
/**
 * teqneers/ext-direct
 *
 * @category   TQ
 * @package    TQ\ExtDirect
 * @copyright  Copyright (C) 2015 by TEQneers GmbH & Co. KG
 */

namespace TQ\ExtDirect\Annotation;


/**
 * Class Parameter
 *
 * @package TQ\ExtDirect\Annotation
 *
 * @Annotation
 * @Target("METHOD")
 */
class Parameter
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array<Symfony\Component\Validator\Constraint>|Constraint[]
     */
    public $constraints = array();

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['value'])) {
            if (is_array($data['value'])) {
                $data['name'] = array_shift($data['value']);
                if (!empty($data['value'])) {
                    $data['constraints'] = array_shift($data['value']);
                }
            } else {
                $data['name'] = $data['value'];
            }
            unset($data['value']);
        }

        foreach ($data as $k => $v) {
            if ($k == 'constraints' && !is_array($v)) {
                $v = array($v);
            }

            $this->{$k} = $v;
        }
    }
}
