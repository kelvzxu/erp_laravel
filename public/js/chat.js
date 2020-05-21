
// Initialize Firebase
var config = {
    apiKey: "AIzaSyD779zqHDQYZa3FvTpRy3FWG0vcM9aGgII",
    authDomain: "erp-production-9fb08.firebaseapp.com",
    databaseURL: "https://erp-production-9fb08.firebaseio.com",
    projectId: "erp-production-9fb08",
    storageBucket: "erp-production-9fb08.appspot.com",
    messagingSenderId: "907372260705",
    appId: "1:907372260705:web:e700ba2c5f4d8d3115a920"
};
firebase.initializeApp(config);  
var database = firebase.database();
var lastIndex = 0;
let Ip_address = $.get('https://ipapi.co/json/',async function(data) { 
    return data;
    })
var time = new Date(),
    days = time.getDate();
    month = time.getMonth();
    year = time.getFullYear();
    hours = time.getHours(),
    minutes = time.getMinutes(),
    seconds = time.getSeconds();
var datetime = days + "-" + month + "-" + year + " " + hours + ":" + minutes + ":" + seconds;

// Get Chat
var users_name = [];
    firebase.database().ref('/chats').on('value', function(snapshot) {
        var chat_element = "";
        var value = snapshot.val();
        if(snapshot.val() != null) {
            snapshot.val().forEach(function(item, index) {
                var chat_name = item.name,
                    chat_content = item.content;
                users_name[index] = chat_name;
                chat_element += '<div class="o_thread_message   o_mail_discussion " data-message-id="1374">';
                chat_element +='<div class="o_thread_message_sidebar">';
                chat_element +='<div class="o_thread_message_sidebar_image">';
                chat_element +='<img alt="" src="uploads/Employees/'+item.photo+'"class="o_thread_message_avatar rounded-circle " width=30px height=30px>';
                chat_element +='</div>';
                chat_element +='</div>';
                chat_element +='<div class="o_thread_message_core">';
                chat_element +='<p class="o_mail_info text-muted">';
                chat_element +='<strong data-oe-model="res.partner" data-oe-id="" class="o_thread_author ">';
                chat_element += chat_name;
                chat_element +='</strong>';
                chat_element +=' <small class="o_mail_timestamp" title="05/21/2020 21:08:31">'+item.created_at+'</small>';
                chat_element +='</p>';
                chat_element +='<div class="o_thread_message_content">';
                chat_element +='<p>'+chat_content+'</p>'
                chat_element +='</div>'
                chat_element +='</div>'
                chat_element +='</div>'
                $(".card-body").html(chat_element);
                lastIndex = index;
            });

        }else{
            $(".card-body").html("<i class='text-center'>No chat</i>")
        }

        users_name = users_name.reverse();
        users_name = $.unique(users_name);

        var html_name = "";
        for(var i = 0; i < users_name.length; i++) {
            if(users_name[i] != undefined)
                html_name += users_name[i] + ', ';
        }

        $(".card-header .users").html(html_name.substring(0, html_name.length - 2));
        old_users_val = $(".users").html();

    }, function(error) {
        alert('ERROR! Please, open your console.')
        console.log(error);
    });

// send message
$('#send_message').on('click',async function(e){
    e.preventDefault()
    let r = Math.random().toString(36).substring(7);
    var values = $("#chat-form").serializeArray();
    var message = values[0].value;
    var name = values[1].value;
    var image = values[2].value;
    var Get_ip = await Ip_address;
    var type = "chat";
    var date = datetime;
    var id = lastIndex+1;

    firebase.database().ref('chats/' + id).set({
        name: name,
        content: message,
        ip: Get_ip.ip,
        id:id,
        type: type,
        photo: image,
        created_at: date
    });
    $("#content").val("");
});