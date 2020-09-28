<?php

namespace {

    use SilverStripe\ORM\DataObject;
    use SilverStripe\ORM\FieldType\DBInt;
    use SilverStripe\ORM\FieldType\DBVarchar;
    use SilverStripe\ORM\ManyManyList;

    /**
     * Class ObjectA
     *
     * @method ManyManyList ObjectBs()
     */
    class ObjectA extends DataObject {

        private static $db = [
            'Title' => DBVarchar::class
        ];

        private static $many_many = [
            'ObjectBs' => ObjectB::class,
            'ObjectCs' => ObjectC::class
        ];

        private static $many_many_extraFields = [
            'ObjectBs' => [
                'Sort' => DBInt::class,
            ],
            'ObjectCs' => [
                // This collides with ObjectC.Sort when building the many many relationship
                'Sort' => DBInt::class,
            ]
        ];

        public function requireDefaultRecords()
        {
            for ($i = 1; $i < 4; $i++) {
                if (!self::get()->find('Title', self::class . ' - ' . $i)) {
                    self::create([
                        'Title' => self::class . ' - ' .$i
                    ])->write();
                }
            }
        }
    }

}
