<?php
/**
 * @package   Divante\PimcoreIntegration
 * @author    Mateusz Bukowski <mbukowski@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\PimcoreIntegration\Logger\Greylog;

use Monolog\Handler\AbstractProcessingHandler;

/**
 * Class StreamHandler
 */
class Handler extends AbstractProcessingHandler
{

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    public function write(array $record): void {
        if (isset($record['file'])) {
            $url = empty($record['file'])
                ? BP . '/var/log/mana.log'
                : BP . '/var/log/mana/' . $record['file'] . '.log';

            unset($record['file']);
        }
        else {
            $url = BP . '/var/log/mana.log';
        }

        if ($this->url != $url) {
            $this->close();
            $this->url = $url;
        }

        parent::write($record);
    }
}
