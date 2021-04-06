<?php

namespace App\Tests\Unit;

use App\Serializer\HttpErrorNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HttpErrorNormalizerTest extends TestCase
{
    /**
     * @var HttpErrorNormalizer
     */
    private $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = new HttpErrorNormalizer();

        parent::setUp();
    }

    public function testNormalize(): void
    {
        $exception = FlattenException::create(
            new NotFoundHttpException('test')
        );

        $expectedOutput = [
            'exception' => [
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ],
        ];

        $output = $this->normalizer->normalize($exception);

        self::assertSame($expectedOutput, $output);
    }

    public function testSupportsNormalization(): void
    {
        $exception = new \Exception('test');

        self::assertFalse($this->normalizer->supportsNormalization($exception));

        $exception = FlattenException::create(
            new \Exception('test')
        );

        self::assertTrue($this->normalizer->supportsNormalization($exception));
    }
}
