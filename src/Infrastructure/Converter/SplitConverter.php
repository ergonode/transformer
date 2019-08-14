<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See license.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Transformer\Infrastructure\Converter;

use Ergonode\Value\Domain\ValueObject\StringCollectionValue;
use Ergonode\Value\Domain\ValueObject\ValueInterface;
use JMS\Serializer\Annotation as JMS;
use Webmozart\Assert\Assert;

/**
 * Class SplitConverter
 */
class SplitConverter extends AbstractConverter implements ConverterInterface
{
    /**
     * @var string
     *
     * @JMS\Type("string")
     *
     */
    private $field;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $delimiter;

    /**
     * @param string $field
     * @param string $delimiter
     */
    public function __construct(string $field, string $delimiter = ',')
    {
        $this->field = $field;
        $this->delimiter = $delimiter;
    }

    /**
     * @param array  $line
     * @param string $field
     * @return ValueInterface|null
     */
    public function map(array $line, string $field): ?ValueInterface
    {
        Assert::notEq($this->delimiter, '');
        $collection = explode($this->delimiter, $line[$this->field]);

        return new StringCollectionValue($collection);
    }
}
