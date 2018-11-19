<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Member;
use Illuminate\Support\Facades\Db;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class StudentController extends BaseController
{
    public function delete(Request $request, $id)
    {
        $student =  Student::find($id);
        if ($student->delete()) {
            return redirect('student/index')->with('success', '删除成功-'.$id);
        } else {
            return redirect('student/index')->with('error', '删除失败-'.$id);            
        }
    }

    public function detail(Request $request, $id)
    {
        $student =  Student::find($id);
        return view('student.detail', array(
            'student' => $student,
        ));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'Student.user_nickname' => 'required|min:2|max:20',
                'Student.remark' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须是整数',
            ], [
                'Student.user_nickname' => '姓名',
                'Student.remark' => 'remark',
                'Student.sex' => '性别',
            ]);

            $data = $request->input('Student');
            $student->user_nickname = $data['user_nickname'];
            $student->remark = $data['remark'];
            $student->sex = $data['sex'];
            if ($student->save()) {
                return redirect('student/index')->with('success', '修改成功-'.$id);
            }
        }
        return view('student.update', array(
            'student' => $student,
        ));
    }


    public function create(Request $request)
    {   
        $student = new Student();
        if ($request->isMethod('POST')) {
            //控制器验证
            // $this->validate($request, [
            //     'Student.user_nickname' => 'required|min:2|max:20',
            //     'Student.remark' => 'required|integer',
            //     'Student.sex' => 'required|integer',
            // ], [
            //     'required' => ':attribute 为必填项',
            //     'min' => ':attribute 长度不符合要求',
            //     'max' => ':attribute 长度不符合要求',
            //     'integer' => ':attribute 必须是整数',
            // ], [
            //     'Student.user_nickname' => '姓名',
            //     'Student.remark' => 'remark',
            //     'Student.sex' => '性别',
            // ]);

            //2 validator 类验证
            $validator = \Validator::make($request->input(), [
                'Student.user_nickname' => 'required|min:2|max:20',
                'Student.remark' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须是整数',
            ], [
                'Student.user_nickname' => '姓名',
                'Student.remark' => 'remark',
                'Student.sex' => '性别',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('Student');
            $student = new Student();
            $student->user_nickname = $data['user_nickname'];
            $student->remark = $data['remark'];
            $student->sex = $data['sex'];
            $student->create_time = time();

            if ($student->save()) {
                return redirect('student/index')->with('success', '添加成功');
            } else {
                return redirect()->back();
            }
        }
        return view('student.create', [
            'student' => $student,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->input('Student');
        $student = new Student();
        $student->user_nickname = $data['user_nickname'];
        $student->remark = $data['remark'];
        $student->sex = $data['sex'];
        $student->create_time = time();

        if ($student->save()) {
            return redirect('student/index')->with('success', '添加成功');
        } else {
            return redirect()->back()->with('success', '添加失败');
        }
    }

    public function test1() {
        // $uses = Db::select('select * from cmf_user');

        // $uses = Db::update('update cmf_user set birthday = ? where id = ?', [500, 1]);
        // // $uses = Db::insert('insert into cmf_user(birthday, user_nickname) values(?, ?)',  [6999, '测试石盾']);
        // $uses = Db::delete('delete from cmf_user where id =?', [33]);
        // var_dump($uses);exit();
    }

    //使用pdo对数据进行操作自动防止了sql注入问题
    //使用查询构造器添加数据
    public function query()
    {
        //插入数据
        // $bool = Db::table('cmf_user')->insert([
        //  'user_nickname' => '侧事故事故的一',
        //  'birthday' => 1111,
        // ]);
        // var_dump($bool);

        //插入数据
        // $id = Db::table('cmf_user')->insertGetId([
        //  'user_nickname' => '侧事故事故的2',
        //  'birthday' => 2222,
        // ]);

        //插入多条数据
        // $bool = Db::table('cmf_user')->insert([
        //  ['user_nickname' => '侧事故事故的3', 'birthday' => 3333],
        //  ['user_nickname' => '侧事故事故的4', 'birthday' => 4444]
        // ]);      
        // var_dump($bool);
    }

    public function query2()
    {
        // $num = Db::table('cmf_user')
        // ->where('id', 37)
        // ->update(['birthday' => '0000']);
        // var_dump($num);

        //默认自增1
        // $num = Db::table('cmf_user')->where('id', 37)->increment('birthday');

        //自增3
        // $num = Db::table('cmf_user')->where('id', 37)->increment('birthday', 3);

        //自减默认1
        // $num = Db::table('cmf_user')->where('id', 37)->decrement('birthday');

        //自减2 并改变user_nickname为ssss
        // $num = Db::table('cmf_user')->where('id', 37)->decrement('birthday', 2, ['user_nickname' => 'sssss']);
        // var_dump($num);
    }

    //使用查询构造器删除数据
    public function query3()
    {
        // $num = Db::table('cmf_user')->where('id', '>', 37)->delete();
        // var_dump($num);
    }

    public function query4()
    {
        //返回所有记录
        // $users = Db::table('cmf_user')->get();

        //返回第一条记录
        // $users = Dbb::table('cmf_user')
        // ->orderBy('id', 'desc')
        // ->first();

        // $users = Db::table('cmf_user')
        // ->where('id', '>=', 33)
        // ->get();

        //where多个条件
        // $users = Db::table('cmf_user')
        // ->whereRaw('id >= ? and irthday > ?', [3, 10])
        // ->get();

        // pluck 查出单个字段
        // $users = Db::table('cmf_user')
        // ->where('id', '>', 30)
        // ->pluck('user_nickname');

        //select 指定查找
        // $users = Db::table('cmf_user')
        // ->where('id', '>', 30)
        // ->select('id', 'user_nickname')
        // ->get();

        //chunk
        // echo "<pre>";
        // $users = Db::table('cmf_user')
        // ->chunk(2, function($user) {
        //         var_dump($user);
        // });
    }

    //聚合函数
    public function query5()
    {
        // $num = Db::table('cmf_user')->count();

        $max = Db::table('cmf_user')->max('birthday');

        $min = Db::table('cmf_user')->min('birthday');

        //avg平均数
        $avg = Db::table('cmf_user')->avg('birthday');

        $sum = Db::table('cmf_user')->sum('birthday');
        var_dump($sum);
    }

    public function orm1()
    {
        //all() 查询表的所有记录
        $students = Student::all();

        $student = Student::find(1);

        //findOrFail()  找不到抛异常
        // $student2 = Student::findOrFail(1111);

        $students = Student::get();
        $num = Student::where('id', '>', 2)->count();

        var_dump($num);exit();
    }

    public function orm2()
    {
        //使用模型新增数据
        // $student = new Student();
        // $student->user_nickname = 'shisss';
        // $student->birthday = '444444';
        // $bool = $student->save();
        // var_dump($bool);
        
        // $student = Student::find(1);
        // var_dump($student['id']);

        //使用模型的create方法新增数据
        // $student = Student::create([
        //     'user_nickname' => 'xiaoshi',
        //     'birthday' => 10001
        // ]);
        // var_dump($student);
    
        //firstOrCreate()
        // $student = Student::firstOrCreate([
        //     'user_nickname' => 'xiaoshi2'
        // ]);

        //firstOrNew()
        // $student = Student::firstOrNew([
        //     'user_nickname' => 'xiaoshi3'
        // ]);
        // $bool = $student->save();
        // var_dump($bool);
    }

    public function orm3()
    {
        //通过模型更新数据
        // $student = Student::find(41);
        // $student->user_nickname = '22121';
        // $bool = $student->save();
        
        $num = Student::where('id', '41')->update(['user_nickname'=>'shidunaaa']);
        var_dump($num);
    }

    public function orm4()
    {
        //通过模型删除
        // $student = Student::find(41);
        // $bool = $student->delete();
        // var_dump($bool);

        //通过主键删除
        // $num = Student::destroy(40);

        // $num = Student::destroy(39, 38);

        // $num = Student::destroy([37, 36]);
        // var_dump($num);

        //删除指定条件数据
        $num = Student::where('id','>','34')->delete();
        var_dump($num);
    }

    public function section1()
    {
        $name = 'shidun';
        $arr = ['shidun', 'aaaa'];
        $users = Student::get();
        $users = array();
        return view('student.section1', array(
            'name' => $name,
            'arr' => $arr,
            'users'=>$users
        ));
    }

    public function urlTest()
    {
        var_dump(111);exit();
    }

    public function request1(Request $request)
    {
        //1.取值
        // $param = $request->input('name2', 'ssss');
        // var_dump($param);

        // if ($request->has('name')) {
        //     var_dump($request->input('name', 'ssss'));
        // } else {
        //     echo "没有参数";
        // }

        // $res = $request->all();
        // var_dump($res);

        //2.判断请求类型
        // $me = $request->method();
        // var_dump($me);

        // if ($request->isMethod('POST')) {
        //     var_dump('yes');
        // } else {
        //     var_dump('no');
        // }

        //判断是否是ajax请求
        $res = $request->ajax();
        var_dump($res);

        $res = $request->is('student/*');
        var_dump($res);

        var_dump($request->url());

    }

    public function session1(Request $request)
    {
        //1 http request session()
        // $request->session()->put('key1', 'value1');
        // echo $request->session()->get('key1');

        //2 session()
        // session()->put('key2', 'value2');
        // echo session()->get('key1');

        //3 Session 

        //存储数据到session
        // Session::put('key3', 'value3');

        //获取session的值 不存在取默认值
        // echo Session::get('key3', 'default');

        // Session::put(['key4'=>'value4']);
        //已数组的形式存储数据
        // echo Session::get('key4', 'default');

        // //把数据放到session的数组中
        // Session::push('student', 'shidun');
        // Session::push('student', 'licheng');

        // // $res = Session::get('student', 'default');

        // //取完就删除
        // $res = Session::pull('student', 'default');
        // var_dump($res);

        //取出所有的值
        // $res = Session::all();
        // dump($res);

        //判断session中某个key是否存在
        // if (Session::has('key1')) {
        //     $res = Session::all();
        //     var_dump($res);
        // } else {
        //     echo "不存在";
        // }

        //删除指定的session
        // Session::forget('key1');

        // $res = Session::all();
        // var_dump($res);

        //删除所有session
        // Session::flush();

        //暂存数据
        // Session::flash('key-flash', 'aaaaa');
        // echo Session::get('key-flash');
    }

    public function session2(Request $request)
    {
        return Session::get('message', 'wu');
        // return 111;
    }


    public function responses()
    {
        //响应json
        // $data = [
        //     'errorCode' => 0,
        //     'errMs' => 'success',
        //     'data' => 'shidun'
        // ];
        // return response($data);

        //重定向
        // return redirect('session2');

        // return redirect('session2')->with('message', '我是快闪数据');

        //action()
        // return redirect()->action('StudentController@session2')->with('message', '我是快闪数据');

        //route()
        // return redirect()->route('session2')->with('message', '我是快闪数据');

        //返回上一个页面
        return redirect()->back();
    }

    //活动的宣传页面
    public function activity0()
    {
        return '活动快要开始了，尽情期待';

    }

    //活动的宣传页面
    public function activity1()
    {
        return '活动进行中，参与活动1';

    }

    //活动的宣传页面
    public function activity2()
    {
        return '活动进行中，参与活动2';

    }

    public function index()
    {
        $students = Student::paginate(5);
        return view('student.index', array(
            'students' => $students,
        ));
    }


}