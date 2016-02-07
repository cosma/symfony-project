<?php
/**
 * This file is part of the symfony-project project
 *
 * (c) Cosmin Voicu<cosmin.voicu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 23/10/15
 * Time: 08:11
 */

namespace AppBundle\Tests;

/**
 * retry 20
 */
class RetryTest extends \Cosma\Bundle\TestingBundle\TestCase\SimpleTestCase
{

    public function testOneOK()
    {
        $this->assertTrue(true);
    }

    /**
     * @retry 10
     */
    public function testFailing()
    {
        $rand = rand(0, 1);

        $this->assertEquals(1, $rand, 'here is failing');
    }

    public function testTwoOK()
    {
        $this->assertTrue(true);
    }

}