jQuery(document).ready(function($json_data) {
   $.ajax({
     url: '/countGender',
     type: 'GET',
     data: {$json_data: $json_data},
   })
   .done(function(data) {
     Morris.Donut({
            element: 'morris-donut-chart',
            data: data
        });
   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });
});
jQuery(document).ready(function($json_amount) {
   $.ajax({
     url: '/amountTitles',
     type: 'GET',
     data: {$json_amount: $json_amount},
   })
   .done(function(data) {
    var obj = JSON.parse(data);
     new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: [obj[0].title,obj[1].title,obj[2].title,obj[3].title,obj[4].title,obj[5].title,obj[6].title],
      datasets: [{
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#66ff66","#ffff33"],
        data: [obj[0].amount,obj[1].amount,obj[2].amount,obj[3].amount,obj[4].amount,obj[5].amount,obj[6].amount]
      }]
    },
    options: {
      title: {
        display: true,
      }
    }
});
        

   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });

   });

