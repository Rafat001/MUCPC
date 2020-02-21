
<div class="container">
	<form method="post" action="<?= base_url() ?>Teams/createteam" id="teamcreateform">
    Team Name:<br>
    <input type="text" name="teamname" id="teamname" required>
    <br>
		Member 1:<br>
		<input type="text" name="member1" id="member1" required>
		<br>
		Member 2:<br>
		<input type="text" name="member2" id="member2" required>
		<br>
		Member 3:<br>
		<input type="text" name="member3" id="member3" required>
		<br><br>
		<input type="submit" value="Create Team" id="submit">
	</form>
</div>
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize 
     $( "#member1" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"<?=base_url() ?>Teams/suggest",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#member1').val(ui.item.label); // display the selected text
          $('#member1').val(ui.item.value); // save selected id to input
          return false;
        }
      });
	 $( "#member2" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url() ?>Teams/suggest",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#member2').val(ui.item.label); // display the selected text
          $('#member2').val(ui.item.value); // save selected id to input
          return false;
        }
      });
	  
	  $( "#member3" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url() ?>Teams/suggest",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#member3').val(ui.item.label); // display the selected text
          $('#member3').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
	
	// function checker(){
		// var member1 = document.getElementById('member1');
		// var member2 = document.getElementById('member2');
		// var member3 = document.getElementById('member3');
		// if(member1!="" && member2=="" && member3!="")
			// document.getElementById('teamcreateform').submit();
		// else
			
	// }
 
</script>
