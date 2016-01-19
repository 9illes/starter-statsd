<?php
namespace Metrics\Collector;

use Iterator\Filter\ExtensionFilter;

class Filesystem
{

  public function directorySize($path)
  {
    if (!is_dir($path) || !is_readable($path)) {
      return 0;
    }

    $io = popen('/usr/bin/du -sk '.$path, 'r');
    $size = fgets($io, 4096);
    $size = substr($size, 0, strpos($size,"\t"));
    pclose ($io);

    return $size;
  }

  public function countFiles($path, $extensions = null)
  {

    $iterator = new \FilesystemIterator($path, \FilesystemIterator::SKIP_DOTS);
    $iteratorFiltered = new ExtensionFilter($iterator, $extensions);

    return iterator_count($iteratorFiltered);
  }

}
