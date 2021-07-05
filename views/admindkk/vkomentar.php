<script>
$(document).ready(function(){
  getdialog();
  // setInterval(function(){ambilpesan()},1000);
  $('#chat-box').slimScroll({
    height: '450px'
  });
  $('#message-box').slimScroll({
    height: '385px'
  });
  $('.dialogs-list').on('click','.item',function(event){
    $(".loading").show();
    var chatId = $(this).attr("chatid");
    var image = $(this).attr("image");
    var nama = $(this).attr("nama");
    $("[name='chatId']").val(chatId);
    $("[name='img']").val(image);
    $("[name='nama']").val(nama);
    getmessage(chatId,nama);
  });
  $("[name='message']").keyup(function(e){
    var code = e.which; // recommended to use e.which, it's normalized across browsers
    if(code==13){
      e.preventDefault();
      $('.send').click();
    }
  });
  $('.send').click(function(){
    $(".loading").show();
    var body = $("[name='message']").val();
    var chatId = $("[name='chatId']").val();
    var nama = $("[name='nama']").val();
    var base_url = "<?php echo site_url("admindkk/simpankomentar");?>";
    $.ajax({
      url   : base_url,
      type : "POST",
      data : {chatId: chatId,jawab: body},
      success: function(result){
        console.log(result);
        $("[name='message']").val('');
        $(".loading").hide();
        getmessage(chatId,nama);
      }
    });
  });
});
function timeConverter(UNIX_timestamp,tipe=1){
  var time = UNIX_timestamp.split(" ");
  var tgl = time[0].split("-");
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = tgl[0];
  var month = months[parseInt(tgl[1])];
  var date = tgl[2];
  if (tipe==1)
  var timer = date + ' ' + month + ' ' + year + ' ' + time[1] ;
  else
  var timer = date + '/' + month+ '/' + year;
  return timer;
}
function getdialog(){
  $(".loading").show();
  var html = "";
  var base_url = "<?php echo base_url("admindkk/getparent");?>";
  $.ajax({
    url   : base_url,
    type : "POST",
    success: function(result){
      console.log(result);
      $.each(JSON.parse(result),function(key, value){
          img = "<?php echo base_url()."img/avatar2.png"; ?>";
          html += '<div class="item" chatid="'+value.id+'" image="'+img+'" nama="'+value.nama+'">';
          html += '	<img src="'+img+'" alt="user image" class="online">';
          html += '	<p class="message">';
          html += '  		<a href="#" class="name">';
          html += '    		<small class="text-muted pull-right"><i class="fa fa-clock-o"></i>&nbsp;'+timeConverter(value.tanggal,1)+'</small>';
          html += '    			'+value.nama;
          html += '  		</a>';
          html += '       '+value.jawab.replace("?","").substring(0,100);
          html += '	<br></p>';
          html +=	'</div>';
      });
      $('.dialogs-list').html(html);
      $(".loading").hide();
    }
  });
}
function getlast(chatId){
  var base_url = "https://api.chat-api.com/instance74123/messages?token=hfkmr7zjpiurt43j&last=1&chatId="+chatId+"&limit=1";
  var html = "";
  $.ajax({
    async : false,
    url   : base_url,
    type : "GET",
    dataType : 'json',
    success: function(result){
      $.each(result.messages,function(key, value){
        html = value.body.substring(0,100);
      });
    }
  });
  return (html=="" ? "<br>" : html);
};
function getmessage(chatId,nama){
  $(".loading").show();
  $('.message-list').empty();
  var base_url = "<?php echo site_url("admindkk/getmessage");?>";
  var html = "";
  $.ajax({
    async : false,
    url   : base_url,
    type : "POST",
    data : {id : chatId},
    success: function(result){
      $(".loading").hide();
      var hasil = JSON.parse(result);
      console.log(hasil.child);
      $.each(hasil.parent,function(key, value){
          if (parseInt(value.admin)!=1) {
            var foto = "<?php echo base_url();?>img/avatar2.png";
            var posisi = "left";
          } else {
              var foto = "<?php echo base_url();?>img/Logo.png";
              var posisi = "right";
          }
          html += '    <div class="direct-chat-msg '+posisi+'">';
          html += '      <div class="direct-chat-info clearfix">';
          html += '        <span class="direct-chat-name pull-right">Guest</span>';
          html += '        <span class="direct-chat-timestamp pull-left">'+timeConverter(value.tanggal,1)+'</span>';
          html += '      </div>';
          html += '      <img class="direct-chat-img" src="'+foto+'" alt="message user image">';
          html += '      <div class="direct-chat-text">'+value.jawab+'</div>';
          html += '   </div>';
          // $("[name='messageNumber']").val(value.messageNumber);
      });
      $.each(hasil.child,function(key, value){
          if (parseInt(value.admin)!=1) {
            var foto = "<?php echo base_url();?>img/avatar2.png";
            var posisi = "left";
          } else {
              var foto = "<?php echo base_url();?>img/Logo.png";
              var posisi = "right";
          }
          html += '    <div class="direct-chat-msg '+posisi+'">';
          html += '      <div class="direct-chat-info clearfix">';
          html += '        <span class="direct-chat-name pull-right">Me</span>';
          html += '        <span class="direct-chat-timestamp pull-left">'+timeConverter(value.tanggal,1)+'</span>';
          html += '      </div>';
          html += '      <img class="direct-chat-img" src="'+foto+'" alt="message user image">';
          html += '      <div class="direct-chat-text">'+value.jawab+'</div>';
          html += '   </div>';
          // $("[name='messageNumber']").val(value.messageNumber);
      });
      // $(".loading").hide();
    }
  });
  $('.message-list').html(html);
  html  = '<div class="chat">';
  html += '	<div class="item">';
  html += '		<img src="'+img+'" alt="user image" class="online">';
  html += '		<p class="message">';
  html += '	  		<a href="#" class="name">'+nama;
  html +=	'			</a>';
  html +=	'		</p>';
  html +=	'	</div>';
  html +=	'</div>';
  $('.message-title').html(html);
  $(".direct-chat-messages").scrollTop(parseInt($(".direct-chat-messages").prop("scrollHeight"))+500);
};
function ambilpesan(){
  var chatId = $("[name='chatId']").val();
  var img = $("[name='img']").val();
  var nama = $("[name='nama']").val();
  var base_url = "https://api.chat-api.com/instance74123/messages?token=hfkmr7zjpiurt43j&last=1&chatId="+chatId+"&limit=1";
  var html = "";
  var ada = 0;
  if (chatId!=""){
    $.ajax({
      async : false,
      url   : base_url,
      type : "GET",
      dataType : 'json',
      success: function(result){
        $(".loading").hide();
        console.log(result);
        $.each(result.messages,function(key, value){
          if (value.messageNumber!=$("[name='messageNumber']").val()){
            if (value.fromMe){
              html += '    <div class="direct-chat-msg right">';
              html += '      <div class="direct-chat-info clearfix">';
              html += '        <span class="direct-chat-name pull-right">Me</span>';
              html += '        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>';
              html += '      </div>';
              html += '      <img class="direct-chat-img" src="img/avatar2.png" alt="message user image">';
              if (value.type=="image")
              html += '<img class="img-thumbnail pull-right" src="'+value.body+'" style="max-width: 50%">';
              else
              html += '      <div class="direct-chat-text">'+value.body+'</div>';
              html += '   </div>';
            } else {
              html += '    <div class="direct-chat-msg left">';
              html += '      <div class="direct-chat-info clearfix">';
              html += '        <span class="direct-chat-name pull-left">'+value.senderName+'</span>';
              html += '        <span class="direct-chat-timestamp pull-right">23 Jan 2:05 pm</span>';
              html += '      </div>';
              html += '      <img class="direct-chat-img" src="img/avatar2.png" alt="message user image">';
              if (value.type=="image")
              html += '<img class="img-thumbnail" src="'+value.body+'" style="max-width: 50%">';
              else
              html += '      <div class="direct-chat-text">'+value.body+'</div>';
              html += '    </div>';
            }
            ada = 1;
          }
        });
        $("[name='messageNumber']").val(result.lastMessageNumber);
      }
    });
    $('.message-list').append(html);
    html  = '<div class="chat">';
    html += '	<div class="item">';
    html += '		<img src="'+img+'" alt="user image" class="online">';
    html += '		<p class="message">';
    html += '	  		<a href="#" class="name">'+nama;
    html +=	'			</a>';
    html +=	'		</p>';
    html +=	'	</div>';
    html +=	'</div>';
    $('.message-title').html(html);
  }
  if (ada)
  $(".direct-chat-messages").scrollTop(parseInt($(".direct-chat-messages").prop("scrollHeight"))+200);
};
</script>
<div class="col-xs-4">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="fa fa-comments-o"></i>
      <h3 class="box-title">Kritik dan Saran</h3>
    </div>
    <div class="box-body chat" id="chat-box">
      <div class="dialogs-list"></div>
    </div>
  </div>
</div>
<div class="col-xs-8">
  <div class="box box-primary direct-chat direct-chat-success">
    <div class="box-header with-border">
      <span class="message-title">
        <i class="fa fa-comments-o"></i>
        <h3 class="box-title">Chat</h3>
      </span>
    </div>
    <div class="box-body" id="message-box">
      <div class="direct-chat-messages">
        <div class="message-list margin"></div>
      </div>
    </div>
    <div class="box-footer">
      <div class="input-group">
        <input type="hidden" name="messageNumber">
        <input type="hidden" name="chatId">
        <input type="hidden" name="img">
        <input type="hidden" name="nama">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
        <span class="input-group-btn">
          <button type="button" class="send btn btn-success btn-flat">Send</button>
        </span>
      </div>
    </div>
  </div>
</div>
<div class='loading modal'>
  <div class='text-center align-middle' style="margin-top: 200px">
    <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
      <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url()."img/load.gif";?>" width="150px"></div>
      <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-5"></div>
  </div>
</div>
