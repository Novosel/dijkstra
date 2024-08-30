<?php
require_once 'class/Dijkstra.php';

$points = [
  'A' => ['B' => 15, 'C' => 9, 'E' => 7],
  'B' => ['A' => 15, 'C' => 2, 'D' => 5],
  'C' => ['A' => 9, 'B' => 2, 'D' => 1],
  'D' => ['B' => 5, 'C' => 1, 'E' => 2],
  'E' => ['A' => 7, 'C' => 3, 'D' => 2],
];

$dijkstra = new Dijkstra();
$dijkstra->addPoints($points);
$path = $dijkstra->findPath('A', 'D');

echo (is_array($path) ? 'Closest path: ' . implode(' -> ', $path) : 'Path not found') . PHP_EOL;
