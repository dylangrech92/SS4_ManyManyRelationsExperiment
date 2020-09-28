<?php

namespace {

    use SilverStripe\ORM\DataObject;
    use SilverStripe\ORM\FieldType\DBInt;
    use SilverStripe\ORM\FieldType\DBVarchar;
    use SilverStripe\ORM\ManyManyList;

    /**
     * Class ObjectB
     *
     * @method ManyManyList ObjectAs()
     */
    class ObjectC extends DataObject {

        private static $db = [
            'Title' => DBVarchar::class,
            'Sort'  => DBInt::class
        ];

        private static $belongs_many_many = [
            'ObjectAs' => ObjectA::class
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