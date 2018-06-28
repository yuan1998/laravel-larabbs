<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\User;
use Auth;
use App\Handlers\ImageUploadHandler;


class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request , Topic $topic , User $user)
	{
		$topics = $topic->withOrder($request->order)->paginate(30);
        $active_users = $user->getActiveUsers();
		return view('topics.index', compact('topics' , 'active_users'));
	}





    /**
     * Route to topic show page
     * @param  $topic
     * @return [type]        [description]
     */
    public function show(Request $request, Topic $topic)
    {

        // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic'));
    }


	public function create(Topic $topic)
	{
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

		return redirect()->to($topic->link())->with('success', '创建文章成功.');

	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{

		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '更新成功.');

	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除成功.');
	}


    public function uploadImage (Request $request , ImageUploadHandler $upload )
    {

        $data = [
            'success' => false,
            'msg' => '上传失败',
            'file_path' => ''
        ];


        if($request->upload_file){

            $result = $upload->save($request->upload_file , 'topics' , \Auth::id(),1024);

            if($result){
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功';
                $data['success'] = true;
            }
        }

        return $data;

    }

}