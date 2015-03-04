<?php include 'header.php' ?>

<div id="adminPageContent"></div>

<script type="text/javascript">
Ext.onReady(function(){
	Ext.Msg.prompt('Password', 'Admin Password:', function(btn, text){
    		if (btn == 'ok'){
			var params = {
				password: text
			}

  			var adminPageContentDiv = Ext.get('adminPageContent');
			adminPageContentDiv.load({
				url: 'ajax/load_admin_page_ajax.php' , 
				params: params,
				method: 'POST',
				text: 'Loading...',
                		success: adminPasswordSuccess.createDelegate(this),
                		failure: adminPasswordFail.createDelegate(this)
            		});	
    		}
		else {
			adminPasswordFail();
		}
	});
});

function adminPasswordFail(responseObject) {
	Ext.get('adminPageContent').update('Unable to Display Admin Page!');
}

function adminPasswordSuccess(responseObject) {
	Ext.get('adminPageContent').update(responseObject.responseText);
}

function editButtonClicked(ransomId) {
	alert('Edit Button Not Yet Implemented (Give Me A Break! There Is A Lot To Do!)');
}

function deleteButtonClicked(ransomId) {
	Ext.Msg.show({
   		title: 'Delete',
   		msg: 'Are You Sure You Want To Delete This Ransom Entry?',
   		buttons: Ext.Msg.YESNO,
   		fn: function(btn) {
			if(btn == 'yes') {
				var params = {
					ransomId: ransomId
				}

			        Ext.Ajax.request({
                			url:     'ajax/delete_ransom_ajax.php',
                			params:  params,
                			method:  'POST',
                			success: function() {
						location.reload(true);	
					}
            			});
			}
		}
	});
}
</script>

<?php include 'footer.php' ?>