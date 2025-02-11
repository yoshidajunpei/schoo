@extends('layout.default')

@section('page-title')
        ツイート新規投稿
@endsection

@section('content')
        <div class="col-md-12">
            @if(count($errors)>0)
                <div class="alert alert-damnger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/tweets" method="post">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">ツイート本文</label>
                    <div class="col-xs-10">
                        <input type="text" name="body" class="form-control" placeholder="ツイート本文を入力してください。" value="{{old('body')}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
