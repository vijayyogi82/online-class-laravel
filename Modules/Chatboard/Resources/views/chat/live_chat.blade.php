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