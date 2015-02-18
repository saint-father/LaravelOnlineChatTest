
$("#testSelect").change(function(){
    if($(this).val() == 0) return false;
    
    console.log($(this).val());
    
    store.unloadAll("message");
    
    var personId = $(this).val();
    var request = $.ajax({
      url: "/messages/conversation",
      type: "POST",
      data: JSON.stringify({receiverId : $(this).val()}),
      contentType: "application/json; charset=utf-8",
      dataType: "json"
    });

    request.done(function(msg) {
        var curId = 0;
        $.each(msg.messages, function() {
            store.push("message", {
                        "id"            : this.id,
                        "userId"       : this.userId,
                        "userName"     : this.userName,
//                        "userIdClass" : "name-" + data.user.id,
                        "message"       : this.message
                    });
            curId = this.id;
        });
    });

    request.fail(function(jqXHR, textStatus) {
      console.log( "Request failed: " + textStatus );
    });

});