<form class="form-horizontal" method="post" action="">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名</label>

        <div class="col-sm-5">
            <input type="text" name="Student[user_nickname]" class="form-control" id="name" placeholder="请输入学生姓名" value="{{ old('Student')['user_nickname'] ? old('Student')['user_nickname'] : $student->user_nickname }}">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.user_nickname') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">remark</label>

        <div class="col-sm-5">
            <input type="text" name="Student[remark]" class="form-control" id="age" placeholder="请输入学生年龄" value="{{ old('Student')['remark'] ?  old('Student')['remark'] : $student->remark}}">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.remark') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">性别</label>
        <div class="col-sm-5">
        	@foreach($student->sexs() as $ind=>$val)
                <label class="radio-inline">
                    <input type="radio" name="Student[sex]" value="{{ $ind }}"
					{{ isset($student->sex) && $student->sex == $ind ? 'checked' : ''  }}
                    > {{ $val }}
                </label>
            @endforeach
     <!--        <label class="radio-inline">
                <input type="radio" name="Student[sex]" value="1"
				@if (old('Student')['sex'] == 1)
					checked
				@endif
                > 男
            </label>
            <label class="radio-inline">
                <input type="radio" name="Student[sex]" value="2"
				@if (old('Student')['sex'] == 2)
					checked
				@endif
                > 女
            </label> -->
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('Student.sex') }}</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
    {{  csrf_field() }}
</form>