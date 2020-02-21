<?php if(!isset($this->group)) {
  redirect(base_url());
} ?>
<?php
set_time_limit(0);
$group = $this->group;
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="details-tab" href="<?= base_url() . "group/" . $group->id ?>">Details</a>
  </li>
  <?php if($this->username == $group->mentor || $this->Group_model->get_participation_by_id(array("group_id" => $group->id, "username" => $this->username)) != false): ?>
  <li class="nav-item">
    <a class="nav-link active" id="chat-tab">Chat</a>
  </li>
  <?php if($this->username == $group->mentor && $this->session->userdata('role') == "mentor"):?>
  <li class="nav-item">
    <a class="nav-link" href="?locate=settings">Settings</a>
  </li>
  <?php endif?>
<?php endif ?>

</ul>
<div class="tab-content" id="myTabContent" style="margin-top: 10px">
  <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  
  <?php if($this->username == $group->mentor || $this->Group_model->get_participation_by_id(array("group_id" => $group->id, "username" => $this->username)) != false): ?>
  <div class="tab-pane fade <?php if($this->input->get('locate') == "chat") echo("show active") ?>" id="chat" role="tabpanel" aria-labelledby="chat-tab">
    <div id="get_messages" style="overflow-y: scroll; height:70%;"> </div>
      <form method="post" action="<?= base_url() ?>Teams/send_chat">
        <div class="input-group mb-3">
          <input name="message" id="message" class="form-control" type="text" placeholder="Type your message" aria-label="Default" aria-describedby="inputGroup-sizing-default" required="">
          <button class="btn btn-success" type="submit" id="btn_send"><span class="fas fa-send"></span> Send</button>
        </div>
        <input type="text" name="group_id" id="group_id" value="<?=$group->id ?>" hidden> 
      </form>
  </div>
<?php endif ?>
</div>

<!-- <script type="text/javascript">
  function getMessages(){
    ("#get_messages").load("<?=base_url() ?>Teams/get_chats/<?=$group->id?>");
  }
</script> -->

<script>
    var c=0;
    var id = 0;
    $(document).ready( function(){

                setInterval(show_chats, 1000);
                setInterval(updateScroll, 1000);

                //set scroll to bottom at first glance
                function updateScroll(){
                    var element = document.getElementById("get_messages");
                    if(c==0){
                        c=c+1;
                        element.scrollTop = element.scrollHeight;
                    }
                }

                $('#btn_send').on('click',function(){
                    var group_id = $('#group_id').val();
                    var message = $('#message').val();
                    c=0;
                    $.ajax({
                        type : "POST",
                        url  : "<?=base_url() ?>Groups/send_chat", 
                        dataType : "JSON",
                        data : {group_id:group_id , message:message, sender:"<?= $this->username ?>"},
                        success: function(data){
                            $('[name="message"]').val("");
                            c=0;
                            show_chats();
                        }
                    });
                    return false;
                });

                //show_chats without refreshing page
                function show_chats(){
                  //alert("dukse");
                  $.ajax({
                    type      : 'ajax',
                    url       : "<?=base_url() ?>Groups/get_chats/<?=$group->id?>", 
                    async     : true,
                    dataType  : 'json',
                    success   : function(data){
                      var html = '';
                      var i;
                      var prv = id;
                      var username= "<?= $this->session->userdata('username') ?>";
                      for(i=0; i<data.length; i++){
                        if(data[i].sender=== username )
                        {
                          /*html += '<div class="container darker">'+
                                  '<h5 align="right"> me </h5>' +
                                  '<p align="right">'+data[i].body+'</p>'+
                                  '<span class="time-right">'+data[i].created_on + '</span>'+
                                  '</div>';*/

                                 html+= '<div style="margin-left: 30%;margin-bottom: 20px" class="card text-white bg-primary mb-3 text-right" style="max-width: 18rem;">'+
                                    '<div style="margin:0px; padding: 5px;" class="card-header"><img class="rounded" width="20" style="margin-left: 5px; float: right;" width="20" src="<?= base_url() . $this->session->userdata('photo') ?>"/><p style="font-family: UbuntuMono-R; font-size: 12px; margin:0px; padding:0px; float: left">'+ data[i].created_on+'</p> <p style="margin:0px; padding:0px; float:right; font-weight:bold;">me</p></div>'+
                                    '<div style="margin:0px; padding: 5px" class="card-body">'+
                                    '<p class="card-text">'+data[i].body+'</p>'+
                                    '</div>'+
                                  '</div>';

                        }
                        else
                        {
                          html+= '<div style="margin-right: 30%;margin-bottom: 20px" class="card bg-light mb-3 text-left" style="max-width: 18rem;">'+
                                    '<div style="margin:0px; padding: 5px;" class="card-header"><p style="font-family: UbuntuMono-R; font-size: 12px; margin:0px; padding:0px; float: right">'+ data[i].created_on+'</p><img style="margin-right: 5px; float:left" class="rounded" width="20" width="20" src="<?=base_url() ?>'+ data[i].photo +'"/><a href="<?=base_url()?>profile/'+ data[i].sender+'" style="margin:0px; text-decoration:none; padding:0px; float: left; font-weight:bold;">'+ data[i].sender+'</a></div>'+
                                    '<div style="margin:0px; padding: 5px" class="card-body">'+
                                    '<p class="card-text">'+data[i].body+'</p>'+
                                    '</div>'+
                                  '</div>';
                        }
                        id = data[i].id;
                      }
                      if(prv != id) {
                        c = 0;
                      }

                      $('#get_messages').html(html);
                    }
                  })
                }
            });
</script>