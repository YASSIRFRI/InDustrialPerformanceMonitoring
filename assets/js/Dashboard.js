console.log("Dashboard.js loaded");
function updateTable() {

    var selectedMonth = document.getElementById('month-select').value.split('-')[1];
    var selectedYear = document.getElementById('month-select').value.split('-')[0];
    var selectedSortColumn = document.getElementById('sort-select').value;

    
    // Make a request to the server with the selected month and sort column
    var requestUrl = '../controllers/DataController.php?item=1&year=' + selectedYear + '&sort=' + selectedSortColumn + '&month=' + selectedMonth;
    fetch(requestUrl)
      .then(function(response) {
        // Check if the response is successful
        if (response.ok) {
            console.log(response);
          return response.text(); // Convert the response to HTML
        } else {
          throw new Error('Error: ' + response.status); // Handle the error if the response is not successful
        }
      })
      .then(function(htmlResponse) {
        // Handle the HTML response
        // Inject the HTML into the desired element on the page
        document.getElementById('flows-table').innerHTML = htmlResponse;
      })
      .catch(function(error) {
        // Handle any errors that occurred during the request
        console.error('Error:', error);
      });
  }
monthInput=document.getElementById('month-select');
sortInput=document.getElementById('sort-select');
monthInput.addEventListener('change', updateTable);
sortInput.addEventListener('change', updateTable);


function updateInventory()
{
    var selectedMonth = document.getElementById('month-select-entity').value.split('-')[1];
    var selectedYear = document.getElementById('month-select-entity').value.split('-')[0];
    var selectedSortColumn = document.getElementById('sort-select-entity').value;

    var requestUrl = '../controllers/DataController.php?item=2&year=' + selectedYear + '&sort=' + selectedSortColumn + '&month=' + selectedMonth;
    fetch(requestUrl)
      .then(function(response) {
        // Check if the response is successful
        if (response.ok) {
            console.log(response);
          return response.text(); // Convert the response to HTML
        } else {
          throw new Error('Error: ' + response.status); // Handle the error if the response is not successful
        }
      })
      .then(function(htmlResponse) {
        // Handle the HTML response
        // Inject the HTML into the desired element on the page
        document.getElementById('entity-table').innerHTML = htmlResponse;
      })
      .catch(function(error) {
        // Handle any errors that occurred during the request
        console.error('Error:', error);
      });


}
monthInputEntity=document.getElementById('month-select-entity');
sortInputEntity=document.getElementById('sort-select-entity');
monthInputEntity.addEventListener('change', updateInventory);
sortInputEntity.addEventListener('change', updateInventory);


