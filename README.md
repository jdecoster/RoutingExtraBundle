# RoutingExtraBundle

Provides a `debug:router:role` command which extends `debug:router` with extra information
about required security ROLES set in the access_map.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require jdecoster/router-extra-bundle "~0.1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new jdecoster\RoutingExtraBundle\jdecosterRoutingExtraBundle(),
        );

        // ...
    }

    // ...
}
```

License
=======

The project is released under the MIT license. See the LICENSE file in `Resources/meta` for
the complete license.
