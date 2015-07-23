<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 23.07.15
 * Time: 10:54
 */

namespace TQ\ExtDirect\Tests\Metadata;

use Doctrine\Common\Annotations\AnnotationReader;
use TQ\ExtDirect\Metadata\Driver\AnnotationDriver;

/**
 * Class ActionMetadataTest
 *
 * @package TQ\ExtDirect\Tests\Metadata
 */
class ActionMetadataTest extends \PHPUnit_Framework_TestCase
{
    public function testSerialize()
    {
        $driver          = new AnnotationDriver(new AnnotationReader(), array(__DIR__ . '/Services'));
        $reflectionClass = new\ReflectionClass('TQ\ExtDirect\Tests\Metadata\Services\Service1');
        $origMetadata    = $driver->loadMetadataForClass($reflectionClass);

        $serialized = serialize($origMetadata);
        /** @var \TQ\ExtDirect\Metadata\ActionMetadata $restoredMetadata */
        $restoredMetadata = unserialize($serialized);

        $this->assertEquals($origMetadata->isAction, $restoredMetadata->isAction);
        $this->assertEquals($origMetadata->serviceId, $restoredMetadata->serviceId);

        $this->assertEquals(count($origMetadata->methodMetadata), count($restoredMetadata->methodMetadata));
    }
}