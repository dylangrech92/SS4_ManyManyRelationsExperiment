<?php

namespace {

    use SilverStripe\Control\Controller;

    class ObjectsControllerAC extends Controller {

        public function index() {
            echo "<h2>Creating relationships</h2>";
            echo "ObjectA (1) -> Object C (1) [Sort: 0]<br />";
            ObjectA::get()->byID(1)->ObjectCs()->add(ObjectC::get()->byID(1), ['Sort' => 0]);
            echo "ObjectA (1) -> Object C (2) [Sort: 1]<br />";
            ObjectA::get()->byID(1)->ObjectCs()->add(ObjectC::get()->byID(2), ['Sort' => 1]);
            echo "ObjectA (1) -> Object C (3) [Sort: 2]<br />";
            ObjectA::get()->byID(1)->ObjectCs()->add(ObjectC::get()->byID(3), ['Sort' => 2]);
            echo "ObjectA (2) -> Object C (1) [Sort: 2]<br />";
            ObjectA::get()->byID(2)->ObjectCs()->add(ObjectC::get()->byID(1), ['Sort' => 2]);
            echo "ObjectA (2) -> Object C (2) [Sort: 1]<br />";
            ObjectA::get()->byID(2)->ObjectCs()->add(ObjectC::get()->byID(2), ['Sort' => 1]);
            echo "ObjectA (2) -> Object C (3) [Sort: 0]<br />";
            ObjectA::get()->byID(2)->ObjectCs()->add(ObjectC::get()->byID(3), ['Sort' => 0]);



            // Test we can get the relationship left to right
            echo "<h2>Loop  ObjectA::ObjectCs()</h2>";
            $left = ObjectA::get()->first();
            foreach ($left->ObjectCs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort} <br />";
            }

            // Test we can get the relationship right to left
            echo "<h2>Loop ObjectC::ObjectAs()</h2>";
            $left = ObjectC::get()->first();
            foreach ($right->ObjectAs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
            }

            // Test fetching in a loop Left to right
            echo "<h2>Loop ObjectA::ObjectCs() and fetch reverse with every iteration</h2>";
            $left = ObjectA::get()->first();
            foreach ($left->ObjectCs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
                foreach ($right->ObjectAs() as $reverse) {
                    echo "&nbsp;&nbsp; Reverse Title: {$reverse->Title}, Sort: {$right->Sort}<br />";
                }
            }

            // Test fetching in a loop right to left
            echo "<h2>Loop ObjectC::ObjectAs() and fetch reverse with every iteration</h2>";
            $left = ObjectC::get()->first();
            foreach ($left->ObjectAs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
                foreach ($right->ObjectCs() as $reverse) {
                    echo "&nbsp;&nbsp; Reverse Title: {$reverse->Title}, Sort: {$right->Sort}<br />";
                }
            }
        }

    }

}