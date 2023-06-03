@extends('admin.layouts.master')
@section('title', 'Chat - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Chat';
$data['title'] = 'Chat';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
    <div class="row">
        <div class="col-lg-12">
            <div class="chat-main-block">
                <div class="card dashboard-card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title"><i class="feather icon-message-circle"></i>My Chats ({{$conversations->count()}})</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                @forelse($conversations as $chat)
                                <div class="shadow-sm card mb-3 border chat-conversation">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="chat-conversation-block">
                                                    <h5 class="box-title">Conversation ID</h5>
                                                    <a href="{{ route('chat.screen',$chat->conv_id) }}">{{ $chat->conv_id }}</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="chat-conversation-block">
                                                    <h5 class="box-title">Conversation with</h5>
                                                    <p>{{ $chat->sender_id == auth()->id() ? $chat->reciever->fname.' '.$chat->reciever->lname : $chat->sender->fname.' '.$chat->sender->lname }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="chat-conversation-block">
                                                    <h5 class="box-title">Last Message</h5>
                                                    <span> <b>{{ !empty( $chat->chat->last() ) ? $chat->chat->last()->message : "No "  }}</b> {{ __('from') }} {{ !empty( $chat->chat->last() ) ? $chat->chat->last()->user->name : '' }} - {{ !empty( $chat->chat->last() ) ? $chat->chat->last()->created_at->format('jS M Y - h:i A') : '' }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <h4 class="no_conv text-center text-muted">
                                    <i class="feather icon-message-circle"></i> {{__("Start a new conversation")}}
                                </h4>
                                @endforelse
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="chat-list">
                                    <div class="chat-search">
                                        <form>
                                            <div class="input-group">
                                                <input type="search" class="form-control" placeholder="Search" name="user" aria-label="Search" aria-describedby="button-addon3">
                                                <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon3"><i class="feather icon-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="chat-user-list scroll-down">
                                        <ul class="list-unstyled mb-0">
                                            @foreach($users as $user)
                                            <a href="{{ route('chat.start',$user->id) }}">
                                                <li class="media">
                                                    @if($user->user_img != '' && file_exists(public_path().'/images/user_img/'.$user->user_img))
                                                        <img class="align-self-center mr-3 rounded-circle" src="{{ url('images/user_img/'.$user->user_img) }}"/>
                                                    @else 
                                                        <img class="align-self-center mr-3 rounded-circle" src="{{ Avatar::create($user->fname)->toBase64() }}"/>
                                                    @endif
                                                    <div class="media-body">
                                                        <h5>{{$user->fname}} {{$user->lname}}</h5>
                                                        <p>{{ucfirst($user->role)}}</p>
                                                    </div>
                                                </li>
                                            </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
