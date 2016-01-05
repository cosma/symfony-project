<?php
/**
 * This file is part of the "cosma/testing-bundle" project
 *
 * (c) Cosmin Voicu<cosmin.voicu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 11/07/14
 * Time: 23:33
 */

namespace AppBundle\TestCase;

use Cosma\Bundle\TestingBundle\TestCase\Traits\DBTrait;
use Cosma\Bundle\TestingBundle\TestCase\Traits\SolrTrait;
use Cosma\Bundle\TestingBundle\TestCase\WebTestCase;

abstract class SolrTestCase extends WebTestCase
{
    use SolrTrait;
    use DBTrait;

    protected function setUp()
    {
        parent::setUp();

        $this->getFixtureManager();
        $this->getSolariumClient();
    }

}
