<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        $data = [
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $posts
        ];
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'Masukkan Title Post!',
            'content.required' => 'Masukkan Content Post!'
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'message' => 'Silahkan isi form dengan benar',
                'data' => $validator->errors(),
            ];
            return response()->json($data, 400);
        } else {
            $simpan = [
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ];
            $post = Post::create($simpan);

            if ($post) {
                $data = [
                    'success' => true,
                    'message' => 'Post berhasil disimpan',
                ];
                return response()->json($data, 200);
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Post gagal disimpan',
                ];
                return response()->json($data, 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();
        if ($post) {
            $data = [
                'success' => true,
                'message' => 'Detail post',
                'data' => $post
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Post tidak ditemukan',
                'data' => ''
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Masukkan Title Post!',
            'content.required' => 'Masukkan Content Post!'
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'message' => 'Silahkan isi form dengan benar',
                'data' => $validator->errors(),
            ];
            return response()->json($data, 400);
        } else {
            $update = [
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ];
            $post = Post::whereId($id)->update($update);

            if ($post) {
                $data = [
                    'success' => true,
                    'message' => 'Post berhasil diupdate',
                ];
                return response()->json($data, 200);
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Post gagal diupdate',
                ];
                return response()->json($data, 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            $data = [
                'success' => true,
                'message' => 'Post berhasil dihapus',
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Post gagal dihapus',
            ];
            return response()->json($data, 404);
        }
    }
}
