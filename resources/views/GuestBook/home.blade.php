@extends('GuestBook.layout')

@section('title', 'GuestBooker')

@section('content')
    @if (count($errors) > 0)
        <div class="container">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('send') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Имя<span style="color:red">*</span>:</label>
                        <input class="form-control form-control-sm" id="name" name="name" type="text" @guest value="{{ old('name') }}" @else value="{{ auth()->user()->name }}" readonly @endguest>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span style="color:red">*</span>:</label>
                        <input class="form-control form-control-sm" id="email" name="email" type="text" @guest value="{{ old('email') }}" @else value="{{ auth()->user()->email }}" readonly @endguest>
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input class="form-control form-control-sm" id="url" name="url" type="text" value="{{ old('url') }}">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="hidden_email" name="hidden_email" type="checkbox" value="1" @if(old('hidden_email')) checked @endif>
                        <label class="form-check-label" for="hidden_email">Не показывать email</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="notify_email" name="notify_email" type="checkbox" value="1" @if(old('notify_email') || count($errors) == 0) checked @endif>
                        <label class="form-check-label" for="notify_email">Уведомить об ответе по Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="message">Сообщение<span style="color:red">*</span>:</label>
                        <textarea class="form-control" name="text" id="message" rows="7">{{ old('message') }}</textarea>
                    </div>
                    <button class="btn btn-lg" style="background-color: #8d8d8d">Отправить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container my-4" style="border: 1px solid #c4c4c4;">
        @foreach($messages as $message)
            <div class="mx-2 my-3">
                <div class="row">
                    <div class="col-md-12" style="border: 1px solid #c4c4c4;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Имя:</b> {{ $message->name }}
                                    </div>
                                    @if(!$message->hidden_email)
                                        <div class="col-md-12">
                                            <b>Email:</b> {{ $message->email }}
                                        </div>
                                    @endif
                                    @if($message->url)
                                        <div class="col-md-12">
                                            <b>URL:</b> {{ $message->url }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Сообщение:</b> {{ $message->text }}
                                    </div>
                                    <div class="col-md-12" style="color: #c4c4c4">
                                        {{ date('H:i | d.m.Y', strtotime($message->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $messages->links() }}
    </div>
@endsection
