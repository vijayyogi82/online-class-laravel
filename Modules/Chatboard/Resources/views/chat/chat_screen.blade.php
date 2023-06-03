@extends('admin.layouts.master')
@section('title', 'Chat - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Chat';
$data['title'] = 'Chat Screen';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
	<div class="row">
		<div class="col-md-12 m-b-30 dashboard-card">
			<div class="card">
				<div class="card-header">
					<a title="Back" href="{{ url()->previous() }}" class="ml-2 float-right btn btn-md btn-primary-rgba">
						<i class="feather icon-arrow-left" aria-hidden="true"></i> {{ __("Back") }}
					</a>
                    <div class="card-title">
                        <span class="text-dark">{{ __('Chat with :user',['user' => $reciever->name]) }}</b> </span>
                    </div>
				</div>

				<div class="card-body">
                    <div class="row">
                         <!-- Start col -->                       
                        <div class="col-lg-12 col-xl-12">       
                            <div class="chat-detail">
                                <div class="chat-head">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">

                                            @if($reciever->user_img != '' &&
                                            file_exists(public_path().'/images/user_img/'.$reciever->user_img))
                                            <img width="50px" src="{{url('images/user_img/'.$reciever->user_img)}}" alt="profilephoto" class="img-fluid align-self-center mr-3 rounded-circle">
                                            @else
                                            <img width="50px" src="{{ Avatar::create($reciever->name)->toBase64() }}" alt="profilephoto" class="img-fluid align-self-center mr-3 rounded-circle">
                                            @endif
                                            <div class="media-body">
                                                <h5 class="font-18">
                                                    {{ $reciever->fname }} {{ $reciever->lname }}
                                                </h5>
                                                <p class="indicators_status"></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div style="max-height: 300px;overflow-y : scroll;" id="chat-body" class="chat-body" onmouseover="get_live_chat()">
                                    @forelse($conversation->chat as $chat)                                       
                                       
                                            <div class="chat-message {{ $chat->user_id == auth()->id() ? "chat-message-right" : "chat-message-left" }}">
                                                <div class="chat-message-text">
                                                    @if($chat->type == 'media')
                                                        <a href="{{ url('images/conversations/'.$chat->media) }}" data-lightbox="image-1" data-title="{{ $chat->media }}">    
                                                            <img src="{{ url('images/conversations/'.$chat->media)  }}" alt="{{ $chat->media }}" width="300px" class="img-fluid img-thumbnail">
                                                        </a>
                                                    @else 
                                                        <span>
                                                            {{$chat->message}}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="chat-message-meta">
                                                    <small>{{ $chat->created_at->format('d-m-Y - h:i A') }}
                                                        @if($chat->user_id == auth()->id())
                                                        <i class="feather icon-check ml-2 {{$chat->status=='Seen'?"text-info":''}}"></i>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>       
                                             @empty 
                                             <h4 class="no_conv text-center text-muted">
                                            <i class="feather icon-message-circle"></i> {{__("Start a conversation with ")}} {{ $reciever->name }}
                                        </h4>

                                    @endforelse
                                    <div class="chatscreen">
                                    </div>
                                </div>
                                <div class="chat-bottom">
                                    <div class="chat-messagebar">
                                        <form class="chatform" id="chatform" action="javascript:void(0)" enctype="multipart/form-data">

                                            <div class="input-group">
                                                <input required autofocus type="text" name="message" class="typemessage form-control" placeholder="Type a message..." aria-label="Text">
                                                <div class="input-group-append">
                                                    <input accept="image/*" type="file" name="media" class="file_choose form-control">
                                                    <button class="btn btn-round btn-secondary-rgba" type="button" id="button-addonlink"><i class="feather icon-image"></i></button>
                                                    <button class="sendMessage btn btn-round btn-primary-rgba" type="button" id="button-addonsend"><i class="feather icon-send"></i></button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    setTimeout(() => {
        scrolldown();
    }, 1000);

    function scrolldown(){
        $('body').css('overflow','auto');
        var objDiv = document.getElementById("chat-body");
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    var rec = {{ $conversation->sender_id == auth()->id() ? $conversation->receiver_id : $conversation->sender_id }};
    var conv_id = "{{ $conversation->id }}";
    var conver_id = "{{ $conversation->conv_id }}";
    var id = {{ auth()->id() }};

    $('.sendMessage').on('click',function(){

        if($('.file_choose').val() == '' && $('.typemessage').val() == ''){
            alert('Message or media is required !');
            return false;
        }

        "use Strict";
        message();
        
    });

    $('.chatform').on('submit',function(){

        "use Strict";

        message();

    });

    $('#button-addonlink').on('click',function(){
        $('.file_choose').click();
    });

    $('.file_choose').on('change', function(e) {
        if (!confirm("are you sure want to sent this file "+ e.target.files[0].name+'?')) {
            e.preventDefault();
            $('.file_choose').val('');
        }else{
            message();
            $('.file_choose').val('');
        }
    });

    function message(){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData =  new FormData($('#chatform')[0]);

        formData.append('rec_id',rec);

        $.ajax({
            method : 'POST',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url  : '{{ route('send.message',$conversation->id) }}',
            dataType : 'json',
            data : formData,
            cache : false,
            contentType: false,
            processData: false,
            success : function(response){

                if(response.status == 'success'){
                    $('.typemessage').val('');
                    get_live_chat();
                }else{
                    alert('Failed to sent message: '+response.message);
                    return false;
                }
            }
        });

        
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    function get_live_chat() {
        $.ajax({
            method : 'POST',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url  : '{{(route('get.live.chat',$conversation->conv_id))}}',
            dataType : 'json',
            cache : false,
            contentType: false,
            processData: false,
            success : function(response){
                $('#chat-body').html(response.chat_model);
            }
        });
    }
    var channel = '';
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
</script>
@endsection