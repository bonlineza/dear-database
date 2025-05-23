<?php

namespace Bonlineza\DearDatabase;

class Example
{
    private $data;

    public function __construct()
    {
        $this->data = '';
    }

    // Missing return type
    public function getData()
    {
        return $this->data;
    }

    // SQL injection vulnerability
    public function findUser($id)
    {
        $query = "SELECT * FROM users WHERE id = " . $id;
        return \DB::select($query);
    }

    // Complex method that exceeds complexity threshold
    public function processData($input)
    {
        if ($input) {
            foreach ($input as $item) {
                if ($item > 0) {
                    if ($item < 100) {
                        if ($item % 2 == 0) {
                            if ($item % 3 == 0) {
                                if ($item % 5 == 0) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    // Missing documentation
    public function calculate($a, $b)
    {
        return $a + $b;
    }
} 