<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return array(
           'Sharkpp\Sculpin\Bundle\CalendarianBundle\SculpinCalendarianBundle',
           'Beryllium\Icelus\IcelusBundle',
           'Mavimo\Sculpin\Bundle\RedirectBundle\SculpinRedirectBundle',
        );
    }
}
