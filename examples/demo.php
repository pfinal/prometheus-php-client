<?php

use Prometheus\RenderTextFormat;

require_once __DIR__ . '/../vendor/autoload.php';

//\Prometheus\CollectorRegistry::getDefault()
//    ->getOrRegisterCounter('', 'some_quick_counter', 'just a quick measurement')
//    ->inc();

$registry = \Prometheus\CollectorRegistry::getDefault();

$counter = $registry->getOrRegisterCounter('test', 'some_counter', 'it increases', ['type']);
$counter->incBy(3, ['blue']);

$gauge = $registry->getOrRegisterGauge('test', 'some_gauge', 'it sets', ['type']);
$gauge->set(2.5, ['blue']);

$histogram = $registry->getOrRegisterHistogram('test', 'some_histogram', 'it observes', ['type'], [0.1, 1, 2, 3.5, 4, 5, 6, 7, 8, 9]);
$histogram->observe(3.5, ['blue']);

$renderer = new RenderTextFormat();
$result = $renderer->render($registry->getMetricFamilySamples());

echo $result;