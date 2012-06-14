<?php
namespace Chewbacca\CoreBundle\Console;
use Symfony\Bundle\FrameworkBundle\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function renderException($e, $output)
    {
        parent::renderException($e, $output);
        $strlen = function ($string) {
            if (!function_exists('mb_strlen')) {
                return strlen($string);
            }

            if (false === $encoding = mb_detect_encoding($string)) {
                return strlen($string);
            }

            return mb_strlen($string, $encoding);
        };
        $log_message = '';
        do {
            $title = sprintf("Exception occured: [%s]\n", get_class($e));
            $len = $strlen($title);
            $lines = array();
            foreach (explode("\n", $e->getMessage()) as $line) {
                $lines[] = sprintf('  %s  ', $line);
                $len = max($strlen($line) + 4, $len);
            }

            $log_message .= $title;

            foreach ($lines as $line) {
                $log_message .= "    ".$line.str_repeat(' ', $len - $strlen($line))."\n";
            }

                $log_message .= "  Exception trace:\n";

                // exception related properties
                $trace = $e->getTrace();
                array_unshift($trace, array(
                    'function' => '',
                    'file'     => $e->getFile() != null ? $e->getFile() : 'n/a',
                    'line'     => $e->getLine() != null ? $e->getLine() : 'n/a',
                    'args'     => array(),
                ));

                for ($i = 0, $count = count($trace); $i < $count; $i++) {
                    $class = isset($trace[$i]['class']) ? $trace[$i]['class'] : '';
                    $type = isset($trace[$i]['type']) ? $trace[$i]['type'] : '';
                    $function = $trace[$i]['function'];
                    $file = isset($trace[$i]['file']) ? $trace[$i]['file'] : 'n/a';
                    $line = isset($trace[$i]['line']) ? $trace[$i]['line'] : 'n/a';

                    $log_message .= sprintf("    %s%s%s() at %s:%s\n", $class, $type, $function, $file, $line);
                }
        } while ($e = $e->getPrevious());
        error_log($log_message);
    }
}
