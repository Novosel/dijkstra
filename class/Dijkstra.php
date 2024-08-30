<?php

class Dijkstra
{
    private $points = [];

    public function addPoints(array $points)
    {
        $this->points = $points;
    }

    public function findPath($from, $to)
    {
        $distances = [];
        $previous = [];
        $unvisited = [];

        foreach (array_keys($this->points) as $point) {
            $distances[$point] = PHP_INT_MAX;
            $previous[$point] = null;
            $unvisited[$point] = true;
        }
        $distances[$from] = 0;

        while (!empty($unvisited)) {
            $minDistance = PHP_INT_MAX;
            $current = null;

            foreach (array_keys($unvisited) as $point) {
                if ($distances[$point] < $minDistance) {
                    $minDistance = $distances[$point];
                    $current = $point;
                }
            }

            if ($minDistance === PHP_INT_MAX) {
                break;
            }

            if ($current === $to) {
                $path = [];
                while ($previous[$current] !== null) {
                    array_unshift($path, $current);
                    $current = $previous[$current];
                }
                array_unshift($path, $from);
                return $path;
            }

            foreach ($this->points[$current] as $neighbor => $weight) {
                $distance = $distances[$current] + $weight;
                if (isset($distances[$neighbor]) && $distance < $distances[$neighbor]) {
                    $distances[$neighbor] = $distance;
                    $previous[$neighbor] = $current;
                }
            }

            unset($unvisited[$current]);
        }

        return null;
    }
}
