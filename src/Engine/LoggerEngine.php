<?php

namespace Btinet\Rpg\Engine;

use SplObserver;
use SplSubject;

class LoggerEngine implements SplObserver
{

    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    /**
     * @param SplSubject $subject
     * @param string|null $event
     * @param null $data
     */
    public function update(SplSubject $subject, string $event = null, $data = null)
    {
        $class = get_class($subject);
        $entry = date("Y-m-d H:i:s") . ", $class, $event, " . json_encode($data) . "\n";
        file_put_contents($this->filename, $entry, FILE_APPEND);
    }

}
