function lastmessage() {
    var objDiv = document.getElementById( "chat"); 
    objDiv.scrollTop=objDiv.scrollHeight;
}

function loadUserMesssages(){
    let userId = $('#selected-user-id').val()
    $.ajax({
        url: 'load-messages?sender_id='+userId,
        method: "GET",
        dataType: 'json',
        success: function (data) {
            $('#chat-area').html('')
            for(let j in data){
                let message = data[j];
                let time = new Date(message.updated_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                let msgClass = message.sender_id == userId ? 'justify-start' : 'justify-end'
                let delIcon = ''
                if(msgClass == 'justify-end') {
                    delIcon = '<span class="block text-xs text-right ml-2 mt-2 cursor-pointer delMsg" data-msgid="'+message.id+'">X</span>';
                }
                $('#chat-area').append('<div class="w-full flex msgBox '+msgClass+'"><div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;"><span class="block">'+message.text+'</span><span class="block text-xs text-right">'+time+'</span></div>'+delIcon+'</div>');
            }
            lastmessage()
            markAsReadMessage()
        }
    });
}

function markAsReadMessage(){
    let userId = $('#selected-user-id').val()
    $.ajax({
        url: 'mark-as-read-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), sender_id : userId},
        success: function (data) {}
    });
}

function checkNewMessages(){
    $.ajax({
        url: 'check-messages',
        method: "GET",
        dataType: 'json',
        success: function (data) {
            $('.message-count').remove();
            if(data['new_messages']){
                for(let j in data['new_messages']){
                    let update = data['new_messages'][j]
                    $('#message-count-'+ update.sender_id).html('<span class="block ml-2 text-sm text-gray-600 message-count border rounded">'+update.message_count+'</span>');
                    if(update.sender_id == $('#selected-user-id').val()){
                        loadUserMesssages()
                    }
                }
            }
            if(data['deleted_messages']){
                for(let j in data['deleted_messages']){
                    let deleted = data['deleted_messages'][j]
                    if(deleted.sender_id == $('#selected-user-id').val()){
                        loadUserMesssages()
                    }
                }
            }
        }
    });
}

function deleteMessage(messageId){
    $.ajax({
        url: 'delete-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), message_id : messageId},
        success: function (data) {
            if(data){
                $('#message_'+messageId).remove()
            }
        }
    });
}
$(function(){
    
    //setInterval(checkNewMessages, 1000)

    Echo.private('chat-channel')
    .listen('SendMessage', (e) => {
        //console.log(e);
        let message = e.message;
        let time = new Date(message.updated_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        let msgClass = message.sender_id == userId ? 'justify-start' : 'justify-end'
        let delIcon = ''
        if(msgClass == 'justify-end') {
            delIcon = '<span class="block text-xs text-right ml-2 mt-2 cursor-pointer delMsg" data-msgid="'+message.id+'">X</span>';
        }
        $('#chat-area').append('<div class="w-full flex msgBox '+msgClass+'"><div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;"><span class="block">'+message.text+'</span><span class="block text-xs text-right">'+time+'</span></div>'+delIcon+'</div>');
    });

});

$(document).on("submit","#messageForm",function(e) {
    let msgtext = $('#message').val()
    $('#message').val('')
    $.ajax({
        url: 'send-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), receiver_id : $('#selected-user-id').val(), text : msgtext},
        success: function (data) {
            loadUserMesssages()
        }
    });
    e.preventDefault();
});

$(document).on("click",".user-item",function(e) {
    e.preventDefault();
    $('.user-item').removeClass('bg-gray-100');
    $(this).addClass('bg-gray-100');
    $(this).find('.message-count').remove();
    let userId = $(this).data('id');
    $('#selected-user-id').val(userId);
    $('#receiver_user_name').text($(this).data('name'));
    $('#receiver_user_details, #messageForm').show();
    loadUserMesssages();
});

$(document).on("click",".delMsg",function(e) {
    e.preventDefault();
    let msgId = $(this).data('msgid');
    $(this).parents('.msgBox').remove();
    console.log(msgId);
    $.ajax({
        url: 'delete-message',
        method: "POST",
        data: { _token : $('meta[name="csrf-token"]').attr('content'), message_id : msgId},
        success: function (data) {}
    });
});




