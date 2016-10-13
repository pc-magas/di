<?php

function require_all_files($root)
{
    $d = new RecursiveDirectoryIterator($root);
    foreach (new RecursiveIteratorIterator($d) as $file => $f)
    {
        $ext = pathinfo($f, PATHINFO_EXTENSION);
        if ($ext == 'php' || $ext == 'inc')
		{
			require_once ($file); // or require(), require_once(), include_once()
		}
    }
}

require_all_files(__DIR__.'/src');
