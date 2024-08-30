<?php
require_once 'class/Dijkstra.php';

use PHPUnit\Framework\TestCase;

class DijkstraTest extends TestCase
{
  private $dijkstra;

  protected function setUp(): void
  {
    $this->dijkstra = new Dijkstra();
  }

  public function testFindPath()
  {
    $this->dijkstra->addPoints([
      'A' => ['B' => 1, 'C' => 4],
      'B' => ['A' => 1, 'C' => 2, 'D' => 5],
      'C' => ['A' => 4, 'B' => 2, 'D' => 1],
      'D' => ['B' => 5, 'C' => 1],
    ]);

    $path = $this->dijkstra->findPath('A', 'D');
    $this->assertEquals(['A', 'B', 'C', 'D'], $path);
  }

  public function testFindPathDisconnected()
  {
    $this->dijkstra->addPoints([
      'A' => ['B' => 1],
      'B' => ['A' => 2],
      'C' => ['D' => 3],
      'D' => ['C' => 4],
    ]);

    $path = $this->dijkstra->findPath('A', 'D');
    $this->assertNull($path);
  }

  public function testFindPathNoPath()
  {
    $this->dijkstra->addPoints([
      'A' => ['C' => 1],
      'B' => ['B' => 2],
      'C' => ['A' => 3]
    ]);

    $path = $this->dijkstra->findPath('A', 'D');
    $this->assertNull($path);
  }
}
