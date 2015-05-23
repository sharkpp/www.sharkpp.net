<?php
namespace Sharkpp\Twig\Extensions;

use Twig_Extension;
use Twig_Environment;
use Twig_Template;
use Twig_SimpleFunction;

class Debug2 extends Twig_Extension
{
    /**
     * Returns a list of global functions to add to the existing list.
     *
     * @return array An array of global functions
     */
    public function getFunctions()
    {
        // dump is safe if var_dump is overriden by xdebug
        $isDumpOutputHtmlSafe = extension_loaded('xdebug') && (false === get_cfg_var('xdebug.overload_var_dump') || get_cfg_var('xdebug.overload_var_dump')) && get_cfg_var('html_errors');

        $functions = array(
            new Twig_SimpleFunction('print_r', array($this, 'twig_print_r'), array('needs_environment' => true, 'needs_context' => true, 'is_safe' => $isDumpOutputHtmlSafe ? array('html') : array())),
        );
        return $functions;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'debug2';
    }

	public function twig_print_r(Twig_Environment $env, $context)
	{
	    if (!$env->isDebug()) {
	        return;
	    }
	
	    ob_start();
	
	    $count = func_num_args();
	    if (2 === $count) {
	        $vars = array();
	        foreach ($context as $key => $value) {
//	            if (!$value instanceof Twig_Template) {
//	                $vars[$key] = $value;
	                $vars[] = $key;
//	            }
	        }

	        print_r($vars);
	    } else {
	        for ($i = 2; $i < $count; $i++) {
$vars = array();
	        foreach (func_get_arg($i) as $key => $value) {
//	                $vars[$key] = $value;
	                $vars[] = $key;
	        }
	        var_dump($vars);
//	            print_r(func_get_arg($i));
	        }
	    }
	
	    return ob_get_clean();
	}
}
