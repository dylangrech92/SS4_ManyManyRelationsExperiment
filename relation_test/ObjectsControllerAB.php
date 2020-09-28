<?php

namespace {

    use SilverStripe\Control\Controller;

    class ObjectsControllerAB extends Controller {

        public function index() {
            echo "<h2>Creating relationships</h2>";
            echo "ObjectA (1) -> Object B (1) [Sort: 0]<br />";
            ObjectA::get()->byID(1)->ObjectBs()->add(ObjectB::get()->byID(1), ['Sort' => 0]);
            echo "ObjectA (1) -> Object B (2) [Sort: 1]<br />";
            ObjectA::get()->byID(1)->ObjectBs()->add(ObjectB::get()->byID(2), ['Sort' => 1]);
            echo "ObjectA (1) -> Object B (3) [Sort: 2]<br />";
            ObjectA::get()->byID(1)->ObjectBs()->add(ObjectB::get()->byID(3), ['Sort' => 2]);
            echo "ObjectA (2) -> Object B (1) [Sort: 2]<br />";
            ObjectA::get()->byID(2)->ObjectBs()->add(ObjectB::get()->byID(1), ['Sort' => 2]);
            echo "ObjectA (2) -> Object B (2) [Sort: 1]<br />";
            ObjectA::get()->byID(2)->ObjectBs()->add(ObjectB::get()->byID(2), ['Sort' => 1]);
            echo "ObjectA (2) -> Object B (3) [Sort: 0]<br />";
            ObjectA::get()->byID(2)->ObjectBs()->add(ObjectB::get()->byID(3), ['Sort' => 0]);



            // Test we can get the relationship left to right
            echo "<h2>Loop  ObjectA::ObjectBs()</h2>";
            $left = ObjectA::get()->first();
            foreach ($left->ObjectBs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort} <br />";
            }

            // Test we can get the relationship right to left
            echo "<h2>Loop ObjectB::ObjectAs()</h2>";
            $left = ObjectB::get()->first();
            foreach ($right->ObjectAs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
            }

            // Test fetching in a loop Left to right
            echo "<h2>Loop ObjectA::ObjectBs() and fetch reverse with every iteration</h2>";
            $left = ObjectA::get()->first();
            foreach ($left->ObjectBs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
                foreach ($right->ObjectAs() as $reverse) {
                    echo "&nbsp;&nbsp; Reverse Title: {$reverse->Title}, Sort: {$right->Sort}<br />";
                }
            }

            // Test fetching in a loop right to left
            echo "<h2>Loop ObjectB::ObjectAs() and fetch reverse with every iteration</h2>";
            $left = ObjectB::get()->first();
            foreach ($left->ObjectAs() as $right) {
                echo "Left Title: {$left->Title}, Right Title: {$right->Title}, Sort: {$right->Sort}<br />";
                foreach ($right->ObjectBs() as $reverse) {
                    echo "&nbsp;&nbsp; Reverse Title: {$reverse->Title}, Sort: {$right->Sort}<br />";
                }
            }
        }

    }

}