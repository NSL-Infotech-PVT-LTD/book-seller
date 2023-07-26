<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book as MyModel;

class BookController extends ApiController
{
    public function index(Request $request)
    {
        $rules = ['page' => '', 'limit' => ''];

        $validateAttributes = parent::validateAttributes($request, 'GET', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $model = new MyModel();
            $model = $model->paginate((isset($request->limit) ? $request->limit : 10));
            return parent::success(['message' => 'Book list', 'data' => $model]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    public function store(Request $request)
    {
        $rules = ['title' => 'required', 'author' => 'required', 'isbn' => 'required', 'published_at' => 'required', 'copies' => 'required'];

        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $input = $request->all();
            $books = MyModel::create($input);
            $books->save();
            return parent::successCreated(['message' => 'Book Created Successfully', 'data' => $books]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $rules = ['title' => 'required', 'author' => 'required', 'isbn' => 'required', 'published_at' => 'required', 'copies' => 'required'];

        $validateAttributes = parent::validateAttributes($request, 'PUT', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $input = $request->all();
            $books = MyModel::findOrFail($id)->update($input);
            return parent::successCreated(['message' => 'Updated Successfully', 'data' => $books]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    public function show(Request $request)
    {

        try {
            $books = Book::get();
            if ($books->isEmpty()) {
                return parent::error('Sorry You Are At Wrong Place');

            } else {
                return parent::success(['story' => $books]);
            }

        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $rules = [];
        $validateAttributes = parent::validateAttributes($request, 'DELETE', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            if (MyModel::whereId($id)->get()->isEmpty())
                return parent::error('Book not found');

            MyModel::destroy($id);
            return parent::success(['message' => 'Book Deleted Successfully']);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
}