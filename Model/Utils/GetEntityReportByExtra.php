<?php
/*
  * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtReportsStock\Model\Utils;

use Magento\Framework\Serialize\SerializerInterface;

class GetEntityReportByExtra
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param string $extraString
     * @return string
     */
    public function execute(string $extraString): string
    {
        $extraData = $this->serializer->unserialize($extraString);

        $result = '';

        if (array_key_exists('error', $extraData)) {
            $result .= 'Error message: ' . $extraData['error'];
        }

        if (array_key_exists('old_qty', $extraData)) {
            $result .= 'Old quantity: ' . $extraData['old_qty'];

            if (array_key_exists('new_qty', $extraData)) {
                $result .= ' | New quantity: ' . $extraData['new_qty'];
            }
        }

        return $result;
    }
}
