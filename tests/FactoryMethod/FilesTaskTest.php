<?php

declare(strict_types=1);

namespace CodeMyMind\DesignPatterns\Tests\FactoryMethod;

use CodeMyMind\DesignPatterns\FactoryMethod\FilesTask;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**s
 * @covers FilesTask
 */
class FilesTaskTest extends TestCase
{
    private array $rows;
    private FilesTask $filesTask;

    public function setUp(): void
    {
        $this->rows = [
            [
                'row-1,element1',
                'row-1,element2'
            ],
            [
                'row-2,element1',
                'row-2,element2'
            ]
        ];
        $this->filesTask = new FilesTask();
    }

    public function testXml(): void
    {
        $fileName = 'xml-test.xml';
        $this->filesTask->saveRowsToFile('xml', $fileName, $this->rows);
        $this->assertSame(sha1_file($fileName), sha1_file(__DIR__ . '/Files/xml-expected-result.xml'));
        unlink($fileName);
    }

    public function testCsv(): void
    {
        $fileName = 'csv-test.csv';
        $this->filesTask->saveRowsToFile('csv', $fileName, $this->rows);
        $this->assertSame(sha1_file($fileName), sha1_file(__DIR__ . '/Files/csv-expected-result.csv'));
        unlink($fileName);
    }

    public function testUnknownFileTy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->filesTask->saveRowsToFile('unknown-file-type', 'unknown-file', $this->rows);
    }
}
