<?php

namespace App\Actions\PayJp;

use Illuminate\Http\Request;

interface PayJpInterface
{
    /**
     * Return result of payment by Pay jp
     *
     * @param int
     * @param \Illuminate\Http\Request
     *
     * @return object
     */
    public function Payment(int $price, string $pay_jp_id): object;

    /**
     * Refund already finished payment
     *
     * @param string
     *
     * @return object
     */
    public function Refund(string $pay_jp_id): object;
}