<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 19.11.17
 * Time: 01:33
 */

use Symfony\Component\Finder\Finder;

$finder = new Finder();
$finder->files()->in('fit/new');

foreach ($finder as $file) {
    // Dump the absolute path
    var_dump($file->getRealPath());

    // Dump the relative path to the file
    var_dump($file->getRelativePathname());
}