<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Checkout as MyModel;

class CheckoutController extends ApiController
{

    public function store(Request $request)
    {
        $rules = ['user_id' => 'required|exists:users,id', 'book_id' => 'required|exists:books,id'];

        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $input = $request->all();
            $bookingCount = MyModel::where('book_id', $request->book_id)->whereNull('return_date')->get()->count();
            $booksCopyCount = Book::whereId($request->book_id)->value('copies');
            // dd($bookingCount,$booksCopyCount,($bookingCount >= (int) $booksCopyCount));
            if ($bookingCount >= (int) $booksCopyCount)
                return parent::error('No More Checkout for this book');
            $input['checkout_date'] = Carbon::now()->format('Y-m-d');
            $books = MyModel::create($input);
            $books->save();
            return parent::successCreated(['message' => 'Booking Created Successfully', 'data' => $books]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    public function destroy(Request $request, $id)
    {
        $rules = [];

        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            if (MyModel::whereId($id)->whereNull('return_date')->get()->isEmpty())
                return parent::error('Booking not found');
            $input['return_date'] = Carbon::now()->format('Y-m-d');
            MyModel::findOrFail($id)->update($input);
            return parent::success(['message' => 'Book returned Successfully']);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
}