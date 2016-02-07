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
     * @retry 6
     */
    public function testFailing()
    {
        //throw new \Exception('dasdas');

        $rand = rand(0, 1);

        //print_r("\n  testing rand: {$rand} \n");

        $this->assertEquals(1, $rand, 'here is failing');



        //$this->assertTrue(false, 'here fails aways' );
    }

    public function testTwoOK()
    {

        $this->assertTrue(true);
    }

}