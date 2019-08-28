<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See license.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Transformer\Infrastructure\Converter;

use Ergonode\Value\Domain\ValueObject\StringValue;
use Ergonode\Value\Domain\ValueObject\ValueInterface;
use JMS\Serializer\Annotation as JMS;

/**
 */
class MappingConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @var array
     *
     * @JMS\Type("array<string,string>")
     */
    private $map;

    /**
     * @var null|string
     *
     * @JMS\Type("string")
     */
    private $field;

    /**
     * @param array       $map
     * @param null|string $field
     */
    public function __construct(array $map, ?string $field = null)
    {
        $this->map = $map;
        $this->field = $field;
    }

    /**
     * @param array  $line
     * @param string $field
     *
     * @return ValueInterface
     */
    public function map(array $line, string $field): ValueInterface
    {
        $field = $this->field ?: $field;
        $value = $line[$field];

        if (isset($this->map[$value])) {
            return new StringValue($this->map[$value]);
        }

        return new StringValue($value);
    }
}
