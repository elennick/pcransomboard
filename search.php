<?php include 'header.php' ?>

<center><div style="font-size: 16pt; font-weight: bold; margin-bottom: 16px;">Search</div></center>

<center>Enter Search Terms:&nbsp<input type="textfield" id="searchTerms" size="30">&nbsp;<input type="button" id="goSearchButton" value="Search!" onclick="submitSearch();">

<center><div id="searchResults" style="padding-top: 20px;"></div></center>

<script type="text/javascript">
function submitSearch() {
	var searchText = Ext.get('searchTerms').getValue();

	if(searchText.length <= 0) {
		Ext.Msg.alert('Search Error', 'Search Text Cannot Be Blank!');
	}
	else {
		var params = {
			searchText: searchText
		}

 	 	var searchResultsDiv = Ext.get('searchResults');
		searchResultsDiv.load({
			url: 'ajax/search_results_ajax.php' , 
			params: params,
			method: 'POST',
			text: 'Getting Search Results...',
      		success: searchSuccess.createDelegate(this),
      		failure: searchFailure.createDelegate(this)
      	});
	}
}

function searchSuccess(responseText) {
	var searchResultsDiv = Ext.get('searchResults');
	searchResultsDiv.update(responseText);
}

function searchFailure() {
	var searchResultsDiv = Ext.get('searchResults');
	searchResultsDiv.update('Unable to display search results!');
}	
</script>

<?php include 'footer.php' ?>